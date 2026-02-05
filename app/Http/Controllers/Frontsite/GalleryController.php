<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use App\Models\TourPhoto;
use App\Models\Tour;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = TourPhoto::with('tour')
            ->where('show', 1)
            ->whereHas('tour', function($query) {
                $query->where('show', Tour::SHOW['publish']);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(24);

        return view('pages.frontsite.gallery.index', compact('photos'));
    }
}