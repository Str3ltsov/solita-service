<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Models\LogActivity;
use App\Mail\UserActivitiesReport;
use App\Exports\UserActivitiesReportExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Barryvdh\DomPDF\Facade\Pdf;
use Flash;
use DB;
use Excel;

class UserActivitiesReportController extends AppBaseController
{
    use forSelector;

    private function getUserActivities()
    {
        $userActivities = QueryBuilder::for(LogActivity::class)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            'user.name',
            'user.email',
            'user.type',
            'activity',
            AllowedFilter::scope('date_from'),
            AllowedFilter::scope('date_to')
        ])
        ->allowedIncludes(['user'])
        ->orderBy('created_at', 'DESC')
        ->paginate(50);

        return $userActivities;
    }

    public function index(Request $request)
    {
        $userActivities = $this->getUserActivities();

        return view('user_activities_report.index')
            ->with([
                'userActivities' => $userActivities,
                'roles' => $this->rolesForSelector(),
                'filter' => $request->query('filter') ?? ''
            ]);
    }

    public function sendEmail()
    {
        $userActivities = $this->getUserActivities();

        Mail::to(Auth::user()->email)->send(new UserActivitiesReport($userActivities));

        return back()->with('success', __('messages.successUserActivitiesReportEmail'));
    }

    public function downloadPdf()
    {
        $data = [
            'userActivities' => $this->getUserActivities()
        ];

        $pdf = PDF::loadView('user_activities_report.report', $data)
            ->setPaper('a3', 'landscape');

        return $pdf->download('user_activities_report.pdf');
    }

    public function downloadCsv()
    {
        $userActivities = $this->getUserActivities();

        return Excel::download(new UserActivitiesReportExport($userActivities),
            'user_activities_report.csv');
    }
}
