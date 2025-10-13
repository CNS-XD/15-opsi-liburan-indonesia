<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Auth;

class RecoverController extends Controller
{
    public function index()
    {
        return view('pages.auth.recover');
    }
}
