<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Destination;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Tour::with(['tour_photos', 'tour_prices', 'tour_departures.departure', 'tour_destinations.destination'])
                ->where('show', Tour::SHOW['publish']);

            // Filter by destination
            if ($request->filled('destination')) {
                $query->whereHas('tour_destinations.destination', function($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->destination . '%');
                });
            }

            // Filter by day (duration)
            if ($request->filled('day')) {
                $days = (int) $request->day;
                $query->where(function($q) use ($days) {
                    $q->where('title', 'like', '%' . $days . ' day%')
                      ->orWhere('title', 'like', '%' . $days . 'd%')
                      ->orWhere('description', 'like', '%' . $days . ' day%');
                });
            }

            // Filter by type (private/sharing/group)
            if ($request->filled('type')) {
                $typeMap = [
                    'private' => 'Private',
                    'sharing' => 'Sharing',
                    'group' => 'Group'
                ];
                
                if (isset($typeMap[$request->type])) {
                    $query->where('title', 'like', '%' . $typeMap[$request->type] . '%');
                }
            }

            // Search by keyword
            if ($request->filled('keyword')) {
                $keyword = $request->keyword;
                $query->where(function($q) use ($keyword) {
                    $q->where('title', 'like', '%' . $keyword . '%')
                      ->orWhere('description', 'like', '%' . $keyword . '%');
                });
            }

            // Get tours and add price attribute
            $tours = $query->orderBy('created_at', 'desc')->paginate(12);
            
            // Add price attribute to each tour
            $tours->getCollection()->transform(function ($tour) {
                if ($tour->tour_prices && $tour->tour_prices->count() > 0) {
                    $tour->price = $tour->tour_prices->min('price');
                } else {
                    $tour->price = 0;
                }
                return $tour;
            });

            // Get all destinations for filter dropdown
            $destinations = Destination::orderBy('title', 'asc')->get();

            return view('pages.frontsite.search.index', [
                'tours' => $tours,
                'destinations' => $destinations,
                'request' => $request
            ]);
        } catch (\Exception $e) {
            // Log error with more details
            Log::error('Search Error: ' . $e->getMessage());
            
            // Create proper empty paginator
            $emptyTours = new \Illuminate\Pagination\LengthAwarePaginator(
                collect([]), // items
                0, // total
                12, // per page
                1, // current page
                [
                    'path' => request()->url(),
                    'pageName' => 'page'
                ]
            );
            
            return view('pages.frontsite.search.index', [
                'tours' => $emptyTours,
                'destinations' => Destination::orderBy('title', 'asc')->get(),
                'request' => $request
            ]);
        }
    }

    public function suggestions(Request $request)
    {
        if (!$request->filled('q')) {
            return response()->json([]);
        }

        $keyword = $request->q;
        
        // Search destinations
        $destinations = Destination::where('title', 'ILIKE', '%' . $keyword . '%')
            ->whereHas('tour_destinations.tour', function($query) {
                $query->where('show', Tour::SHOW['publish']);
            })
            ->limit(5)
            ->get()
            ->map(function($destination) {
                return [
                    'type' => 'destination',
                    'title' => $destination->title,
                    'subtitle' => 'Destination'
                ];
            });

        // Search tours
        $tours = Tour::where('show', Tour::SHOW['publish'])
            ->where(function($q) use ($keyword) {
                $q->where('title', 'ILIKE', '%' . $keyword . '%')
                  ->orWhere('description', 'ILIKE', '%' . $keyword . '%');
            })
            ->limit(5)
            ->get()
            ->map(function($tour) {
                return [
                    'type' => 'tour',
                    'title' => $tour->title,
                    'subtitle' => 'Tour Package'
                ];
            });

        $suggestions = $destinations->concat($tours)->take(10);

        return response()->json($suggestions);
    }
}