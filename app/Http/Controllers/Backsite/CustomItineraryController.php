<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use App\Models\CustomItinerary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomItineraryController extends Controller
{
    public function index()
    {
        $customItineraries = CustomItinerary::with(['destinations.destination', 'activities'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('pages.backsite.custom-itinerary.index', compact('customItineraries'));
    }

    public function show($id)
    {
        $customItinerary = CustomItinerary::with(['destinations.destination', 'activities'])
            ->findOrFail($id);
        
        return view('pages.backsite.custom-itinerary.show', compact('customItinerary'));
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:pending,review,quoted,confirmed,cancelled',
                'admin_notes' => 'nullable|string',
                'estimated_price' => 'nullable|numeric|min:0',
                'final_price' => 'nullable|numeric|min:0'
            ]);

            $customItinerary = CustomItinerary::findOrFail($id);
            
            $customItinerary->update([
                'status' => $request->status,
                'admin_notes' => $request->admin_notes,
                'estimated_price' => $request->estimated_price,
                'final_price' => $request->final_price
            ]);

            // Send email notification to customer (optional)
            Log::info('Custom itinerary status updated', [
                'id' => $customItinerary->id,
                'status' => $request->status,
                'old_status' => $customItinerary->getOriginal('status')
            ]);

            return redirect()->back()->with('success', 'Custom itinerary status updated successfully!');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Failed to update custom itinerary status: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update status: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $customItinerary = CustomItinerary::findOrFail($id);
        $customItinerary->delete();

        return redirect()->route('backsite.custom-itinerary.index')
            ->with('success', 'Custom itinerary request deleted successfully!');
    }

    public function export()
    {
        // You can implement CSV/Excel export here
        $customItineraries = CustomItinerary::with(['destinations.destination', 'activities'])
            ->orderBy('created_at', 'desc')
            ->get();

        $filename = 'custom_itineraries_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($customItineraries) {
            $file = fopen('php://output', 'w');
            
            // CSV Headers
            fputcsv($file, [
                'ID',
                'Customer Name',
                'Email',
                'Phone',
                'Participants',
                'Duration (Days)',
                'Budget Range',
                'Destinations',
                'Tour Type',
                'Accommodation',
                'Transportation',
                'Status',
                'Created At'
            ]);

            // CSV Data
            foreach ($customItineraries as $itinerary) {
                $destinations = $itinerary->destinations->pluck('destination.title')->join(', ');
                
                fputcsv($file, [
                    $itinerary->id,
                    $itinerary->customer_name,
                    $itinerary->email,
                    $itinerary->phone,
                    $itinerary->total_participants . ' (' . $itinerary->participants_adult . ' Adults, ' . $itinerary->participants_child . ' Children)',
                    $itinerary->duration_days,
                    $itinerary->budget_range,
                    $destinations,
                    $itinerary->tour_type_label,
                    $itinerary->accommodation_level_label,
                    $itinerary->transportation_type_label,
                    $itinerary->status_label,
                    $itinerary->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}