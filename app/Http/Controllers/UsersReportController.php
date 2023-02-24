<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Models\User;
use App\Mail\UsersReport;
use App\Exports\UsersReportExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Barryvdh\DomPDF\Facade\Pdf;
use Flash;
use DB;
use Excel;

class UsersReportController extends AppBaseController
{
    use forSelector;

    private function getUsers()
    {
        $users = QueryBuilder::for(User::class)
            ->allowedFilters([
                AllowedFilter::exact('id'),
                AllowedFilter::exact('name'),
                AllowedFilter::exact('email'),
                AllowedFilter::exact('phone_number'),
                AllowedFilter::exact('street'),
                AllowedFilter::exact('house_flat'),
                AllowedFilter::exact('post_index'),
                AllowedFilter::exact('city'),
                'role.id',
                'status.id',
                AllowedFilter::scope('date_from'),
                AllowedFilter::scope('date_to')
            ])
            ->orderBy('id')
            ->paginate(50);

        return $users;
    }

    public function index(Request $request)
    {
        return view('users_report.index')
            ->with([
                'users' => $this->getUsers(),
                'roles' => $this->rolesForSelector(),
                'statuses' => $this->userStatusForSelector(),
                'filter' => $request->query('filter') ?? ''
            ]);
    }

    public function sendEmail()
    {
        $users = $this->getUsers();

        Mail::to(Auth::user()->email)->send(new UsersReport($users));

        return back()->with('success', __('messages.successUsersReportEmail'));
    }

    public function downloadPdf()
    {
        $data = [
            'users' => $this->getUsers()
        ];

        $pdf = PDF::loadView('users_report.report', $data)
            ->setPaper('a3', 'landscape');

        return $pdf->download('users_report.pdf');
    }

    public function downloadCsv()
    {
        $users = $this->getUsers();

        return Excel::download(new UsersReportExport($users), 'users_report.csv');
    }
}
