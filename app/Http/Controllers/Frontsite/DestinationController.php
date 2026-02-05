<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use App\Models\Destination;
use App\Models\Tour;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::withCount(['tour_destinations as tours_count' => function($query) {
                $query->whereHas('tour', function($q) {
                    $q->where('show', Tour::SHOW['publish']);
                });
            }])
            ->orderBy('tours_count', 'desc')
            ->paginate(12);

        return view('pages.frontsite.destinations.index', compact('destinations'));
    }

    public function show($id)
    {
        $destination = Destination::findOrFail($id);
        
        $tours = Tour::with([
            'tour_photos' => function($q) {
                $q->where('show', 1);
            },
            'tour_prices', 
            'tour_departures.departure'
        ])
            ->whereHas('tour_destinations', function($query) use ($id) {
                $query->where('id_destination', $id);
            })
            ->where('show', Tour::SHOW['publish'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('pages.frontsite.destinations.show', compact('destination', 'tours'));
    }
}