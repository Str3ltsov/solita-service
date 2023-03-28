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
            'order_id',
            'user_id',
            'employee_id',
            'status_id',
            'priority_id',
            'name',
            'description',
            'budget',
            'total_hours',
            'complete_hours',
            'start_date',
            'end_date',
            'sum',
            'created_at',
            'updated_at'
        ];
    }

    public function collection()
    {
        return Order::select(
            'order_id',
            'user_id',
            'employee_id',
            'status_id',
            'priority_id',
            'name',
            'description',
            'budget',
            'total_hours',
            'complete_hours',
            'start_date',
            'end_date',
            'sum',
            'created_at',
            'updated_at'
        )->get();
    }
}
