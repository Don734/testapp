@extends('layouts.app')

@section('content')
<main class="main">
    <section class="sign-block">
        <a class="navbar-brand" href="{{ url('') }}"><img src="{{ url('img/logo.png') }}" alt="Логотип"><span>GRANIT</span></a>
        <div class="form-block">
            <h2 class="form-header">Регистрация</h2>
            <form class="signup-form" action="" method="POST">
                @csrf
                <input class="form__input" type="email" name="email" placeholder="Email" required>
                <input class="form__input" type="password" name="password" placeholder="Пароль" required>
                <input class="form__input" type="password" name="password_confirmation" placeholder="Повторите пароль" required>
                <div class="btn-block">
                    <a class="form__link" href="{{ url('/login') }}">Вход</a>
                    <input class="form__submit" type="submit" value="Зарегистрироваться">
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
