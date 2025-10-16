@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', $role['role'])
@section('activeMenuUser', 'active open')
@section('activeSubMenu' . str_replace(' ', '', ucwords($role['role'])), 'active open')

{{-- Breadcrumb --}}
@section('breadcrumb1', 'User')
@section('breadcrumb2', $role['role'])

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ route('backsite.user.create', $role['index_role']) }}" class="btn btn-success btn-sm btn-glow round">
    <i class="fa fa-plus"></i> Add
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
                                    class="table material-table table-hover table-striped dataTable no-footer zero-configuration dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Plaintext</th>
                                            <th>Phone</th>
                                            <th>Nationality</th>
                                            <th>Role</th>
                                            <th>Status</th>
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

@include('pages.backsite.user.show', ['role' => $role])
@endsection

@push('after-script')
<script>
    $(document).ready(function() {
        datatable()
    });

    let idRole = '{{ $role['id_role'] }}';
    let indexRole = '{{ $role['index_role'] }}';

    const datatable = () => {
        let urlDatatable = "{{ route('backsite.user.datatable', $role['index_role']) }}"
        urlDatatable = urlDatatable.replace(':id', idRole);

        var columns = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'name',
                name: 'name',
            },
            {
                data: 'email',
                name: 'email',
            },
            {
                data: 'plain_text',
                name: 'plain_text',
            },
            {
                data: 'phone',
                name: 'phone',
            },
            {
                data: 'nationality',
                name: 'nationality',
            },
            {
                data: 'role',
                name: 'role',
                render: function(data, type, row) {
                    if (row.role === 1) {
                        return 'Superadmin';
                    } else {
                        return 'Client';
                    }
                }
            },
            {
                data: 'status',
                name: 'status',
                render: function(data, type, row) {
                    let btn = `
                        <label class="pure-material-switch">
                            <input class="set-status" data-id="${row.id}" data-status="${row.status == 1 ? 0 : 1}" type="checkbox" ${row.status == 1 ? "checked" : "" } >
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
                searchable: false,
                render: function(data, type, row) {
                    var editUrl = "{{ route('backsite.user.edit', [':role', ':id']) }}";
                    editUrl = editUrl.replace(':role', '{{ $role['index_role'] }}').replace(':id', row.id);

                    let ret = '';
                    ret += `
                            <div class="btn-group">
                                <button data-id="${row.id}" class="btn btn-info btn-sm round btn-detail" title="Detail">
                                    <i class="la la-eye"></i>
                                </button>
                                <a href="${editUrl}" class="btn btn-sm btn-warning round" title="Edit data">
                                    <i class="la la-edit"></i>
                                </a>
                                <button onClick="deleteConf(${row.id})" class="btn btn-danger btn-sm btn_delete round" title="Delete data">
                                    <i class="la la-trash"></i>
                                </button>
                            </div>
                    `;
                    return ret;
                }
            },
        ];

        $('#dataTable').DataTable().destroy();
        $('#dataTable').DataTable({
            serverSide: true,
            processing: true,
            "lengthMenu": [
                [50, 100, -1],
                [50, 100, "All"]
            ],
            ajax: {
                url: urlDatatable,
                type: 'GET',
            },
            columns: columns
        })
    }

    // Set Status User
    $(document).on('change', ".set-status", function() {
        var id = $(this).data('id');
        var status = $(this).data('status');
        var url = "{{ route('backsite.user.set-status', [':role', ':id']) }}";
        url = url.replace(':role', '{{ $role['index_role'] }}').replace(':id', id);

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            statusCode: {
                500: function(xhr) {
                    Swal.hideLoading();
                    Swal.close();
                    let err = JSON.parse(xhr.responseText)
                    swal.fire('Failed', err.data, 'error')
                }
            },
            beforeSend: function() {
                swal.fire({
                    title: 'Sending to server, please wait',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        swal.showLoading();
                    }
                })
            },
            success: function(res) {
                if (res.success) {
                    swal.fire('Success', 'Successfully Changed Status', 'success');
                    $('#dataTable').DataTable().ajax.reload();
                } else {
                    swal.fire('Failed', res.data, 'error');
                }
                datatable();
            },
            error: function(err) {
                var errors = err.responseJSON.errors
                var message = "";
                $.each(errors, function(key, value) {
                    message += value[0] + " ";
                })
                swal.fire('Failed', message, 'error')
            },
            onerror: function(XMLHttpRequest, textStatus, errorThrown) {
                //
            }
        })
    });

    // Delete
    const deleteRoute = "{{ route('backsite.user.destroy', [':role', ':id']) }}";
    function deleteConf(id) {
        Swal.fire({
            icon: 'warning',
            title: 'Are you sure?',
            text: "You will not be able to restore this data back!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes delete!'
        }).then((result) => {
            if (result.value) {
                let url = deleteRoute.replace(':role', '{{ $role['index_role'] }}').replace(':id', id);

                $.ajax({
                    type: 'DELETE',
                    url: url,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if (res.success == true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.message,
                            });
                            datatable();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed',
                                text: res.message,
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Oops Something went wrong!', xhr.responseJSON.message || 'Failed to delete data.', 'error');
                    }
                });
            }
        });
    }
</script>
@endpush
