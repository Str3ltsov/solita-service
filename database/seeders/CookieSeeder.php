<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CookieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cookies')->insert([
            'name'=> 'essential',
            'description'=> 'are necessary for technical reasons Without them,
            this website may not function properly.',
            'isMandatory' => true,
        ]);
        DB::table('cookies')->insert([
            'name'=> 'functional',
            'description'=> 'are necessary for specific functionality on
            the website. Without them, some features may be disabled.',
            'isMandatory' => true,
        ]);
        DB::table('cookies')->insert([
            'name'=> 'marketing',
            'description'=> 'allow us to personalise your experience and to send
            you relevant content and offers, on this website and other websites.',
            'isMandatory' => false,
        ]);
        DB::table('cookies')->insert([
            'name'=> 'analytics',
            'description'=> 'allow us to analyse website use and to improve the
            visitor\'s experience.',
            'isMandatory' => false,
        ]);
    }
}
