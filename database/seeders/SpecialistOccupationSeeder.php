<?php

namespace Database\Seeders;

use App\Models\OrderUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialistOccupationSeeder extends Seeder
{
    private function getSpecialistUsers()
    {
        return User::select('id', 'type')->where('type', 2)->get();
    }

    private function getOrderUsersByUserId(int $userId)
    {
        return OrderUser::where('user_id', $userId)->get();
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
            $orderUsers = $this->getOrderUsersByUserId($specialist->id);
            $hoursSum = 0;
            $completeHoursSum = 0;

            foreach ($orderUsers as $orderUser) {
                $hoursSum += $orderUser->hours;
                $completeHoursSum += $orderUser->complete_hours;
            }

            $uncompletedHours = $hoursSum - $completeHoursSum;
            $occupationPercentage = round(($uncompletedHours / $hoursSum * 100), 2);

            DB::table('specialist_occupations')->insert([
                'specialist_id' => $specialist->id,
                'percentage' => $occupationPercentage
            ]);
        }
    }
}
