@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Payment Detail')
@section('activeMenuPayment', 'open active')

{{-- Breadcrumb --}}
@section('breadcrumb1', 'Transaction')
@section('breadcrumb2', 'Payment')
@section('breadcrumb3', 'Detail')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ route('backsite.payment.index') }}" class="btn btn-secondary btn-sm btn-glow round">
    <i class="fa fa-arrow-left"></i> Back to List
</a>
@endsection

@section('content-body1')
<div class="content-body">
    <div class="row">
        <!-- Payment Information -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="fa fa-credit-card"></i> Payment Information
                        <span class="badge {{ $payment->status_badge_class }} ml-2">
                            {{ $payment->status_label }}
                        </span>
                    </h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Payment Code:</strong></td>
                                        <td><span class="badge badge-primary">{{ $payment->payment_code }}</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Amount:</strong></td>
                                        <td>
                                            <strong class="text-success">{{ $payment->formatted_amount }}</strong><br>
                                            <small class="text-muted">{{ $payment->currency }}</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Payment Method:</strong></td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method ?? 'N/A')) }}</td>
                                    </tr>
                                    @if($payment->payment_channel)
                                    <tr>
                                        <td><strong>Payment Channel:</strong></td>
                                        <td><span class="badge badge-info">{{ strtoupper($payment->payment_channel) }}</span></td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td><strong>Status:</strong></td>
                                        <td><span class="badge {{ $payment->status_badge_class }}">{{ $payment->status_label }}</span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    @if($payment->paid_at)
                                    <tr>
                                        <td><strong>Paid At:</strong></td>
                                        <td>{{ $payment->paid_at->format('d M Y H:i') }} WIB</td>
                                    </tr>
                                    @endif
                                    @if($payment->expired_at)
                                    <tr>
                                        <td><strong>Expires At:</strong></td>
                                        <td>
                                            {{ $payment->expired_at->format('d M Y H:i') }} WIB
                                            @if($payment->expired_at->isPast())
                                                <span class="badge badge-danger">Expired</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td><strong>Created At:</strong></td>
                                        <td>{{ $payment->created_at->format('d M Y H:i') }} WIB</td>
                                    </tr>
                                    @if($payment->updated_at && $payment->updated_at != $payment->created_at)
                                    <tr>
                                        <td><strong>Updated At:</strong></td>
                                        <td>{{ $payment->updated_at->format('d M Y H:i') }} WIB</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                        
                        @if($payment->failure_reason)
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    <h6><i class="fa fa-exclamation-triangle"></i> Failure Reason:</h6>
                                    <p class="mb-0">{{ $payment->failure_reason }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Xendit Information -->
            @if($payment->xendit_invoice_id || $payment->xendit_external_id)
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="fa fa-external-link"></i> Xendit Information</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    @if($payment->xendit_invoice_id)
                                    <tr>
                                        <td><strong>Xendit Invoice ID:</strong></td>
                                        <td><code>{{ $payment->xendit_invoice_id }}</code></td>
                                    </tr>
                                    @endif
                                    @if($payment->xendit_external_id)
                                    <tr>
                                        <td><strong>External ID:</strong></td>
                                        <td><code>{{ $payment->xendit_external_id }}</code></td>
                                    </tr>
                                    @endif
                                    @if($payment->xendit_status)
                                    <tr>
                                        <td><strong>Xendit Status:</strong></td>
                                        <td><span class="badge badge-info">{{ $payment->xendit_status }}</span></td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                            <div class="col-md-6">
                                @if($payment->xendit_response && isset($payment->xendit_response['invoice_url']))
                                <div class="text-center">
                                    <a href="{{ $payment->xendit_response['invoice_url'] }}" 
                                       class="btn btn-primary" target="_blank">
                                        <i class="fa fa-external-link"></i> View Xendit Invoice
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>

                        @if($payment->xendit_response)
                        <div class="mt-3">
                            <h6>Xendit Response Data:</h6>
                            <div class="card">
                                <div class="card-body">
                                    <pre class="mb-0" style="max-height: 300px; overflow-y: auto; font-size: 0.8em;">{{ json_encode($payment->xendit_response, JSON_PRETTY_PRINT) }}</pre>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Booking Information -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="fa fa-ticket"></i> Related Booking</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @if($payment->booking)
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Booking Code:</strong></td>
                                        <td>
                                            <a href="{{ route('backsite.booking.show', $payment->booking->id) }}" 
                                               class="badge badge-primary">
                                                {{ $payment->booking->booking_code }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Customer:</strong></td>
                                        <td>{{ $payment->booking->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td>{{ $payment->booking->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Phone:</strong></td>
                                        <td>{{ $payment->booking->phone }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Tour:</strong></td>
                                        <td>{{ $payment->booking->tour->title ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Travelers:</strong></td>
                                        <td><span class="badge badge-info">{{ $payment->booking->travelers }} orang</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Departure:</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($payment->booking->preferred_date)->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Booking Status:</strong></td>
                                        <td>
                                            <span class="badge badge-{{ $payment->booking->status == 'confirmed' ? 'success' : ($payment->booking->status == 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($payment->booking->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        @else
                        <div class="alert alert-warning">
                            <i class="fa fa-exclamation-triangle"></i> Booking information not available
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Payment Details -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="fa fa-bolt"></i> Quick Actions</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="btn-group-vertical btn-block">
                            @if($payment->booking)
                            <a href="{{ route('backsite.booking.show', $payment->booking->id) }}" 
                               class="btn btn-info btn-sm">
                                <i class="fa fa-ticket"></i> View Booking
                            </a>
                            <a href="mailto:{{ $payment->booking->email }}" class="btn btn-success btn-sm">
                                <i class="fa fa-envelope"></i> Send Email
                            </a>
                            <a href="tel:{{ $payment->booking->phone }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-phone"></i> Call Customer
                            </a>
                            @endif
                            
                            @if($payment->status === 'pending' && $payment->xendit_response && isset($payment->xendit_response['invoice_url']))
                            <a href="{{ $payment->xendit_response['invoice_url'] }}" 
                               class="btn btn-primary btn-sm" target="_blank">
                                <i class="fa fa-external-link"></i> Open Xendit Invoice
                            </a>
                            @endif
                            
                            @if($payment->status === 'pending')
                            <a href="{{ route('frontsite.payment.status', $payment->payment_code) }}" 
                               class="btn btn-secondary btn-sm" target="_blank">
                                <i class="fa fa-eye"></i> View Payment Status
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Details -->
            @if($payment->payment_details)
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="fa fa-info-circle"></i> Payment Details</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="payment-details">
                            @foreach($payment->payment_details as $key => $value)
                            <div class="detail-item mb-2">
                                <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                                @if(is_array($value))
                                    <pre class="mt-1" style="font-size: 0.8em;">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                                @else
                                    <span>{{ $value }}</span>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Payment Timeline -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="fa fa-history"></i> Payment Timeline</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <h6>Payment Created</h6>
                                    <small class="text-muted">{{ $payment->created_at->format('d M Y H:i') }}</small>
                                </div>
                            </div>
                            
                            @if($payment->paid_at)
                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <h6>Payment Completed</h6>
                                    <small class="text-muted">{{ $payment->paid_at->format('d M Y H:i') }}</small>
                                </div>
                            </div>
                            @endif
                            
                            @if($payment->status === 'expired')
                            <div class="timeline-item">
                                <div class="timeline-marker bg-secondary"></div>
                                <div class="timeline-content">
                                    <h6>Payment Expired</h6>
                                    <small class="text-muted">{{ $payment->expired_at ? $payment->expired_at->format('d M Y H:i') : 'N/A' }}</small>
                                </div>
                            </div>
                            @endif
                            
                            @if($payment->status === 'failed')
                            <div class="timeline-item">
                                <div class="timeline-marker bg-danger"></div>
                                <div class="timeline-content">
                                    <h6>Payment Failed</h6>
                                    <small class="text-muted">{{ $payment->updated_at->format('d M Y H:i') }}</small>
                                </div>
                            </div>
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

.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -23px;
    top: 5px;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px #e9ecef;
}

.timeline-content h6 {
    margin-bottom: 5px;
    font-weight: 600;
}

.detail-item {
    padding: 8px 0;
    border-bottom: 1px solid #f0f0f0;
}

.detail-item:last-child {
    border-bottom: none;
}

pre {
    background: #f8f9fa;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #e9ecef;
}
</style>
@endpush