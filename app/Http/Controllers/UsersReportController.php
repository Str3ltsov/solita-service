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
use Flash;
use DB;
use PDF;
use Excel;

class UsersReportController extends AppBaseController
{
    private function getUsers() 
    {
        $users = QueryBuilder::for(User::class)
            ->allowedFilters([
                AllowedFilter::exact('id'), 
                'name',
                'email',
                'phone_number',
                'street',
                'house_flat',
                'post_index',
                'city',
                'type', 
                AllowedFilter::scope('date_from'), 
                AllowedFilter::scope('date_to')
            ])
            ->orderBy('id')
            ->get();

        return $users;
    }
    
    public function index()
    {
        $users = $this->getUsers();

        return view('users_report.index')->with('users', $users);
    }

    public function sendEmail() 
    {
        $users = $this->getUsers();
        $email = Auth::user()->email;
        
        Mail::to($email)->send(new UsersReport($users, $email));

        Flash::success('Email has been sent.');

        return view('users_report.index')
            ->with(['users' => $users]);
    }

    public function downloadPdf() 
    {
        $data = [
            'users' => $this->getUsers()
        ];

        $pdf = PDF::loadView('users_report.report', $data);

        return $pdf->download('users_report.pdf');
    }

    public function downloadCsv()
    {
        $users = $this->getUsers();

        return Excel::download(new UsersReportExport($users), 'users_report.csv');
    }
}
