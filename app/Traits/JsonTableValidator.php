<?php

namespace App\Traits;

use Flash;
use Illuminate\Support\Facades\Validator;

trait JsonTableValidator
{
    public function ordersValidator($data)
    {
        $rules = [
            '*.order_id' => 'required|numeric',
            '*.user_id' => 'required|numeric',
            '*.employee_id' => 'required|numeric',
            '*.status_id' => 'required|numeric',
            '*.delivery_time' => 'nullable|numeric|min:1|max:100',
            '*.name' => 'required|string',
            '*.description' => 'nullable|string',
            '*.budget' => 'required|numeric',
            '*.total_hours' => 'required|numeric|min:1',
            '*.complete_hours' => 'nullable|numeric|lte:*.total_hours',
            '*.start_date' => 'required|required|date',
            '*.end_date' => 'required|date|after:start_date',
            '*.sum' => 'nullable|numeric',
            '*.priority_id' => 'required|numeric',
        ];

        return Validator::make($data, $rules);
    }

    public function productsValidator($data)
    {
        $rules = [
            '*.price' => 'required|numeric',
            '*.count' => 'required|numeric',
            '*.visible' => 'required|numeric',
            '*.name' => 'required|string',
            '*.description' => 'required|string',
            '*.is_for_specialist' => 'required|boolean',
            '*.delivery_time' => 'nullable|numeric',
        ];

        return Validator::make($data, $rules);
    }

    public function usersValidator($data)
    {
        $rules = [
            '*.name' => 'required',
            '*.email' => 'required|unique:users|email:rfc',
            '*.password' => 'required',
            '*.type' => 'required|numeric',
            '*.phone_number' => 'nullable|numeric|digits:11',
            '*.work_info' => 'nullable|string',
            '*.hourly_price' => 'nullable|numeric',
            '*.status_id' => 'required|numeric',
            '*.experience_id' => 'nullable|numeric',
            '*.delete_notifications' => 'required|boolean',
        ];

        return Validator::make($data, $rules);
    }

    public function categoriesValidator($data)
    {
        $rules = [
            '*.visible' => 'required|numeric',
            '*.name' => 'required',
            '*.description' => 'required'
        ];

        return Validator::make($data, $rules);
    }

    public function specialistsValidator($data)
    {
        $rules = [
            '*.name' => 'required',
            '*.email' => 'required|unique:users|email:rfc',
            '*.password' => 'required',
            '*.type' => 'required|numeric|between:2,2',
            '*.phone_number' => 'nullable|numeric|digits:11',
            '*.work_info' => 'nullable|string',
            '*.hourly_price' => 'nullable|numeric',
            '*.status_id' => 'required|numeric',
            '*.experience_id' => 'nullable|numeric',
            '*.delete_notifications' => 'required|boolean',
        ];

        return Validator::make($data, $rules);
    }
}
