@extends('layouts.app')
@section('title', 'Успешно')

@section('content')
        @csrf
        <div class="notification__wrapper">
            <p class="notification">Регистрация прошла успешно!</p>
            <br>
            <p class="notification">Перейдите на указанный вами адрес электронной почты и подтвердите его</p>
        </div>
@endsection
