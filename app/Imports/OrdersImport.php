<?php

namespace App\Imports;

use App\Models\Order;
use App\Models\Cart;
use App\Models\User;
use App\Models\OrderStatus;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class OrdersImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    /**
    * @param array $row
    *
    * @return Order
     */
    public function model(array $row)
    {
        $order = Order::where('id', $row['order_id'])->first();
        $user = User::where('id', $row['user_id'])->where('type', '4')->first();
        $employee = User::where('id', $row['employee_id'])->where('type', '3')->first();
        $status = OrderStatus::where('id', $row['status_id'])->first();

        return new Order([
            'order_id' => $order->id,
            'user_id' => $user->id,
            'employee_id' => $employee->id,
            'status_id' => $status->id,
            'delivery_time' => $row['delivery_time'] ?? NULL,
            'name' => $row['name'],
            'description' => $row['description'] ?? NULL,
            'budget' => $row['budget'],
            'total_hours' => $row['total_hours'],
            'complete_hours' => $row['complete_hours'] ?? NULL,
            'start_date' => $row['start_date'],
            'end_date' => $row['end_date'],
            'sum' => $row['sum'] ?? NULL,
            'created_at' => $row['created_at'] ?? NULL,
            'updated_at' => $row['updated_at'] ?? NULL,
            'priority_id' => $row['priority_id']
        ]);
    }

    public function rules(): array
    {
        return [
            'order_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'employee_id' => 'required|numeric',
            'status_id' => 'required|numeric',
            'delivery_time' => 'nullable|numeric|min:1|max:100',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'budget' => 'required|numeric',
            'total_hours' => 'required|numeric|min:1',
            'complete_hours' => 'nullable|numeric|lte:*.total_hours',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'sum' => 'nullable|numeric',
            'priority_id' => 'required|numeric',
        ];
    }
}
