<?php

namespace App\Http\Controllers\Frontsite;

use Illuminate\Routing\Controller;
use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'tour_id' => 'required|exists:tours,id',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'travelers' => 'required|integer|min:1',
                'preferred_date' => 'required|date|after_or_equal:today',
                'special_requests' => 'nullable|string|max:1000'
            ]);

            $tour = Tour::findOrFail($request->tour_id);
            
            // Generate booking code
            $bookingCode = 'OLI-' . strtoupper(Str::random(8));
            
            // Calculate total price
            $totalPrice = $tour->price * $request->travelers;

            $booking = Booking::create([
                'id_tour' => $request->tour_id,
                'id_tour_price' => null, // We'll set this to null for now since we're using base tour price
                'booking_code' => $bookingCode,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'travelers' => $request->travelers,
                'preferred_date' => $request->preferred_date,
                'special_requests' => $request->special_requests,
                'total_price' => $totalPrice,
                'status' => 'pending',
                'order_date' => now()->toDateString(),
                'created_by' => $request->email
            ]);

            // Send confirmation email (you can implement this later)
            // Mail::to($request->email)->send(new BookingConfirmation($booking));

            return redirect()->route('frontsite.payment.show', $booking->booking_code)
                            ->with('success', 'Your booking has been submitted successfully! Please complete the payment.');
                            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                            ->withErrors($e->validator)
                            ->withInput()
                            ->with('error', 'Please check the form and try again.');
        } catch (\Exception $e) {
            \Log::error('Booking creation failed: ' . $e->getMessage());
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Something went wrong. Please try again or contact support.');
        }
    }

    public function success($bookingCode)
    {
        $booking = Booking::with('tour')->where('booking_code', $bookingCode)->firstOrFail();
        
        return view('pages.frontsite.booking.success', compact('booking'));
    }

    public function show($bookingCode)
    {
        $booking = Booking::with('tour')->where('booking_code', $bookingCode)->firstOrFail();
        
        return view('pages.frontsite.booking.show', compact('booking'));
    }
}