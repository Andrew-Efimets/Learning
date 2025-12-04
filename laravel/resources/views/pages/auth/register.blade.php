@extends('layouts.app')
@section('title', 'Регистрация')

@section('content')
    <form method="POST" action="{{ route('create_user') }}" class="form__container">
        @csrf
        <div class="form__wrapper">
            <label class="field__heading" for="name">Имя</label>
            <div class="field__wrapper">
                <input class="field" name="name" type="text" id="name">
            </div>
            <label class="field__heading" for="email">Электронная почта E-mail</label>
            <div class="field__wrapper">
                <input class="field" name="email" type="email" id="email">
            </div>
            <label class="field__heading" for="password">Пароль</label>
            <div class="field__wrapper">
                <input class="field" name="password" type="password" id="password">
            </div>
            <div class="button__wrapper">
                <button class="button" type="submit">Зарегистрироваться</button>
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
