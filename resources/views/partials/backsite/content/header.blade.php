<div class="content-header row">
    <div class="content-header-light col-12">
        <div class="row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12 pl-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0)" class="color-primary">@yield('breadcrumb1')</a>
                            </li>
                            <li class="breadcrumb-item active">@yield('breadcrumb2')</li>
                            {{-- @if (countUriSegment() > 3)
                                <li class="breadcrumb-item active">@yield('breadcrumb3')</li>
                            @endif --}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
