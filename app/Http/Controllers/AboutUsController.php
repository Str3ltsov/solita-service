<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Flash;
use Response;

class AboutUsController extends Controller
{
    public function index( Request $request ) {
        return view('user_views.about.index', ['lang' => app()->getLocale()]);
    }

}
