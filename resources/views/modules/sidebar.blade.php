<aside class="sidebar" id="sidebar">
    <ul class="sidebar-menu">
        <li class="sidebar-item"><a class="sidebar-link" href="{{ url('dashboard') }}"><span class="icon material-icons">border_all</span><span class="text">Панель</span></a></li>
        <li class="sidebar-item">
            <a class="sidebar-link" id="dropdown-toggle" href="{{ url('materials') }}"><span class="icon material-icons">table_chart</span><span class="text">Материалы</span></a>
        </li>
        <li class="sidebar-item"><a class="sidebar-link" href="{{ url('reports') }}"><span class="icon material-icons">assignment</span><span class="text">Отчёты</span></a></li>
        <li class="sidebar-item"><a class="sidebar-link" href="{{ url('users') }}"><span class="icon material-icons">person</span><span class="text">Пользователи</span></a></li>
        <li class="sidebar-item"><a class="sidebar-link" href="{{ url('groups') }}"><span class="icon material-icons">group</span><span class="text">Группы</span></a></li>
        <li class="sidebar-item"><a class="sidebar-link" href="{{ url('settings') }}"><span class="icon material-icons">settings</span><span class="text">Настройки</span></a></li>
        <li class="sidebar-item"><a class="logout-link" href="{{ route('logout') }}"><span class="icon material-icons">exit_to_app</span><span class="text">Выйти</span></a></li>
    </ul>
    <button class="sidebar__toggle-min" id="sidebar__toggle"><span class="icon material-icons">arrow_forward_ios</span></button>
</aside>