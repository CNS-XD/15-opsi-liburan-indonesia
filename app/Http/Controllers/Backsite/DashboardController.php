<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use App\Models\DivisiKompetisi;
use App\Models\Tahapan;
use App\Models\User;
use Session;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.backsite.dashboard');
    }
}
