@admin
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Меню </li>

                <li>
                    <a href="{{route('adminHome')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-home"></i></div>
                        <span>Главная</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('news.index')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-newspaper"></i></div>
                        <span>Новости</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('course.index')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-book"></i></div>
                        <span>Курсы</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('lesson.index')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-video"></i></div>
                        <span>Видеоуроки</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('question.index')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-question-circle"></i></div>
                        <span>Тесты</span>
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
                    <a href="{{route('event.index')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-calendar"></i></div>
                        <span>Мероприятия</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('forum.index')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-comment"></i></div>
                        <span>Форум</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('invite.index')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="far fa-handshake"></i></div>
                        <span>Приглашения</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('all-result')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="far fa-flag"></i></div>
                        <span>Результаты</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('literature-category.index')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-book"></i></div>
                        <span>Категория литературы</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('literature.index')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-book"></i></div>
                        <span>Литература</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('document-category.index')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-book"></i></div>
                        <span>Категория документов</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('document.index')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-book"></i></div>
                        <span>Рабочие документы</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('adminDirectory')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-address-book"></i></div>
                        <span>Справочник</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('email.index')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-address-book"></i></div>
                        <span>Почта</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('search')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-search"></i></div>
                        <span>Поиск</span>
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
                        <span>Приглашения <span class="badge bg-success">{{$invitesCount}}</span> </span>
                    </a>
                </li>
               @notCandidate
                <li>
                    <a href="{{route("my-results")}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-percent"></i></div>
                        <span>Результаты</span>
                    </a>
                </li>
                @endnotCandidate

                @notCandidate
                <li>
                    <a href="{{route('employeeDirectory')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-address-book"></i></div>
                        <span>Справочник</span>
                    </a>
                </li>
                @endnotCandidate
                @notCandidate
                <li>
                    <a href="{{route('employee-news')}}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="fas fa-newspaper"></i></div>
                        <span>Новости</span>
                    </a>
                </li>
                @endnotCandidate

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
