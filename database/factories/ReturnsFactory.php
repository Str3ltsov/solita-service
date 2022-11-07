<?php

namespace Database\Factories;

use App\Models\Returns;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReturnsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Returns::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomDigitNotNull,
        'admin_id' => $this->faker->randomDigitNotNull,
        'order_id' => $this->faker->randomDigitNotNull,
        'code' => $this->faker->word,
        'description' => $this->faker->word,
        'status_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
