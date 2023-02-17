<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'name',
            'email',
            'password',
            'type',
            'status_id',
            'avatar',
            'provider_id',
            'provider',
            'access_token',
            "street",
            "house_flat",
            "post_index",
            "city",
            "phone_number",
            'work_info',
            'hourly_price',
            'facebook_id',
            'google_id',
            'twitter_id',
            'status_id',
            'experience_id',
            'created_at',
            'updated_at'
        ];
    }

    public function map($row): array
    {
        return $row->makeVisible('password')->toArray();
    }

    public function collection()
    {
        return User::select(
            'name',
            'email',
            'password',
            'type',
            'status_id',
            'avatar',
            'provider_id',
            'provider',
            'access_token',
            "street",
            "house_flat",
            "post_index",
            "city",
            "phone_number",
            'work_info',
            'hourly_price',
            'facebook_id',
            'google_id',
            'twitter_id',
            'status_id',
            'experience_id',
            'created_at',
            'updated_at'
        )->get();
    }
}
