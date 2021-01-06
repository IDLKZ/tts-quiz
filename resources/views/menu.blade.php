@admin
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Admin Menu</li>

                <li>
                    <a href="{{route('adminHome')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-home"></i></div>
                        <span>Главная</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('user.index')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-address-card"></i></div>
                        <span>Сотрудники</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('company.index')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fab fa-firefox"></i></div>
                        <span>Компании</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('department.index')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-hockey-puck"></i></div>
                        <span>Департамент</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('invite.index')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="far fa-handshake"></i></div>
                        <span>Приглашения</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('adminDirectory')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-address-book"></i></div>
                        <span>Справочник</span>
                    </a>
                </li>

                <hr>

                <li>
                    <a href="{{route('logout')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-sign-out-alt"></i></div>
                        <span>Выход</span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
@endadmin

@employee
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Меню</li>

                <li>
                    <a href="{{route('employeeHome')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-home"></i></div>
                        <span>Мой профиль</span>
                    </a>
                </li>
                <li>
                    <a href="{{route("invite")}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="far fa-handshake"></i></div>
                        <span>Приглашения</span>
                    </a>
                </li>
                <li>
                    <a href="{{route("my-results")}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-percent"></i></div>
                        <span>Результаты</span>
                    </a>
                </li>

                <hr>

                <li>
                    <a href="{{route('logout')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-sign-out-alt"></i></div>
                        <span>Выход</span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
@endemployee
