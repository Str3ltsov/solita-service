<?php

namespace App\Traits;

use App\Models\User;
use App\Models\UserReview;
use Illuminate\Database\Eloquent\Collection;

trait UserReviewServices
{
    private static float $reviewAverageRating = 0.0;

    public function getReviewsUser(int $userToId)
    {
        return User::select('id', 'name', 'email')->where('id', $userToId)->first();
    }

    public function getReviewsByUserToId(int $userToId)
    {
        $userReviews = UserReview::all()
            ->where('user_to_id', $userToId);

        if (count($userReviews) === 0)
            return $userReviews;

        return $userReviews
            ->toQuery()
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }

    private function calculateReviewRatingAverage(object $user): void
    {
        $reviewRatingTotal = 0;

        foreach ($user->reviews as $i => $review) {
            $i++;
            $reviewRatingTotal += $review->rating;
            self::$reviewAverageRating = $reviewRatingTotal / $i;
        }
    }

    public function getReviewRatingAverage(object $user): float
    {
        $this->calculateReviewRatingAverage($user);

        return self::$reviewAverageRating;
    }
}
