<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\forSelector;
use App\Http\Requests\UpdateOrderRequest;
use App\Traits\OrderServices;
use App\Traits\UserReviewServices;

class OrderController extends Controller
{
    use forSelector, OrderServices, UserReviewServices;

    public function __construct()
    {
        //
    }

    /**
     * Displays a list of orders
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('employee_views.orders.index')
            ->with('orders', $this->getOrders(auth()->user()->type));
    }

    /**
     * Display order details
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $order = $this->getOrderById($id);
        $orderItems = $this->getOrderItems($id);

        $this->checkIfOrderItemIsReturned($orderItems);
        $this->setOrderItemCountSum($orderItems);

        return view('employee_views.orders.show')
            ->with([
                'order' => $order,
                'reviewAverageRating' => [
                    'user' => $this->getReviewRatingAverage($order->user),
                    'specialist' => $this->getReviewRatingAverage($order->specialist),
                ],
                'orderItems' => $orderItems,
                'specialistList' => $this->orderSpecialistForSelector(),
                'statusList' => $this->orderStatusesForSelector(),
                'priorityList' => $this->orderPrioritiesForSelector(),
                'logs' => $this->getOrderLogs($id)->sortDesc(),
                'orderItemCountSum' => $this->getOrderItemCountSum()
            ]);
    }

    /**
     * Update the specified order
     *
     * @param int $id
     * @param UpdateOrderRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateOrderRequest $request)
    {
        try {
            $order = $this->getOrderById($id);

            $this->setUpdateOrderLogs($order, $request, $id);

            $order->specialist_id = $request->specialist_id;
            $order->status_id = $request->status_id;
            $order->priority_id = $request->priority_id;
            $order->delivery_time = $request->delivery_time;
            $order->updated_at = now();
            $order->save();

            return back()->with('success', __('messages.successUpdateOrder'));
        }
        catch (\Throwable $exception) {
            return back()->with('error', $exception);
        }
    }
}
