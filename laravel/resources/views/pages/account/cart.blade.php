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
                        <a class="product-cart__link"
                           href="{{ route('product_item.show', [$item['category_slug'], $item['product_slug']]) }}">
                        <div class="product-item">
                            @if(!empty($item['images']))
                            <div class="product-cart">
                                <img class="image-cart" src="{{ asset('storage/product/'
                                . $item['created_at']->format('Y/m')
                                . '/' . $item['id'] . '/' . $item['images']) }}"
                                     alt="Изображение">
                            </div>
                            @else
                                <div class="no__image-cart">Photo</div>
                            @endif
                            <div class="product-cart">
                                <h4>Название:</h4> {{ $item['name'] }}
                            </div>
                            <div class="product-cart">
                                <h4>Цена:</h4> {{ $item['price'] }} р.
                            </div>
                        </div>
                        </a>
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
@endsection
