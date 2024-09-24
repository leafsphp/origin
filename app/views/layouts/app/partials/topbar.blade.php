<header id="topnav">
    <!-- Topbar Start -->
    <div class="navbar-custom">
        <div class="container-fluid">
            <ul class="list-unstyled topnav-menu float-right mb-0">

                <li class="dropdown notification-list">
                    <a class="navbar-toggle nav-link">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                </li>

                <li class="dropdown notification-list">
                    <a href="javascript:void(0)" class="nav-link dropdown-toggle nav-user mr-0"
                        data-toggle="dropdown"  role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ urlPath($loggedUser['avatar']) }}" alt="user-image" class="rounded-circle">
                        <span class="pro-user-name d-none d-xl-inline-block ml-2">
                            {{ explode(' ', $loggedUser['fullname'])[0] }}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                        <a href="{{ route('app.profile') }}" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-outline"></i>
                            <span>Profile</span>
                        </a>

                        <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                            <i class="mdi mdi-logout-variant"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </li>

                <li class="dropdown notification-list">
                    <a href="javascript:void(0);" class="nav-link right-bar-toggle">
                        <i class="mdi mdi-settings-outline noti-icon"></i>
                    </a>
                </li>

            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="{{ route('app.home') }}" class="logo text-center">
                    <span class="logo-lg">
                        <img src="/assets/images/logo-dark.png" alt="" height="26">
                    </span>
                    <span class="logo-sm">
                        <img src="/assets/images/logo-sm.png" alt="" height="22">
                    </span>
                </a>
            </div>

            <div id="navigation">
            
                <ul class="navigation-menu">

                    <li class="has-submenu">
                        <a href="{{ route('app.home') }}">
                            <i class="ti-home"></i>Dashboard
                        </a>
                    </li>

                </ul>

                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</header>