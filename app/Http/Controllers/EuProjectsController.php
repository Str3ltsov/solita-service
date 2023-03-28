<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;

class EuProjectsController extends AppBaseController
{
    public function index(): Factory|View|Application
    {
        return view('user_views.eu_projects.index', ['lang' => app()->getLocale()]);
    }
}
