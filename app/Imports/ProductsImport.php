<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Discount;
use App\Models\Promotion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $promotion_id = Promotion::where('id', $row['promotion_id'])->first();
        $discount_id = Discount::where('id', $row['discount_id'])->first();

        return new Product([
            'price' => $row['price'],
            'count' => $row['count'],
            'image' => $row['image'] ?? NULL,
            'video' => $row['video'] ?? NULL,
            'visible' => $row['visible'],
            'promotion_id' => $promotion_id ?? NULL,
            'discount_id' => $discount_id ?? NULL,
            'created_at' => $row['created_at'] ?? NULL,
            'updated_at' => $row['updated_at'] ?? NULL,
            'name' => $row['name'],
            'description' => $row['description']
        ]);
    }

    public function rules(): array
    {
        return [
            'price' => 'required|numeric',
            'count' => 'required|numeric',
            'visible' => 'required|boolean',
            'name' => 'required',
            'description' => 'required'
        ];
    }
}

