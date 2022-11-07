<?php

namespace App\Traits;

use App\Models\Ratings;
use Illuminate\Support\Facades\Auth;

trait ProductRatings
{
    public function getProductRatings(string $productId): object
    {
        return Ratings::query()->where('product_id', $productId)->get();
    }

    public function calculateRatingSumAndCount(object $ratings): array
    {
        $sum = 0;
        $count = 0;

        foreach ($ratings as $rating) {
            $sum += $rating['value'];
            $count++;
        }

        return [
            'sum' => $sum,
            'count' => $count
        ];
    }

    private function getProductRatingsByUserId(string $productId): mixed
    {
        return Ratings::query()
            ->where([
                'product_id' => $productId,
                'user_id' => Auth::user()->id ?? NULL
            ])
            ->get();
    }

    public function getVotedCondition(string $productId): bool
    {
        return count($this->getProductRatingsByUserId($productId)) > 0;
    }

    public function calculateAverageRating(float|int $sum, int $count): float|int
    {
        return $count > 0 ? round(($sum / $count),1) : 0;
    }
}
