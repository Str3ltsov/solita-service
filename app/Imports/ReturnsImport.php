<?php

namespace App\Imports;

use App\Models\Returns;
use App\Models\User;
use App\Models\Order;
use App\Models\ReturnStatus;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class ReturnsImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::where('id', $row['user_id'])->first();
        $admin = User::where('id', $row['admin_id'])->where('type', '1')->first();
        $order = Order::where('id', $row['order_id'])->first();
        $status = ReturnStatus::where('id', $row['status_id'])->first();

        return new Returns([
            'user_id' => $user->id,
            'admin_id' => $admin->id,
            'order_id' => $order->id,
            'code' => $row['code'],
            'description' => $row['description'] ?? NULL,
            'status_id' => $status->id,
            'created_at' => $row['created_at'] ?? NULL,
            'updated_at' => $row['updated_at'] ?? NULL
        ]);
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|numeric',
            'admin_id' => 'required|numeric',
            'order_id' => 'required|numeric',
            'code' => 'required',
            'status_id' => 'required|numeric',
        ];
    }
}
