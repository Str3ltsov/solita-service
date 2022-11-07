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
use Illuminate\Support\Facades\Storage;

trait TableToJson 
{
    public function ordersToJson()
    {
        $orders = Order::select(
            'id',
            'cart_id', 
            'order_id', 
            'user_id', 
            'admin_id', 
            'status_id', 
            'sum', 
            'created_at', 
            'updated_at'
        )->get();

        foreach ($orders as $order) {
            $order_items = OrderItem::select(
                'order_id',
                'product_id',
                'price_current',
                'count',
                'created_at',
                'updated_at'
            )
            ->where('order_id', $order->id)
            ->get();

            $order->items = $order_items;
        }

        $orders = json_encode($orders, JSON_PRETTY_PRINT);

        return Storage::disk('public')->put('orders.json', $orders);
    }

    public function productsToJson()
    {
        $products = Product::select(
            'id',
            'price',
            'count',
            'image',
            'video',
            'visible',
            'promotion_id',
            'discount_id',
            'created_at',
            'updated_at'
        )->get();
        $products = json_encode($products, JSON_PRETTY_PRINT);

        return Storage::disk('public')->put('products.json', $products);
    }

    public function usersToJson()
    {
        $users = User::select(
            'id',
            'name',
            'email',
            'password',
            'avatar', 
            'provider_id', 
            'provider',
            'access_token',
            'type',
            "street",
            "house_flat",
            "post_index",
            "city",
            "phone_number",
            'facebook_id',
            'google_id',
            'twitter_id',
            'created_at',
            'updated_at'
        )->get();
        $users = json_encode($users, JSON_PRETTY_PRINT);

        return Storage::disk('public')->put('users.json', $users);
    }

    public function returnsToJson()
    {
        $returns = Returns::select(
            'id',
            'user_id',
            'admin_id',
            'order_id',
            'code',
            'description',
            'status_id',
            'created_at',
            'updated_at'
        )->get();

        foreach ($returns as $return) {
            $return_items = ReturnItem::select(
                'order_id',
                'user_id',
                'return_id',
                'product_id',
                'price_current',
                'count',
                'created_at',
                'updated_at'
            )
            ->where('return_id', $return->id)
            ->get();

            $return->items = $return_items;
        }
        $returns = json_encode($returns, JSON_PRETTY_PRINT);

        return Storage::disk('public')->put('returns.json', $returns);
    }

    public function cartsToJson()
    {
        $carts = Cart::select(
            'id',
            'user_id',
            'code',
            'sum',
            'status_id',
            'admin_id',
            'created_at',
            'updated_at'
        )->get();

        foreach ($carts as $cart) {
            $cart_items = CartItem::select(
                'cart_id',
                'product_id',
                'price_current',
                'count',
                'created_at',
                'updated_at'
            )
            ->where('cart_id', $cart->id)
            ->get();

            $cart->items = $cart_items;
        }

        $carts = json_encode($carts, JSON_PRETTY_PRINT);

        return Storage::disk('public')->put('carts.json', $carts);
    }

    public function categoriesToJson()
    {
        $categories = Category::select(
            'id',
            'parent_id',
            'visible',
            'created_at',
            'updated_at'
        )->get();
        $categories = json_encode($categories, JSON_PRETTY_PRINT);

        return Storage::disk('public')->put('categories.json', $categories);
    }
}