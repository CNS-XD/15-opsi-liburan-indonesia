<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\BookingRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Booking;
use App\Models\Payment;
use App\Services\CurrencyService;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BookingController extends Controller
{
    use \App\Traits\AjaxTrait;
    
    protected $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!empty(session('error_msg')))
            Alert::error('Failed !', session('error_msg'))->persistent('Tutup');
        if (!empty(session('success')))
            Alert::success('Success !', session('success'));
        
        // Get booking statistics
        $data['stats'] = [
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', Booking::STATUS_PENDING)->count(),
            'confirmed_bookings' => Booking::where('status', Booking::STATUS_CONFIRMED)->count(),
            'cancelled_bookings' => Booking::where('status', Booking::STATUS_CANCELLED)->count(),
            'completed_bookings' => Booking::where('status', Booking::STATUS_COMPLETED)->count(),
            'total_revenue' => Payment::where('status', Payment::STATUS_PAID)->sum('amount'),
            'pending_payments' => Payment::where('status', Payment::STATUS_PENDING)->count(),
        ];

        // Add exchange rate info
        $data['exchange_rate'] = $this->currencyService->getExchangeRateInfo();

        return view('pages.backsite.booking.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::with(['tour', 'tourPrice', 'payments'])->findOrFail($id);
        
        return view('pages.backsite.booking.show', compact('booking'));
    }

    /**
     * Update booking status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $request->status]);

        Alert::success('Success!', 'Status booking berhasil diupdate');
        return redirect()->back();
    }

    /**
     * DataTable for bookings
     */
    public function datatable()
    {
        $query = Booking::with([
                'tour:id,title',
                'tour.tour_destinations.destination:id,title',
                'tourPrice:id,price',
                'latestPayment'
            ])
            ->select('bookings.*')
            ->latest('created_at');

        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('booking_code', function ($row) {
                return '<span class="badge badge-primary">' . $row->booking_code . '</span>';
            })

            ->addColumn('customer_info', function ($row) {
                return '<div class="customer-info">
                    <strong>' . $row->name . '</strong><br>
                    <small class="text-muted">' . $row->email . '</small><br>
                    <small class="text-muted">' . $row->phone . '</small>
                </div>';
            })

            ->addColumn('tour_info', function ($row) {
                $tour = $row->tour;
                $destinations = 'Multiple Destinations';
                
                if ($tour && $tour->tour_destinations && $tour->tour_destinations->count() > 0) {
                    $destinationNames = $tour->tour_destinations
                        ->pluck('destination.title')
                        ->filter()
                        ->take(2);
                    
                    if ($destinationNames->count() > 0) {
                        $destinations = $destinationNames->implode(', ');
                        if ($tour->tour_destinations->count() > 2) {
                            $destinations .= '...';
                        }
                    }
                }
                
                return '<div class="tour-info">
                    <strong>' . ($tour->title ?? '-') . '</strong><br>
                    <small class="text-muted"><i class="fa fa-map-marker"></i> ' . $destinations . '</small>
                </div>';
            })

            ->addColumn('booking_details', function ($row) {
                return '<div class="booking-details">
                    <strong>' . $row->travelers . ' orang</strong><br>
                    <small class="text-muted">Keberangkatan: ' . \Carbon\Carbon::parse($row->preferred_date)->format('d M Y') . '</small>
                </div>';
            })

            ->addColumn('total_amount', function ($row) {
                $idrAmount = $this->currencyService->convertUsdToIdr($row->total_price);
                return '<div class="amount-info">
                    <strong>$' . number_format($row->total_price, 2) . '</strong><br>
                    <small class="text-muted">Rp ' . number_format($idrAmount, 0, ',', '.') . '</small>
                </div>';
            })

            ->addColumn('booking_status', function ($row) {
                return '<span class="badge ' . $row->status_badge_class . '">' . $row->status_label . '</span>';
            })

            ->addColumn('payment_status', function ($row) {
                $payment = $row->latestPayment;
                if (!$payment) {
                    return '<span class="badge badge-light">No Payment</span>';
                }
                
                return '<div class="payment-info">
                    <span class="badge ' . $payment->status_badge_class . '">' . $payment->status_label . '</span><br>
                    <small class="text-muted">' . $payment->formatted_payment_method . '</small>
                </div>';
            })

            ->addColumn('created_at', function ($row) {
                return '<div class="date-info">
                    <strong>' . $row->created_at . '</strong><br>
                    <small class="text-muted">by ' . ($row->created_by ?? 'System') . '</small>
                </div>';
            })

            ->addColumn('action', function ($row) {
                return '<div class="btn-group" role="group">
                    <a href="' . route('backsite.booking.show', $row->id) . '" class="btn btn-info btn-sm" title="Detail">
                        <i class="fa fa-eye"></i>
                    </a>
                    <button type="button" class="btn btn-warning btn-sm" onclick="updateStatus(' . $row->id . ')" title="Update Status">
                        <i class="fa fa-edit"></i>
                    </button>
                </div>';
            })

            ->rawColumns(['booking_code', 'customer_info', 'tour_info', 'booking_details', 'total_amount', 'booking_status', 'payment_status', 'created_at', 'action'])
            ->make(true);
    }

    /**
     * Refresh exchange rate via AJAX
     */
    public function refreshExchangeRate()
    {
        try {
            $rate = $this->currencyService->refreshExchangeRate();
            $rateInfo = $this->currencyService->getExchangeRateInfo();
            
            return response()->json([
                'success' => true,
                'message' => 'Exchange rate refreshed successfully',
                'rate' => $rateInfo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to refresh exchange rate: ' . $e->getMessage()
            ], 500);
        }
    }
}