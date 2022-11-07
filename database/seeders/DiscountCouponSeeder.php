<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;
class DiscountCouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i<10; $i++){
            DB::table('discount_coupons')->insert([
                'code' => substr(md5(Hash::make($faker->text)), 0, 6),
                'used' => rand(0,1),
                'value' => rand(0,1000),
                'user_id' => rand(1,3),
            ]);
        }
    }
}
