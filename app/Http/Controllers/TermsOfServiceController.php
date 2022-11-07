<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TermsOfServiceController extends AppBaseController
{
    public function index(Request $request) {
        return view('user_views.terms.index', ['lang' => app()->getLocale()]);
    }

    public function policy(Request $request) {
        return view('user_views.terms.policy', ['lang' => app()->getLocale()]);
    }
}
