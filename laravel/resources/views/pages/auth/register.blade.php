@extends('layouts.app')
@section('title', 'Подача объявления')

@section('content')
    <form method="POST" action="{{ route('create_user') }}" class="form_wrapper">
        @csrf
        <div class="login_wrapper">
            <label class="login" for="name">Имя</label>
            <div class="login_input_wrapper">
                <input class="login_input" name="name" type="text" id="name">
            </div>
            <label class="login" for="email">Электронная почта E-mail</label>
            <div class="login_input_wrapper">
                <input class="login_input" name="email" type="email" id="email">
            </div>
            <label class="login" for="password">Пароль</label>
            <div class="login_input_wrapper">
                <input class="login_input" name="password" type="password" id="password">
            </div>
            <div class="button_wrapper_create">
                <button class="action_button" type="submit">Зарегистрироваться</button>
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
