<?php

namespace App\Http\Controllers\Employee;

use App\Events\OrderStatusUpdated;
use App\Http\Controllers\Controller;
use App\Http\Controllers\forSelector;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\OrderFile;
use App\Models\OrderUser;
use App\Traits\OrderFileServices;
use App\Traits\OrderServices;
use App\Traits\UserReviewServices;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{
    use forSelector, OrderServices, UserReviewServices, OrderFileServices;

    /*
     * Orders page.
     */
    public function index(): View|Factory|Application
    {
        return view('employee_views.orders.index')
            ->with('orders', $this->getOrders());
    }

    /*
     * Order details page.
     */
    public function show(int $id): View|Factory|Application
    {
        $order = $this->getOrderById($id);
//        $orderItems = $this->getOrderItems($id);

//        $this->checkIfOrderItemIsReturned($orderItems);
//        $this->setOrderItemCountSum($orderItems);

        return view('employee_views.orders.show')
            ->with([
                'order' => $order,
//                'orderItems' => $orderItems,
//                'specialistList' => $this->orderSpecialistForSelector(),
                'statusList' => $this->orderStatusesForSelector(),
                'priorityList' => $this->orderPrioritiesForSelector(),
                'orderFileExtensions' => $this->getOrderFileExtensions($order->files),
                'logs' => $this->getOrderLogs($id)->sortDesc(),
//                'orderItemCountSum' => $this->getOrderItemCountSum(),
                'specialistCount' => count($this->getNotAddedSpecialists($order->specialists)),
                'specActivities' => $this->getOrderUserActivitiesForMany($id, $order->specialists),
            ]);
    }

    /*
     * Form that updates order.
     */
    public function update(int $id, UpdateOrderRequest $request)
    {
            $order = $this->getOrderById($id);

            $this->checkSpecialistAndOrderHours($order, $request->total_hours);
            $this->setUpdateOrderLogs($order, $request, $id);

            if ($order->status_id != $request->status_id)
                event(new OrderStatusUpdated($order, $request->status_id));

            $order->status_id = $request->status_id;
            $order->priority_id = $request->priority_id;
            $order->budget = $request->budget;
            $order->total_hours = $request->total_hours;
            $order->end_date = $request->end_date;
            $order->updated_at = now();
            $order->save();

            if ($order->status_id == Order::COMPLETED) {
                $this->deleteEcommerceOffer($id);

                $orderPath = public_path()."/documents/orders/$order->id";

                $this->createDirForOrderFiles($orderPath);
                $this->createVatInvoice($order, $orderPath);
                $this->createTACertificate($order, $orderPath);
            }

            return back()->with('success', __('messages.successUpdateOrder'));
    }

    /*
     * Add order specialists page.
     */
    public function addOrderSpecialist(int $id): Factory|View|Application
    {
        $order = $this->getOrderById($id);
        $orderSpecialists = $this->getNotAddedSpecialists($order->specialists);

        return view('employee_views.orders.add_specialist')
            ->with([
                'order' => $order,
                'specialists' => $orderSpecialists,
                'specialistAverageRating' =>  $this->getReviewAverageRatingSpecialists($orderSpecialists)
            ]);
    }

    /*
     * Form that adds order specialists.
     */
    public function addOrderSpecialistSave(int $id, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'specialistsIds' => 'required',
            'specialistsHours' => 'required'
        ]);

        try {
            $specIds = explode(',', $validated['specialistsIds']);
            $specHours = explode(',', $validated['specialistsHours']);

            $this->createOrderSpecialists($specIds, $specHours, $id);
            $this->updateSpecialistOccupation($specIds);

            return redirect()
                ->route('employeeOrderDetails', $id)
                ->with('success', __('messages.successAddOrderSpec'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    /*
     * Form that updates order specialist hours.
     */
    public function updateOrderSpecialists(int $id, Request $request): RedirectResponse
    {
        $validated = $request->validate(['specHours' => 'required']);

        try {
            $specHours = explode(',', $validated['specHours']);

            $orderUsers = OrderUser::where('order_id', $id)->get();

            foreach ($orderUsers as $key => $orderUser) {
                $orderUser->hours = $specHours[$key];
                $orderUser->complete_percentage = round($orderUser->complete_hours * 100 / $orderUser->hours, 2);
                $orderUser->updated_at = now();
                $orderUser->save();
            }

            $this->updateSpecialistOccupation($orderUsers->pluck('user_id')->toArray());

            return back()->with('success', __('messages.successUpdateOrderSpec'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    /*
     * Form that deletes order specialists.
     */
    public function deleteOrderSpecialist(int $id): RedirectResponse
    {
        try {
            $orderUser = OrderUser::find($id);
            $orderUser->delete();

            $specIds = [];
            $specIds[] = $orderUser->user_id;

            $this->updateSpecialistOccupation($specIds);
            $this->subtractSpecialistCompleteHours($orderUser);

            return back()->with('success', __('messages.successDeleteOrderSpec'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    /*
     * Generates a commerce offer pdf file for an order.
     */
    public function generateCommerceOffer(int $id): RedirectResponse
    {
        try {
            $order = $this->getOrderById($id);
            $order->generated_com_offer = true;
            $order->save();

            $offersPath = public_path().'/documents/offers';

            $this->createDirForOrderFiles($offersPath);
            $this->createEcommerceOffer($order, $offersPath);

            return back()->with('success', __('messages.successGeneratedComOffer'));
        }
        catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
