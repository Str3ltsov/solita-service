<?php

namespace App\Traits;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Returns;
use App\Models\ReturnItem;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Flash;

trait JsonToTable 
{
    public function ordersToTable($validator, $data)
    {
        if ($validator->passes()) {
            foreach ($data as $row) {
                Order::create([
                    'cart_id' => $row['cart_id'],
                    'order_id' => $row['order_id'],
                    'user_id' => $row['user_id'],
                    'admin_id' => $row['admin_id'],
                    'status_id' => $row['status_id'],
                    'sum' => $row['sum'] ?? NULL,
                    'created_at' => $row['created_at'] ?? NULL,
                    'updated_at' => $row['updated_at'] ?? NULL
                ]);
                
                foreach ($row['items'] as $row) {
                    OrderItem::create([
                        'order_id' => $row['order_id'],
                        'product_id' => $row['product_id'],
                        'price_current' => $row['price_current'],
                        'count' => $row['count'],
                        'created_at' => $row['created_at'] ?? NULL,
                        'updated_at' => $row['updated_at'] ?? NULL,
                    ]);
                }
            }
    
            Flash::success("Imported data");
            return back();
        }
        else {
            return back()->withErrors($validator);
        }
    }

    public function productsToTable($validator, $data)
    {
        if ($validator->passes()) {
            foreach ($data as $row) {
                Product::create([
                    'price' => $row['price'],
                    'count' => $row['count'],
                    'image' => $row['image'] ?? NULL,
                    'video' => $row['video'] ?? NULL,
                    'visible' => $row['visible'],
                    'promotion_id' => $row['promotion_id'] ?? NULL,
                    'discount_id' => $row['discount_id'] ?? NULL,
                    'created_at' => $row['created_at'] ?? NULL,
                    'updated_at' => $row['updated_at'] ?? NULL,
                    'name' => $row['name'],
                    'description' => $row['description']
                ]);
            }
    
            Flash::success("Imported data");
            return back();
        }
        else {
            return back()->withErrors($validator);
        }
    }

    public function usersToTable($validator, $data)
    {
        if ($validator->passes()) {
            foreach ($data as $row) {
                User::create([
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
    
            Flash::success("Imported data");
            return back();
        }
        else {
            return back()->withErrors($validator);
        }
    }

    public function returnsToTable($validator, $data)
    {
        if ($validator->passes()) {
            foreach ($data as $row) {
                Returns::create([
                    'user_id' => $row['user_id'],
                    'admin_id' => $row['admin_id'],
                    'order_id' => $row['order_id'],
                    'code' => $row['code'],
                    'description' => $row['description'] ?? NULL,
                    'status_id' => $row['status_id'],
                    'created_at' => $row['created_at'] ?? NULL,
                    'updated_at' => $row['updated_at'] ?? NULL
                ]);

                foreach ($row['items'] as $row) {
                    ReturnItem::create([
                        'order_id' => $row['order_id'],
                        'user_id' => $row['user_id'],
                        'return_id' => $row['return_id'],
                        'product_id' => $row['product_id'],
                        'price_current' => $row['price_current'],
                        'count' => $row['count'],
                        'created_at' => $row['created_at'] ?? NULL,
                        'updated_at' => $row['updated_at'] ?? NULL,
                    ]);
                }
            }
    
            Flash::success("Imported data");
            return back();
        }
        else {
            return back()->withErrors($validator);
        }
    }

    public function cartsToTable($validator, $data)
    {
        if ($validator->passes()) {
            foreach ($data as $row) {
                Cart::create([
                    'user_id' => $row['user_id'],
                    'code' => $row['code'],
                    'sum' => $row['sum'] ?? NULL,
                    'status_id' => $row['status_id'],
                    'admin_id' => $row['admin_id'],
                    'created_at' => $row['created_at'] ?? NULL,
                    'updated_at' => $row['updated_at'] ?? NULL
                ]);

                foreach ($row['items'] as $row) {
                    CartItem::create([
                        'cart_id' => $row['cart_id'],
                        'product_id' => $row['product_id'],
                        'price_current' => $row['price_current'],
                        'count' => $row['count'],
                        'created_at' => $row['created_at'] ?? NULL,
                        'updated_at' => $row['updated_at'] ?? NULL,
                    ]);
                }
            }
    
            Flash::success("Imported data");
            return back();
        }
        else {
            return back()->withErrors($validator);
        }
    }

    public function categoriesToTable($validator, $data)
    {
        if ($validator->passes()) {
            foreach ($data as $row) {
                Category::create([
                    'parent_id' => $row['parent_id'] ?? NULL,
                    'visible' => $row['visible'],
                    'created_at' => $row['created_at'] ?? NULL,
                    'updated_at' => $row['updated_at'] ?? NULL,
                    'name' => $row['name'],
                    'description' => $row['description']
                ]);
            }
    
            Flash::success("Imported data");
            return back();
        }
        else {
            return back()->withErrors($validator);
        }
    }
}