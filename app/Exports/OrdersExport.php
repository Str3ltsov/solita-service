<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'cart_id',
            'order_id',
            'user_id',
            'admin_id',
            'status_id',
            'sum',
            'created_at',
            'updated_at'
        ];
    }

    public function collection()
    {
        return Order::select(
            'cart_id', 
            'order_id', 
            'user_id', 
            'admin_id', 
            'status_id', 
            'sum', 
            'created_at', 
            'updated_at'
        )->get();
    }
}
