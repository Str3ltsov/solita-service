<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\Product;
//use DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i <= 200; $i++) {
            $price = rand(50, 1000);
//            $hourPrice = rand(1, 50);
//
//            if ($price === $hourPrice) continue;

            $cdata = [
                'en' => [
                    'name' => "product $faker->name",
                    'description' => "product $faker->text",
                ],
                'lt' => [
                    'name' => "produktas $faker->name",
                    'description' => "produktas $faker->text",
                ],
                /*'ru' => [
                    'name' => "RUproduct $faker->name",
                    'description' => "RUproduct $faker->text",
                ],*/
                'price' => $price,
//                'price_per_hour' => $hourPrice,
                'is_for_specialist' => rand(0, 100) < 25,
//                'promotion_id' => ($i % 10 ? rand(1, 10) : null)
            ];

            Product::create($cdata);
            //$product = Product::create($cdata);

            /*DB::table('products')->insert([
                'name' => "product $faker->name",
                'description' => "product $faker->text",
                'price' => rand(1, 1000),
                'is_for_specialist' => rand(0, 100) < 25,
                'promotion_id' => ($i % 10 ? rand(1,10) : null)
            ]);*/
        }
    }
}
