<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $p = null;
        for ($i=0; $i<=20; $i++){
               $cdata = [
                'parent_id' => null,
                'en' => [
                    'name' => "category $faker->name",
                    'description' => "category $faker->text",
                ],
                'lt' => [
                    'name' => "kategorija $faker->name",
                    'description' => "kategorija $faker->text",
                ],
                /*'ru' => [
                    'name' => "RUcategory $faker->name",
                    'description' => "RUcategory $faker->text",
                ],*/
            ];
               $category = Category::create($cdata);
        }

        for ($i=0; $i<=20; $i++){
            $p = $i > 5 ? rand(1,10) : null;
            DB::table('categories')->where('id', $i)->update(['parent_id' => $p]);
        }
    }
}
