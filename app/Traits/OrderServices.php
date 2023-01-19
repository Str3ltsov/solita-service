<?php

namespace App\Traits;

use App\Models\LogActivity;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPriority;
use App\Models\OrderStatus;
use App\Models\OrderUser;
use App\Models\User;

trait OrderServices
{
    use ReturnServices;

    public static int $orderItemCountSum = 0;

    public function getOrders()
    {
        return Order::all()->where('employee_id', auth()->user()->id);
    }

    public function getSpecialistOrders(int $specialistId)
    {
        return OrderUser::all()->where('user_id', $specialistId);
    }

    public function getOrderById(string $id)
    {
        return Order::find($id);
    }

    public function getOrderItems(string $id)
    {
        return OrderItem::select('id', 'order_id', 'product_id', 'price_current', 'count')
            ->where('order_id', $id)
            ->get();
    }

    public function checkIfOrderItemIsReturned(object $orderItems): void
    {
        foreach ($orderItems as $orderItem) {
            $returnItemProductId = $this->getReturnItemByProductId($orderItem->product_id);

            if ($orderItem->product_id === $returnItemProductId) {
                $orderItem->setAttribute('isReturned', 'Returned');
            }
        }
    }

    public function getOrderLogs(string $id)
    {
        return LogActivity::search("Order ID:{$id}")->get();
    }

    public function getOrderItemCountSum(): int
    {
        return self::$orderItemCountSum;
    }

    public function setOrderItemCountSum(object $orderItems): void
    {
        foreach ($orderItems as $orderItem) {
            self::$orderItemCountSum += $orderItem->count;
        }
    }

    private function getOrderSpecialist(int $specialistId)
    {
        return User::where('id', $specialistId)->value('name');
    }

    private function getOrderStatus(int $statusId)
    {
        return OrderStatus::where('id', $statusId)->value('name');
    }

    private function getOrderPriority(int $priorityId)
    {
        return OrderPriority::where('id', $priorityId)->value('name');
    }

    public function setUpdateOrderLogs(object $order, object $request, string $id): void
    {
        $user = auth()->user();
//        $orderSpecialist = $this->getOrderSpecialist($request->specialist_id);
        $orderStatus = $this->getOrderStatus($request->status_id);
        $orderPriority = $this->getOrderPriority($request->priority_id);

//        if ($order->specialist_id != $request->specialist_id)
//            $user->log("{$user->role->name}:{$user->name} set Order ID:{$id} Specialist to:{$orderSpecialist}");

        if ($order->status_id != $request->status_id)
            $user->log("{$user->role->name}:{$user->name} set Order ID:{$id} Status to:{$orderStatus}");

        if ($order->priority_id != $request->priority_id)
            $user->log("{$user->role->name}:{$user->name} set Order ID:{$id} Priority to:{$orderPriority}");

        if ($order->delivery_time != $request->delivery_time)
            $user->log("{$user->role->name}:{$user->name} set Order ID:{$id} Delivery Time to:{$request->delivery_time} days");
    }
}
