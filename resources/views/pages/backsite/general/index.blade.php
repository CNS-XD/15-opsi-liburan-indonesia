@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'General')
@section('activeMenuGeneral', 'open active')

{{-- Breadcrumb --}}
@section('breadcrumb1', 'Information')
@section('breadcrumb2', 'General')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ url('/') }}" class="btn btn-info btn-sm btn-glow round" target="_blank">
    View Page <i class="fa fa-arrow-right"></i>
</a>
@endsection

@push('after-style')
    <style>
        .fade.show {
            background: #fff !important;
        }
    </style>
@endpush

@section('content-body1')
<div class="content-body">
    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab">
                            <ul class="nav nav-tabs customtab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link text-blue active" data-toggle="tab" href="#partner" role="tab">
                                        Partner
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#contactGeneral" role="tab">
                                        Contact General
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#contactSocmed" role="tab">
                                        Contact Socmed
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="partner" role="tabpanel">
                                    <div class="pt-20 pb-20">
                                        <div class="mt-1 mb-2">
                                            <button type="button" class="btn btn-primary btn-sm scroll-click" onclick="showModal('form_partner')">
                                                <i class="fa fa-plus"></i> Add Partner
                                            </button>
                                        </div>
                                        <table id="partnerTable"
                                            class="table material-table table-hover table-striped dataTable no-footer zero-configuration datatable"
                                            style="width:100% !important">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Logo</th>
                                                    <th>Name</th>
                                                    <th>Url</th>
                                                    <th>Show</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contactGeneral" role="tabpanel">
                                    <div class="pt-20">
                                        <form method="POST" action="javascript:void(0);" id="form_contact_general">
                                            @csrf

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input class="form-control" placeholder="Ex: opsiliburan@gmail.com" name="email" type="email" value="{{ $contactGeneral->email ?? null }}" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input class="form-control" placeholder="ex: 081234698453" name="phone" type="text" value="{{ $contactGeneral->phone ?? null }}" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="fax">Fax</label>
                                                <input class="form-control" placeholder="Fax" name="fax" type="number" value="{{ $contactGeneral->fax ?? null }}" />
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea class="form-control" placeholder="ex: Perumahan Jl. Magersari Permai No.BP 9, Gajah Timur, Magersari, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61211" name="address" required>{{ $contactGeneral->address ?? null }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="latitude">Latitude</label>
                                                <input class="form-control" placeholder="Ex: -7.4466087" name="latitude" value="{{ $contactGeneral->latitude ?? null }}" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="longitude">Longitude</label>
                                                <input class="form-control" placeholder="Ex: 112.7103605" name="longitude" value="{{ $contactGeneral->longitude ?? null }}" required />
                                            </div>

                                            <div class="pl-0 profile-social form-group">
                                                <button class="btn btn-primary button-save" type="button" onclick="submitForm('form_contact_general')">
                                                    <i class="fa fa-save"></i> Save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contactSocmed" role="tabpanel">
                                    <div class="pt-20 pb-20">
                                        <div class="mt-1 mb-2">
                                            <button type="button" class="btn btn-primary btn-sm scroll-click" onclick="showModal('form_contact_socmed')">
                                                <i class="fa fa-plus"></i> Add Contact Socmed
                                            </button>
                                        </div>
                                        <table id="contactSocmedTable"
                                            class="table material-table table-hover table-striped dataTable no-footer zero-configuration datatable"
                                            style="width:100% !important">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Type Socmed</th>
                                                    <th>Name Account</th>
                                                    <th>Url</th>
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

                <div class="modal fade" id="modal_form_partner" tabindex="-1" aria-labelledby="modal_form_partnerLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_form_partnerLabel">Form</h5>
                                <button type="button" class="close" onclick="closeModal('form_partner')" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <form form method="POST" action="javascript:void(0);" id="form_partner" enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="id" value="">
                                        <div class="mb-3">
                                            <label class="label-control required">Name Partner</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="ex: Wonderfull Indonesia" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="label-control required">URL</label>
                                            <input type="url" class="form-control" id="url" name="url" placeholder="ex: http://partner.com" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="label-control required">Logo Partner</label>
                                            <input type="file" class="form-control" id="file_partner" name="file_partner" accept="image/*">
                                        </div>
                                        <div class="mb-3">
                                            <label class="label-control required">Show</label>
                                            <select name="show" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Non Active</option>
                                            </select>
                                        </div>
                                        <div class="pl-0 profile-social form-group">
                                            <button class="btn btn-primary button-save" type="button" onclick="submitForm('form_partner')">
                                                <i class="fa fa-save"></i> Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white text-black" onclick="closeModal('form_partner')" data-dismiss="modal">
                                    <b>Close</b>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modal_form_contact_socmed" tabindex="-1" aria-labelledby="modal_form_contact_socmedLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_form_contact_socmedLabel">Form</h5>
                                <button type="button" class="close" onclick="closeModal('form_contact_socmed')" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <form form method="POST" action="javascript:void(0);" id="form_contact_socmed">

                                        <input type="hidden" name="id" value="">
                                        <div class="mb-3">
                                            <label class="label-control required">Type Social Media</label>
                                            <select name="type_socmed" class="form-control" required>
                                                <option value="Facebook">Facebook</option>
                                                <option value="Instagram">Instagram</option>
                                                <option value="Tiktok">Tiktok</option>
                                                <option value="Twitter">X (Twitter)</option>
                                                <option value="Youtube">Youtube</option>
                                                <option value="Web">Web</option>
                                                <option value="WeChat">WeChat</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="label-control required">Name Account</label>
                                            <input type="text" class="form-control" name="name_account" placeholder="ex: Opsi Travel" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="url" class="label-control required">URL</label>
                                            <input type="url" class="form-control" name="url" placeholder="ex: https://instagram.com/opsiliburan" required>
                                        </div>
                                        <div class="pl-0 profile-social form-group">
                                            <button class="btn btn-primary button-save" type="button" onclick="submitForm('form_contact_socmed')">
                                                <i class="fa fa-save"></i> Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white text-black" onclick="closeModal('form_contact_socmed')" data-dismiss="modal">
                                    <b>Close</b>
                                </button>
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
        drawTablePartner();
        drawTableSocmed();

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
        });
    });

    const drawTablePartner = () => {
        $('#partnerTable').DataTable({
            processing: true,
            "scrollX": true,
            serverSide: true,
            responsive: true,
            bDestroy: true,
            'bAutoWidth': false,
            ajax: '{{ route('backsite.general.datatable-partner') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    bSearchable: false
                },
                {
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'url',
                    name: 'url',
                    render: function(data, type, row) {
                        return `<a href="${row.url}" target="_blank">${row.url}</label>`
                    }
                },
                {
                    data: 'show',
                    name: 'show'
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

    const drawTableSocmed = () => {
        $('#contactSocmedTable').DataTable({
            processing: true,
            "scrollX": true,
            serverSide: true,
            responsive: true,
            bDestroy: true,
            'bAutoWidth': false,
            ajax: '{{ route('backsite.general.datatable-socmed') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    bSearchable: false
                },
                {
                    data: 'type_socmed',
                    name: 'type_socmed'
                },
                {
                    data: 'name_account',
                    name: 'name_account'
                },
                {
                    data: 'url',
                    name: 'url',
                    render: function(data, type, row) {
                        return `<a href="${row.url}" target="_blank">${row.url}</label>`
                    }
                },
                {
                    data: 'show',
                    name: 'show'
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

    const showModal = async (typeForm, id = null) => {
        if (id !== null) {
            var url = "{{ route('backsite.general.edit', ':id') }}".replace(':id', id);
            url += '?form_input=' + typeForm;

            $.ajax({
                url: url,
                type: 'GET',
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.success) {
                        let currentForm = $(`#${typeForm}`);
                        currentForm.find('input[name="id"]').val(res.data.id);
                        currentForm.find('input[name="url"]').val(res.data.url);
                        if (typeForm == 'form_contact_socmed') {
                            currentForm.find('input[name="name_account"]').val(res.data.name_account);
                            currentForm.find('select[name="type_socmed"]').val(res.data.type_socmed);
                        } else {
                            currentForm.find('input[name="name"]').val(res.data.name);
                            currentForm.find('select[name="show"]').val(res.data.show);
                        }
                        $(`#modal_${typeForm}`).modal('show');

                    } else {
                        swal.fire('Failed', res.message, 'error');
                    }
                },
                error: function(err) {
                    var errors = err.responseJSON.errors
                    var message = "";
                    $.each(errors, function(key, value) {
                        message += value[0] + " ";
                    })
                    swal.fire('Failed', message, 'error')
                },
            })
        } else {
            let currentForm = $(`#${typeForm}`);
            currentForm[0].reset();
            currentForm.find('input[name="id"]').val('');
            $(`#modal_${typeForm}`).modal('show');
        }

    }

    const closeModal = (typeForm) => {
        $(`#modal_${typeForm}`).modal('hide');
        $(`#${typeForm}`)[0].reset();
    }

    const deleteData = async (typeForm, id) => {
        var url = "{{ route('backsite.general.destroy', ':id') }}".replace(':id', id);
        Swal.fire({
            icon: 'warning',
            title: 'Are you sure?',
            text: "You will not be able to restore this data back!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        })
        .then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        form_input: typeForm,
                    },
                    success: function(res) {
                        if (res.success) {
                            swal.fire('Success', res.message, 'success');
                        } else {
                            swal.fire('Failed', res.message, 'error');
                        }
                        if (typeForm == 'form_partner') {
                            drawTablePartner();
                        } else {
                            drawTableSocmed();
                        }
                    },
                })
            }
        });
    }

    const submitForm = (typeForm) => {
        var url = "{{ route('backsite.general.store') }}";
        var form = $(`#${typeForm}`);
        var formData = new FormData(form[0]);
        formData.append('form_input', typeForm);
        formData.append('_token', '{{ csrf_token() }}');
        var button = $('.button-save');
        button.attr('disabled', true);
        button.html(`<i class="fa fa-spinner fa-spin"></i> In Progress`);

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
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
                    swal.fire('Success', res.message, 'success');
                    if (typeForm == 'form_partner') {
                        closeModal('form_partner');
                        drawTablePartner();
                    } else if (typeForm == 'form_contact_socmed') {
                        closeModal('form_contact_socmed');
                        drawTableSocmed();
                    }
                } else {
                    swal.fire('Failed', res.message, 'error');
                }
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
            },
            complete: function() {
                button.attr('disabled', false);
                button.html(`<i class="fa fa-save"></i> Save`);
            }
        })
    }
</script>
@endpush
