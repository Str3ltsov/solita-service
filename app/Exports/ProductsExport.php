<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'price',
            'count',
            'image',
            'video',
            'visible',
            'promotion_id',
            'discount_id',
            'created_at',
            'updated_at',
        ];
    }

    public function collection()
    {
        return Product::select(
            'price',
            'count',
            'image',
            'video',
            'visible',
            'promotion_id',
            'discount_id',
            'created_at',
            'updated_at'
        )->get();
    }
}
