<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderUserActivitySeeder extends Seeder
{
    private function getOrders()
    {
        return Order::select('id', 'complete_hours')->get();
    }

    private function getOrderUsersByOrderId(int $orderId)
    {
        return OrderUser::where('order_id', $orderId)->get();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = $this->getOrders();

        foreach ($orders as $order) {
            $orderUsers = $this->getOrderUsersByOrderId($order->id);
            $totalCompletedHours = 0;

            foreach ($orderUsers as $orderUser) {
                $totalHours = 0;

                for ($i = 0; $i < rand(5, 10); $i++) {
                    $randHours = rand(1, 5);
                    $totalHours += $randHours;

                    if ($totalHours >= $orderUser->hours) break;

                    DB::table('order_user_activities')->insert([
                        'order_id' => $orderUser->order_id,
                        'user_id' => $orderUser->user_id,
                        'hours' => $randHours,
                        'created_at' => now()->subDays(rand(0, 7))
                    ]);
                }

                $orderUser->complete_hours = $totalHours;
                $orderUser->complete_percentage = round($totalHours * 100 / $orderUser->hours, 2);
                $orderUser->save();

                $totalCompletedHours += $totalHours;
            }

            $order->complete_hours = $totalCompletedHours;
            $order->save();
        }
    }
}
