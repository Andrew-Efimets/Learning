@extends('layouts.app')
@section('title', 'Вход')

@section('content')
    <form method="POST" action="{{ route('auth') }}" class="form__container">
        @csrf
        <div class="form__wrapper">
            <div class="heading__container">
                <p class="heading">
                    Введите ваши данные
                </p>
            </div>
            <label class="field__heading" for="email">Электронная почта E-mail</label>
            <div class="field__wrapper">
                <input class="field" name="email" type="email" id="email">
            </div>
            <label class="field__heading" for="password">Пароль</label>
            <div class="field__wrapper">
                <input class="field" name="password" type="password" id="password">
            </div>
            <div class="register__wrapper-link">
                <a href="{{ route('register') }}" class="register__link">Регистрация</a>
            </div>
            <div class="button__wrapper">
                <button class="button" type="submit">Войти</button>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </form>
@endsection
