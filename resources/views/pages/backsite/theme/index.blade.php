@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Theme')
@section('activeMenuTheme', 'open active')

{{-- Breadcrumb --}}
@section('breadcrumb1', 'Setting')
@section('breadcrumb2', 'Theme')

{{-- Button Pojok Kanan --}}
@section('buttonRight')

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
                                            <th>Color 1</th>
                                            <th>Color 2</th>
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
                url: '{{ route('backsite.theme.datatable') }}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    bSearchable: false
                },
                {
                    data: 'color_1',
                    name: 'color_1',
                    orderable: false,
                    bSearchable: false
                },
                {
                    data: 'color_2',
                    name: 'color_2',
                    orderable: false,
                    bSearchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    render: function(data, type, row, meta) {
                        let editUrl = '{{ route('backsite.theme.edit', ':id') }}';
                        editUrl = editUrl.replace(':id', row.id);

                        let ret = `
                            <div class="btn-group">
                                <a href="${editUrl}" class="btn btn-sm btn-warning round" title="Edit data">
                                    <i class="la la-edit"></i>
                                </a>
                            </div>
                        `;
                        return ret;
                    },
                    orderable: false,
                    bSearchable: false
                }
            ],
        });
    }
</script>
@endpush
