<?php

namespace App\Traits;

use App\Models\CategoryTranslation;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

trait JsonToTable
{
    public function ordersToTable($validator, $data)
    {
        if ($validator->passes()) {
            foreach ($data as $row) {
                Order::create([
                    'order_id' => $row['order_id'] ?? 0,
                    'user_id' => $row['user_id'],
                    'employee_id' => $row['employee_id'],
                    'status_id' => $row['status_id'] ?? 1,
                    'delivery_time' => $row['delivery_time'] ?? NULL,
                    'name' => $row['name'],
                    'description' => $row['description'] ?? NULL,
                    'budget' => $row['budget'],
                    'total_hours' => $row['total_hours'],
                    'complete_hours' => $row['complete_hours'] ?? NULL,
                    'start_date' => $row['start_date'],
                    'end_date' => $row['end_date'],
                    'sum' => $row['sum'] ?? NULL,
                    'created_at' => $row['created_at'] ?? NULL,
                    'updated_at' => $row['updated_at'] ?? NULL,
                    'priority_id' => $row['priority_id'],
                ]);

//                foreach ($row['items'] as $row) {
//                    OrderItem::create([
//                        'order_id' => $row['order_id'],
//                        'product_id' => $row['product_id'],
//                        'price_current' => $row['price_current'],
//                        'count' => $row['count'],
//                        'created_at' => $row['created_at'] ?? NULL,
//                        'updated_at' => $row['updated_at'] ?? NULL,
//                    ]);
//                }
            }

            return back()->with('success', __('messages.successImportedOrders'));
        }
        else {
            return back()->withErrors($validator);
        }
    }

    public function productsToTable($validator, $data)
    {
        if ($validator->passes()) {
            foreach ($data as $row) {
                $product = Product::create([
                    'price' => $row['price'],
                    'count' => $row['count'],
                    'image' => $row['image'] ?? NULL,
                    'video' => $row['video'] ?? NULL,
                    'visible' => $row['visible'],
                    'is_for_specialist' => $row['is_for_specialist'],
                    'delivery_time' => $row['delivery_time'] ?? NULL,
                    'created_at' => $row['created_at'] ?? NULL,
                    'updated_at' => $row['updated_at'] ?? NULL,
                ]);

                foreach ($row['translations'] as $translation) {
                    DB::table('products_translations')->insert([
                        'product_id' => $product->id,
                        'locale' => $translation['locale'],
                        'name' => $translation['name'],
                        'description' => $translation['description']
                    ]);
                }
            }

            return back()->with('success', __('messages.successImportedProducts'));
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

            return back()->with('success', __('messages.successImportedUsers'));
        }
        else {
            return back()->withErrors($validator);
        }
    }

    public function categoriesToTable($validator, $data)
    {
        if ($validator->passes()) {
            foreach ($data as $row) {
                $category = Category::create([
                    'parent_id' => $row['parent_id'] ?? NULL,
                    'visible' => $row['visible'],
                    'created_at' => $row['created_at'] ?? NULL,
                    'updated_at' => $row['updated_at'] ?? NULL,
                    'name' => $row['name'],
                    'description' => $row['description']
                ]);

                foreach ($row['translations'] as $translation) {
                    DB::table('categories_translations')->insert([
                        'category_id' => $category->id,
                        'locale' => $translation['locale'],
                        'name' => $translation['name'],
                        'description' => $translation['description']
                    ]);
                }
            }

            return back()->with('success', __('messages.successImportedCategories'));
        }
        else {
            return back()->withErrors($validator);
        }
    }
}
