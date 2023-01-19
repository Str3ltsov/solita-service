<?php

namespace Database\Seeders;

use App\Models\UserStatus;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('users')->insert([
            [
                'name' => 'igor',
                'email' => 'igor@getweb.lt',
                'password' => Hash::make('zhopazhopa'),
                'street' => "Birzelio 23",
                'house_flat' => "3/9",
                "post_index" => "LT 02178",
                'city' => "Vilnius",
                'phone_number' => "37012345678",
                'work_info' => '',
                'hourly_price' => null,
                'type' => 1,
                'status_id' => UserStatus::APPROVED,
                'experience_id' => ''
            ],
            [
                'name' => 'andrej',
                'email' => 'andtaress2@gmail.com',
                'password' => Hash::make('caveman123'),
                'street' => '',
                'house_flat' => '',
                "post_index" => '',
                'city' => '',
                'phone_number' => '',
                'work_info' => '',
                'hourly_price' => null,
                'type' => 1,
                'status_id' => UserStatus::APPROVED,
                'experience_id' => ''
            ],
            [
                'name' => 'Administratorius',
                'email' => 'admin@solita.lt',
                'password' => Hash::make('password'),
                'street' => '',
                'house_flat' => '',
                "post_index" => '',
                'city' => '',
                'phone_number' => '',
                'work_info' => '',
                'hourly_price' => null,
                'type' => 1,
                'status_id' => UserStatus::APPROVED,
                'experience_id' => ''
            ],
            [
                'name' => 'Specialistas 1',
                'email' => 'specialistas1@solita.lt',
                'password' => Hash::make('password'),
                'street' => '',
                'house_flat' => '',
                "post_index" => '',
                'city' => '',
                'phone_number' => '',
                'work_info' => $faker->text(400),
                'hourly_price' => $faker->randomFloat(2, 5, 20),
                'type' => 2,
                'status_id' => UserStatus::APPROVED,
                'experience_id' => rand(1, 5)
            ],
            [
                'name' => 'Specialistas 2',
                'email' => 'specialistas2@solita.lt',
                'password' => Hash::make('password'),
                'street' => '',
                'house_flat' => '',
                "post_index" => '',
                'city' => '',
                'phone_number' => '',
                'work_info' => $faker->text(500),
                'hourly_price' => $faker->randomFloat(2, 5, 20),
                'type' => 2,
                'status_id' => UserStatus::APPROVED,
                'experience_id' => rand(1, 5)
            ],
            [
                'name' => 'Darbuotojas',
                'email' => 'darbuotojas@solita.lt',
                'password' => Hash::make('password'),
                'street' => '',
                'house_flat' => '',
                "post_index" => '',
                'city' => '',
                'phone_number' => '',
                'work_info' => '',
                'hourly_price' => null,
                'type' => 3,
                'status_id' => UserStatus::APPROVED,
                'experience_id' => ''
            ],
            [
                'name' => 'Client',
                'email' => 'client@solita.lt',
                'password' => Hash::make('password'),
                'street' => '',
                'house_flat' => '',
                "post_index" => '',
                'city' => '',
                'phone_number' => '',
                'work_info' => '',
                'hourly_price' => null,
                'type' => 4,
                'status_id' => UserStatus::APPROVED,
                'experience_id' => ''
            ],
        ]);
    }
}
