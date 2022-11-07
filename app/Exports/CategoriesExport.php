<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoriesExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'parent_id',
            'visible',
            'created_at',
            'updated_at',
            'name',
            'description'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Category::select(
            'id',
            'parent_id',
            'visible',
            'created_at',
            'updated_at'
        )->get();
    }
}