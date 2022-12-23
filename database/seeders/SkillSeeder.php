<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skills')->insert([
            [ 'name' => 'HTML' ],
            [ 'name' => 'CSS' ],
            [ 'name' => 'JavaScript' ],
            [ 'name' => 'PHP' ],
            [ 'name' => 'Java' ],
            [ 'name' => 'C#' ],
            [ 'name' => 'Python' ]
        ]);
    }
}
