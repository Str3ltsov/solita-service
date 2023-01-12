<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\DiscountCoupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPriority;
use App\Repositories\CartRepository;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 30; $i++) {
            $this->createOrder($i);
        }
    }

    public function createOrder($orderID){

//        $cartRepository = new CartRepository(app());
//        $cart = $cartRepository->find($cartID);
//
//        if ($cart) {
//            $cartItems = CartItem::query()
//                ->where([
//                    'cart_id' => $cart->id,
//                ])
//                ->get();
//
//            $cart->status_id = Cart::STATUS_OFF;
//            $cart->save();

//            DiscountCoupon::where([
//                'cart_id' => $cart->id,
//            ])->update([
//                'used' => 1
//            ]);

            $randTotalHours = rand(50, 200);
            $randCompletedHours = rand(1, 50);

            $newOrder = new Order();
            $newOrder->order_id = $orderID;
            $newOrder->user_id = 7;
            $newOrder->employee_id = 6;
            $newOrder->status_id = $randTotalHours === $randCompletedHours ? 6 : rand(1, 7);
            $newOrder->sum = 0;
            $newOrder->delivery_time = 3;
            $newOrder->total_hours = $randTotalHours;
            $newOrder->complete_hours = $randCompletedHours;
            $newOrder->priority_id = OrderPriority::LOW;
            $newOrder->created_at = now();
            $newOrder->save();

//            if ($newOrder->save()) {
//                foreach ($cartItems as $cartItem) {
//                    $newOrderItem = new OrderItem();
//                    $newOrderItem->order_id = $newOrder->id;
//                    $newOrderItem->product_id = $cartItem->product_id;
//                    $newOrderItem->price_current = $cartItem->price_current;
//                    $newOrderItem->count = $cartItem->count;
//                    $newOrderItem->save();
//                }
//            }
//        }
    }

}
