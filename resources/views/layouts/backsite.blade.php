<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    {{-- Meta --}}
    @include('partials.backsite.meta')

    <title>@yield('title')</title>

    {{-- Style --}}
    @stack('before-style')
    @include('partials.backsite.style')
    @include('partials.backsite.style-custom')
    @stack('after-style')
</head>

<body class="material-vertical-layout vertical-layout vertical-menu 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">
    {{-- Header --}}
    @include('partials.backsite.header')

    {{-- Menu --}}
    @include('partials.backsite.menu')

    {{-- Content --}}
    <div class="app-content content">
        {{-- Content Header --}}
        @include('partials.backsite.content.header')

        <div class="content-overlay"></div>

        {{-- Content Body --}}
        @include('partials.backsite.content.body')
    </div>

    {{-- Footer --}}
    @include('partials.backsite.footer')
</body>

{{-- Script --}}
@stack('before-script')
@include('partials.backsite.script')
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
<script src="/backsite-assets/vendors/js/sweetalert/sweetalert2@9.js"></script>
@include('sweetalert::alert')
@stack('after-script')

</html>
