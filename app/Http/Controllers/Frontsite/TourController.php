<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use App\Models\Tour;
use App\Models\TourReview;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $query = Tour::with([
            'tour_photos' => function($query) {
                $query->where('show', 1);
            },
            'tour_prices', 
            'tour_departures.departure', 
            'tour_destinations.destination'
        ])->where('show', 1);

        // Apply filters
        if ($request->filled('destination')) {
            $query->whereHas('tour_destinations', function($q) use ($request) {
                $q->where('id_destination', $request->destination);
            });
        }

        if ($request->filled('departure')) {
            $query->whereHas('tour_departures', function($q) use ($request) {
                $q->where('id_departure', $request->departure);
            });
        }

        if ($request->filled('duration')) {
            $duration = $request->duration;
            if ($duration == '4') {
                $query->where('day_tour', '>=', 4);
            } else {
                $query->where('day_tour', $duration);
            }
        }

        if ($request->filled('price')) {
            $priceRange = $request->price;
            if ($priceRange == '200+') {
                $query->where('price', '>=', 200);
            } else {
                $prices = explode('-', $priceRange);
                if (count($prices) == 2) {
                    $query->whereBetween('price', [(int)$prices[0], (int)$prices[1]]);
                }
            }
        }

        // Apply sorting
        $sortBy = $request->get('sort', 'newest');
        switch ($sortBy) {
            case 'price-low':
                $query->orderBy('price', 'asc');
                break;
            case 'price-high':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                $query->where('is_best', 1)->orderBy('created_at', 'desc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
                break;
        }

        $tours = $query->paginate(12);

        // If AJAX request, return JSON
        if ($request->ajax()) {
            return response()->json([
                'html' => view('pages.frontsite.tours.partials.tour-cards', compact('tours'))->render(),
                'pagination' => $tours->links()->render(),
                'total' => $tours->total(),
                'count' => $tours->count()
            ]);
        }

        // Get destinations and departures for filters
        $destinations = \App\Models\Destination::orderBy('title', 'asc')->get();
        $departures = \App\Models\Departure::orderBy('title', 'asc')->get();

        return view('pages.frontsite.tours.index', compact('tours', 'destinations', 'departures'));
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