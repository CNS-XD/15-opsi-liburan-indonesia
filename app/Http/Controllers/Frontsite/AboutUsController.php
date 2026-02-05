<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use App\Models\About;
use App\Models\Advantage;
use App\Models\Testimony;

class AboutUsController extends Controller
{
    public function index()
    {
        $about = About::first();
        
        $advantages = Advantage::orderBy('created_at', 'asc')->get();
        
        $testimonies = Testimony::where('show', Testimony::SHOW['publish'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.frontsite.about-us.index', compact('about', 'advantages', 'testimonies'));
    }
}
