<nav
    class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light bg-info navbar-shadow bg-primary-c">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto">
                    <a class="nav-link nav-menu-main menu-toggle hidden-xs waves-effect waves-dark is-active" href="javascript:void(0)">
                        <i class="ft-menu font-large-1"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand waves-effect waves-dark" href="{{ route('backsite.dashboard.index') }}"
                        style="padding: 0px 0px;">
                        <img src="/frontsite-assets/img/logo-text.png"
                            class="brand-logo img-objectfit" alt="Logo Belum Diunggah" style="height: 70px">
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container waves-effect waves-dark" data-toggle="collapse"
                        data-target="#navbar-mobile">
                        <i class="la la-ellipsis-v"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav left-nav mr-auto float-left">
                    <li class="nav-item">
                        <a class="nav-link nav-link-expand waves-effect waves-dark" href="javascript:void(0)">
                            <i class="ficon ft-maximize"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <h3 class="nav-title" style="margin-top: 18px">
                            <b>
                                Opsi Liburan Indonesia
                            </b>
                        </h3>
                    </li>
                </ul>

                <ul class="nav navbar-nav right-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link waves-effect waves-dark" href="javascript:void(0)"
                            data-toggle="dropdown">
                            <span class="mr-1 user-name text-bold-700 text-truncate" style="margin-top: 7px;">
                                {{ Str::limit(Auth::user()->name, 32) }}
                            </span>
                            <span class="avatar avatar-online">
                                @if (empty(\Auth::user()->foto_profil))
                                    <img src="{{ asset('backsite-assets/images/logo/foto-unvailable.png') }}"
                                        alt="Foto Profil Belum Diunggah">
                                @else
                                    <img src="/storage/{{ \Auth::user()->foto_profil }}"
                                        {{-- onerror="this.src='frontsite-assets/images/common/image-broken.jpg';" --}}
                                        alt="Foto Profil">
                                @endif
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item @yield('activeSubMenuProfil') waves-effect waves-dark"
                                href="{{ route('backsite.profil.user.index') }}">
                                <i class="material-icons">person_outline</i> Edit Profil
                            </a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item waves-effect waves-dark" href="{{ url('/') }}">
                                <i class="material-icons">store_mall_directory</i> Halaman Depan
                            </a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Keluar
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
