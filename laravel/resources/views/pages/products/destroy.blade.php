@extends('layouts.app')
@section('title', 'Удаление объявления')

@section('content')
    <div class="notification__wrapper">
        <p class="notification">Объявление {{$product->name}} удалено</p>
    </div>
    <form action="{{ route('home') }}">
        <div class="button__wrapper">
            <button class="button" type="submit">Перейти на главную страницу</button>
        </div>
    </form>
@endsection
