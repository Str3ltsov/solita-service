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
                'name' => 'Igor',
                'email' => 'igor@getweb.lt',
                'password' => Hash::make('zhopazhopa'),
                'company_code' => null,
                'vat_code' => null,
                'street' => 'Birželio 23',
                'house_flat' => '3/9',
                'post_index' => 'LT 02178',
                'city' => 'Vilnius',
                'phone_number' => '37012345678',
                'work_info' => null,
                'hourly_price' => null,
                'type' => 1,
                'status_id' => UserStatus::APPROVED,
                'experience_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Andrej',
                'email' => 'andtaress2@gmail.com',
                'password' => Hash::make('caveman123'),
                'company_code' => null,
                'vat_code' => null,
                'street' => null,
                'house_flat' => null,
                'post_index' => null,
                'city' => null,
                'phone_number' => null,
                'work_info' => null,
                'hourly_price' => null,
                'type' => 1,
                'status_id' => UserStatus::APPROVED,
                'experience_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Administratorius',
                'email' => 'admin@solita.lt',
                'password' => Hash::make('123456789'),
                'company_code' => null,
                'vat_code' => null,
                'street' => null,
                'house_flat' => null,
                'post_index' => null,
                'city' => null,
                'phone_number' => null,
                'work_info' => null,
                'hourly_price' => null,
                'type' => 1,
                'status_id' => UserStatus::APPROVED,
                'experience_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Darbuotojas',
                'email' => 'darb@solita.lt',
                'password' => Hash::make('123456789'),
                'company_code' => $faker->randomNumber(9),
                'vat_code' => 'LT'.rand(100000000000, 1999999999),
                'street' => null,
                'house_flat' => null,
                'post_index' => null,
                'city' => null,
                'phone_number' => null,
                'work_info' => null,
                'hourly_price' => null,
                'type' => 3,
                'status_id' => UserStatus::APPROVED,
                'experience_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Projektų vadovas',
                'email' => 'spec@solita.lt',
                'password' => Hash::make('123456789'),
                'company_code' => null,
                'vat_code' => null,
                'street' => null,
                'house_flat' => null,
                'post_index' => null,
                'city' => null,
                'phone_number' => null,
                'work_info' => 'Išsilavinimas: aukštasis universitetinis išsilavinimas (ne žemesnis kaip bakalauro kvalifikacinis laipsnis). Dalyvavimo IT projektuose patirtis – ne mažiau 10 metų. IT projektų vadovavimo ir veiklų koordinavimo patirtis - ne mažiau 5 metai. Anglų kalbos mokėjimo lygis – ne mažiau C1.',
                'hourly_price' => 35,
                'type' => 2,
                'status_id' => UserStatus::APPROVED,
                'experience_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Programuotojas (front end/back end)',
                'email' => 'spec1@solita.lt',
                'password' => Hash::make('123456789'),
                'company_code' => null,
                'vat_code' => null,
                'street' => null,
                'house_flat' => null,
                'post_index' => null,
                'city' => null,
                'phone_number' => null,
                'work_info' => 'Išsilavinimas: aukštasis universitetinis išsilavinimas (ne žemesnis kaip bakalauro kvalifikacinis laipsnis) arba jam lygiavertė aukštojo mokslo kvalifikacija Informacinių technologijų ar programavimo srityje. Ne mažesnė kaip 2 metų programavimo srities darbo patirtis, kuriant bei įgivendinant užduotis, susijusias su sistemų dalių programavimu, jų integravimu. Anglų kalbos mokėjimo lygis – ne mažiau B2.',
                'hourly_price' => 27,
                'type' => 2,
                'status_id' => UserStatus::APPROVED,
                'experience_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'UAB "Nykštukas"',
                'email' => 'client@solita.lt',
                'password' => Hash::make('123456789'),
                'company_code' => $faker->randomNumber(9),
                'vat_code' => 'LT'.rand(100000000000, 1999999999),
                'street' => null,
                'house_flat' => null,
                'post_index' => null,
                'city' => null,
                'phone_number' => null,
                'work_info' => null,
                'hourly_price' => null,
                'type' => 4,
                'status_id' => UserStatus::APPROVED,
                'experience_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
