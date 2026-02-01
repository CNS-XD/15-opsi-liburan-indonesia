<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;
use App\Services\CurrencyService;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    protected $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!empty(session('error_msg')))
            Alert::error('Failed !', session('error_msg'))->persistent('Tutup');
        if (!empty(session('success')))
            Alert::success('Success !', session('success'));
        
        // Get payment statistics
        $data['stats'] = [
            'total_payments' => Payment::count(),
            'pending_payments' => Payment::where('status', Payment::STATUS_PENDING)->count(),
            'paid_payments' => Payment::where('status', Payment::STATUS_PAID)->count(),
            'failed_payments' => Payment::where('status', Payment::STATUS_FAILED)->count(),
            'expired_payments' => Payment::where('status', Payment::STATUS_EXPIRED)->count(),
            'total_revenue' => Payment::where('status', Payment::STATUS_PAID)->sum('amount'),
            'pending_amount' => Payment::where('status', Payment::STATUS_PENDING)->sum('amount'),
        ];

        // Add exchange rate info
        $data['exchange_rate'] = $this->currencyService->getExchangeRateInfo();

        return view('pages.backsite.payment.index', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $payment = Payment::with(['booking.tour'])->findOrFail($id);
        
        return view('pages.backsite.payment.show', compact('payment'));
    }

    /**
     * DataTable for payments
     */
    public function datatable()
    {
        $query = Payment::with([
                'booking.tour:id,title',
                'booking.tour.tour_destinations.destination:id,title'
            ])
            ->select('payments.*')
            ->latest('created_at');

        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('payment_code', function ($row) {
                return '<span class="badge badge-primary">' . $row->payment_code . '</span>';
            })

            ->addColumn('booking_info', function ($row) {
                $booking = $row->booking;
                return '<div class="booking-info">
                    <strong>' . $booking->booking_code . '</strong><br>
                    <small class="text-muted">' . $booking->name . '</small><br>
                    <small class="text-muted">' . $booking->email . '</small>
                </div>';
            })

            ->addColumn('tour_info', function ($row) {
                $tour = $row->booking->tour ?? null;
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
                    <strong>' . ($tour->title ?? 'N/A') . '</strong><br>
                    <small class="text-muted">' . $destinations . '</small>
                </div>';
            })

            ->addColumn('amount', function ($row) {
                return '<div class="amount-info">
                    <strong>' . $row->formatted_amount . '</strong><br>
                    <small class="text-muted">' . $row->currency . '</small>
                </div>';
            })

            ->addColumn('payment_method', function ($row) {
                $method = ucfirst(str_replace('_', ' ', $row->payment_method ?? 'N/A'));
                $channel = $row->payment_channel ? strtoupper($row->payment_channel) : '';
                
                return '<div class="method-info">
                    <strong>' . $method . '</strong>' . 
                    ($channel ? '<br><small class="text-muted">' . $channel . '</small>' : '') .
                '</div>';
            })

            ->addColumn('status', function ($row) {
                return '<span class="badge ' . $row->status_badge_class . '">' . $row->status_label . '</span>';
            })

            ->addColumn('payment_date', function ($row) {
                if ($row->paid_at) {
                    return '<div class="date-info">
                        <strong>' . $row->paid_at->format('d M Y') . '</strong><br>
                        <small class="text-muted">' . $row->paid_at->format('H:i') . '</small>
                    </div>';
                } elseif ($row->expired_at) {
                    return '<div class="date-info">
                        <small class="text-muted">Expires: ' . $row->expired_at->format('d M Y H:i') . '</small>
                    </div>';
                } else {
                    return '<small class="text-muted">-</small>';
                }
            })

            ->addColumn('created_at', function ($row) {
                return '<div class="date-info">
                    <strong>' . $row->created_at->format('d M Y') . '</strong><br>
                    <small class="text-muted">' . $row->created_at->format('H:i') . '</small>
                </div>';
            })

            ->addColumn('action', function ($row) {
                $actions = '<div class="btn-group" role="group">
                    <a href="' . route('backsite.payment.show', $row->id) . '" class="btn btn-info btn-sm" title="Detail">
                        <i class="fa fa-eye"></i>
                    </a>';
                
                if ($row->xendit_invoice_id && $row->status === Payment::STATUS_PENDING) {
                    $actions .= '<a href="' . route('frontsite.payment.status', $row->payment_code) . '" class="btn btn-warning btn-sm" title="View Payment" target="_blank">
                        <i class="fa fa-external-link"></i>
                    </a>';
                }
                
                $actions .= '</div>';
                
                return $actions;
            })

            ->rawColumns(['payment_code', 'booking_info', 'tour_info', 'amount', 'payment_method', 'status', 'payment_date', 'created_at', 'action'])
            ->make(true);
    }
}