<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    @include('partials.auth.meta')

    <title>@yield('title')</title>

    @stack('before-style')
    @include('partials.auth.style')
    @stack('after-style')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu 1-column bg-full-screen-image blank-page" data-open="click" data-menu="vertical-menu" data-col="1-column">
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

    @stack('before-script')
    @include('partials.auth.script')
    @stack('after-script')

</body>
<!-- END: Body-->

</html>