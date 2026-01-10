<!doctype html>
<html lang="en">
<head>
    {{-- Meta --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/frontsite-assets/img/logo.png" type="image/x-icon">
		
    {{-- Title --}}
    <title>Login - @yield('title')</title>

    {{-- Style --}}
    @stack('before-style')
    @include('partials.backsite.style')
    @stack('after-style')
    <style>
        html body.bg-full-screen-image {
        background : url(../../backsite-assets/images/backgrounds/bg-15.jpg) no-repeat center center fixed;
        background-size : cover;
        }
    </style>
</head>

<body class="vertical-layout vertical-menu material-vertical-layout material-layout 1-column bg-full-screen-image fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="1-column">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img class="brand-logo" alt="modern admin logo" src="/frontsite-assets/img/logo.png" style="height: 36px">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Content-->
    @yield('content')
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer fixed-bottom footer-light navbar-border navbar-shadow">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
            <span class="float-md-left d-block d-md-inline-block">Copyright &copy; {{ date('Y') }}
                <a class="text-bold-800 grey darken-2" href="https://opsitravel.id" target="_blank">Opsi Liburan Indonesia</a>
            </span>
            <span class="float-md-right d-none d-lg-block">
                Opsi Liburan Indonesia
                <i class="ft-heart pink"></i>
                <span id="scroll-top"></span>
            </span>
        </p>
    </footer>
    <!-- END: Footer-->

</body>

{{-- Script --}}
@stack('before-script')
@include('partials.backsite.script')
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
<script src="/backsite-assets/vendors/js/sweetalert/sweetalert2@9.js"></script>
@include('sweetalert::alert')
@stack('after-script')

</html>