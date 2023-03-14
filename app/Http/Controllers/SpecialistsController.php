<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Skill;
use App\Models\User;
use App\Traits\SkillServices;
use App\Traits\UserReviewServices;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SpecialistsController extends Controller
{
    use UserReviewServices, SkillServices;

    private function getFilteredSpecialists(): object
    {
        return QueryBuilder::for(User::class)
            ->crossJoin('skills_users', function ($join) {
                $join->on('users.id', '=', 'skills_users.user_id');
            })
            ->allowedFilters([
                'skills_users.skill_id',
                AllowedFilter::scope('rating_from'),
                AllowedFilter::scope('rating_to'),
            ])
            ->allowedIncludes('skills_users')
            ->select('users.id', 'users.name', 'users.average_rating', 'users.work_info', 'users.hourly_price')
            ->where('type', 2)
            ->groupBy('users.id', 'users.name', 'users.average_rating', 'users.work_info', 'users.hourly_price')
            ->paginate(100)
            ->appends(request()->query());
    }

    public function index(Request $request): Factory|View|Application
    {
        $filter = $request->query('filter');

        $selectedSkills = $filter && array_key_exists('skills_users.skill_id', $filter)
            ? $filter['skills_users.skill_id']
            : [];

        if (empty($selectedSkills))
            $filter['rating_to'] = ceil(User::where('type', 2)->get()->max('average_rating'));

        $specialists = $this->getFilteredSpecialists();

        return view('user_views.specialists.index')
            ->with([
                'specialists' => $specialists,
                'maxRating' => ceil($specialists->max('average_rating')),
                'skills' => $this->getSkills(),
                'filter' => $filter,
                'selectedSkills' => $selectedSkills ? explode(',', $selectedSkills) : [],
            ]);
    }
}
