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
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $cart = Cart::where('id', $row['cart_id'])->first();
        $order = Order::where('id', $row['order_id'])->first();
        $user = User::where('id', $row['user_id'])->first();
        $admin = User::where('id', $row['admin_id'])->where('type', '1')->first();
        $status = OrderStatus::where('id', $row['status_id'])->first();

        return new Order([
            'cart_id' => $cart->id,
            'order_id' => $order->id,
            'user_id' => $user->id,
            'admin_id' => $admin->id,
            'status_id' => $status->id,
            'sum' => $row['sum'] ?? NULL,
            'created_at' => $row['created_at'] ?? NULL,
            'updated_at' => $row['updated_at'] ?? NULL
        ]);
    }

    public function rules(): array
    {
        return [
            'cart_id' => 'required|numeric',
            'order_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'admin_id' => 'required|numeric',
            'status_id' => 'required|numeric'
        ];
    }
}
