<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class CategoriesImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Category([
            'parent_id' => $row['parent_id'] ?? NULL,
            'visible' => $row['visible'],
            'created_at' => $row['created_at'] ?? NULL,
            'updated_at' => $row['updated_at'] ?? NULL,
            'name' => $row['name'],
            'description' => $row['description']
        ]);
    }

    public function rules(): array
    {
        return [
            'visible' => 'required|boolean',
            'name' => 'required',
            'description' => 'required'
        ];
    }
}