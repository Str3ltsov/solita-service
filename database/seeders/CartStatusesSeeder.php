<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CartStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cart_statuses')->insert([
            'name' => 'On',
        ]);
        DB::table('cart_statuses')->insert([
            'name' => 'Off',
        ]);
    }
}
