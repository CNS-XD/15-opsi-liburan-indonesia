<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    @include('partials.backsite.meta')

    <title>@yield('title')</title>

    @stack('before-style')
    @include('partials.backsite.style')
    @stack('after-style')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu material-vertical-layout material-layout 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('partials.backsite.header')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @include('partials.backsite.menu')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-header row"></div>
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('partials.backsite.footer')

    @stack('before-script')
    @include('partials.backsite.script')
    @stack('after-script')

</body>
<!-- END: Body-->

</html>