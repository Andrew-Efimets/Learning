@extends('layouts.app')
@section('title', 'Корзина')

@section('content')
    @csrf
    <div class="category_title">
        <p class="category_title_item">
            Корзина
        </p>
    </div>
    <section class="content_wrapper">
        @if($product->isNotEmpty())
            @include('partials.products.product-card')
        @else
            <div class="notification_wrapper">
                <p class="notification">
                    Ваша корзина пуста
                </p>
            </div>
        @endif
    </section>
@endsection
