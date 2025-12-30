@extends('layouts.app')
@section('title', 'Корзина')

@section('content')
    <div class="container">
        <div class="notification__wrapper">
            <p class="heading">Корзина</p>
        </div>
        <section class="cart__wrapper">
            @if($product->isNotEmpty())
                @foreach($product as $item)
                    <div class="product-cart__wrapper cart-item">
                        <div class="product-item">
                            <div class="product-cart">
                                <img class="image-cart" src="{{ asset('storage/product/'
                                . $item['created_at']->format('Y/m')
                                . '/' . $item['id'] . '/' . $item['images']) }}"
                                     alt="Изображение">
                            </div>
                            <div class="product-cart">
                                <h4>Название:</h4> {{ $item['name'] }}
                            </div>
                            <div class="product-cart">
                                <h4>Цена:</h4> {{ $item['price'] }} р.
                            </div>
                        </div>
                        <div>
                            <button class="product__button remove-from-cart" data-id="{{ $item['id'] }}">
                                Удалить
                            </button>
                        </div>
                    </div>
                @endforeach
                <div class="button__wrapper">
                    <p class="heading__h4 total-price">Итого: {{ $totalPrice }} р.</p>
                </div>
                <div class="button__wrapper">
                    <form method="GET" action="{{ route('payment') }}"
                          class="button__wrapper-form">
                        <button class="button" type="submit">Оплатить</button>
                    </form>
                </div>
            @else
                <div class="notification__wrapper">
                    <p class="notification">Ваша корзина пуста</p>
                </div>
            @endif
        </section>
    </div>
    @if($orders->isNotEmpty())
        <div class="orders__container">
            <div class="cart-orders__wrapper" id="toggle-orders">
                <div class="cart-orders__header">
                    <div class="orders__heading">
                        <p class="orders__heading-text">
                            Оплаченные покупки
                        </p>
                        <span class="arrow">▼</span>
                    </div>
                    <div class="cart-orders__wrapper" id="orders-content" style="display: none;">
                        @foreach($orders as $order)
                            <div class="order__wrapper">
                                <div class="notification">Номер заказа: №{{ $order->order_number }}</div>
                                <div class="notification">Дата
                                    оплаты: {{ $order->created_at->translatedFormat('d F, H:i') }}</div>
                                <div class="notification">Оплачено: {{ $order->total_price }} р.</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
