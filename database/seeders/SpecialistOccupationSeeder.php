<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\SpecialistOccupation;
use App\Models\User;
use Illuminate\Database\Seeder;

class SpecialistOccupationSeeder extends Seeder
{
    private function getSpecialistUsers()
    {
        return User::select('id', 'type')->where('type', 2)->get();
    }
    private function getOrders(int $specialistId)
    {
        return Order::select('id', 'specialist_id', 'total_hours', 'complete_hours')
            ->where('specialist_id', $specialistId)
            ->get();
    }
    private function createSpecialistOccupation(object $orders, int $specialistId): void
    {
        $totalHoursSum = 0;
        $completeHoursSum = 0;

        foreach ($orders as $order) {
            $totalHoursSum += $order->total_hours;
            $completeHoursSum += $order->complete_hours;
        }

        $uncompletedHours = $totalHoursSum - $completeHoursSum;
        $occupationPercentage = round(($uncompletedHours / $totalHoursSum * 100), 2);

        SpecialistOccupation::firstOrCreate([
            'specialist_id' => $specialistId,
            'percentage' => $occupationPercentage
        ]);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialists = $this->getSpecialistUsers();

        foreach ($specialists as $specialist) {
            $this->createSpecialistOccupation($this->getOrders($specialist->id), $specialist->id);
        }
    }
}
