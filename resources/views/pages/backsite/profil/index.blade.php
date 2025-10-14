@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Profil')
@section('activeMenuPengaturan', 'active open')
@section('activeSubMenuProfil', 'active open')

{{-- Breadcrumb --}}
@section('breadcrumb1', 'Pengaturan')
@section('breadcrumb2', 'Profil')

@push('after-style')
<style>
    label {
        font-weight: bold;
    }
</style>
@endpush

@section('content-body1')
<div class="content-body">
    <section id="row-separator-form-layouts">
        <div class="row" id="data-profil-operator">
            <div class="col-md-12">
                <div class="card">
                    {{-- Card Header --}}
                    @include('partials.backsite.content.card-header')
                    
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form form-horizontal row-separator"
                                action="{{ route('backsite.profil.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <input type="hidden" value="{{ $user->id }}" name="id_user">
                                <div class="form-body">
                                    <h4 class="form-section"><i class="ft-user"></i> Profile Info</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="media mb-2">
                                                @if (\Auth::user()->photo == null || empty(\Auth::user()->photo))
                                                    <a class="mr-1" href="/backsite-assets/images/logo/foto-unvailable.png" target="_blank">
                                                        <img src="/backsite-assets/images/logo/foto-unvailable.png"
                                                            alt="Photo Belum Diunggah" class="border border-info border-3 users-avatar-shadow rounded-circle width-100 height-100 img-objectfit" style="object-fit: cover">
                                                    </a>
                                                @else
                                                    <a class="mr-1" href="{{ asset('storage') . '/' . $user->photo }}" target="_blank">
                                                        <img src="{{ asset('storage') . '/' . $user->photo }}"
                                                            onerror="this.src='/frontsite-assets/img/image-broken.jpg';"
                                                            alt="Photo" class="border border-info border-3 users-avatar-shadow rounded-circle width-100 height-100 img-objectfit" style="object-fit: cover">
                                                    </a>
                                                @endif
                                                <div class="border-left-2 border-info height-100"></div>
                                                <div class="media-body">
                                                    <h2 class="media-heading ml-2">Photo</h2>
                                                    <div class="card-body">
                                                        <div class="custom-file">
                                                            <fieldset class="form-group">
                                                                <input type="file" name="foto_profil" class="custom-file-input" accept="image/*">
                                                                <label class="custom-file-label" for="foto" aria-describedby="foto">Choose File</label>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row mx-auto last">
                                                <label class="col-md-3 label-control">Full Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Full Name" value="{{ $user->name }}" name="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row mx-auto last">
                                                <label class="col-md-3 label-control">Nomor HP</label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control" placeholder="example: 0878****" value="{{ $user->phone }}" name="phone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row mx-auto last">
                                                <label class="col-md-3 label-control" for="email">Email</label>
                                                <div class="col-md-9">
                                                    <input type="email" id="email" class="form-control" placeholder="Email" name="email" value="{{ $user->email }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row mx-auto last">
                                                <label class="col-md-3 label-control" for="password">Password</label>
                                                <div class="col-md-9">
                                                    <input type="password" id="password" class="form-control" placeholder="Password" name="password">
                                                    <i class="far fa-eye-slash" id="showPassword" data-show="false"
                                                    style="cursor: pointer; float:right; margin-right:30px; position: relative; top:-25px"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row mx-auto last">
                                                <label class="col-md-3 label-control">Status User</label>
                                                <div class="col-md-9">
                                                    <h5 class="pl7">
                                                        @if (Auth()->user()->status == 1)
                                                            <i class="fa fa-circle text-success"></i>
                                                            Aktif
                                                        @else
                                                            <i class="fa fa-circle text-danger"></i>
                                                            Non Aktif
                                                        @endif
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions text-right">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        <i class="la la-check"></i> Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<button id="scrollUpBtn" class="btn btn-dark rounded-circle shadow" style="position: fixed; bottom: 20px; right: 20px; display: none;">
    <i class="fa fa-arrow-up"></i>
</button>
@endsection

@push('after-script')
<script>
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();

        const target = $(this.getAttribute('href'));
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 60 // sesuaikan dengan tinggi navbar jika ada
            }, 800); // durasi scroll dalam milidetik
        }
    });

    // Tampilkan tombol saat scroll turun 100px
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('#scrollUpBtn').fadeIn();
        } else {
            $('#scrollUpBtn').fadeOut();
        }
    });

    // Scroll ke atas saat tombol diklik
    $('#scrollUpBtn').click(function() {
        $('html, body').animate({ scrollTop: 0 }, 800);
        return false;
    });
        
    $(document).on('click', '#showPassword', function() {
        show = $(this).data('show')
        ret = !show
        if (ret == true) {
            $(this).data('show', true)
            $(this).removeClass('fa-eye-slash')
            $(this).addClass('fa-eye')
            $('#password').attr('type', 'text')
        } else {
            $(this).data('show', false)
            $(this).removeClass('fa-eye')
            $(this).addClass('fa-eye-slash')
            $('#password').attr('type', 'password')
        }
    });
</script>
@endpush
