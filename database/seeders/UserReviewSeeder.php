<?php

namespace Database\Seeders;

use App\Models\UserReview;
use Illuminate\Database\Seeder;

class UserReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserReview::factory()->count(20)->create();
    }
}
