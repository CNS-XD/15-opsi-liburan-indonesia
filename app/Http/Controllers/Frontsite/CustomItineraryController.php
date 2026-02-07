<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\CustomItinerary;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class CustomItineraryController extends Controller
{
    public function index()
    {
        $destinations = Destination::orderBy('title', 'asc')->get();
        
        return view('pages.frontsite.custom-itinerary.index', compact('destinations'));
    }

    public function store(Request $request)
    {        
        try {
            $validated = $request->validate([
                'customer_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'participants_adult' => 'required|integer|min:1',
                'participants_child' => 'nullable|integer|min:0',
                'budget_min' => 'nullable|numeric|min:0',
                'budget_max' => 'nullable|numeric|min:0',
                'duration_days' => 'required|integer|min:1',
                'travel_date_start' => 'nullable|date',
                'travel_date_end' => 'nullable|date',
                'date_flexible' => 'boolean',
                'tour_type' => 'required|in:private,sharing,group',
                'accommodation_level' => 'required|in:budget,standard,luxury',
                'transportation_type' => 'required|in:car,bus,flight',
                'special_requirements' => 'nullable|string',
                'destinations' => 'required|array|min:1',
                'destinations.*' => 'exists:destinations,id',
                'activities' => 'nullable|array',
                'activities.*' => 'string'
            ]);

            // Create custom itinerary
            $customItinerary = CustomItinerary::create([
                'customer_name' => $validated['customer_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'participants_adult' => $validated['participants_adult'],
                'participants_child' => $validated['participants_child'] ?? 0,
                'budget_min' => $validated['budget_min'] ?? null,
                'budget_max' => $validated['budget_max'] ?? null,
                'duration_days' => $validated['duration_days'],
                'travel_date_start' => $validated['travel_date_start'] ?? null,
                'travel_date_end' => $validated['travel_date_end'] ?? null,
                'date_flexible' => $validated['date_flexible'] ?? false,
                'tour_type' => $validated['tour_type'],
                'accommodation_level' => $validated['accommodation_level'],
                'transportation_type' => $validated['transportation_type'],
                'special_requirements' => $validated['special_requirements'] ?? null,
                'status' => 'pending'
            ]);

            // Save selected destinations
            if (!empty($validated['destinations'])) {
                foreach ($validated['destinations'] as $index => $destinationId) {
                    $customItinerary->destinations()->create([
                        'id_destination' => $destinationId,
                        'sequence_order' => $index + 1,
                        'days_allocated' => 1 // Default, can be customized later
                    ]);
                }
            }

            // Save activities if provided
            if (!empty($validated['activities'])) {
                foreach ($validated['activities'] as $activity) {
                    $customItinerary->activities()->create([
                        'activity_name' => $activity,
                        'activity_type' => 'general'
                    ]);
                }
            }

            return redirect()->route('frontsite.custom-itinerary.success', $customItinerary->request_code)
                ->with('success', 'Your custom itinerary request has been submitted successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Custom itinerary validation failed', ['errors' => $e->errors()]);
            
            return back()->withErrors($e->errors())->withInput()
                ->with('error', 'Please check the form and try again.');
                
        } catch (\Exception $e) {
            Log::error('Custom itinerary creation failed: ' . $e->getMessage());
            
            return back()->withInput()
                ->with('error', 'Failed to submit your request. Please try again.');
        }
    }

    public function success(CustomItinerary $customItinerary)
    {
        $customItinerary->load(['destinations.destination', 'activities']);
        
        return view('pages.frontsite.custom-itinerary.success', compact('customItinerary'));
    }

    public function show(CustomItinerary $customItinerary)
    {
        $customItinerary->load(['destinations.destination', 'activities']);
        
        return view('pages.frontsite.custom-itinerary.show', compact('customItinerary'));
    }
}