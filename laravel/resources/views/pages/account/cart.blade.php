@extends('layouts.app')
@section('title', 'Корзина')

@section('content')
    @csrf
    <div class="heading__container">
        <p class="heading">
            Корзина
        </p>
    </div>
    <section class="content__wrapper">
        @if($product->isNotEmpty())
            @include('partials.products.product-card')
        @else
            <div class="notification__wrapper">
                <p class="notification">
                    Ваша корзина пуста
                </p>
            </div>
        @endif
    </section>
    <div class="">
        <form method="GET" action="{{ route('home') }}" class="button__wrapper">
            <button class="button" type="submit">Оплатить</button>
        </form>
    </div>
@endsection
