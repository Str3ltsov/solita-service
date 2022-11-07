<?php

namespace App\Exports;

use App\Models\Cart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CartsExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'user_id',
            'code',
            'sum',
            'status_id',
            'admin_id',
            'created_at',
            'updated_at'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cart::select(
            'user_id',
            'code',
            'sum',
            'status_id',
            'admin_id',
            'created_at',
            'updated_at'
        )->get();
    }
}

