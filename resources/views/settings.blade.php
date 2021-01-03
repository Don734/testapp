@extends('layouts.app')

@section('content')
    @include('modules.header')
    <main class="main">
        @include('modules.sidebar')
        <section class="content">
            <div class="container">
                <h2 class="page__title"><span class="icon material-icons">settings</span>Настройки</h2>
                <div class="link-row">
                    <a class="settings__link active" href="#profile">Профиль</a>
                    <a class="settings__link" href="#security">Безопасность</a>
                </div>
                <div class="settings-row">
                    <div class="col active" id="profile">
                        <h3 class="settings-title">Изображение пользователя</h3>
                        <p class="settings-context">Изменить картинку учетной записи</p>
                        <div class="settings-col other-style">
                            <div class="profile-image-setting">
                                <img class="profile-image" src="{{ url('img/user-img.svg') }}" alt="Картинка пользователя">
                            </div>
                            <div class="profile-image-content">
                                <div class="profile-image-btn">
                                    <label for="userimage">Выбрать файл</label>
                                    <input id="userimage" name="userimage" type="file">
                                </div>
                                <p class="settings-context">Поддерживаемые форматы: JPEG, PNG или GIF. Макс. размер: 10 МБ.</p>
                            </div>
                        </div>
                        <h3 class="settings-title">Настройки пользователя</h3>
                        <p class="settings-context">Изменить персональные данные учетной записи</p>
                        <div class="settings-col">
                            <form class="profile-form" action="{{ route('updatePublic') }}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="form-col other-style">
                                    <div class="form-col-title"> 
                                        <label class="form-title" for="username">Имя пользователя</label>
                                    </div>
                                    <div class="form-col-input">
                                        <input class="form-input" id="username" name="username" type="text" value="{{ $user->fullname }}">
                                        <p class="settings-context">Введите имя и фамилию.</p>
                                    </div>
                                </div>
                                <div class="form-col other-style">
                                    <div class="form-col-title"> 
                                        <label class="form-title" for="aboutText">О себе</label>
                                    </div>
                                    <div class="form-col-input">
                                        <textarea class="form-input" id="aboutText" name="aboutText">{{ $user->about }}</textarea>
                                        <p class="settings-context">Напишите, что-нибудь о себе. (Необязательно)</p>
                                    </div>
                                </div>
                                <div class="form-col other-style">
                                    <div class="form-col-title"> 
                                        <p class="form-title">Уведомление</p>
                                    </div>
                                    <div class="form-col-input">
                                        <label><input class="chkbox" type="checkbox" name="notify" {{($user->notifiable == 1) ? "checked" : "" }}>вкл. / выкл. уведомления</label><br>
                                        <p class="settings-context">Здесь можно включить или отключить уведомления.</p>
                                    </div>
                                </div>
                                <div class="form-col other-style">
                                    <button class="form-send" type="submit">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col" id="security">
                        <h3 class="settings-title">Связь и безопасность</h3>
                        <p class="settings-context">Защитите свою учетную запись</p>
                        <div class="settings-col">
                            <form class="profile-form" action="{{ route('updatePersonal') }}" method="post">
                                @csrf
                                <div class="form-col other-style">
                                    <div class="form-col-title"> 
                                        <label class="form-title" for="email">Адрес электронной почты</label>
                                    </div>
                                    <div class="form-col-input">
                                        <input class="form-input" id="email" name="email" type="email" value="{{ $user->email }}">
                                        <p class="settings-context">Этот адрес электронной почты привязан к вашей учетной записи.</p>
                                    </div>
                                </div>
                                <div class="form-col other-style">
                                    <div class="form-col-title"> 
                                        <label class="form-title" for="phone">Номер телефона</label>
                                    </div>
                                    <div class="form-col-input">
                                        <input class="form-input" id="phone" name="phone" type="phone" value="{{ $user->phone }}">
                                        <p class="settings-context">Этот номер телефона привязан к вашей учетной записи.</p>
                                    </div>
                                </div>
                                <div class="form-col other-style">
                                    <div class="form-col-title"> 
                                        <label class="form-title" for="password">Пароль</label>
                                    </div>
                                    <div class="form-col-input">
                                        <input class="form-input" id="password" name="password" type="password">
                                        <p class="settings-context">Повысьте безопасность, выбрав более надежный пароль.</p>
                                    </div>
                                    @error('password')
                                        <p class="msg-error">{{ $msg }}</p>
                                    @enderror
                                </div>
                                <div class="form-col other-style">
                                    <div class="form-col-title"> 
                                        <label class="form-title" for="confirmpass">Подтвердите пароль</label>
                                    </div>
                                    <div class="form-col-input">
                                        <input class="form-input" id="confirmpass" name="confirmpass" type="password">
                                        <p class="settings-context">Подтвердите пароль.</p>
                                    </div>
                                </div>
                                <div class="form-col other-style">
                                    <button class="form-send" type="submit">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection