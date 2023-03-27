<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\SkillServices;
use App\Traits\UserReviewServices;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SpecialistsController extends Controller
{
    use UserReviewServices, SkillServices, forSelector;

    private object $specialists;

    public function __construct()
    {
        $this->specialists = User::where('type', 2)->get();
    }

    private function getFilterByOrder($selectedOrder): array
    {
        return match ((int)$selectedOrder) {
            0 => ["users.id", "asc"],
            1 => ["users.name", "asc"],
            2 => ["users.name", "desc"],
            3 => ["users.average_rating", "asc"],
            4 => ["users.average_rating", "desc"]
        };
    }

    private function getFilteredSpecialists(string $orderBy, string $orderByDirection): object
    {
        return QueryBuilder::for(User::class)
            ->leftJoin('experiences', 'experience_id', '=', 'experiences.id')
            ->crossJoin('skills_users', function ($join) {
                $join->on('users.id', '=', 'skills_users.user_id');
            })
            ->allowedFilters([
                'skills_users.skill_id',
                AllowedFilter::scope('rating_from'),
                AllowedFilter::scope('rating_to'),
            ])
            ->allowedIncludes('skills_users')
            ->select('users.id', 'users.name', 'users.average_rating', 'users.work_info', 'users.hourly_price', 'experiences.name AS experience_name')
            ->where('type', 2)
            ->groupBy('users.id', 'users.name', 'users.average_rating', 'users.work_info', 'users.hourly_price', 'experience_name')
            ->orderBy($orderBy, $orderByDirection)
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
            $filter['rating_to'] = ceil($this->specialists->max('average_rating'));

        $selectedOrder = $request->order != null ? $request->order : 0;

        $orderBy = $this->getFilterByOrder($selectedOrder)[0];
        $orderByDirection = $this->getFilterByOrder($selectedOrder)[1];

        $specialists = $this->getFilteredSpecialists($orderBy, $orderByDirection);

        return view('user_views.specialists.index')
            ->with([
                'totalSpecialistCount' => count($this->specialists),
                'specialists' => $specialists,
                'maxRating' => ceil($specialists->max('average_rating')),
                'skills' => $this->getSkills(),
                'filter' => $filter,
                'selectedSkills' => $selectedSkills ? explode(',', $selectedSkills) : [],
                'orderList' => $this->specialistsOrderSelector(),
                'selectedOrder' => $selectedOrder
            ]);
    }
}
