<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use App\Models\Testimony;

class TestimonyController extends Controller
{
    public function index()
    {
        $testimonies = Testimony::where('show', Testimony::SHOW['publish'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('pages.frontsite.testimonies.index', compact('testimonies'));
    }
}