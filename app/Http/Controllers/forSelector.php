<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartStatus;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Experience;
use App\Models\Order;
use App\Models\OrderPriority;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Returns;
use App\Models\ReturnStatus;
use App\Models\Role;
use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Support\Facades\DB;

trait forSelector
{
    public function VisibilityForSelector()
    {
        return [
            __('forms.invisible'),
            __('forms.visible')
        ];
    }

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
            $c[$item->id] = $item->name;
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

    public function specialistForSelector()
    {
        $c = array();
        User::all()
            ->where('type', 2)
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

    public function rolesForSelector()
    {
        $c = array();
        Role::all()->map(function ($item) use (&$c) {
            $c[$item->id] = $item->name;
        });
        return $c;
    }

    public function userStatusForSelector()
    {
        $c = array();
        UserStatus::all()->map(function ($item) use (&$c) {
            $c[$item->id] = $item->name;
        });
        return $c;
    }

    public function experienceForSelector()
    {
        $c = array();
        Experience::all()->map(function ($item) use (&$c) {
            $c[$item->id] = $item->name;
        });
        return $c;
    }


    public function orderSpecialistForSelector()
    {
        $c = array();
        User::all()->where('type', 2)->map(function ($item) use (&$c) {
            $c[$item->id] = $item->name;
        });
        return $c;
    }

    public function orderEmployeeForSelector()
    {
        $c = array();
        User::all()->where('type', 3)->map(function ($item) use (&$c) {
            $c[$item->id] = $item->name;
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

    public function orderPrioritiesForSelector()
    {
        $c = array();
        OrderPriority::all()->map(function ($item) use (&$c) {
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

    public function categoriesOrderSelector(): array
    {
        $c = array();

        $titles = [
            __('forms.default'),
            __('forms.categoryNameAsc'),
            __('forms.categoryNameDesc')
        ];

        for($i = 0; $i < count($titles); $i++){
            $c[$i] = $titles[$i];
        }

        return $c;
    }

    public function userOrderSelector(int $userId, int $userType)
    {
        $c = array();

        $orders = Order::select('id', 'name');

        if ($userType == 1)
            $orders = $orders->get();
        if ($userType == 2) {
            $orders = DB::table('orders')
                ->join('order_users', 'orders.id', '=', 'order_users.order_id')
                ->select('orders.*', 'order_users.user_id')
                ->where('order_users.user_id', '=', $userId)
                ->get();
        }
        if ($userType == 3)
            $orders = $orders->where('employee_id', $userId)->get();
        if ($userType == 4)
            $orders = $orders->where('user_id', $userId)->get();

        for($i = 0; $i < count($orders); $i++){
            $c[$orders[$i]->id] = $orders[$i]->name;
        }

        return $c;
    }

    public function messageTypeSelector()
    {
        $c = array();

        $types = [
            __('names.message'),
            __('names.problem')
        ];

        for($i = 0; $i < count($types); $i++){
            $c[$i] = $types[$i];
        }

        return $c;
    }

    public function orderUsersSelector(int $orderId, string $authUserId)
    {
        $c = array();

        $order = Order::find($orderId);

        $c[$order->user_id] = $order->user->name;
        $c[$order->employee_id] = $order->employee->name;

        for ($i = 0; $i < count($order->specialists); $i++) {
            $c[$order->specialists[$i]->user_id] = $order->specialists[$i]->user->name;
        }

        foreach ($c as $key => $d) {
            if ($key === (int)$authUserId)
                unset($c[$key]);
        }

        return $c;
    }
}
