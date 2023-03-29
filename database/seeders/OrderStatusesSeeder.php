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
            ['name' => 'Created'],
            ['name' => 'Preview'],
            ['name' => 'Previewed'],
            ['name' => 'Approved by Client'],
            ['name' => 'Approved by Employee'],
            ['name' => 'Running'],
            ['name' => 'Completed'],
            ['name' => 'Overdue'],
            ['name' => 'Cancelled'],
        ]);
    }
}
