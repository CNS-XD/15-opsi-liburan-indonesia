@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Payment Management')
@section('activeMenuPayment', 'open active')

{{-- Breadcrumb --}}
@section('breadcrumb1', 'Transaction')
@section('breadcrumb2', 'Payment')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ url('/') }}" class="btn btn-info btn-sm btn-glow round" target="_blank">
    View Page <i class="fa fa-arrow-right"></i>
</a>
@endsection

@section('content-body1')
<div class="content-body">
    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-xl-2 col-lg-4 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="primary">{{ $stats['total_payments'] }}</h3>
                                <span>Total Payment</span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-credit-card primary font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-2 col-lg-4 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="warning">{{ $stats['pending_payments'] }}</h3>
                                <span>Pending</span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-clock warning font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-2 col-lg-4 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="success">{{ $stats['paid_payments'] }}</h3>
                                <span>Paid</span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-check success font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-2 col-lg-4 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="danger">{{ $stats['failed_payments'] }}</h3>
                                <span>Failed</span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-close danger font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-2 col-lg-4 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="info">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
                                <span>Total Revenue</span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-wallet info font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-2 col-lg-4 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="warning">Rp {{ number_format($stats['pending_amount'], 0, ',', '.') }}</h3>
                                <span>Pending Amount</span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-hourglass warning font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Exchange Rate Info -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h4 class="primary">{{ $exchange_rate['formatted_rate'] }}</h4>
                                        <span>Current USD to IDR Rate</span>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-refresh primary font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted">
                                    <strong>Source:</strong> {{ ucfirst($exchange_rate['source']) }}<br>
                                    <strong>Last Updated:</strong> {{ $exchange_rate['last_updated']->format('d M Y H:i') }}
                                </small>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="refreshExchangeRate()">
                                    <i class="fa fa-refresh"></i> Refresh Rate
                                </button>
                                @if($exchange_rate['source'] === 'fallback')
                                <span class="badge badge-warning ml-2">Using Fallback Rate</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    {{-- Card Header --}}
                    <div class="card-header">
                        <h4 class="card-title">Payment Management</h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table id="dataTable"
                                    class="table table-striped table-bordered"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Payment Code</th>
                                            <th>Booking Info</th>
                                            <th>Tour Info</th>
                                            <th>Amount</th>
                                            <th>Payment Method</th>
                                            <th>Status</th>
                                            <th>Payment Date</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('after-script')
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            scrollX: true,

            ajax: {
                url: "{{ route('backsite.payment.datatable') }}"
            },

            columns: [
                {
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    width: '5%'
                },
                {
                    data: 'payment_code',
                    name: 'payment_code',
                    width: '10%'
                },
                {
                    data: 'booking_info',
                    name: 'booking.booking_code',
                    width: '15%'
                },
                {
                    data: 'tour_info',
                    name: 'booking.tour.title',
                    width: '15%'
                },
                {
                    data: 'amount',
                    name: 'amount',
                    width: '10%'
                },
                {
                    data: 'payment_method',
                    name: 'payment_method',
                    width: '12%'
                },
                {
                    data: 'status',
                    name: 'status',
                    width: '8%'
                },
                {
                    data: 'payment_date',
                    name: 'paid_at',
                    width: '10%'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    width: '10%'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false,
                    width: '5%'
                }
            ]
        });
    });

    function refreshExchangeRate() {
        $.ajax({
            url: '{{ route("backsite.currency.refresh") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            beforeSend: function() {
                $('button[onclick="refreshExchangeRate()"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Refreshing...');
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert('Failed to refresh exchange rate: ' + response.message);
                }
            },
            error: function() {
                alert('Failed to refresh exchange rate. Please try again.');
            },
            complete: function() {
                $('button[onclick="refreshExchangeRate()"]').prop('disabled', false).html('<i class="fa fa-refresh"></i> Refresh Rate');
            }
        });
    }
</script>

<style>
    .booking-info, .tour-info, .amount-info, .method-info, .date-info {
        line-height: 1.4;
    }

    .booking-info strong, .tour-info strong, .amount-info strong, .method-info strong, .date-info strong {
        display: block;
        margin-bottom: 2px;
    }

    .text-muted {
        font-size: 0.85em;
    }

    .badge {
        font-size: 0.75em;
        padding: 0.25em 0.5em;
    }

    .btn-group .btn {
        margin-right: 2px;
    }

    .table td {
        vertical-align: middle;
        padding: 0.75rem 0.5rem;
    }
</style>
@endpush