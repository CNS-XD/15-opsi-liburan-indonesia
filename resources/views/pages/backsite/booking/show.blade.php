@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Booking Detail')
@section('activeMenuBooking', 'open active')

{{-- Breadcrumb --}}
@section('breadcrumb1', 'Transaction')
@section('breadcrumb2', 'Booking')
@section('breadcrumb3', 'Detail')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ route('backsite.booking.index') }}" class="btn btn-secondary btn-sm btn-glow round">
    <i class="fa fa-arrow-left"></i> Back to List
</a>
@endsection

@section('content-body1')
<div class="content-body">
    <div class="row">
        <!-- Booking Information -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="fa fa-info-circle"></i> Booking Information
                        <span class="badge {{ $booking->status_badge_class }} ml-2">
                            {{ $booking->status_label }}
                        </span>
                    </h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Booking Code:</strong></td>
                                        <td><span class="badge badge-primary">{{ $booking->booking_code }}</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Customer Name:</strong></td>
                                        <td>{{ $booking->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td>{{ $booking->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Phone:</strong></td>
                                        <td>{{ $booking->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nationality:</strong></td>
                                        <td>
                                            <span class="badge badge-secondary">
                                                <i class="fa fa-flag"></i> {{ $booking->nationality ?? 'Not specified' }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Number of Travelers:</strong></td>
                                        <td><span class="badge badge-info">{{ $booking->travelers }} orang</span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Departure Date:</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($booking->preferred_date)->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Price:</strong></td>
                                        <td>
                                            <strong class="text-success">${{ number_format($booking->total_price, 2) }}</strong><br>
                                            <small class="text-muted">Rp {{ number_format($booking->total_price * 15000, 0, ',', '.') }}</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Booking Date:</strong></td>
                                        <td>{{ $booking->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Created By:</strong></td>
                                        <td>{{ $booking->created_by ?? 'System' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        @if($booking->special_requests)
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <h6><i class="fa fa-comment"></i> Special Requests:</h6>
                                    <p class="mb-0">{{ $booking->special_requests }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Tour Information -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="fa fa-map-marker"></i> Tour Information</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @if($booking->tour)
                        <div class="row">
                            @if($booking->tour->tour_photos->count() > 0)
                            <div class="col-md-4">
                                <img src="{{ Storage::url($booking->tour->tour_photos->first()->photo) }}" 
                                     alt="{{ $booking->tour->title }}" 
                                     class="img-fluid rounded">
                            </div>
                            @endif
                            <div class="col-md-8">
                                <h5>{{ $booking->tour->title }}</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Duration:</strong></td>
                                        <td>{{ $booking->tour->duration }} days</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Location:</strong></td>
                                        <td>
                                            @if($booking->tour->tour_destinations && $booking->tour->tour_destinations->count() > 0)
                                                {{ $booking->tour->tour_destinations->pluck('destination.title')->filter()->implode(', ') }}
                                            @else
                                                Multiple Destinations
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Type:</strong></td>
                                        <td>{{ $booking->tour->type }}</td>
                                    </tr>
                                    @if($booking->tour->tour_reviews->count() > 0)
                                    <tr>
                                        <td><strong>Rating:</strong></td>
                                        <td>
                                            <span class="badge badge-warning">
                                                <i class="fa fa-star"></i> {{ number_format($booking->tour->tour_reviews->avg('rating'), 1) }}/5
                                            </span>
                                            <small class="text-muted">({{ $booking->tour->tour_reviews->count() }} reviews)</small>
                                        </td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                        @else
                        <div class="alert alert-warning">
                            <i class="fa fa-exclamation-triangle"></i> Tour information not available
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Information & Actions -->
        <div class="col-lg-4">
            <!-- Update Status -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="fa fa-edit"></i> Update Status</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('backsite.booking.update-status', $booking->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Booking Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="{{ \App\Models\Booking::STATUS_PENDING }}" {{ $booking->status == \App\Models\Booking::STATUS_PENDING ? 'selected' : '' }}>{{ \App\Models\Booking::STATUS_PENDING == 'pending' ? 'Menunggu Konfirmasi' : ucfirst(\App\Models\Booking::STATUS_PENDING) }}</option>
                                    <option value="{{ \App\Models\Booking::STATUS_CONFIRMED }}" {{ $booking->status == \App\Models\Booking::STATUS_CONFIRMED ? 'selected' : '' }}>{{ \App\Models\Booking::STATUS_CONFIRMED == 'confirmed' ? 'Dikonfirmasi' : ucfirst(\App\Models\Booking::STATUS_CONFIRMED) }}</option>
                                    <option value="{{ \App\Models\Booking::STATUS_CANCELLED }}" {{ $booking->status == \App\Models\Booking::STATUS_CANCELLED ? 'selected' : '' }}>{{ \App\Models\Booking::STATUS_CANCELLED == 'cancelled' ? 'Dibatalkan' : ucfirst(\App\Models\Booking::STATUS_CANCELLED) }}</option>
                                    <option value="{{ \App\Models\Booking::STATUS_COMPLETED }}" {{ $booking->status == \App\Models\Booking::STATUS_COMPLETED ? 'selected' : '' }}>{{ \App\Models\Booking::STATUS_COMPLETED == 'completed' ? 'Selesai' : ucfirst(\App\Models\Booking::STATUS_COMPLETED) }}</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fa fa-save"></i> Update Status
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="fa fa-credit-card"></i> Payment Information</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @if($booking->payments->count() > 0)
                            @foreach($booking->payments as $payment)
                            <div class="payment-item mb-3 p-3" style="border: 1px solid #eee; border-radius: 5px;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge badge-primary">{{ $payment->payment_code }}</span>
                                    <span class="badge {{ $payment->status_badge_class }}">{{ $payment->status_label }}</span>
                                </div>
                                
                                <table class="table table-sm table-borderless mb-0">
                                    <tr>
                                        <td><strong>Amount:</strong></td>
                                        <td>{{ $payment->formatted_amount }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Method:</strong></td>
                                        <td>{{ $payment->formatted_payment_method }}</td>
                                    </tr>
                                    @if($payment->paid_at)
                                    <tr>
                                        <td><strong>Paid At:</strong></td>
                                        <td>{{ $payment->paid_at->format('d M Y H:i') }}</td>
                                    </tr>
                                    @endif
                                    @if($payment->expired_at)
                                    <tr>
                                        <td><strong>Expires At:</strong></td>
                                        <td>{{ $payment->expired_at->format('d M Y H:i') }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td><strong>Created:</strong></td>
                                        <td>{{ $payment->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                </table>

                                @if($payment->xendit_invoice_id)
                                <div class="mt-2">
                                    <small class="text-muted">
                                        <strong>Xendit ID:</strong> {{ $payment->xendit_invoice_id }}
                                    </small>
                                </div>
                                @endif

                                @if($payment->failure_reason)
                                <div class="alert alert-danger mt-2 mb-0">
                                    <small><strong>Failure Reason:</strong> {{ $payment->failure_reason }}</small>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        @else
                            <div class="alert alert-info">
                                <i class="fa fa-info-circle"></i> No payment information available
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="fa fa-bolt"></i> Quick Actions</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="btn-group-vertical btn-block">
                            <a href="mailto:{{ $booking->email }}" class="btn btn-info btn-sm">
                                <i class="fa fa-envelope"></i> Send Email
                            </a>
                            <a href="tel:{{ $booking->phone }}" class="btn btn-success btn-sm">
                                <i class="fa fa-phone"></i> Call Customer
                            </a>
                            @if($booking->payments->where('status', 'pending')->count() > 0)
                            <a href="{{ route('frontsite.payment.show', $booking->booking_code) }}" 
                               class="btn btn-warning btn-sm" target="_blank">
                                <i class="fa fa-credit-card"></i> View Payment Page
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-script')
<style>
    .payment-item {
        background: #f8f9fa;
    }

    .table-borderless td {
        border: none;
        padding: 0.25rem 0.5rem;
    }

    .btn-group-vertical .btn {
        margin-bottom: 5px;
    }

    .card-title i {
        margin-right: 8px;
    }
</style>
@endpush