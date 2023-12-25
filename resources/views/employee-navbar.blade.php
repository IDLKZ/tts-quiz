<div class="container-fluid xl:container mx-auto xl:bg-transparent p-0">
    <nav>
        <div class="w-full flex flex-wrap items-center justify-between mx-auto p-3">
            <a class="navbar-brand d-flex d-xl-none  justify-content-center align-items-center" href="/">
                <img src="/images/navbar-logo.png">
            </a>
            <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg xl:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-dropdown" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
            <div class="hidden w-full xl:block xl:w-auto" id="navbar-dropdown" style="width: 100%">
                <ul class="xl:flex justify-content-center align-items-center flex-col font-medium p-4 xl:space-x-8 rtl:space-x-reverse xl:flex-row xl:mt-0">
                    <li class="  d-lg-flex justify-content-center align-items-center">
                        <a class="{{ request()->is('employeeMainPage') ? 'employee-nav-link-active ' : 'employee-nav-link' }} nav-link text-uppercase text-md font-weight-bold h-full xl:flex align-items-center justify-content-center " href="{{route("employeeMainPage")}}"> <img class="min-w-[40px]" src="/images/navbar-logo.png"> </a>
                    </li>
                    <li class=" d-lg-flex  justify-content-center align-items-center text-center">
                        <a class="{{ request()->is('employeeMainPage') ? 'employee-nav-link-active ' : 'employee-nav-link' }} nav-link text-uppercase text-md font-weight-bold h-full xl:flex align-items-center justify-content-center " href="{{route("employeeMainPage")}}">Главная</a>
                    </li>
                    <li class=" d-lg-flex  justify-content-center align-items-center text-center">
                        <a class="{{ request()->is('employee') ? 'employee-nav-link-active ' : 'employee-nav-link' }} nav-link text-uppercase text-md font-weight-bold h-full xl:flex align-items-center justify-content-center " href="{{route("employeeHome")}}">Тестирование</a>
                    </li>
                    <li class=" d-lg-flex  justify-content-center align-items-center text-center">
                        <a href="{{route('employee-news')}}" class="{{ request()->is('employee/employee-news') ? 'employee-nav-link-active ' : 'employee-nav-link ' }} nav-link text-uppercase text-md font-weight-bold h-full xl:flex align-items-center justify-content-center" >Новости  </a>
                    </li>
                    <li class=" d-lg-flex  justify-content-center align-items-center text-center">
                        <a href="{{route('courseListEmployee')}}" class="{{ request()->routeIs('courseListEmployee') ? 'employee-nav-link-active ' : 'employee-nav-link ' }} nav-link text-uppercase text-md font-weight-bold h-full xl:flex align-items-center justify-content-center">Курсы  </a>
                    </li>
                    <li class=" d-lg-flex justify-content-center align-items-center">
                        <a href="{{route("invite")}}" class="{{ request()->is('employee/my-invites') ? 'employee-nav-link-active ' : 'employee-nav-link ' }} nav-link text-uppercase text-md font-weight-bold h-full xl:flex align-items-center justify-content-center text-center">Предстоящие тесты <span class="badge ">{{$invitesCount}}</span> </a>
                    </li>
                    <li class=" d-lg-flex  justify-content-center align-items-center text-center">
                        <a href="{{route("my-results")}}" class="{{ request()->is('employee/my-results') ? 'employee-nav-link-active ' : 'employee-nav-link ' }} nav-link text-uppercase text-md font-weight-bold h-full xl:flex align-items-center justify-content-center">Результаты </a>
                    </li>
                    <li class=" d-lg-flex  justify-content-center align-items-center text-center">
                        <a href="{{route('employeeDirectory')}}" class="{{ request()->is('employee/directory') || request()->is('get-employees/*') ? 'employee-nav-link-active ' : 'employee-nav-link ' }} nav-link text-uppercase text-md font-weight-bold h-full xl:flex align-items-center justify-content-center">Справочник </a>
                    </li>
                    <li class=" d-lg-flex  justify-content-center align-items-center text-center">
                        <div class="dropdown">
                            <button class="btn main-bg text-white dropdown-toggle text-uppercase font-weight-bold bg-warning text-white" type="button" data-toggle="dropdown" aria-expanded="false">
                                Личный кабинет
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item text-uppercase font-weight-bold {{ request()->is('employee/directory') ? 'employee-nav-link-active ' : 'employee-nav-link ' }}" href="#">Мой профиль</a>
                                <a class="dropdown-item text-uppercase font-weight-bold {{ request()->is('forum-list') ? 'employee-nav-link-active ' : 'employee-nav-link ' }}" href="{{route("forum-list")}}">Форум</a>
                                <a class="dropdown-item text-uppercase font-weight-bold {{ request()->routeIs('employee-tasks') ? 'employee-nav-link-active ' : 'employee-nav-link ' }}" href="{{route("employee-tasks")}}">Задачи</a>
                                <a class="dropdown-item text-uppercase font-weight-bold employee-nav-link" href="{{route("logout")}}">Выход</a>

                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

