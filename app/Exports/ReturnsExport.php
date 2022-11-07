<?php

namespace App\Exports;

use App\Models\Returns;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReturnsExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'user_id',
            'admin_id',
            'order_id',
            'code',
            'description',
            'status_id',
            'created_at',
            'updated_at'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Returns::select(
            'user_id',
            'admin_id',
            'order_id',
            'code',
            'description',
            'status_id',
            'created_at',
            'updated_at'
        )->get();
    }
}

