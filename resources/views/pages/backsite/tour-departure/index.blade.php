@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Tour Departure')
@section('activeMenuTour', 'open active')
@section('activeSubMenuTourDeparture', 'open active')

{{-- Breadcrumb --}}
@section('breadcrumb1', $tour->title)
@section('breadcrumb2', 'Tour Departure')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ route('backsite.tour.index') }}" class="btn btn-danger btn-sm round">
    <i class="fa fa-arrow-left mr5"></i> Back
</a>
<a href="{{ route('backsite.tour-departure.create', $tour->id) }}" class="btn btn-success btn-sm round">
    <i class="fa fa-plus"></i> Add
</a>
<a href="{{ url('/') }}" class="btn btn-info btn-sm round" target="_blank">
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
                            <div class="card-text"></div>

                            <div class="table-responsive">
                                <table id="dataTable"
                                    class="table material-table table-hover table-striped dataTable no-footer zero-configuration datatable"
                                    style="width:100% !important">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tour</th>
                                            <th>Departure</th>
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
    initDatatable();
});

function initDatatable() {
    $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,

        ajax: "{{ route('backsite.tour-departure.datatable', $tour->id) }}",

        columns: [
            {
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'tour',
                name: 'tour.title'
            },
            {
                data: 'departure',
                name: 'departure.title'
            },
            {
                data: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });
}
</script>
@endpush
