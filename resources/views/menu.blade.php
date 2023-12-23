@admin
<nav id="sidebar">
    <div class="p-4 pt-5">
        <a  href="{{route('adminSettings')}}" class="img logo rounded-circle mb-5" style="background-image: url({{auth()->user()->img}});"></a>
        <div class="menu-title text-center">{{auth()->user()->name}} </div>
        <div class="menu-title text-center mb-3">{{auth()->user()->email}} </div>
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title">Меню </li>

            <li>
                <a href="{{route('adminHome')}}"  class="{{request()->routeIs('adminHome') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="fas fa-home"></i></div>
                    <span>Главная</span>
                </a>
            </li>
            <li>
                <a href="{{route('news.index')}}" class="{{request()->routeIs('news.index') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="fas fa-newspaper"></i></div>
                    <span>Новости</span>
                </a>
            </li>
            <li>
                <a href="{{route('course.index')}}" class="{{request()->routeIs('course.index') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="fas fa-book"></i></div>
                    <span>Курсы</span>
                </a>
            </li>
            <li>
                <a href="{{route('lesson.index')}}" class="{{request()->routeIs('lesson.index') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="fas fa-video"></i></div>
                    <span>Видеоуроки</span>
                </a>
            </li>
            <li>
                <a href="{{route('question.index')}}" class="{{request()->routeIs('question.index') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="fas fa-question-circle"></i></div>
                    <span>Тесты</span>
                </a>
            </li>
            <li>
                <a href="{{route('user.index')}}" class="{{request()->routeIs('user.index') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="fas fa-address-card"></i></div>
                    <span>Сотрудники</span>
                </a>
            </li>
            <li>
                <a href="{{route('company.index')}}" class="{{request()->routeIs('company.index') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="fab fa-firefox"></i></div>
                    <span>Компании</span>
                </a>
            </li>
            <li>
                <a href="{{route('department.index')}}" class="{{request()->routeIs('department.index') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="fas fa-hockey-puck"></i></div>
                    <span>Департамент</span>
                </a>
            </li>
            <li>
                <a href="{{route('event.index')}}" class="{{request()->routeIs('event.index') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="fas fa-calendar"></i></div>
                    <span>Мероприятия</span>
                </a>
            </li>
            <li>
                <a href="{{route('forum.index')}}" class="{{request()->routeIs('forum.index') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="fas fa-comment"></i></div>
                    <span>Форум</span>
                </a>
            </li>
            <li>
                <a href="{{route('invite.index')}}" class="{{request()->routeIs('invite.index') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="far fa-handshake"></i></div>
                    <span>Приглашения</span>
                </a>
            </li>
            <li>
                <a href="{{route('all-result')}}" class="{{request()->routeIs('all-result') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="far fa-flag"></i></div>
                    <span>Результаты</span>
                </a>
            </li>
            <li>
                <a href="{{route('task.index')}}" class="{{request()->routeIs('task.index') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="far fa-list-ol"></i></div>
                    <span>Задачи</span>
                </a>
            </li>
            <li>
                <a href="{{route('literature-category.index')}}" class="{{request()->routeIs('literature-category.index') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="fas fa-book"></i></div>
                    <span>Категория литературы</span>
                </a>
            </li>
            <li>
                <a href="{{route('literature.index')}}" class="{{request()->routeIs('literature.index') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="fas fa-book"></i></div>
                    <span>Литература</span>
                </a>
            </li>
            <li>
                <a href="{{route('document-category.index')}}" class="{{request()->routeIs('document-category.index') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="fas fa-book"></i></div>
                    <span>Категория документов</span>
                </a>
            </li>
            <li>
                <a href="{{route('document.index')}}"  class="{{request()->routeIs('document.index') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="fas fa-book"></i></div>
                    <span>Рабочие документы</span>
                </a>
            </li>
            <li>
                <a href="{{route('adminDirectory')}}" class="{{request()->routeIs('adminDirectory') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="fas fa-address-book"></i></div>
                    <span>Справочник</span>
                </a>
            </li>
            <li>
                <a href="{{route('email.index')}}" class="{{request()->routeIs('email.index') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="fas fa-address-book"></i></div>
                    <span>Почта</span>
                </a>
            </li>
            <li>
                <a href="{{route('search')}}" class="{{request()->routeIs('search') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="fas fa-search"></i></div>
                    <span>Поиск</span>
                </a>
            </li>

            <hr>

            <li>
                <a href="{{route('logout')}}" class="{{request()->routeIs('logout') ? 'waves-effect-active' : 'waves-effect'}}">
                    <div class="d-inline-block icons-sm mr-1"><i class="fas fa-sign-out-alt"></i></div>
                    <span>Выход</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
@endadmin

