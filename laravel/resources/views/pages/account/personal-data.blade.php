@extends('layouts.app')
@section('title', 'Ваши объявления')

@section('content')
        <form action="{{ route('personal.data.update') }}" class="form__wrapper" method="POST">
            @csrf
            <label class="field__heading" for="name">Ваше имя</label>
            <div class="field__wrapper">
                <input class="field @error('name') field__error @enderror" name="name"
                       type="text" id="user_name" value="{{ Auth::user()->name }}">
            </div>
            @error('name')
            <span class="field__error-message">{{ $message }}</span>
            @enderror

            <label class="field__heading" for="phone">Номер телефона для связи</label>
            <div class="field__wrapper">
                <input class="field @error('phone') field__error @enderror" name="phone" type="text" id="phone"
                       value="{{ Auth::user()->phone }}">
            </div>
            @error('phone')
            <span class="field__error-message">{{ $message }}</span>
            @enderror
            <div class="button__wrapper">
                <button class="button" type="submit">Обновить данные профиля</button>
            </div>
        </form>
@endsection
