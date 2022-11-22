<?php

namespace App\Http\Controllers\Specialist;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\forSelector;
use App\Http\Requests\UpdateOrderRequest;
use App\Traits\OrderServices;

class OrderController extends AppBaseController
{
    use forSelector, OrderServices;

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
        return view('specialist_views.orders.index')
            ->with([
                'orders' => $this->getOrders(auth()->user()->type)
            ]);
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
        $orderItems = $this->getOrderItems($id);

        $this->setOrderItemCountSum($orderItems);
        return view('specialist_views.orders.show')
            ->with([
                'order' => $this->getOrderById($id),
                'orderItems' => $orderItems,
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

            $this->setUpdateLogs($order, $request, $id);

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
