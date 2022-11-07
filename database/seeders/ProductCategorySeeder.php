<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<100; $i++){
            DB::table('category_product')->insert([
                'category_id' => rand(1,15),
                'product_id' => rand(1,100),
            ]);
        }
    }
}
