<?php

namespace App\Imports;

use App\Models\Cart;
use App\Models\User;
use App\Models\CartStatus;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class CartsImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
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
        $status = CartStatus::where('id', $row['status_id'])->first();

        return new Cart([
            'user_id' => $user->id,
            'code' => $row['code'],
            'sum' => $row['sum'] ?? NULL,
            'status_id' => $status->id,
            'admin_id' => $admin->id,
            'created_at' => $row['created_at'] ?? NULL,
            'updated_at' => $row['updated_at'] ?? NULL
        ]);
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|numeric',
            'code' => 'required',
            'status_id' => 'required|numeric',
            'admin_id' => 'required|numeric'
        ];
    }
}
