<header class="header">
    <div class="container">
        <nav class="top-bar">
            <a class="navbar-brand" href="#"><img src="{{ url('img/logo.png') }}" alt="Логотип"><span>Склад</span></a>
            <a class="mobile-options" href="#"><span class="material-icons">more_horiz</span></a>
            <div class="right-block">
                <div class="notification-col">
                    <button class="notifi-btn"><span class="material-icons">notifications</span>
                        @if (!$unreadNotifications->isEmpty())
                            <span class="notifi-count">{{$unreadNotifications->count()}}</span>
                        @endif
                    </button>
                    <div class="notifications">
                        <div class="notification-header">
                            <h6 class="notification-title">Уведомление</h6>
                            @if (!$notifications->isEmpty())
                                <a class="notifications-delete" href="#">Удалить всё</a>
                            @endif
                        </div>
                        <ul class="notification-menu">
                            @foreach ($notifications as $notification)
                                <li class="notification-item">
                                    <h5 class="notification-user">{{ $notification->data['name'] }}</h5>
                                    <p class="notification-msg">{{ $notification->data['message'] }}</p>
                                    <h5 class="notification-time">{{ $notification->created_at }}</h5>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="user__settings">
                    <a class="user__dropdown-toggle" id="user__menu-btn" href="#"><img class="user__avatar" src="{{ url('img/favicon.ico') }}"><span class="icon material-icons">expand_more</span></a>
                    <ul class="user__setting-menu" id="user__menu">
                        <div class="user__info-block">
                            <div class="user__img-block"><img class="user__avatar" src="{{ url('img/favicon.ico') }}"></div>
                            <p class="user__info-name">{{ $current_user->fullname }}</p>
                            <p class="user__info-pos">{{ $current_user->group }}</p>
                            <p class="user__info-status">В сети</p>
                        </div>
                        <li class="user__item"><a class="logout-link user__link" href="{{ route('logout') }}">Выход</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>