@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Tour Detail')
@section('activeMenuTour', 'open active')
@section('activeSubMenuTourDetail', 'open active')

{{-- Breadcrumb --}}
@section('breadcrumb1', $tour->title)
@section('breadcrumb2', 'Tour Detail')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ route('backsite.tour.index') }}" class="btn btn-danger btn-sm round">
    <i class="fa fa-arrow-left mr5"></i> Back
</a>
<a href="{{ route('backsite.tour-detail.create', $tour->id) }}" class="btn btn-success btn-sm round">
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
                                    class="table table-striped table-bordered zero-configuration datatable"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Type</th>
                                            <th>Description</th>
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

    const initDatatable = () => {
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            responsive: true,
            lengthMenu: [
                [50, 100, -1],
                [50, 100, "All"]
            ],
            ajax: {
                url: "{{ route('backsite.tour-detail.datatable', $tour->id) }}"
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    };

    // DELETE (SAMA PERSIS POLA ADVANTAGE / DESTINATION)
    const deleteRoute = "{{ route('backsite.tour-detail.destroy', ':id') }}";

    function deleteConf(id) {
        Swal.fire({
            icon: 'warning',
            title: 'Are you sure?',
            text: "You will not be able to restore this data!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let url = deleteRoute.replace(':id', id);

                $.ajax({
                    type: 'DELETE',
                    url: url,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        if (res.success === true) {
                            Swal.fire('Success', res.message, 'success');
                            $('#dataTable').DataTable().ajax.reload();
                        } else {
                            Swal.fire('Failed', res.message, 'error');
                        }
                    },
                    error: function (xhr) {
                        Swal.fire(
                            'Error',
                            xhr.responseJSON?.message || 'Failed to delete data.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>
@endpush

