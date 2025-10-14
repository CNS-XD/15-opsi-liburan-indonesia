@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Destination')
@section('activeMenuDestination', 'open active')
@section('activeSubMenuDestination', 'open active')

{{-- Breadcrumb --}}
@section('breadcrumb1', 'Master')
@section('breadcrumb2', 'Destination')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ route('backsite.destination.create') }}" class="btn btn-success btn-sm btn-glow round">
    <i class="fa fa-plus"></i> Tambah
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
                                <table id="tableData"
                                    class="table material-table table-hover table-striped dataTable no-footer zero-configuration datatable"
                                    style="width:100% !important">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <th>Aksi</th>
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
        $('#tableData').DataTable().destroy();
        $('#tableData').DataTable({
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
                url: '{{ route('backsite.destination.datatable') }}',
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    bSearchable: false
                },
                {
                    data: 'title',
                    name: 'title',
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    bSearchable: false
                }
            ]
        });
    }

    // Delete
    const deleteRoute = "{{ route('backsite.destination.destroy', ':id') }}";
    function deleteConf(id) {
        Swal.fire({
            icon: 'warning',
            title: 'Apa kamu yakin?',
            text: "Anda tidak akan dapat mengembalikan data ini kembali!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
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
                                icon: 'success',
                                title: 'Berhasil',
                                text: res.message,
                            });
                            datatable();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: res.message,
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Ups Terjadi Kesalahan!', xhr.responseJSON.message || 'Gagal menghapus data.', 'error');
                    }
                });
            }
        });
    }
</script>
@endpush
