<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use App\Models\Departure;
use App\Models\Tour;

class DepartureController extends Controller
{
    public function index()
    {
        $departures = Departure::withCount(['tour_departures as tours_count' => function($query) {
                $query->whereHas('tour', function($q) {
                    $q->where('show', Tour::SHOW['publish']);
                });
            }])
            ->orderBy('tours_count', 'desc')
            ->paginate(12);

        return view('pages.frontsite.departures.index', compact('departures'));
    }

    public function show($id)
    {
        $departure = Departure::findOrFail($id);
        
        $tours = Tour::with([
            'tour_photos' => function($q) {
                $q->where('show', 1);
            },
            'tour_prices', 
            'tour_destinations.destination'
        ])
            ->whereHas('tour_departures', function($query) use ($id) {
                $query->where('id_departure', $id);
            })
            ->where('show', Tour::SHOW['publish'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('pages.frontsite.departures.show', compact('departure', 'tours'));
    }
}