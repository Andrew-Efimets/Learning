@extends('layouts.app')
@section('title', 'Вход')

@section('content')
    <form method="POST" action="{{ route('auth') }}" class="form__container">
        @csrf
        <div class="form__wrapper">
            <label class="field__heading" for="email">Электронная почта E-mail</label>
            <div class="field__wrapper">
                <input class="field @error('email') field__error @enderror"
                       name="email" type="email" id="email" value="{{ old('email') }}">
            </div>
            @error('email')
            <span class="field__error-message">{{ $message }}</span>
            @enderror
            <label class="field__heading" for="password">Пароль</label>
            <div class="field__wrapper">
                <input class="field @error('password') field__error @enderror"
                       name="password" type="password" id="password">
            </div>
            @error('password')
            <span class="field__error-message">{{ $message }}</span>
            @enderror
            <label class="check-photo__wrapper">
                <input class="checkbox" type="checkbox" name="remember">
                Запомнить меня
            </label>
            <div class="register__wrapper-link">
                <a href="{{ route('register') }}" class="register__link">Регистрация</a>
                <a href="{{ route('password.request') }}" class="register__link">Забыли пароль?</a>
            </div>
            <div class="button__wrapper">
                <button class="button" type="submit">Войти</button>
            </div>
        </div>
    </form>
@endsection
