<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use App\Models\DivisiKompetisi;
use App\Models\Faq;
use App\Models\Tour;

class HomeController extends Controller
{
    public function index()
    {
        // Get popular tours (is_best = 1 and show = 1) with related data
        $popularTours = Tour::with(['tour_photos', 'tour_prices', 'tour_departures'])
            ->where('is_best', 1)
            ->where('show', 1)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('pages.frontsite.home.index', compact('popularTours'));
    }
}
