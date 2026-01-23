@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Booking')
@section('activeMenuBooking', 'open active')

{{-- Breadcrumb --}}
@section('breadcrumb1', 'Transaction')
@section('breadcrumb2', 'Booking')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ url('/') }}" class="btn btn-info btn-sm btn-glow round" target="_blank">
    View Page <i class="fa fa-arrow-right"></i>
</a>
@endsection

@section('content-body1')
<div class="content-body">
    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    {{-- Card Header --}}
                    @include('partials.backsite.content.card-header')

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table id="dataTable"
                                    class="table table-striped table-bordered"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tour</th>
                                            <th>Harga</th>
                                            <th>Tanggal Order</th>
                                            <th>Dibuat Oleh</th>
                                            <th>Tanggal Dibuat</th>
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

        ajax: {
            url: "{{ route('backsite.booking.datatable') }}"
        },

        columns: [
            {
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'tour',
                name: 'tour'
            },
            {
                data: 'price',
                name: 'price'
            },
            {
                data: 'order_date',
                name: 'order_date'
            },
            {
                data: 'created_by',
                name: 'created_by'
            },
            {
                data: 'created_at',
                name: 'created_at'
            }
        ]
    });
});
</script>
@endpush
