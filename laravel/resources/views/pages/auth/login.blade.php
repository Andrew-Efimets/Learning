@extends('layouts.app')
@section('title', 'Вход')

@section('content')
    <form method="POST" action="{{ route('auth') }}" class="form_wrapper">
        @csrf
        <div class="login_wrapper">
            <div class="category_title">
                <p class="category_title_item">
                    Введите ваши данные
                </p>
            </div>
            <label class="login" for="email">Электронная почта E-mail</label>
            <div class="login_input_wrapper">
                <input class="login_input" name="email" type="email" id="email">
            </div>
            <label class="login" for="password">Пароль</label>
            <div class="login_input_wrapper">
                <input class="login_input" name="password" type="password" id="password">
            </div>
            <div class="redirect_register_wrapper">
                <a href="{{ route('register') }}" class="redirect_register">Регистрация</a>
            </div>
            <div class="button_wrapper_create">
                <button class="action_button" type="submit">Войти</button>
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
