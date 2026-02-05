<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use App\Models\Tour;
use App\Models\Slider;
use App\Models\Destination;
use App\Models\Advantage;
use App\Models\Blog;
use App\Models\Testimony;
use App\Models\Partner;

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

        // Get advantages (show = 1) ordered by created_at
        $advantages = Advantage::where('show', 1)
            ->orderBy('created_at', 'asc')
            ->limit(6)
            ->get();

        // Get one day tours (day_tour = 1 day) with related data
        $oneDayTours = Tour::with([
            'tour_photos' => function($q) {
                $q->where('show', 1);
            },
            'tour_prices', 
            'tour_departures'
        ])
            ->where('show', 1)
            ->where('day_tour', 1) // Filter for 1-day tours
            ->orderBy('is_best', 'desc') // Prioritize best tours
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Get last minute deals (tours with multiple prices for discount display)
        // $lastMinuteDeals = Tour::with([
        //     'tour_photos' => function($q) {
        //         $q->where('show', 1);
        //     },
        //     'tour_prices', 
        //     'tour_departures'
        // ])
        //     ->where('show', 1)
        //     ->whereHas('tour_prices', function($q) {
        //         $q->havingRaw('COUNT(*) > 1'); // Tours with multiple prices for discount
        //     })
        //     ->orderBy('is_best', 'desc')
        //     ->orderBy('created_at', 'desc')
        //     ->limit(3)
        //     ->get();

        // Get latest blogs (show = 1) for Travel Inspirations section
        $blogs = Blog::where('show', Blog::SHOW['publish'])
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Get testimonials (show = 1) for Hear It from Travelers section
        $testimonials = Testimony::where('show', Testimony::SHOW['publish'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Get partners (show = 1) for Our Partner section
        $partners = Partner::where('show', Partner::SHOW['publish'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.frontsite.home.index', compact('sliders', 'destinations', 'popularTours', 'advantages', 'oneDayTours', 'blogs', 'testimonials', 'partners'));
    }
}
