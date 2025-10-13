@extends('layouts.auth')
@section('title', 'Recover')
@section('content')
<body class="vertical-layout vertical-menu 1-column bg-full-screen-image blank-page" data-open="click" data-menu="vertical-menu" data-col="1-column">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                                <div class="card-header border-0 pb-0">
                                    <div class="card-title text-center">
                                        <img src="{{ asset('frontsite-assets/images/mrya-logo.png') }}" alt="branding logo">
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>We will send you a link 
                                        to reset password.</span></h6>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal" action="login" novalidate>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="email" class="form-control" id="user-email" placeholder="Your Email Address" required>
                                                <div class="form-control-position">
                                                    <i class="la la-envelope"></i>
                                                </div>
                                            </fieldset>
                                            <button type="submit" class="btn btn-outline-info btn-lg btn-block"><i class="ft-unlock"></i> Recover
                                                Password</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-footer border-0">
                                    <p class="float-sm-left text-center"><a href="{{ route('login') }}" class="card-link"> Login</a></p>
                                    <p class="float-sm-right text-center">New to Modern ? <a href="{{ route('register') }}" class="card-link">Create
                                        Account</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    
@endsection