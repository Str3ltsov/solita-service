<?php

namespace App\Exports;

use App\Models\OrderFile;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class CommerceOffersExport implements FromCollection
{
    public function headings(): array
    {
        return [
            'order_id',
            'is_commerce_offer',
            'name',
            'location',
            'created_at',
            'updated_at'
        ];
    }

    public function collection()
    {
        return OrderFile::where('is_commerce_offer', true)->get();
    }
}
