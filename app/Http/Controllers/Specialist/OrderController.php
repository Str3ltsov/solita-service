<?php

namespace App\Http\Controllers\Specialist;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\forSelector;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderUserActivities;
use App\Traits\OrderServices;
use App\Traits\UserReviewServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends AppBaseController
{
    use forSelector, OrderServices, UserReviewServices;

    public function index(): Factory|View|Application
    {
        return view('specialist_views.orders.index')
            ->with('orderUsers', $this->getSpecialistOrders(auth()->user()->id));
    }

    public function show(int $id): Factory|View|Application
    {
        $order = $this->getOrderById($id);
//        $orderItems = $this->getOrderItems($id);
//
//        $this->checkIfOrderItemIsReturned($orderItems);
//        $this->setOrderItemCountSum($orderItems);

        return view('specialist_views.orders.show')
            ->with([
                'order' => $order,
                'orderUser' => $this->getOrderUser($id, auth()->user()->id)->first(),
                'reviewAverageRating' => [
                    'user' => $order->user->average_rating,
                    'employee' => $order->employee->average_rating,
                ],
//                'orderItems' => $orderItems,
//                'statusList' => $this->orderStatusesForSelector(),
//                'priorityList' => $this->orderPrioritiesForSelector(),
//                'orderItemCountSum' => $this->getOrderItemCountSum(),
                'specActivities' => $this->getOrderUserActivitiesById($id, auth()->user()->id),
                'logs' => $this->getOrderLogs($id)->sortDesc(),
                'orderFileExtensions' => $this->getOrderFileExtensions($order->files)
            ]);
    }

    public function update(int $id, UpdateOrderRequest $request): RedirectResponse
    {
        try {
            $order = $this->getOrderById($id);

            $this->setUpdateOrderLogs($order, $request, $id);

            $order->status_id = $request->status_id;
            $order->priority_id = $request->priority_id;
            $order->delivery_time = $request->delivery_time;
            $order->updated_at = now();
            $order->save();

            return back()->with('success', __('messages.successUpdateOrder'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    public function addHours(int $id, Request $request): RedirectResponse
    {
        $orderUser = $this->getOrderUser($id, auth()->user()->id)->first();
        $orderUserHoursLeft = $orderUser->hours - $orderUser->complete_hours;
        $validated = $request->validate(['hours' => "required|integer|min:1|max:$orderUserHoursLeft"]);

        try {
            $newAddedHours = OrderUserActivities::create([
                'order_id' => $id,
                'user_id' => auth()->user()->id,
                'hours' => $validated['hours'],
                'created_at' => now()
            ]);

            $orderUser->complete_hours = $orderUser->complete_hours + $newAddedHours->hours;
            $orderUser->complete_percentage = round($orderUser->complete_hours * 100 / $orderUser->hours, 2);
            $orderUser->updated_at = now();
            $orderUser->save();

            $order = $this->getOrderById($id);
            $order->complete_hours = $order->complete_hours + $newAddedHours->hours;
            $order->updated_at = now();
            $order->save();

            $this->updateSpecialistOccupation(
                $this->getOrderUser($id, auth()->user()->id)->pluck('user_id')->toArray()
            );

            return back()->with('success', __('messages.successSpecAddHours'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }
}
