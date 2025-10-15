<!-- BEGIN: Main Menu -->
<div class="main-menu material-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class=" main-menu-content menu-accordion">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" style="padding-bottom: 50px">
            <div class="user-profile"
                style="background: url('{{ asset('backsite-assets/images/gallery/dark-menu.jpg') }}') center center no-repeat;">
                <div class="user-info text-center pt-1 pb-1 px-2">
                    <div class="name-wrapper d-block dropdown">
                        <h5 class="text-white">
                            <b>
                                Superadmin
                            </b>
                        </h5>
                    </div>
                </div>
            </div>
            <li class="nav-item @yield('activeMenuDashboard')">
                <a href="{{ route('backsite.dashboard.index') }}">
                    <i class="la la-home"></i>
                    <span class="menu-title" data-i18n="eCommerce">Dashboard</span>
                </a>
            </li>

            @can('access-superadmin')
                {{-- MASTER --}}
                <li class="navigation-header open">
                    <span data-i18n="Master">Master</span>
                    <i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right"
                        data-original-title="Master">more_horiz</i>
                </li>
                <li class="nav-item @yield('activeMenuDeparture')">
                    <a href="{{ route('backsite.departure.index') }}" class="@yield('activeSubMenuDeparture')">
                        <i class="la la-plane"></i>
                        <span class="menu-title" data-i18n="eCommerce">Departure</span>
                    </a>
                </li>
                <li class="nav-item @yield('activeMenuDestination')">
                    <a href="{{ route('backsite.destination.index') }}" class="@yield('activeSubMenuDestination')">
                        <i class="la la-map-marker"></i>
                        <span class="menu-title" data-i18n="eCommerce">Destination</span>
                    </a>
                </li>

                {{-- INFORMATION --}}
                <li class="navigation-header open">
                    <span data-i18n="Information">Information</span>
                    <i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right"
                        data-original-title="Information">more_horiz</i>
                </li>
                <li class="nav-item @yield('activeMenuGeneral')">
                    <a href="{{ route('backsite.general.index') }}" class="@yield('activeSubMenuGeneral')">
                        <i class="la la-desktop"></i>
                        <span class="menu-title" data-i18n="eCommerce">General</span>
                    </a>
                </li>
                <li class="nav-item @yield('activeMenuSlider')">
                    <a href="{{ route('backsite.slider.index') }}" class="@yield('activeSubMenuSlider')">
                        <i class="la la-picture-o"></i>
                        <span class="menu-title" data-i18n="eCommerce">Slider</span>
                    </a>
                </li>
                <li class="nav-item @yield('activeMenuAbout')">
                    <a href="{{ route('backsite.about.index') }}" class="@yield('activeSubMenuAbout')">
                        <i class="la la-book"></i>
                        <span class="menu-title" data-i18n="eCommerce">About</span>
                    </a>
                </li>
                <li class="nav-item @yield('activeMenuAdvantage')">
                    <a href="{{ route('backsite.advantage.index') }}" class="@yield('activeSubMenuAdvantage')">
                        <i class="la la-list"></i>
                        <span class="menu-title" data-i18n="eCommerce">Advantage</span>
                    </a>
                </li>
                <li class="nav-item @yield('activeMenuTestimony')">
                    <a href="{{ route('backsite.testimony.index') }}" class="@yield('activeSubMenuTestimony')">
                        <i class="la la-comments-o"></i>
                        <span class="menu-title" data-i18n="eCommerce">Testimony</span>
                    </a>
                </li>
                <li class="nav-item @yield('activeMenuBlog')">
                    <a href="" class="@yield('activeSubMenuBlog')">
                        <i class="la la-newspaper-o"></i>
                        <span class="menu-title" data-i18n="eCommerce">Blog</span>
                    </a>
                </li>
                <li class="nav-item @yield('activeMenuFaq')">
                    <a href="{{ route('backsite.faq.index') }}" class="@yield('activeSubMenuFaq')">
                        <i class="la la-question-circle"></i>
                        <span class="menu-title" data-i18n="eCommerce">Faq</span>
                    </a>
                </li>

                {{-- DATA --}}
                <li class="navigation-header open">
                    <span data-i18n="Data">Data</span>
                    <i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right"
                        data-original-title="Data">more_horiz</i>
                </li>
                <li class="nav-item @yield('activeMenuTour')">
                    <a href="" class="@yield('activeSubMenuTour')">
                        <i class="la la-globe"></i>
                        <span class="menu-title" data-i18n="eCommerce">Tour</span>
                    </a>
                </li>

                {{-- TRANSACTION --}}
                <li class="navigation-header open">
                    <span data-i18n="Transaction">Transaction</span>
                    <i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right"
                        data-original-title="Transaction">more_horiz</i>
                </li>
                <li class="nav-item @yield('activeMenuTour')">
                    <a href="" class="@yield('activeSubMenuTour')">
                        <i class="la la-money"></i>
                        <span class="menu-title" data-i18n="eCommerce">Booking</span>
                    </a>
                </li>

                {{-- SETTING --}}
                <li class="navigation-header open">
                    <span data-i18n="Setting">Setting</span>
                    <i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right"
                        data-original-title="Setting">more_horiz</i>
                </li>
                <li class="nav-item @yield('activeMenuUser')">
                    <a href="" class="@yield('activeSubMenuUser')">
                        <i class="la la-users"></i>
                        <span class="menu-title" data-i18n="eCommerce">User</span>
                    </a>
                </li>
                <li class="nav-item @yield('activeMenuTheme')">
                    <a href="" class="@yield('activeSubMenuTheme')">
                        <i class="la la-paint-brush"></i>
                        <span class="menu-title" data-i18n="eCommerce">Theme</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</div>
<!-- END: Main Menu -->