<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class UsersImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
            'avatar' => $row['avatar'] ?? NULL,
            'provider_id' => $row['provider_id'] ?? NULL,
            'provider' => $row['provider'] ?? NULL,
            'access_token' => $row['access_token'] ?? NULL,
            'type' => $row['type'] ?? 2,
            "street" => $row['street'] ?? NULL,
            "house_flat" => $row['house_flat'] ?? NULL,
            "post_index" => $row['post_index'] ?? NULL,
            "city" => $row['city'] ?? NULL,
            "phone_number" => $row['phone_number'] ?? NULL,
            'facebook_id' => $row['facebook_id'] ?? NULL,
            'google_id' => $row['google_id'] ?? NULL,
            'twitter_id' => $row['twitter_id'] ?? NULL,
            'created_at' => $row['created_at'] ?? NULL,
            'updated_at' => $row['updated_at'] ?? NULL,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'type' => 'required|integer',
            'phone_number' => 'nullable|numeric|digits:11',
        ];
    }
}
