<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderUserSeeder extends Seeder
{
    private function getOrders()
    {
        return Order::select('id', 'status_id', 'total_hours', 'complete_hours')->get();
    }

    private function getSpecialists()
    {
        return User::select('id', 'type')->where('type', 2)->get();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = $this->getOrders();
        $specialistCount = count($this->getSpecialists());

        foreach ($orders as $order) {
            $totalSpecialistHours = 0;
            $randSpecialistCount = rand(1, $specialistCount);

            for ($i = 0; $i < $randSpecialistCount; $i++) {
                $randHours = rand(10, $order->total_hours / 2);
                $specialist = $this->getSpecialists()[$i];

                if ($i === $specialistCount - 1)
                    $randHours = $order->total_hours - $totalSpecialistHours;

                DB::table('order_users')->insert([
                    'order_id' => $order->id,
                    'user_id' => $specialist->id,
                    'hours' => $randSpecialistCount > 1 ? $randHours : $order->total_hours
                ]);

                $totalSpecialistHours += $randHours;
            }
        }
    }
}
