<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartStatus;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Returns;
use App\Models\ReturnStatus;
use App\Models\User;

trait forSelector
{
    protected $visible_list = ['invisible', 'visible'];

    public function categoriesForSelector()
    {
        $c = array();
//        Category::all()->map(function ($item) use (&$c) {
//            $c[$item->id] = $item->name;
//        });
    Category::translatedIn(app()->getLocale())->get()->map(function ($item) use (&$c) {
            $c[$item->id] = $item->name;
        });
        return $c;
    }

    public function productsForSelector()
    {
        $c = array();
//        Product::all()->map(function ($item) use (&$c) {
//            $c[$item->id] = $item->name;
//        });
        Product::translatedIn(app()->getLocale())->get()->map(function ($item) use (&$c) {
            $c[$item->id] = $item->name;
        });
        return $c;
    }

    public function discountForSelector()
    {
        $c = array();
        Discount::all()->map(function ($item) use (&$c) {
            $c[$item->id] = $item->name;
        });
        return $c;
    }

    public function promotionForSelector()
    {
        $c = array();
        Promotion::all()->map(function ($item) use (&$c) {
            $c[$item->id] = $item->name;
        });
        return $c;
    }

    public function cartsForSelector()
    {
        $c = array();
        Cart::all()->map(function ($item) use (&$c) {
            $c[$item->id] = $item->id;
        });
        return $c;
    }

    public function usersForSelector()
    {
        $c = array();
        User::all()->map(function ($item) use (&$c) {
            $c[$item->id] = '[' . $item->id . '] ' . $item->name;
        });
        return $c;
    }

    public function cartStatusesForSelector()
    {
        $c = array();
        CartStatus::all()->map(function ($item) use (&$c) {
            $c[$item->id] = $item->name;
        });
        return $c;
    }

    public function adminForSelector()
    {
        $c = array();
        User::all()
            ->where('type', User::TYPE_ADMIN)
            ->map(function ($item) use (&$c) {
                $c[$item->id] = '[' . $item->id . '] ' . $item->name;
            });
        return $c;
    }

    public function ordersForSelector()
    {
        $c = array();
        Order::all()->map(function ($item) use (&$c) {
            $c[$item->id] = 'id: ' . $item->id . ' userId: ' . $item->user_id;
        });
        return $c;
    }

    public function orderStatusesForSelector()
    {
        $c = array();
        OrderStatus::all()->map(function ($item) use (&$c) {
            $c[$item->id] = $item->name;
        });
        return $c;
    }

    public function returnsForSelector()
    {
        $c = array();
        Returns::all()->map(function ($item) use (&$c) {
            $c[$item->id] = 'id: ' . $item->id . ' userId: ' . $item->user_id;
        });
        return $c;
    }

    public function returnStatusesForSelector()
    {
        $c = array();
        ReturnStatus::all()->map(function ($item) use (&$c) {
            $c[$item->id] = $item->name;
        });
        return $c;
    }

    public function productsOrderSelector(): array
    {
        $c = array();

        $titles = [
            __('forms.default'),
            __('forms.productNameAsc'),
            __('forms.productNameDesc'),
            __('forms.priceAsc'),
            __('forms.priceDesc')
        ];

        for($i = 0; $i < count($titles); $i++){
            $c[$i] = $titles[$i];
        }

        return $c;
    }

    public function productsPaginateNumberSelector(): array
    {
        $c = array();

        $numbers = [12, 24, 36];

        for($i = 0; $i < count($numbers); $i++){
            $c[$i] = $numbers[$i];
        }

        return $c;
    }
}
