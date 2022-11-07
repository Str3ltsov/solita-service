<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserActivitiesReportExport implements FromView
{
    private $userActivities;

    public function __construct($userActivities)
    {
        $this->userActivities = $userActivities;
    }

    public function view(): View
    {
        return view('user_activities_report.report', 
            ['userActivities' => $this->userActivities]);
    }
}
