<div class="content-wrapper">
    <div class="card mb5">
        <div class="card-body shadow-none">
            <div class="content-header-left col-md-6 col-12 pl-0 pr-0 float-left">
                <h3 style="margin-top: 5px;">
                    <b>@yield('title')</b>
                </h3>
            </div>
            <div class="content-header-right col-md-6 col-12 pl-0 pr-0 float-right">
                <div class="btn-group float-md-right" style="margin-top: 5px;">
                    @yield('buttonRight')
                </div>
            </div>
        </div>
    </div>

    @yield('content-body1')

    @yield('content-body2')
</div>
