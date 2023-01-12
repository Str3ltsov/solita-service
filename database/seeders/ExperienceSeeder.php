<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('experiences')->insert([
            [ 'name' => '0-1' ],
            [ 'name' => '1-2' ],
            [ 'name' => '2-5' ],
            [ 'name' => '5-10' ],
            [ 'name' => '10+' ],
        ]);
    }
}
