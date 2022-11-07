<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'price' => $this->faker->word,
        'count' => $this->faker->randomDigitNotNull,
        'description' => $this->faker->text,
        'image' => $this->faker->word,
        'video' => $this->faker->word,
        'visible' => $this->faker->randomDigitNotNull,
        'promotion_id' => $this->faker->randomDigitNotNull,
        'discount_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
