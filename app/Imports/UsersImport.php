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
            'type' => $row['type'] ?? 4,
            "street" => $row['street'] ?? NULL,
            "house_flat" => $row['house_flat'] ?? NULL,
            "post_index" => $row['post_index'] ?? NULL,
            "city" => $row['city'] ?? NULL,
            "phone_number" => $row['phone_number'] ?? NULL,
            'work_info' => $row['work_info'] ?? NULL,
            'hourly_price' => $row['hourly_price'] ?? NULL,
            'facebook_id' => $row['facebook_id'] ?? NULL,
            'google_id' => $row['google_id'] ?? NULL,
            'twitter_id' => $row['twitter_id'] ?? NULL,
            'status_id' => $row['status_id'] ?? 1,
            'experience_id' => $row['experience_id'] ?? NULL,
            'delete_notifications' => $row['delete_notifications'],
            'created_at' => $row['created_at'] ?? NULL,
            'updated_at' => $row['updated_at'] ?? NULL,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users|email:rfc',
            'password' => 'required',
            'type' => 'required|numeric',
            'phone_number' => 'nullable|numeric|digits:11',
            'work_info' => 'nullable|string',
            'hourly_price' => 'nullable|numeric',
            'status_id' => 'required|numeric',
            'experience_id' => 'nullable|numeric',
            'delete_notifications' => 'required|boolean',
        ];
    }
}
