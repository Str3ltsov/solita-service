<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\UserReviewServices;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;

class SpecialistsController extends Controller
{
    use UserReviewServices;

    private object $specialists;

    public function __construct()
    {
        $this->specialists = $this->getSpecialists();
    }

    private function getSpecialists(): LengthAwarePaginator
    {
        return User::select('id', 'name', 'work_info', 'hourly_price')->where('type', 2)->paginate(5);
    }

    private function getForEachUserAverageRating(object $specialists)
    {
        foreach ($specialists as $specialist) {
            $specialist->averageRating = round($this->getReviewRatingAverage($specialist), 1);
        }
    }

    public function index(): Factory|View|Application
    {
        $this->getForEachUserAverageRating($this->specialists);

        return view('user_views.specialists.index')
            ->with('specialists', $this->specialists);
    }
}
