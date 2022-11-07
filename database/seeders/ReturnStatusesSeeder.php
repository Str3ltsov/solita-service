<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ReturnStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('return_statuses')->insert([
            'name' => 'New',
        ]);
        DB::table('return_statuses')->insert([
            'name' => 'Open',
        ]);
        DB::table('return_statuses')->insert([
            'name' => 'Close',
        ]);
    }
}
