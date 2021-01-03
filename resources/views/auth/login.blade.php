@extends('layouts.app')

@section('content')
    <main class="main">
        <section class="sign-block">
            <a class="navbar-brand" href="{{ url('') }}"><img src="{{ url('img/logo.png') }}" alt="Логотип"><span>GRANIT</span></a>
            <div class="form-block">
                <h2 class="form-header">Авторизация</h2>
                <form class="signup-form" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form__col">
                        <input class="form__input" id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" autocomplete="email" required autofocus>
                        <input class="form__input" id="password" type="password" name="password" placeholder="Пароль" autocomplete="current-password" required>
                    </div>
                    <div class="form__col">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Запомнить пароль?</label>
                    </div>
                    <div class="btn-block">
                        <a class="form__link" href="{{ url('/register') }}">Регистрация</a>
                        <input class="form__submit" type="submit" value="Войти">
                    </div>
                </form>
            </div>
            @error('email')
                <p class="msg-error">{{ $message }}</p>
            @enderror
            @error('password')
                <p class="msg-error">{{ $message }}</p>
            @enderror
        </section>
    </main>
@endsection