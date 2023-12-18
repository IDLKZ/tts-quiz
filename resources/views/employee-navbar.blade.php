<div class="container">
    <div class="row">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg bg-transparent">
                <a class="navbar-brand d-lg-none d-flex justify-content-center align-items-center mx-2" href="/">
                    <img src="/images/navbar-logo.png">
                </a>
                <button class="navbar-toggler main-color" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="fas fa-bars"></i>
                    </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item d-none d-lg-flex  justify-content-center align-items-center px-3">
                            <a class="{{ request()->is('employee') ? 'employee-nav-link-active ' : 'employee-nav-link' }} nav-link text-uppercase h-4 font-weight-bold" href="{{route("employeeHome")}}"> <img src="/images/navbar-logo.png"> </a>
                        </li>
                        <li class="nav-item d-lg-flex  justify-content-center align-items-center px-3">
                            <a class="{{ request()->is('employee') ? 'employee-nav-link-active ' : 'employee-nav-link' }} nav-link text-uppercase h-4 font-weight-bold" href="{{route("employeeHome")}}">Главная </a>
                        </li>
                        <li class="nav-item d-lg-flex  justify-content-center align-items-center px-3">
                            <a href="{{route('employee-news')}}" class="{{ request()->is('employee/employee-news') ? 'employee-nav-link-active ' : 'employee-nav-link ' }} nav-link text-uppercase h-4 font-weight-bold" >Новости  </a>
                        </li>
                        <li class="nav-item d-lg-flex justify-content-center align-items-center px-3">
                            <a href="{{route("invite")}}" class="{{ request()->is('employee/my-invites') ? 'employee-nav-link-active ' : 'employee-nav-link ' }} nav-link text-uppercase h-4 font-weight-bold" >Тестирование <span class="badge bg-white">{{$invitesCount}}</span> </a>
                        </li>
                        <li class="nav-item d-lg-flex  justify-content-center align-items-center px-3">
                            <a href="{{route("my-results")}}" class="{{ request()->is('employee/my-results') ? 'employee-nav-link-active ' : 'employee-nav-link ' }} nav-link text-uppercase h-4 font-weight-bold" >Результаты </a>
                        </li>
                        <li class="nav-item d-lg-flex  justify-content-center align-items-center px-3">
                            <a href="{{route('employeeDirectory')}}" class="{{ request()->is('employee/directory') || request()->is('get-employees/*') ? 'employee-nav-link-active ' : 'employee-nav-link ' }} nav-link text-uppercase h-4 font-weight-bold" >Справочник </a>
                        </li>
                        <li class="nav-item d-lg-flex  justify-content-center align-items-center px-3">
                            <div class="dropdown">
                                <button class="btn main-bg text-white dropdown-toggle text-uppercase font-weight-bold" type="button" data-toggle="dropdown" aria-expanded="false">
                                    Личный кабинет
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item text-uppercase font-weight-bold {{ request()->is('employee/directory') ? 'employee-nav-link-active ' : 'employee-nav-link ' }}" href="#">Мой профиль</a>
                                    <a class="dropdown-item text-uppercase font-weight-bold employee-nav-link" href="{{route("logout")}}">Выход</a>

                                </div>
                            </div>
                        </li>
                    </ul>

                </div>
            </nav>
        </div>
    </div>
</div>
