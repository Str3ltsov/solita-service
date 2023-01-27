<?php

namespace App\Traits;

use App\Models\LogActivity;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPriority;
use App\Models\OrderStatus;
use App\Models\OrderUser;
use App\Models\OrderUserActivities;
use App\Models\Role;
use App\Models\SpecialistOccupation;
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

    public function getOrderUser(int $orderId, $userId)
    {
        return OrderUser::where([
            'order_id' => $orderId,
            'user_id' => $userId
        ])->get();
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

    public function getOrderUserActivitiesById(int $orderId, int $userId)
    {
        return OrderUserActivities::where([
            'order_id' => $orderId,
            'user_id' => $userId
        ])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getOrderUserActivitiesForMany(int $orderId, object $specialists)
    {
        $totalActivities = collect();

        foreach ($specialists as $specialist) {
            $activities = OrderUserActivities::select('id', 'order_id', 'user_id', 'hours', 'created_at')
                ->where('order_id', $orderId)
                ->where('user_id', $specialist->user->id)
                ->get();

            $totalActivities = $totalActivities->merge($activities);
        }

        return $totalActivities->sortByDesc('created_at');
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

    public function checkSpecialistAndOrderHours(object $order, float $totalHours): void
    {
        $specHoursSum = 0;

        foreach ($order->specialists as $specialist) {
            $specHoursSum += $specialist->hours;
        }

        if ($totalHours < $specHoursSum)
            throw new \Error(__('messages.errorMoreHours'));
    }

    private function getSpecialists()
    {
        return User::where('type', 2)->get();
    }

    public function getNotAddedSpecialists(object $orderSpecs): object
    {
        $specialists = $this->getSpecialists();

        foreach ($specialists as $key => $specialist) {
            if (isset($orderSpecs[$key]->user_id) && $specialist->id === $orderSpecs[$key]->user_id)
                $specialists->forget($key);
        }

        return $specialists;
    }

    private function createOrderSpecialists(array $specIds, array $specHours, int $id): void
    {
        foreach ($specIds as $key => $specId) {
            OrderUser::firstOrCreate([
                'order_id' => $id,
                'user_id' => $specId,
                'hours' => $specHours[$key],
                'complete_hours' => 0,
                'complete_percentage' => 0
            ]);
        }
    }

    private function calculateSpecialistOccupation(int $specId): float
    {
        $orderUsers = OrderUser::where('user_id', $specId)->get();
        $hoursSum = 0;
        $completeHoursSum = 0;

        foreach ($orderUsers as $orderUser) {
            $hoursSum += $orderUser->hours;
            $completeHoursSum += $orderUser->complete_hours;
        }

        $uncompletedHours = $hoursSum - $completeHoursSum;

        return round(($uncompletedHours / $hoursSum * 100), 2);
    }

    public function updateSpecialistOccupation(array $specIds): void
    {
        foreach ($specIds as $specId) {
            $specialistOccupation = SpecialistOccupation::where('specialist_id', $specId)->first();
            $specialistOccupation->percentage = $this->calculateSpecialistOccupation($specId);
            $specialistOccupation->save();
        }
    }

    public function getOrderFileExtensions(object $orderFiles): array
    {
        $fileExtensions = [];

        foreach ($orderFiles as $file) {
            $splitFileName = explode('.', $file->name);
            $fileExtensions[] = $splitFileName[count($splitFileName) - 1];
        }

        return $fileExtensions;
    }

    public function setUpdateOrderLogs(object $order, object $request, string $id): void
    {
        $user = auth()->user();
        $orderStatus = $this->getOrderStatus($request->status_id);
        $orderPriority = $this->getOrderPriority($request->priority_id);

        if ($order->status_id != $request->status_id)
            $user->log("{$user->role->name}:{$user->name} set Order ID:{$id} Status to:{$orderStatus}");

        if ($order->priority_id != $request->priority_id)
            $user->log("{$user->role->name}:{$user->name} set Order ID:{$id} Priority to:{$orderPriority}");

        if ($order->total_hours != $request->total_hours)
            $user->log("{$user->role->name}:{$user->name} set Order ID:{$id} Total Hours to:{$request->total_hours} hours");

        if ($order->end_date->format('Y-m-d') != $request->end_date)
            $user->log("{$user->role->name}:{$user->name} set Order ID:{$id} End Date to:{$request->end_date}");
    }
}
