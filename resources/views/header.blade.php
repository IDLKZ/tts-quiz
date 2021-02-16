@admin
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="/admin" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="/images/logo-dark.png" alt="logo" width="100" height="75">
                                </span>
                    <span class="logo-lg">
                                    <img src="/images/logo-dark.png" alt="logo" width="100" height="75">
                                </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect d-block d-sm-none" id="vertical-menu-btn">
                <i class="mdi mdi-backburger"></i>
            </button>

            <!-- App Search-->
{{--            <form class="app-search d-none d-lg-block">--}}
{{--                <div class="position-relative">--}}
{{--                    <input type="text" class="form-control" placeholder="Search...">--}}
{{--                    <span class="mdi mdi-magnify"></span>--}}
{{--                </div>--}}
{{--            </form>--}}
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{Auth::user()->img}}" alt="Header Avatar">
                    <span class="d-none d-sm-inline-block ml-1">{{Auth::user()->name}}</span>
                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a class="dropdown-item" href="{{route('adminSettings')}}"><i class="mdi mdi-account-settings font-size-16 align-middle mr-1"></i> Настройки</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('logout')}}"><i class="mdi mdi-logout font-size-16 align-middle mr-1"></i> Выход</a>
                </div>
            </div>

        </div>
    </div>

</header>
@endadmin

@employee
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="/employee" class="logo logo-dark">
                                 <span class="logo-sm">
                                    <img src="/images/logo-dark.png" alt="logo" width="100" height="75">
                                </span>
                    <span class="logo-lg">
                                    <img src="/images/logo-dark.png" alt="logo" width="100" height="75">
                                </span>
                </a>

            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect d-block d-sm-none" id="vertical-menu-btn">
                <i class="mdi mdi-backburger"></i>
            </button>

        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{Auth::user()->img}}" alt="Header Avatar">
                    <span class="d-none d-sm-inline-block ml-1">{{Auth::user()->name}}</span>
                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a class="dropdown-item" href="{{route('employeeHome')}}"><i class="mdi mdi-face-profile font-size-16 align-middle mr-1"></i> Профиль</a>
                    <a class="dropdown-item" href="{{route('employeeSettings')}}"><i class="mdi mdi-account-settings font-size-16 align-middle mr-1"></i> Настройки</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('logout')}}"><i class="mdi mdi-logout font-size-16 align-middle mr-1"></i> Выход</a>
                </div>
            </div>

        </div>
    </div>

</header>
@endemployee
