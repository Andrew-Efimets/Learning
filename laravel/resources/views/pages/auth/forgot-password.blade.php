@extends('layouts.app')
@section('title', 'Вход')

@section('content')
    <form method="POST" action="{{ route('password.email') }}" class="form__container">
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
            <div class="button__wrapper">
                <button class="button" type="submit">Получить ссылку на почту</button>
            </div>
        </div>
    </form>
@endsection
