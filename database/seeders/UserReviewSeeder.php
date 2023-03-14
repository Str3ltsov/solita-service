<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserReview;
use App\Traits\UserReviewServices;
use Illuminate\Database\Seeder;

class UserReviewSeeder extends Seeder
{
    use UserReviewServices;

    private function setAverageRatingForUsers(object $users): void
    {
        foreach ($users as $user) {
            $this->calculateReviewRatingAverage($user);
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserReview::factory()->count(20)->create();

        $this->setAverageRatingForUsers(User::all());
    }
}
