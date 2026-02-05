<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use App\Models\Tour;
use App\Models\TourReview;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::with([
            'tour_photos' => function($query) {
                $query->where('show', 1);
            },
            'tour_prices', 
            'tour_departures.departure', 
            'tour_destinations.destination'
        ])
            ->where('show', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // Add price attribute to each tour
        $tours->getCollection()->transform(function ($tour) {
            if ($tour->tour_prices && $tour->tour_prices->count() > 0) {
                $tour->price = $tour->tour_prices->min('price');
            } else {
                $tour->price = 0;
            }
            return $tour;
        });

        return view('pages.frontsite.tours.index', compact('tours'));
    }

    public function show($slug)
    {
        $tour = Tour::with([
            'tour_photos' => function($query) {
                $query->where('show', 1);
            },
            'tour_prices',
            'tour_departures.departure',
            'tour_destinations.destination',
            'tour_details',
            'tour_reviews' => function($query) {
                $query->where('show', 1)->orderBy('created_at', 'desc');
            }
        ])->where('slug', $slug)
          ->where('show', 1)
          ->firstOrFail();

        // Calculate average rating
        $averageRating = $tour->tour_reviews->avg('rating') ?? 0;
        $totalReviews = $tour->tour_reviews->count();

        // Get related tours
        $relatedTours = Tour::with([
            'tour_photos' => function($q) {
                $q->where('show', 1);
            },
            'tour_prices'
        ])
            ->where('show', 1)
            ->where('id', '!=', $tour->id)
            ->limit(4)
            ->get();

        return view('pages.frontsite.tours.show', compact('tour', 'averageRating', 'totalReviews', 'relatedTours'));
    }
}