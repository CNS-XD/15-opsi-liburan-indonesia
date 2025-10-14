@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Beranda')
@section('activeMenuBeranda', 'open active')

{{-- Breadcrumb --}}
@section('breadcrumb1', 'Informasi')
@section('breadcrumb2', 'Beranda')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ url('/') }}" class="btn btn-info btn-sm btn-glow round" target="_blank">
    Lihat Tampilan <i class="fa fa-arrow-right"></i>
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
                                        <a class="nav-link text-blue active" data-toggle="tab" href="#infoHeader" role="tab">
                                            Header
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-blue" data-toggle="tab" href="#infoSponsor" role="tab">
                                            Sponsor
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-blue" data-toggle="tab" href="#infoKontakUmum" role="tab">
                                            Kontak Umum
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-blue" data-toggle="tab" href="#infoKontakSosmed" role="tab">
                                            Kontak Sosmed
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="infoHeader" role="tabpanel">
                                        <div class="pt-20">
                                            <form method="POST" action="javascript:void(0);" id="form_header"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group">
                                                    <label for="judul">Judul</label>
                                                    <input type="text" name="judul" class="form-control" placeholder="Judul" value="{{ $infoHeader->judul ?? null }}" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="deskripsi">Deskripsi</label>
                                                    <textarea name="deskripsi" class="form-control" placeholder="Deskripsi">{{ $infoHeader->deskripsi ?? null }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="judul_countdown">Judul Countdown</label>
                                                    <textarea name="judul_countdown" class="form-control" placeholder="Judul Countdown" cols="30" rows="3">{{ $infoHeader->judul_countdown ?? null }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="countdown">Countdown</label>
                                                    <input type="text" name="countdown" class="form-control" placeholder="ex: 10/05/2025 23:59:59" value="{{ $infoHeader->countdown ?? null }}" />
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Background</label>
                                                            <input type="file" name="file_background" class="val-control-file  form-control height-auto" id="img-input">
                                                        </div>
                                                        <div class="form-group">
                                                            @if (!empty($infoHeader->background))
                                                                @php
                                                                    $filename = $infoHeader->background;
                                                                    $temp = explode('.', $filename);
                                                                    $ext = end($temp);
                                                                @endphp
                                                                <label>Background Saat Ini</label><br>
                                                                @if ($ext == "mp4")
                                                                    <video loop="" muted="" autoplay="" controls style="width: 100%">
                                                                        <source src="/storage/{{ $infoHeader->background }}" type="video/mp4">
                                                                    </video>
                                                                @else
                                                                    <img src="{{ Storage::url($infoHeader->background) }}" class="img-responsive" height="200">
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Ilustrasi</label>
                                                            <input type="file" name="file_ilustrasi" class="val-control-file  form-control height-auto" id="img-input">
                                                        </div>
                                                        <div class="form-group">
                                                            @if (!empty($infoHeader->ilustrasi))
                                                                <label>Ilustrasi Saat Ini</label><br>
                                                                <img src="{{ Storage::url($infoHeader->ilustrasi) }}" class="img-responsive" height="200">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="running_text">Running Text</label>
                                                    <textarea class="form-control" placeholder="Running Text" name="running_text">{{ $infoHeader->running_text ?? null }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="link">Link</label>
                                                    <textarea class="form-control" placeholder="Link" name="link">{{ $infoHeader->link ?? null }}</textarea>
                                                </div>

                                                <div class="pl-0 profile-social form-group">
                                                    <button class="btn btn-primary button-simpan" type="button" onclick="submitForm('form_header')">
                                                        <i class="fa fa-save"></i> Simpan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="infoSponsor" role="tabpanel">
                                        <div class="pt-20 pb-20">
                                            <div class="mt-1 mb-2">
                                                <button type="button" class="btn btn-primary btn-sm scroll-click" onclick="showModal('form_sponsor')">
                                                    <i class="fa fa-plus"></i> Tambah Sponsor
                                                </button>
                                            </div>
                                            <table id="sponsorTable"
                                                class="table material-table table-hover table-striped dataTable no-footer zero-configuration datatable"
                                                style="width:100% !important">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Logo</th>
                                                        <th>Nama</th>
                                                        <th>Url</th>
                                                        <th>Tayang</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="infoKontakUmum" role="tabpanel">
                                        <div class="pt-20">
                                            <form method="POST" action="javascript:void(0);" id="form_kontak_umum">
                                                @csrf

                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input class="form-control" placeholder="Email" name="email" type="email" value="{{ $infoKontakUmum->email ?? null }}" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="telepon">Telepon</label>
                                                    <input class="form-control" placeholder="ex: 85712484205" name="telepon" type="number" value="{{ $infoKontakUmum->telepon ?? null }}" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="fax">Fax</label>
                                                    <input class="form-control" placeholder="Fax" name="fax" type="number" value="{{ $infoKontakUmum->fax ?? null }}" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <textarea class="form-control" placeholder="Alamat" name="alamat" required>{{ $infoKontakUmum->alamat ?? null }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="latitude">Latitude</label>
                                                    <input class="form-control" placeholder="Ex: -6.3466436640308075" name="latitude" value="{{ $infoKontakUmum->latitude ?? null }}" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="longitude">Longitude</label>
                                                    <input class="form-control" placeholder="Ex: 106.83563682493455" name="longitude" value="{{ $infoKontakUmum->longitude ?? null }}" required />
                                                </div>

                                                <div class="pl-0 profile-social form-group">
                                                    <button class="btn btn-primary button-simpan" type="button" onclick="submitForm('form_kontak_umum')">
                                                        <i class="fa fa-save"></i> Simpan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="infoKontakSosmed" role="tabpanel">
                                        <div class="pt-20 pb-20">
                                            <div class="mt-1 mb-2">
                                                <button type="button" class="btn btn-primary btn-sm scroll-click" onclick="showModal('form_kontak_sosmed')">
                                                    <i class="fa fa-plus"></i> Tambah Kontak Sosmed
                                                </button>
                                            </div>
                                            <table id="kontakSosmedTable"
                                                class="table material-table table-hover table-striped dataTable no-footer zero-configuration datatable"
                                                style="width:100% !important">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Jenis Sosmed</th>
                                                        <th>Nama Akun</th>
                                                        <th>Url</th>
                                                        <th>Tayang</th>
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

                    <div class="modal fade" id="modal_form_sponsor" tabindex="-1" aria-labelledby="modal_form_sponsorLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal_form_sponsorLabel">Form</h5>
                                    <button type="button" class="close" onclick="closeModal('form_sponsor')" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12">
                                        <form form method="POST" action="javascript:void(0);" id="form_sponsor" enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="id" value="">
                                            <div class="mb-3">
                                                <label class="label-control required">Nama Sponsor</label>
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="ex: Wadimor" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="label-control required">URL</label>
                                                <input type="url" class="form-control" id="url" name="url" placeholder="ex: http://sponsor.com" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="label-control required">Logo Sponsor</label>
                                                <input type="file" class="form-control" id="file_sponsor" name="file_sponsor">
                                            </div>
                                            <div class="mb-3">
                                                <label class="label-control required">Tampil</label>
                                                <select name="tayang" class="form-control">
                                                    <option value="1">Tampil</option>
                                                    <option value="0">Tidak Tampil</option>
                                                </select>
                                            </div>
                                            <div class="pl-0 profile-social form-group">
                                                <button class="btn btn-primary button-simpan" type="button" onclick="submitForm('form_sponsor')">
                                                    <i class="fa fa-save"></i> Simpan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white text-black" onclick="closeModal('form_sponsor')" data-dismiss="modal">
                                        <b>Tutup</b>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modal_form_kontak_sosmed" tabindex="-1" aria-labelledby="modal_form_kontak_sosmedLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal_form_kontak_sosmedLabel">Form</h5>
                                    <button type="button" class="close" onclick="closeModal('form_kontak_sosmed')" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12">
                                        <form form method="POST" action="javascript:void(0);" id="form_kontak_sosmed">

                                            <input type="hidden" name="id" value="">
                                            <div class="mb-3">
                                                <label class="label-control required">Jenis Sosial Media</label>
                                                <select name="jenis_sosmed" class="form-control" required>
                                                    <option value="Facebook">Facebook</option>
                                                    <option value="Instagram">Instagram</option>
                                                    <option value="Tiktok">Tiktok</option>
                                                    <option value="Twitter">X (Twitter)</option>
                                                    <option value="Youtube">Youtube</option>
                                                    <option value="Web">Web</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="label-control required">Nama Akun</label>
                                                <input type="text" class="form-control" name="nama_akun" placeholder="ex: Puspresnas" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="url" class="label-control required">URL</label>
                                                <input type="url" class="form-control" name="url" placeholder="ex: https://instagram.com/puspresnas" required>
                                            </div>
                                            <div class="pl-0 profile-social form-group">
                                                <button class="btn btn-primary button-simpan" type="button" onclick="submitForm('form_kontak_sosmed')">
                                                    <i class="fa fa-save"></i> Simpan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white text-black" onclick="closeModal('form_kontak_sosmed')" data-dismiss="modal">
                                        <b>Tutup</b>
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
            drawTableSponsor();
            drawTableSosmed();
        });

        const drawTableSponsor = () => {
            $('#sponsorTable').DataTable({
                processing: true,
                "scrollX": true,
                serverSide: true,
                responsive: true,
                bDestroy: true,
                'bAutoWidth': false,
                ajax: '{{ route('backsite.beranda.datatable-sponsor') }}',
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
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'url',
                        name: 'url',
                        render: function(data, type, row) {
                            return `<a href="${row.url}" target="_blank">${row.url}</label>`
                        }
                    },
                    {
                        data: 'tayang',
                        name: 'tayang'
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

        const drawTableSosmed = () => {
            $('#kontakSosmedTable').DataTable({
                processing: true,
                "scrollX": true,
                serverSide: true,
                responsive: true,
                bDestroy: true,
                'bAutoWidth': false,
                ajax: '{{ route('backsite.beranda.datatable-sosmed') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        bSearchable: false
                    },
                    {
                        data: 'jenis_sosmed',
                        name: 'jenis_sosmed'
                    },
                    {
                        data: 'nama_akun',
                        name: 'nama_akun'
                    },
                    {
                        data: 'url',
                        name: 'url',
                        render: function(data, type, row) {
                            return `<a href="${row.url}" target="_blank">${row.url}</label>`
                        }
                    },
                    {
                        data: 'tayang',
                        name: 'tayang'
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

        const showModal = async (jenisForm, id = null) => {
            if (id !== null) {
                var url = "{{ route('backsite.beranda.edit', ':id') }}".replace(':id', id);
                url += '?form_input=' + jenisForm;

                $.ajax({
                    url: url,
                    type: 'GET',
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.success) {
                            let currentForm = $(`#${jenisForm}`);
                            currentForm.find('input[name="id"]').val(res.data.id);
                            currentForm.find('input[name="url"]').val(res.data.url);
                            if (jenisForm == 'form_kontak_sosmed') {
                                currentForm.find('input[name="nama_akun"]').val(res.data.nama_akun);
                                currentForm.find('select[name="jenis_sosmed"]').val(res.data.jenis_sosmed);
                            } else {
                                currentForm.find('input[name="nama"]').val(res.data.nama);
                                currentForm.find('select[name="tayang"]').val(res.data.tayang);
                            }
                            $(`#modal_${jenisForm}`).modal('show');

                        } else {
                            swal.fire('Gagal', res.message, 'error');
                        }
                    },
                    error: function(err) {
                        var errors = err.responseJSON.errors
                        var message = "";
                        $.each(errors, function(key, value) {
                            message += value[0] + " ";
                        })
                        swal.fire('Gagal', message, 'error')
                    },
                })
            } else {
                $(`#modal_${jenisForm}`).modal('show');
            }

        }

        const closeModal = (jenisForm) => {
            $(`#modal_${jenisForm}`).modal('hide');
            $(`#${jenisForm}`)[0].reset();
        }

        const deleteData = async (jenisForm, id) => {
            var url = "{{ route('backsite.beranda.destroy', ':id') }}".replace(':id', id);
            Swal.fire({
                icon: 'warning',
                title: 'Apa kamu yakin?',
                text: "Anda tidak akan dapat mengembalikan data ini kembali!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            form_input: jenisForm,
                        },
                        success: function(res) {
                            if (res.success) {
                                swal.fire('Berhasil', res.message, 'success');
                            } else {
                                swal.fire('Gagal', res.message, 'error');
                            }
                            if (jenisForm == 'form_sponsor') {
                                drawTableSponsor();
                            } else {
                                drawTableSosmed();
                            }
                        },
                    })
                }
            });
        }

        const submitForm = (jenisForm) => {
            var url = "{{ route('backsite.beranda.store') }}";
            var form = $(`#${jenisForm}`);
            var formData = new FormData(form[0]);
            formData.append('form_input', jenisForm);
            formData.append('_token', '{{ csrf_token() }}');
            var button = $('.button-simpan');
            button.attr('disabled', true);
            button.html(`<i class="fa fa-spinner fa-spin"></i> Sedang Mengirim`);

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
                        swal.fire('Gagal', err.data, 'error')
                    }
                },
                beforeSend: function() {
                    swal.fire({
                        title: 'Sedang mengirim ke server, mohon tunggu',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            swal.showLoading();
                        }
                    })
                },
                success: function(res) {
                    if (res.success) {
                        swal.fire('Berhasil', res.message, 'success');
                        if (jenisForm == 'form_sponsor') {
                            closeModal('form_sponsor');
                            drawTableSponsor();
                        } else if (jenisForm == 'form_kontak_sosmed') {
                            closeModal('form_kontak_sosmed');
                            drawTableSosmed();
                        }
                    } else {
                        swal.fire('Gagal', res.message, 'error');
                    }
                },
                error: function(err) {
                    var errors = err.responseJSON.errors
                    var message = "";
                    $.each(errors, function(key, value) {
                        message += value[0] + " ";
                    })
                    swal.fire('Gagal', message, 'error')
                },
                onerror: function(XMLHttpRequest, textStatus, errorThrown) {
                    //
                },
                complete: function() {
                    button.attr('disabled', false);
                    button.html(`<i class="fa fa-save"></i> Simpan`);
                }
            })
        }
    </script>
@endpush
