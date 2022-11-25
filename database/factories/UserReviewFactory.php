<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserReviewFactory extends Factory
{
    /**
     * If $userFromId and $userToId are different, then return array.
     * Else repeat until they are different.
     */
    private function checkIfUsersAreDifferent(int $userFromId, int $userToId, $faker): array
    {
        if ($userFromId === $userToId)
            return $this->definition();
        else
            return [
                'rating' => $faker->numberBetween(1, 5),
                'review' => $faker->sentence(10),
                'user_from_id' => $userFromId,
                'user_to_id' => $userToId,
                'created_at' => $faker->dateTimeBetween('-1 month')
            ];
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = $this->faker;

        $userFromId = $faker->numberBetween(4, 6);
        $userToId = $faker->numberBetween(4, 6);

        return $this->checkIfUsersAreDifferent($userFromId, $userToId, $faker);
    }
}
