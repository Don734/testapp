@extends('layouts.app')

@section('content')
    @include('modules.header')
    <main class="main">
        @include('modules.sidebar')
        <section class="content">
            <div class="container">
                <h2 class="page__title"><span class="icon material-icons">account_circle</span>Управление аккаунтом</h2>
                <div class="wrapper">
                    <div class="avatar-block">
                        <div class="avatar"><img class="avatar__img" src="{{ url('img/favicon.ico') }}" alt="Аватарка"></div>
                        <p class="user-name" id="user-name">{{ $user->fullname }}</p>
                        <p class="user-pos" id="user-pos">{{ $user->group }}</p>
                        <form id="avatar-form" action="{{ route('update') }}">
                            @csrf
                            <label class="input-name" for="myFoto">Выберите фото профиля:</label>
                            <input class="input-file" type="file" name="myFoto" value="Обзор">
                        </form>
                        <p class="date-reg" id="date-reg">Дата регистрации: <span id="date">{{ $user->created_at }}</span></p>
                    </div>
                    <div class="form-block">
                        <div class="form-header">
                            <p class="form-header-text">Настройки аккаунта</p>
                        </div>
                        <form class="user-forms" action="{{ route('update') }}" method="POST">
                            @csrf
                            <h4 class="input-header">Персональная информация:</h4>
                            <div class="col-info">
                                <input class="input-form" type="text" name="username" value="{{ $user->fullname }}" placeholder="Имя Фамилия">
                                <input class="input-form" type="text" name="birthday" value="{{ $user->birthday }}" placeholder="Дата рождения">
                            </div>
                            <h4 class="input-header">Контактная информация:</h4>
                            <div class="col-info">
                                <input class="input-form" type="email" name="email" value="{{ $user->email }}" placeholder="Почта">
                                <input class="input-form" type="text" name="phone" value="{{ $user->phone }}" placeholder="Телефон">
                            </div>
                            <h4 class="input-header">Дополнительная информация:</h4>
                            <div class="col-info">
                                <textarea class="input-form text-form" name="aboutText" placeholder="О себе">{{ $user->about }}</textarea>
                                <input class="input-form" type="text" name="website" value="{{ $user->website }}" placeholder="Сайт">
                            </div>
                            <h4 class="input-header">Дополнительная информация:</h4>
                            <div class="col-info">
                                <input class="input-form" type="password" name="oldPassword" placeholder="Старый пароль">
                                <input class="input-form" type="password" name="newPassword" placeholder="Новый пароль">
                            </div>
                            <input class="form-submit" type="submit" value="Сохранить">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script src="{{ url('js/sidebar.js') }}"></script>
@endpush