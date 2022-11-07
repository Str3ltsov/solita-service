<?php

namespace Database\Seeders;

use App\Models\Discount;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use DB;
class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        for ($i=0; $i<=20; $i++){
            $cdata = [
                'en' => [
                    'name' => "discount $faker->name",
                    'description' => "discount $faker->text",
                ],
                'lt' => [
                    'name' => "nuolaida $faker->name",
                    'description' => "nuolaida $faker->text",
                ],
                /*'ru' => [
                    'name' => "RU skidka $faker->name",
                    'description' => "RU skidka $faker->text",
                ],*/
                'proc' => rand(1,99),
            ];
            $discount = Discount::create($cdata);
        }


//        for ($i=0; $i<10; $i++){
//            DB::table('discounts')->insert([
//                'name' => $faker->name,
//                'description' => $faker->text,
//                'proc' => rand(1,99),
//            ]);
//
//
//
//        }
    }
}
