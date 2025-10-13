<div class="main-menu material-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="user-profile">
        <div class="user-info text-center pb-2">
            <img class="user-img img-fluid rounded-circle w-25 mt-2" src="{{ asset('backsite-assets/app-assets/images/portrait/small/avatar-s-1.png') }}" alt=""/>
            <div class="name-wrapper d-block dropdown mt-1">
                <a class="white dropdown-toggle ml-2" id="user-account" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="user-name">Rafi Yahya</span>
                </a>
                <div class="text-light">UX Designer</div>
                <div class="dropdown-menu arrow">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="material-icons align-middle mr-1">power_settings_new</i>
                        <span class="align-middle">Log Out</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item @yield('activeProfil')">
                <a href="{{ route('backsite.dashboard') }}">
                    <i class="la la-user t3"></i>
                    <span class="menu-title" data-i18n="Profil">Profil</span>
                </a>
            </li>
            <li class=" nav-item @yield('activeCV')">
                <a href="{{ asset('frontsite-assets/pdf/CV Muhammad Rafi Yahya Ardiansyah.pdf') }}">
                    <i class="la la-cloud-upload t3"></i>
                    <span class="menu-title" data-i18n="File Uploader">CV</span>
                </a>
            </li>
            <li class=" nav-item @yield('activePengalaman')">
                <a href="{{ route('backsite.experience') }}">
                    <i class="la la-paste t3"></i>
                    <span class="menu-title" data-i18n="Pengalaman">Pengalaman</span>
                </a>
            </li>
            <li class=" nav-item @yield('activePortofolio')">
                <a href="{{ route('backsite.porto')}}">
                    <i class="la la-file-code-o"></i>
                    <span class="menu-title" data-i18n="Portofolio">Portofolio</span>
                </a>
            </li>
            <li class=" nav-item @yield('activePendidikan')">
                <a href="{{ route('backsite.education') }}">
                    <i class="la la-graduation-cap t3"></i>
                    <span class="menu-title" data-i18n="Pendidikan">Pendidikan</span>
                </a>
            </li>
            <li class=" nav-item @yield('activeNarasumber')">
                <a href="form-repeater.html">
                    <i class="la la-volume-up"></i>
                    <span class="menu-title" data-i18n="Narasumber">Narasumber</span>
                </a>
            </li>
            <li class=" nav-item @yield('activeGallary')">
                <a href="{{ route('backsite.gallary') }}">
                    <i class="la la-image t3"></i>
                    <span class="menu-title" data-i18n="Gallery">Gallery</span>
                </a>
            </li>
            <li class=" nav-item @yield('activeBlog')">
                <a href="{{ route('backsite.blog') }}">
                    <i class="la la-file-text t3"></i>
                    <span class="menu-title" data-i18n="Blog">Blog</span>
                </a>
            </li>
            <li class=" nav-item @yield('activeKontak')">
                <a href="{{ route('backsite.contact') }}">
                    <i class="la la-users t3"></i>
                    <span class="menu-title" data-i18n="Contacts">Contacts</span>
                </a>
            </li>
        </ul>
    </div>
</div>