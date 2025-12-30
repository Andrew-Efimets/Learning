@extends('layouts.app')
@section('title', 'Регистрация')

@section('content')
    <form method="POST" action="{{ route('create_user') }}" class="form__container">
        @csrf
        <div class="form__wrapper">
            <label class="field__heading" for="name">Имя</label>
            <div class="field__wrapper">
                <input class="field
                @error('name') field__error @enderror" name="name" type="text" id="name" value="{{ old('name') }}">
            </div>
            @error('name')
            <span class="field__error-message">{{ $message }}</span>
            @enderror
            <label class="field__heading" for="email">Электронная почта E-mail</label>
            <div class="field__wrapper">
                <input class="field
                @error('email') field__error @enderror" name="email" type="email" id="email" value="{{ old('email') }}">
            </div>
            @error('email')
            <span class="field__error-message">{{ $message }}</span>
            @enderror
            <label class="field__heading" for="password">Пароль</label>
            <div class="field__wrapper">
                <input class="field
                @error('password') field__error @enderror" name="password" type="password" id="password">
            </div>
            @error('password')
            <span class="field__error-message">{{ $message }}</span>
            @enderror
            <label class="field__heading" for="password_confirmation">Подтвердить пароль</label>
            <div class="field__wrapper">
                <input class="field" name="password_confirmation" type="password" id="password_confirmation">
            </div>
            <div class="button__wrapper">
                <button class="button" type="submit">Зарегистрироваться</button>
            </div>
        </div>
    </form>
@endsection
