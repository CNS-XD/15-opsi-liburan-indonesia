<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use App\Models\Faq;

class AboutUsController extends Controller
{
    public function index()
    {
        return view('pages.frontsite.about-us.index');
    }
}
