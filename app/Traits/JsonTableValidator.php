<?php

namespace App\Traits;

use Flash;
use Illuminate\Support\Facades\Validator;

trait JsonTableValidator 
{
    public function ordersValidator($data)
    {
        $rules = [
            '*.cart_id' => 'required|numeric',
            '*.order_id' => 'required|numeric',
            '*.user_id' => 'required|numeric',
            '*.admin_id' => 'required|numeric',
            '*.status_id' => 'required|numeric',
            '*.items' => 'nullable|array',
            '*.items.*.order_id' => 'required|numeric',
            '*.items.*.product_id' => 'required|numeric',
            '*.items.*.price_current' => 'required|numeric|min:5',
            '*.items.*.count' => 'required|numeric'
        ];

        $validator = Validator::make($data, $rules);

        return $validator;
    }

    public function productsValidator($data)
    {
        $rules = [
            '*.price' => 'required|numeric',
            '*.count' => 'required|numeric',
            '*.visible' => 'required|numeric',
            '*.name' => 'required',
            '*.description' => 'required'
        ];

        $validator = Validator::make($data, $rules);

        return $validator;
    }

    public function usersValidator($data)
    {
        $rules = [
            '*.name' => 'required',
            '*.email' => 'required|unique:users|email:rfc',
            '*.password' => 'required',
            '*.type' => 'required|integer',
            '*.phone_number' => 'nullable|numeric|digits:11',
        ];

        $validator = Validator::make($data, $rules);

        return $validator;
    }

    public function returnsValidator($data)
    {
        $rules = [
            '*.user_id' => 'required|numeric',
            '*.admin_id' => 'required|numeric',
            '*.order_id' => 'required|numeric',
            '*.code' => 'required',
            '*.status_id' => 'required|numeric',
            '*.items' => 'nullable|array',
            '*.items.*.order_id' => 'required|numeric',
            '*.items.*.user_id' => 'required|numeric',
            '*.items.*.return_id' => 'required|numeric',
            '*.items.*.product_id' => 'required|numeric',
            '*.items.*.price_current' => 'required|numeric|min:5',
            '*.items.*.count' => 'required|numeric'
        ];
        $validator = Validator::make($data, $rules);

        return $validator;
    }

    public function cartsValidator($data)
    {
        $rules = [
            '*.user_id' => 'required|numeric',
            '*.code' => 'required',
            '*.status_id' => 'required|numeric',
            '*.admin_id' => 'required|numeric',
            '*.items' => 'nullable|array',
            '*.items.*.cart_id' => 'required|numeric',
            '*.items.*.product_id' => 'required|numeric',
            '*.items.*.price_current' => 'required|numeric|min:5',
            '*.items.*.count' => 'required|numeric'
        ];

        $validator = Validator::make($data, $rules);

        return $validator;
    }

    public function categoriesValidator($data)
    {
        $rules = [
            '*.visible' => 'required|numeric',
            '*.name' => 'required',
            '*.description' => 'required'
        ];

        $validator = Validator::make($data, $rules);

        return $validator;
    }
}