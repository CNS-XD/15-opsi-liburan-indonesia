@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="app-content content">
    <div class="content-header row"></div>
    <div class="content-overlay"></div>
    <div class="content-wrapper pt-5">
        <div class="content-body mt-5">
            <section class="row navbar-flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 m-0">
                            <div class="card-header border-0">
                                <div class="card-title text-center">
                                    <img src="/frontsite-assets/img/logo-text.png" alt="Logo Opsi Travel" style="height: 60px">
                                </div>
                                <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                    <span>Login</span>
                                </h6>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form-horizontal" method="post" action="{{ route('login.auth') }}" novalidate>
                                    @csrf
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="email" name="email" id="email" class="form-control input-lg @error('email') is-invalid @enderror" placeholder="Enter email" tabindex="1" required data-validation-required-message="Please enter your email." value="{{ old('email') }}" autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="form-control-position">
                                                <i class="la la-user"></i>
                                            </div>
                                            <div class="help-block font-small-3"></div>
                                        </fieldset>
                                        
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="password" name="password" id="password" class="form-control input-lg @error('password') is-invalid @enderror" placeholder="Enter password" tabindex="2" required data-validation-required-message="Please enter valid passwords." autocomplete="current-password">
                                            <i class="la la-eye-slash" id="showPassword" data-show="false" style="cursor: pointer; float:right; margin-right:30px; position: relative; top:-37px; font-size: 25px;"></i>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="form-control-position">
                                                <i class="la la-key"></i>
                                            </div>
                                            <div class="help-block font-small-3"></div>
                                        </fieldset>
                                        <button type="submit" class="btn btn-danger btn-block btn-lg">
                                            <i class="ft-unlock"></i> Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
@endsection

@push('after-script')
<script>
    // Show Password
    $(document).on('click', '#showPassword', function() {
        show = $(this).data('show')
        ret = !show
        if (ret == true) {
            $(this).data('show', true)
            $(this).removeClass('la la-eye-slash')
            $(this).addClass('la la-eye')
            $('#password').attr('type', 'text')
        } else {
            $(this).data('show', false)
            $(this).removeClass('la la-eye')
            $(this).addClass('la la-eye-slash')
            $('#password').attr('type', 'password')
        }
    });
</script>
@endpush
