@extends('layouts.app')

@section('content')
    <div class="notification_wrapper">
        <p class="notification">Объявление {{$product->name}} удалено</p>
    </div>
    <form action="{{ route('products.index') }}">
        <div class="button_wrapper_destroy">
            <button class="destroy_button" type="submit">Перейти на главную страницу</button>
        </div>
    </form>
@endsection
