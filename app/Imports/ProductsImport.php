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
    * @return Product
     */
    public function model(array $row)
    {
        return new Product([
            'price' => $row['price'],
            'count' => $row['count'],
            'image' => $row['image'] ?? NULL,
            'video' => $row['video'] ?? NULL,
            'visible' => $row['visible'],
            'is_for_specialists' => $row['is_for_specialists'],
            'delivery_time' => $row['delivery_time'] ?? NULL,
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
            'visible' => 'required|numeric',
            'name' => 'required|string',
            'description' => 'required|string',
            'is_for_specialist' => 'required|boolean',
            'delivery_time' => 'nullable|numeric',
        ];
    }
}

