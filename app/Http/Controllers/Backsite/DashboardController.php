<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Tour;
use App\Models\TourReview;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Load statistics directly for server-side rendering
            $stats = [
                'overview' => [
                    'total_bookings' => Booking::count(),
                    'total_revenue' => Payment::where('status', 'paid')->sum('amount') ?? 0,
                    'total_tours' => Tour::count(),
                    'total_users' => User::count(),
                    'pending_bookings' => Booking::where('status', 'pending')->count(),
                    'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
                    'cancelled_bookings' => Booking::where('status', 'cancelled')->count(),
                    'active_tours' => Tour::where('show', 1)->count()
                ],
                'bookings' => [
                    'today' => Booking::whereDate('created_at', Carbon::today())->count(),
                    'this_week' => Booking::where('created_at', '>=', Carbon::now()->startOfWeek())->count(),
                    'this_month' => Booking::where('created_at', '>=', Carbon::now()->startOfMonth())->count(),
                    'growth_percentage' => $this->calculateBookingGrowth()
                ],
                'revenue' => [
                    'growth_percentage' => $this->calculateRevenueGrowth()
                ],
                'tours' => [
                    'average_rating' => TourReview::avg('rating') ?? 0
                ],
                'monthly_revenue' => $this->getMonthlyRevenue(),
                'booking_status_chart' => $this->getBookingStatusChart(),
                'popular_tours' => $this->getPopularTours(),
                'recent_activities' => $this->getRecentActivities()
            ];

            return view('pages.backsite.dashboard', compact('stats'));
        } catch (\Exception $e) {
            // Return view with empty stats on error
            $stats = [
                'overview' => [
                    'total_bookings' => 0,
                    'total_revenue' => 0,
                    'total_tours' => 0,
                    'total_users' => 0,
                    'pending_bookings' => 0,
                    'confirmed_bookings' => 0,
                    'cancelled_bookings' => 0,
                    'active_tours' => 0
                ],
                'bookings' => [
                    'today' => 0,
                    'this_week' => 0,
                    'this_month' => 0,
                    'growth_percentage' => 0
                ],
                'revenue' => [
                    'growth_percentage' => 0
                ],
                'tours' => [
                    'average_rating' => 0
                ],
                'monthly_revenue' => [
                    'labels' => [],
                    'data' => []
                ],
                'booking_status_chart' => [
                    'labels' => [],
                    'data' => [],
                    'colors' => []
                ],
                'popular_tours' => [],
                'recent_activities' => []
            ];
            
            return view('pages.backsite.dashboard', compact('stats'));
        }
    }

    public function getStatistics(Request $request)
    {
        try {
            // Get real data from database for AJAX requests
            $stats = [
                'overview' => [
                    'total_bookings' => Booking::count(),
                    'total_revenue' => Payment::where('status', 'paid')->sum('amount') ?? 0,
                    'total_tours' => Tour::count(),
                    'total_users' => User::count(),
                    'pending_bookings' => Booking::where('status', 'pending')->count(),
                    'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
                    'cancelled_bookings' => Booking::where('status', 'cancelled')->count(),
                    'active_tours' => Tour::where('show', 1)->count()
                ],
                'bookings' => [
                    'today' => Booking::whereDate('created_at', Carbon::today())->count(),
                    'this_week' => Booking::where('created_at', '>=', Carbon::now()->startOfWeek())->count(),
                    'this_month' => Booking::where('created_at', '>=', Carbon::now()->startOfMonth())->count(),
                    'growth_percentage' => $this->calculateBookingGrowth()
                ],
                'revenue' => [
                    'current_month' => Payment::where('status', 'paid')
                        ->where('created_at', '>=', Carbon::now()->startOfMonth())
                        ->sum('amount') ?? 0,
                    'last_month' => Payment::where('status', 'paid')
                        ->whereBetween('created_at', [
                            Carbon::now()->subMonth()->startOfMonth(),
                            Carbon::now()->subMonth()->endOfMonth()
                        ])
                        ->sum('amount') ?? 0,
                    'growth_percentage' => $this->calculateRevenueGrowth(),
                    'average_booking_value' => $this->getAverageBookingValue()
                ],
                'tours' => [
                    'total_tours' => Tour::count(),
                    'active_tours' => Tour::where('show', 1)->count(),
                    'inactive_tours' => Tour::where('show', 0)->count(),
                    'tours_with_reviews' => Tour::has('tour_reviews')->count(),
                    'average_rating' => TourReview::avg('rating') ?? 0
                ],
                'recent_activities' => $this->getRecentActivities(),
                'monthly_revenue' => $this->getMonthlyRevenue(),
                'booking_status_chart' => $this->getBookingStatusChart(),
                'popular_tours' => $this->getPopularTours()
            ];

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading statistics: ' . $e->getMessage()
            ], 500);
        }
    }

    private function getRecentActivities()
    {
        try {
            $activities = [];

            // Recent bookings - use selectRaw to get raw created_at
            $recentBookings = Booking::selectRaw('*, created_at as raw_created_at')
                ->with(['tour'])
                ->latest('created_at')
                ->limit(3)
                ->get();

            foreach ($recentBookings as $booking) {
                try {
                    $timeAgo = Carbon::parse($booking->raw_created_at)->diffForHumans();
                } catch (\Exception $e) {
                    $timeAgo = 'Recently';
                }
                
                $activities[] = [
                    'type' => 'booking',
                    'message' => "New booking for " . ($booking->tour->title ?? 'Unknown Tour'),
                    'user' => $booking->name ?? 'Unknown User',
                    'time' => $timeAgo,
                    'status' => $booking->status ?? 'unknown',
                    'icon' => 'calendar',
                    'color' => $this->getStatusColor($booking->status ?? 'unknown'),
                    'created_timestamp' => $booking->raw_created_at
                ];
            }

            // Recent payments
            $recentPayments = Payment::with(['booking.tour'])
                ->latest('created_at')
                ->limit(3)
                ->get();

            foreach ($recentPayments as $payment) {
                if ($payment->booking && $payment->booking->tour) {
                    try {
                        $timeAgo = $payment->created_at->diffForHumans();
                    } catch (\Exception $e) {
                        $timeAgo = 'Recently';
                    }
                    
                    $activities[] = [
                        'type' => 'payment',
                        'message' => "Payment received for " . $payment->booking->tour->title,
                        'user' => $payment->booking->name ?? 'Unknown User',
                        'time' => $timeAgo,
                        'amount' => $payment->amount ?? 0,
                        'status' => $payment->status ?? 'unknown',
                        'icon' => 'credit-card',
                        'color' => $this->getStatusColor($payment->status ?? 'unknown'),
                        'created_timestamp' => $payment->created_at
                    ];
                }
            }

            // Sort by timestamp (newest first) and limit to 6
            usort($activities, function($a, $b) {
                $timeA = isset($a['created_timestamp']) ? strtotime($a['created_timestamp']) : 0;
                $timeB = isset($b['created_timestamp']) ? strtotime($b['created_timestamp']) : 0;
                return $timeB - $timeA;
            });

            // Remove timestamp from final result
            $activities = array_map(function($activity) {
                unset($activity['created_timestamp']);
                return $activity;
            }, $activities);

            return array_slice($activities, 0, 6);
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getMonthlyRevenue()
    {
        $months = [];
        $revenues = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M Y');
            
            $revenue = Payment::where('status', 'paid')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('amount');
            
            $revenues[] = $revenue ?? 0;
        }

        return [
            'labels' => $months,
            'data' => $revenues
        ];
    }

    private function getBookingStatusChart()
    {
        $statuses = ['pending', 'confirmed', 'cancelled', 'completed'];
        $data = [];

        foreach ($statuses as $status) {
            $data[] = Booking::where('status', $status)->count();
        }

        return [
            'labels' => ['Pending', 'Confirmed', 'Cancelled', 'Completed'],
            'data' => $data,
            'colors' => ['#ffc107', '#28a745', '#dc3545', '#007bff']
        ];
    }

    private function getPopularTours()
    {
        try {
            $tours = Tour::withCount('bookings')
                ->with(['tour_prices', 'tour_reviews'])
                ->orderBy('bookings_count', 'desc')
                ->limit(5)
                ->get();

            return $tours->map(function ($tour) {
                $firstPrice = $tour->tour_prices->first();
                $avgRating = $tour->tour_reviews->avg('rating');
                
                return [
                    'name' => $tour->title ?? $tour->name ?? 'Unknown Tour',
                    'bookings_count' => $tour->bookings_count ?? 0,
                    'price' => $firstPrice ? $firstPrice->price : 0,
                    'rating' => $avgRating ? round($avgRating, 1) : 0,
                    'slug' => $tour->slug ?? ''
                ];
            })->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    private function calculateBookingGrowth()
    {
        try {
            $thisMonth = Booking::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();
            $lastMonth = Booking::whereMonth('created_at', Carbon::now()->subMonth()->month)
                ->whereYear('created_at', Carbon::now()->subMonth()->year)
                ->count();
            
            if ($lastMonth == 0) return $thisMonth > 0 ? 100 : 0;
            
            return round((($thisMonth - $lastMonth) / $lastMonth) * 100, 2);
        } catch (\Exception $e) {
            return 0;
        }
    }

    private function calculateRevenueGrowth()
    {
        try {
            $thisMonth = Carbon::now()->startOfMonth();
            $lastMonth = Carbon::now()->subMonth()->startOfMonth();
            $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

            $currentRevenue = Payment::where('status', 'paid')
                ->where('created_at', '>=', $thisMonth)
                ->sum('amount') ?? 0;

            $lastMonthRevenue = Payment::where('status', 'paid')
                ->whereBetween('created_at', [$lastMonth, $lastMonthEnd])
                ->sum('amount') ?? 0;

            if ($lastMonthRevenue == 0) return $currentRevenue > 0 ? 100 : 0;
            
            return round((($currentRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 2);
        } catch (\Exception $e) {
            return 0;
        }
    }

    private function getAverageBookingValue()
    {
        try {
            return Payment::where('status', 'paid')->avg('amount') ?? 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    private function getStatusColor($status)
    {
        $colors = [
            'pending' => 'warning',
            'confirmed' => 'success',
            'cancelled' => 'danger',
            'completed' => 'primary',
            'paid' => 'success',
            'failed' => 'danger',
            'expired' => 'secondary'
        ];

        return $colors[$status] ?? 'secondary';
    }
}
