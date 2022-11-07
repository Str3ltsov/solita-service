<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->insert([
            'name' => 'Draft',
        ]);
        DB::table('order_statuses')->insert([
            'name' => 'New',
        ]);
        DB::table('order_statuses')->insert([
            'name' => 'Waiting',
        ]);
        DB::table('order_statuses')->insert([
            'name' => 'Shipped',
        ]);
        DB::table('order_statuses')->insert([
            'name' => 'Canceled',
        ]);
        DB::table('order_statuses')->insert([
            'name' => 'Completed',
        ]);
        DB::table('order_statuses')->insert([
            'name' => 'Returned',
        ]);
    }
}
