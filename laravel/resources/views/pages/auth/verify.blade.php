@extends('layouts.app')
@section('title', 'Вход')

@section('content')
        @csrf
        <div class="notification_wrapper">
            <p class="notification">Регистрация прошла успешно!</p>
            <br>
            <p class="notification">Перейдите на указанный вами адрес электронной почты и подтвердите его</p>
        </div>
@endsection
