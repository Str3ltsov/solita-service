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
        $orders = Order::all();
        $orders = json_encode($orders, JSON_PRETTY_PRINT);

        return Storage::disk('public')->put('orders.json', $orders);
    }

    public function productsToJson()
    {
        $products = Product::all();
        $products = json_encode($products, JSON_PRETTY_PRINT);

        return Storage::disk('public')->put('products.json', $products);
    }

    public function usersToJson()
    {
        $users = User::all();
        $users = json_encode($users, JSON_PRETTY_PRINT);

        return Storage::disk('public')->put('users.json', $users);
    }

    public function categoriesToJson()
    {
        $categories = Category::all();
        $categories = json_encode($categories, JSON_PRETTY_PRINT);

        return Storage::disk('public')->put('categories.json', $categories);
    }
}
