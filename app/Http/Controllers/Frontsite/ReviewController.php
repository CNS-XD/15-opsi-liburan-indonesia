<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use App\Models\TourReview;
use App\Models\Tour;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000'
        ]);

        $tour = Tour::findOrFail($request->tour_id);

        TourReview::create([
            'id_tour' => $request->tour_id,
            'name' => $request->name,
            'description' => $request->review,
            'rating' => $request->rating,
            'show' => 0, // pending approval
            'created_by' => $request->name
        ]);

        return redirect()->back()->with('success', 'Thank you for your review! It will be published after moderation.');
    }

    public function index($tourSlug)
    {
        $tour = Tour::where('slug', $tourSlug)->firstOrFail();
        
        $reviews = TourReview::where('id_tour', $tour->id)
            ->where('show', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $averageRating = $reviews->avg('rating') ?? 0;
        $totalReviews = $reviews->total();

        // Rating distribution
        $ratingDistribution = [];
        for ($i = 5; $i >= 1; $i--) {
            $count = TourReview::where('id_tour', $tour->id)
                ->where('show', 1)
                ->where('rating', $i)
                ->count();
            $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
            $ratingDistribution[$i] = [
                'count' => $count,
                'percentage' => $percentage
            ];
        }

        return view('pages.frontsite.tours.reviews', compact('tour', 'reviews', 'averageRating', 'totalReviews', 'ratingDistribution'));
    }
}