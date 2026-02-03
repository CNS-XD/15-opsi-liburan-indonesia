<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Tour;
use App\Models\TourReview;
use App\Models\User;
use App\Models\Blog;
use App\Models\Testimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                    'growth_percentage' => 15.5
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
            // Simple test data for AJAX requests
            $stats = [
                'overview' => [
                    'total_bookings' => 150,
                    'total_revenue' => 75000000,
                    'total_tours' => 25,
                    'total_users' => 500,
                    'pending_bookings' => 10,
                    'confirmed_bookings' => 120,
                    'cancelled_bookings' => 20,
                    'active_tours' => 20
                ],
                'bookings' => [
                    'today' => 5,
                    'this_week' => 25,
                    'this_month' => 80,
                    'growth_percentage' => 15.5
                ],
                'revenue' => [
                    'current_month' => 25000000,
                    'last_month' => 20000000,
                    'growth_percentage' => 25.0,
                    'average_booking_value' => 500000
                ],
                'tours' => [
                    'total_tours' => 25,
                    'active_tours' => 20,
                    'inactive_tours' => 5,
                    'tours_with_reviews' => 15,
                    'average_rating' => 4.5
                ],
                'recent_activities' => [
                    [
                        'type' => 'booking',
                        'message' => 'New booking for Bromo Sunrise Tour',
                        'user' => 'John Doe',
                        'time' => '2 minutes ago',
                        'status' => 'pending',
                        'icon' => 'calendar',
                        'color' => 'warning'
                    ],
                    [
                        'type' => 'payment',
                        'message' => 'Payment received for Ijen Blue Fire Tour',
                        'user' => 'Jane Smith',
                        'time' => '5 minutes ago',
                        'amount' => 850000,
                        'status' => 'paid',
                        'icon' => 'credit-card',
                        'color' => 'success'
                    ]
                ],
                'monthly_revenue' => [
                    'labels' => ['Jan 2024', 'Feb 2024', 'Mar 2024', 'Apr 2024', 'May 2024', 'Jun 2024'],
                    'data' => [15000000, 18000000, 22000000, 20000000, 25000000, 28000000]
                ],
                'booking_status_chart' => [
                    'labels' => ['Pending', 'Confirmed', 'Cancelled', 'Completed'],
                    'data' => [10, 120, 20, 80],
                    'colors' => ['#ffc107', '#28a745', '#dc3545', '#007bff']
                ],
                'popular_tours' => [
                    [
                        'name' => 'Bromo Sunrise Tour 2D1N',
                        'bookings_count' => 45,
                        'price' => 850000,
                        'rating' => 4.8,
                        'slug' => 'bromo-sunrise-tour-2d1n'
                    ],
                    [
                        'name' => 'Ijen Blue Fire Tour 2D1N',
                        'bookings_count' => 38,
                        'price' => 950000,
                        'rating' => 4.7,
                        'slug' => 'ijen-blue-fire-tour-2d1n'
                    ]
                ]
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

    private function getOverviewStats()
    {
        $totalBookings = Booking::count();
        $totalRevenue = Payment::where('status', 'paid')->sum('amount') ?? 0;
        $totalTours = Tour::count();
        $totalUsers = User::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $cancelledBookings = Booking::where('status', 'cancelled')->count();
        $activeTours = Tour::where('show', 1)->count(); // Using 'show' column

        return [
            'total_bookings' => $totalBookings,
            'total_revenue' => $totalRevenue,
            'total_tours' => $totalTours,
            'total_users' => $totalUsers,
            'pending_bookings' => $pendingBookings,
            'confirmed_bookings' => $confirmedBookings,
            'cancelled_bookings' => $cancelledBookings,
            'active_tours' => $activeTours
        ];
    }

    private function getBookingStats()
    {
        $today = Carbon::today();
        $thisWeek = Carbon::now()->startOfWeek();
        $thisMonth = Carbon::now()->startOfMonth();

        return [
            'today' => Booking::whereDate('created_at', $today)->count(),
            'this_week' => Booking::where('created_at', '>=', $thisWeek)->count(),
            'this_month' => Booking::where('created_at', '>=', $thisMonth)->count(),
            'growth_percentage' => $this->calculateBookingGrowth()
        ];
    }

    private function getRevenueStats()
    {
        $thisMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        $currentRevenue = Payment::where('status', 'paid')
            ->where('created_at', '>=', $thisMonth)
            ->sum('amount');

        $lastMonthRevenue = Payment::where('status', 'paid')
            ->whereBetween('created_at', [$lastMonth, $lastMonthEnd])
            ->sum('amount');

        $growth = $lastMonthRevenue > 0 
            ? (($currentRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 
            : 0;

        return [
            'current_month' => $currentRevenue,
            'last_month' => $lastMonthRevenue,
            'growth_percentage' => round($growth, 2),
            'average_booking_value' => $this->getAverageBookingValue()
        ];
    }

    private function getTourStats()
    {
        $totalTours = Tour::count();
        $activeTours = Tour::where('show', 1)->count(); // Using 'show' column
        $toursWithReviews = Tour::has('tour_reviews')->count();
        $averageRating = TourReview::avg('rating') ?? 0;

        return [
            'total_tours' => $totalTours,
            'active_tours' => $activeTours,
            'inactive_tours' => $totalTours - $activeTours,
            'tours_with_reviews' => $toursWithReviews,
            'average_rating' => round($averageRating, 1)
        ];
    }

    private function getRecentActivities()
    {
        try {
            $activities = [];

            // Recent bookings
            $recentBookings = Booking::with(['tour'])
                ->latest('created_at')
                ->limit(5)
                ->get();

            foreach ($recentBookings as $booking) {
                $activities[] = [
                    'type' => 'booking',
                    'message' => "New booking for " . ($booking->tour->title ?? 'Unknown Tour'),
                    'user' => $booking->customer_name ?? 'Unknown User',
                    'time' => Carbon::parse($booking->getRawOriginal('created_at'))->diffForHumans(),
                    'status' => $booking->status ?? 'unknown',
                    'icon' => 'calendar',
                    'color' => $this->getStatusColor($booking->status ?? 'unknown')
                ];
            }

            // Recent payments
            $recentPayments = Payment::with(['booking.tour'])
                ->latest()
                ->limit(5)
                ->get();

            foreach ($recentPayments as $payment) {
                if ($payment->booking && $payment->booking->tour) {
                    $activities[] = [
                        'type' => 'payment',
                        'message' => "Payment received for " . $payment->booking->tour->title,
                        'user' => $payment->booking->customer_name ?? 'Unknown User',
                        'time' => $payment->created_at->diffForHumans(),
                        'amount' => $payment->amount ?? 0,
                        'status' => $payment->status ?? 'unknown',
                        'icon' => 'credit-card',
                        'color' => $this->getStatusColor($payment->status ?? 'unknown')
                    ];
                }
            }

            // Sort by created_at and limit to 10
            usort($activities, function($a, $b) {
                return strcmp($b['time'], $a['time']);
            });

            return array_slice($activities, 0, 10);
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
            });
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    private function calculateBookingGrowth()
    {
        $thisMonth = Booking::whereMonth('created_at', Carbon::now()->month)->count();
        $lastMonth = Booking::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        
        if ($lastMonth == 0) return 0;
        
        return round((($thisMonth - $lastMonth) / $lastMonth) * 100, 2);
    }

    private function getAverageBookingValue()
    {
        return Payment::where('status', 'paid')->avg('amount') ?? 0;
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
