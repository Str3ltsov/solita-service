<?php

namespace App\Traits;

use App\Models\ReturnItem;
use App\Models\Returns;
use App\Models\ReturnStatus;
use App\Models\User;

trait ReturnServices
{
    private static float $returnItemPriceSum = 0.0;
    private static int $returnItemCountSum = 0;

    public function getReturns(int $authType)
    {
        if ($authType === 2)
            return Returns::all()->where('specialist_id', auth()->user()->id);
        if ($authType === 3)
            return Returns::all()->where('employee_id', auth()->user()->id);

        return back()->with('error', __('messages.errorGetReturns'));
    }

    public function getReturnById(string $id)
    {
        return Returns::find($id);
    }

    public function getReturnItems(string $id)
    {
        return ReturnItem::select('id', 'order_id', 'product_id', 'price_current', 'count')
            ->where('return_id', $id)
            ->get();
    }

    public function getReturnItemByProductId(int $productId)
    {
        return ReturnItem::where('product_id', $productId)->value('product_id');
    }

    public function getReturnItemPriceSum(): int
    {
        return self::$returnItemPriceSum;
    }

    public function getReturnItemCountSum(): int
    {
        return self::$returnItemCountSum;
    }

    public function setReturnItemPriceSum(object $returnItems): void
    {
        foreach ($returnItems as $returnItem) {
            self::$returnItemPriceSum += $returnItem->price_current;
        }
    }

    public function setReturnItemCountSum(object $returnItems): void
    {
        foreach ($returnItems as $returnItem) {
            self::$returnItemCountSum += $returnItem->count;
        }
    }

    private function getReturnStatus(int $statusId)
    {
        return ReturnStatus::where('id', $statusId)->value('name');
    }

    private function getReturnSpecialist(int $specialistId)
    {
        return User::where('id', $specialistId)->value('name');
    }

    public function setUpdateReturnLogs(object $return, object $request): void
    {
        $user = auth()->user();
        $returnStatus = $this->getReturnStatus($request->status_id);
        $returnSpecialist = $this->getReturnSpecialist($request->specialist_id);

        if ($return->specialist_id != $request->specialist_id)
            $user->log("{$user->role->name}:{$user->name} set Order ID:{$return->order_id} Return Specialist to:{$returnSpecialist}");

        if ($return->status_id != $request->status_id)
            $user->log("{$user->role->name}:{$user->name} set Order ID:{$return->order_id} Return Status to:{$returnStatus}");
    }
}
