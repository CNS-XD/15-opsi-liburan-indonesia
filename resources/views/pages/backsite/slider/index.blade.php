@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Slider')
@section('activeMenuSlider', 'open active')
@section('activeSubMenuSlider', 'open active')

{{-- Breadcrumb --}}
@section('breadcrumb1', 'Information')
@section('breadcrumb2', 'Slider')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ route('backsite.slider.create') }}" class="btn btn-success btn-sm btn-glow round">
    <i class="fa fa-plus"></i> Add
</a>
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
                            <div class="card-text"></div>

                            <div class="table-responsive">
                                <table id="dataTable"
                                    class="table material-table table-hover table-striped dataTable no-footer zero-configuration datatable"
                                    style="width:100% !important">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Slider</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Type</th>
                                            <th>Show</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
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
    $(document).ready(function() {
        datatable()
    });

    // Table
    const datatable = () => {
        $('#dataTable').DataTable().destroy();
        $('#dataTable').DataTable({
            // "scrollX": true,
            processing: true,
            serverSide: true,
            "bAutoWidth": false,
            "bDestroy": true,
            "lengthMenu": [
                [50, 100, -1],
                [50, 100, "All"]
            ],
            "ajax": {
                url: '{{ route('backsite.slider.datatable') }}',
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    bSearchable: false
                },
                {
                    data: 'slider',
                    name: 'slider',
                    orderable: false,
                    bSearchable: false,
                },
                {
                    data: 'title',
                    name: 'title',
                },
                {
                    data: 'description',
                    name: 'description',
                },
                {
                    data: 'type',
                    name: 'type',
                    render: function(data, type, row) {
                        let type = row.type;
                        let badge = type == 1 ? 'Gambar' : 'Video';
                        let btn = `
                            <span class="badge badge-primary">${badge}</span>
                        `
                        return btn;
                    }
                },
                {
                    data: 'show',
                    name: 'show',
                    render: function(data, type, row) {
                        let show = row.show;
                        let btn = `
                            <label class="pure-material-switch">
                                <input onChange="setShow(${row.id})" 
                                    type="checkbox" ${show == 1 ? "checked" : "" }>
                                <span></span>
                            </label>
                        `
                        return btn;
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    bSearchable: false
                }
            ]
        });
    }

    // Set Show
    function setShow(id) {
        let show = $(`input[data-id="${id}"]`).data('show');
        let url = `{{ route('backsite.slider.set-show', ':id') }}`;
        url = url.replace(':id', id);

        $.ajax({
            type: "POST",
            url: url,
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success == 200) {
                    Swal.fire({
                        slider: 'success',
                        title: 'Success',
                        text: response.message,
                    });
                    datatable();
                } else {
                    Swal.fire({
                        slider: 'error',
                        title: 'Failed',
                        text: response.message,
                    });
                }
            }
        });
    }

    // Delete
    const deleteRoute = "{{ route('backsite.slider.destroy', ':id') }}";
    function deleteConf(id) {
        Swal.fire({
            slider: 'warning',
            title: 'Are you sure?',
            text: "You will not be able to restore this data back!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                let url = deleteRoute.replace(':id', id);

                $.ajax({
                    type: 'DELETE',
                    url: url,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if (res.success == true) {
                            Swal.fire({
                                slider: 'success',
                                title: 'Success',
                                text: res.message,
                            });
                            datatable();
                        } else {
                            Swal.fire({
                                slider: 'error',
                                title: 'Failed',
                                text: res.message,
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Oops something went wrong!', xhr.responseJSON.message || 'Failed to delete data.', 'error');
                    }
                });
            }
        });
    }
</script>
@endpush
