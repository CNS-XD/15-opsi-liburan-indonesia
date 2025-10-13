<?php

namespace App\Http\Controllers; // ⬅️ DIPINDAH KE SINI

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BacksiteController extends Controller
{
    public function index()
    {
        return view('pages.backsite.index');
    }
}