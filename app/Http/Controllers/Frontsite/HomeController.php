<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use App\Models\Tour;
use App\Models\Slider;
use App\Models\Destination;

class HomeController extends Controller
{
    public function index()
    {
        // Get active sliders (show = 1) ordered by created_at
        $sliders = Slider::published()
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Get destinations with tour count
        $destinations = Destination::withCount(['tour_destinations as tour_destinations_count' => function($query) {
                $query->whereHas('tour', function($q) {
                    $q->where('show', Tour::SHOW['publish']);
                });
            }])
            ->orderBy('tour_destinations_count', 'desc')
            ->get();

        // If no destinations with tours, get all destinations
        if ($destinations->where('tour_destinations_count', '>', 0)->count() == 0) {
            $destinations = Destination::withCount(['tour_destinations as tour_destinations_count' => function($query) {
                    $query->whereHas('tour', function($q) {
                        $q->where('show', Tour::SHOW['publish']);
                    });
                }])
                ->orderBy('title', 'asc')
                ->get();
        }

        // Get popular tours (is_best = 1 and show = 1) with related data
        $popularTours = Tour::with([
            'tour_photos' => function($q) {
                $q->where('show', 1);
            },
            'tour_prices', 
            'tour_departures'
        ])
            ->where('is_best', 1)
            ->where('show', 1)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('pages.frontsite.home.index', compact('sliders', 'destinations', 'popularTours'));
    }
}
