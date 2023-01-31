<?php

namespace Database\Seeders;

use App\Models\OrderQuestion;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class OrderQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $rateQuestion = [
            'en' => ['question' => "Rate order"],
            'lt' => ['question' => "Įvertinkite užsakymą"],
            'ru' => ['question' => "Оцените заказ"],
        ];

        OrderQuestion::create($rateQuestion);

        for ($i = 0; $i < 5; $i++) {
            $questions = [
                'en' => ['question' => "question {$faker->text(50)}"],
                'lt' => ['question' => "klausimas {$faker->text(50)}"],
                'ru' => ['question' => "вопрос {$faker->text(50)}"],
            ];

            OrderQuestion::create($questions);
        }
    }
}
