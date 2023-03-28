<?php

namespace Database\Seeders;

use App\Enums\SkillExperience;
use App\Models\Experience;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $randomSkill = rand(1, 7);
            $randomUser = rand(4, 5);

            $experiences = Experience::all();

            $skillUserExists = DB::table('skills_users')
                ->where('skill_id', '=', $randomSkill)
                ->where('user_id', '=', $randomUser)
                ->get();

            if (count($skillUserExists) === 0) {
                DB::table('skills_users')->insert([
                    [
                        'skill_id' => $randomSkill,
                        'user_id' => $randomUser,
                        'experience' => $experiences[rand(0, count($experiences) - 1)]->name
                    ]
                ]);
            }
        }
    }
}
