<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use App\Models\DivisiKompetisi;
use App\Models\Faq;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.frontsite.index');
    }
}
