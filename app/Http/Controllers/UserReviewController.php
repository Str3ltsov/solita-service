<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserReviewRequest;
use App\Models\UserReview;
use App\Traits\UserReviewServices;
use Illuminate\Http\Request;

class UserReviewController extends Controller
{
    use UserReviewServices;

    public function show($prefix, $id)
    {
        $user = $this->getReviewsUser($id);

        return view('user_views.reviews.show')
            ->with([
                'user' => $user,
                'reviewAverageRating' => $this->getReviewRatingAverage($user),
                'reviews' => $this->getReviewsByUserToId($id)
            ]);
    }

    public function store(CreateUserReviewRequest $request)
    {
        $validated = $request->validated();

        try {
            $userReview = UserReview::firstOrCreate([
                'rating' => $validated['rating'],
                'user_from_id' => $validated['user_from_id'],
                'user_to_id' => $validated['user_to_id'],
                'review' => $validated['review'],
                'created_at' => now()
            ]);

            if ($userReview->wasRecentlyCreated)
                return back()->with('success', __('messages.successUserReview'));
            else
                return back()->with('error', __('messages.errorUserReview'));
        }
        catch (\Throwable $exception) {
            return back()->with('error', $exception);
        }
    }
}
