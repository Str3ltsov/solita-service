<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class SpecialistsExport implements FromCollection
{
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
            'delete_notifications',
            'delete_messages',
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
        return User::where('type', 2)->get();
    }
}
