@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Dashboard')
@section('activeMenuDashboard', 'open active')

{{-- Breadcrumb --}}
@section('breadcrumb1', 'Backsite')
@section('breadcrumb2', 'Dashboard')

@push('after-style')
<style>
    .gradient-1 {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .gradient-2 {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .gradient-3 {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .gradient-4 {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }

    .activity-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }

    .activity-content {
        flex: 1;
    }

    .activity-time {
        font-size: 12px;
        color: #999;
    }

    .tour-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .tour-item:last-child {
        border-bottom: none;
    }

    .tour-info h6 {
        margin: 0;
        font-size: 14px;
    }

    .tour-stats {
        font-size: 12px;
        color: #666;
    }

    .refresh-btn-loading {
        pointer-events: none;
    }

    .chart-container {
        position: relative;
        min-height: 300px;
    }

    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
    }

    .loading-spinner {
        display: inline-block;
        width: 40px;
        height: 40px;
        border: 3px solid #f3f3f3;
        border-top: 3px solid #667eea;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endpush

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<button type="button" class="btn btn-primary" id="refreshStats">
    <i class="fa fa-sync-alt"></i> Refresh Data
</button>
@endsection

@section('content-body1')
<div class="content-body">
    <!-- Overview Cards -->
    <div class="row mt-1">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Bookings</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white" id="totalBookings">
                            @if(isset($stats))
                                {{ number_format($stats['overview']['total_bookings']) }}
                            @else
                                <div class="spinner-border spinner-border-sm text-white" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            @endif
                        </h2>
                        <p class="text-white mb-0">
                            <span id="bookingGrowth" class="badge badge-light">
                                @if(isset($stats))
                                    @php
                                        $bookingGrowth = $stats['bookings']['growth_percentage'];
                                        $isPositive = $bookingGrowth >= 0;
                                        $badgeClass = $isPositive ? 'badge-success' : 'badge-danger';
                                        $arrow = $isPositive ? '↑' : '↓';
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $arrow }} {{ abs($bookingGrowth) }}%</span>
                                @else
                                    <div class="spinner-border spinner-border-sm" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                @endif
                            </span>
                        </p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="card gradient-2">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Revenue</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white" id="totalRevenue">
                            @if(isset($stats))
                                Rp {{ number_format($stats['overview']['total_revenue']) }}
                            @else
                                <div class="spinner-border spinner-border-sm text-white" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            @endif
                        </h2>
                        <p class="text-white mb-0">
                            <span id="revenueGrowth" class="badge badge-light">
                                @if(isset($stats))
                                    @php
                                        $revenueGrowth = $stats['revenue']['growth_percentage'];
                                        $isPositive = $revenueGrowth >= 0;
                                        $badgeClass = $isPositive ? 'badge-success' : 'badge-danger';
                                        $arrow = $isPositive ? '↑' : '↓';
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $arrow }} {{ abs($revenueGrowth) }}%</span>
                                @else
                                    <div class="spinner-border spinner-border-sm" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                @endif
                            </span>
                        </p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money-bill-alt"></i></span>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="card gradient-3">
                <div class="card-body">
                    <h3 class="card-title text-white">Active Tours</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white" id="activeTours">
                            @if(isset($stats))
                                {{ $stats['overview']['active_tours'] }}
                            @else
                                <div class="spinner-border spinner-border-sm text-white" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            @endif
                        </h2>
                        <p class="text-white mb-0">
                            <span id="totalTours" class="badge badge-light">
                                @if(isset($stats))
                                    of {{ $stats['overview']['total_tours'] }} total
                                @else
                                    <div class="spinner-border spinner-border-sm" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                @endif
                            </span>
                        </p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-map-marker-alt"></i></span>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="card gradient-4">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Users</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white" id="totalUsers">
                            @if(isset($stats))
                                {{ number_format($stats['overview']['total_users']) }}
                            @else
                                <div class="spinner-border spinner-border-sm text-white" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            @endif
                        </h2>
                        <p class="text-white mb-0">
                            <span class="badge badge-light">Registered</span>
                        </p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Row -->
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-one card-body">
                    <div class="stat-icon d-inline-block">
                        <i class="ti-calendar text-success border-success"></i>
                    </div>
                    <div class="stat-content d-inline-block">
                        <div class="stat-text">Today's Bookings</div>
                        <div class="stat-digit" id="todayBookings">
                            @if(isset($stats))
                                {{ $stats['bookings']['today'] }}
                            @else
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-one card-body">
                    <div class="stat-icon d-inline-block">
                        <i class="ti-check text-primary border-primary"></i>
                    </div>
                    <div class="stat-content d-inline-block">
                        <div class="stat-text">Confirmed</div>
                        <div class="stat-digit" id="confirmedBookings">
                            @if(isset($stats))
                                {{ $stats['overview']['confirmed_bookings'] }}
                            @else
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-one card-body">
                    <div class="stat-icon d-inline-block">
                        <i class="ti-time text-warning border-warning"></i>
                    </div>
                    <div class="stat-content d-inline-block">
                        <div class="stat-text">Pending</div>
                        <div class="stat-digit" id="pendingBookings">
                            @if(isset($stats))
                                {{ $stats['overview']['pending_bookings'] }}
                            @else
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-one card-body">
                    <div class="stat-icon d-inline-block">
                        <i class="ti-star text-info border-info"></i>
                    </div>
                    <div class="stat-content d-inline-block">
                        <div class="stat-text">Avg Rating</div>
                        <div class="stat-digit" id="avgRating">
                            @if(isset($stats))
                                {{ number_format($stats['tours']['average_rating'], 1) }}
                            @else
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Monthly Revenue Trend</h4>
                </div>
                <div class="card-body">
                    <div id="revenueChartLoading" class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading chart...</span>
                        </div>
                        <p class="mt-2 mb-0">Loading revenue chart...</p>
                    </div>
                    <canvas id="revenueChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Booking Status</h4>
                </div>
                <div class="card-body">
                    <div id="statusChartLoading" class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading chart...</span>
                        </div>
                        <p class="mt-2 mb-0">Loading status chart...</p>
                    </div>
                    <canvas id="statusChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Tours and Recent Activities -->
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Popular Tours</h4>
                </div>
                <div class="card-body">
                    <div id="popularToursLoading" class="text-center py-3" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-2 mb-0">Loading popular tours...</p>
                    </div>
                    <div id="popularTours">
                        @if(isset($stats) && count($stats['popular_tours']) > 0)
                            @foreach($stats['popular_tours'] as $tour)
                                <div class="tour-item">
                                    <div class="tour-info">
                                        <h6>{{ $tour['name'] ?? 'Unknown Tour' }}</h6>
                                        <div class="tour-stats">
                                            {{ $tour['bookings_count'] ?? 0 }} bookings • 
                                            ⭐ {{ number_format($tour['rating'] ?? 0, 1) }} • 
                                            Rp {{ number_format($tour['price'] ?? 0) }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center text-muted py-3">No popular tours data available</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recent Activities</h4>
                </div>
                <div class="card-body">
                    <div id="activitiesLoading" class="text-center py-3" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-2 mb-0">Loading activities...</p>
                    </div>
                    <div id="recentActivities">
                        @if(isset($stats) && count($stats['recent_activities']) > 0)
                            @foreach($stats['recent_activities'] as $activity)
                                <div class="activity-item">
                                    <div class="activity-icon bg-{{ $activity['color'] ?? 'secondary' }}">
                                        <i class="{{ $activity['icon'] === 'calendar' ? 'ti-calendar' : 'ti-credit-card' }} text-white"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-message">{{ $activity['message'] ?? 'Unknown activity' }}</div>
                                        <div class="activity-user">by {{ $activity['user'] ?? 'Unknown user' }}</div>
                                        <div class="activity-time">{{ $activity['time'] ?? 'Unknown time' }}</div>
                                    </div>
                                    @if(isset($activity['amount']))
                                        <div class="activity-amount">Rp {{ number_format($activity['amount']) }}</div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="text-center text-muted py-3">No recent activities</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-script')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
<script>
    // Create charts with real data
    function createChartsWithRealData() {
        // Hide loading indicators
        const revenueLoading = document.getElementById('revenueChartLoading');
        const statusLoading = document.getElementById('statusChartLoading');
        
        if (revenueLoading) revenueLoading.style.display = 'none';
        if (statusLoading) statusLoading.style.display = 'none';
        
        // Get real data from server
        @if(isset($stats))
            const revenueData = @json($stats['monthly_revenue']);
            const statusData = @json($stats['booking_status_chart']);
            
            // Revenue Chart
            const revenueCanvas = document.getElementById('revenueChart');
            if (revenueCanvas) {
                try {
                    // Convert string numbers to actual numbers
                    const chartData = revenueData.data.map(value => parseFloat(value) || 0);
                    
                    const revenueChart = new Chart(revenueCanvas, {
                        type: 'line',
                        data: {
                            labels: revenueData.labels,
                            datasets: [{
                                label: 'Revenue (Rp)',
                                data: chartData,
                                borderColor: '#667eea',
                                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                                borderWidth: 2,
                                fill: true,
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return 'Rp ' + value.toLocaleString('id-ID');
                                        }
                                    }
                                }
                            }
                        }
                    });
                } catch (error) {
                    // Silent error handling
                }
            }
            
            // Status Chart
            const statusCanvas = document.getElementById('statusChart');
            if (statusCanvas) {
                try {
                    const statusChart = new Chart(statusCanvas, {
                        type: 'doughnut',
                        data: {
                            labels: statusData.labels,
                            datasets: [{
                                data: statusData.data,
                                backgroundColor: statusData.colors,
                                borderWidth: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }
                    });
                } catch (error) {
                    // Silent error handling
                }
            }
        @else
            // Fallback to test data if no server data
            createTestCharts();
        @endif
    }

    // Fallback test charts
    function createTestCharts() {
        const revenueCanvas = document.getElementById('revenueChart');
        if (revenueCanvas) {
            try {
                const revenueChart = new Chart(revenueCanvas, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                        datasets: [{
                            label: 'Revenue (Rp)',
                            data: [1000000, 2000000, 1500000, 3000000, 2500000, 4000000],
                            borderColor: '#667eea',
                            backgroundColor: 'rgba(102, 126, 234, 0.1)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + value.toLocaleString('id-ID');
                                    }
                                }
                            }
                        }
                    }
                });
            } catch (error) {
                // Silent error handling
            }
        }
        
        const statusCanvas = document.getElementById('statusChart');
        if (statusCanvas) {
            try {
                const statusChart = new Chart(statusCanvas, {
                    type: 'doughnut',
                    data: {
                        labels: ['Pending', 'Confirmed', 'Cancelled', 'Completed'],
                        datasets: [{
                            data: [7, 32, 1, 0],
                            backgroundColor: ['#ffc107', '#28a745', '#dc3545', '#007bff'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            } catch (error) {
                // Silent error handling
            }
        }
    }

    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Chart !== 'undefined') {
            createChartsWithRealData();
        } else {
            setTimeout(function() {
                if (typeof Chart !== 'undefined') {
                    createChartsWithRealData();
                }
            }, 2000);
        }
        
        // Add refresh button functionality
        const refreshBtn = document.getElementById('refreshStats');
        if (refreshBtn) {
            refreshBtn.addEventListener('click', function() {
                // Add loading state
                refreshBtn.disabled = true;
                const icon = refreshBtn.querySelector('i');
                if (icon) {
                    icon.className = 'fa fa-spin fa-spinner';
                }
                
                // Reload the page to get fresh data
                setTimeout(function() {
                    window.location.reload();
                }, 500);
            });
        }
    });
</script>
@endpush
