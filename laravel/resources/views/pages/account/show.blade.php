@extends('layouts.app')
@section('title', 'Ваши объявления')

@section('content')
    <section class="sort__wrapper">
        <form method="get" action="{{ route('account') }}" class="sort__form" id="sort-form">
            @include('partials.products.sort')
        </form>
    </section>
    <div class="heading__container">
        <p class="heading">
            Ваши объявления
        </p>
    </div>
    <section class="content__wrapper">
        @include('partials.products.left-side')
        @if ($product->isNotEmpty())
            @include('partials.products.product-card')
        @else
            <div class="notification__wrapper">
                <p class="notification">
                    У вас пока нет объявлений.
                </p>
                <p class="notification">
                    Вы можете подать новое прямо сейчас!
                </p>
            </div>
        @endif
    </section>
    @if($productSold->isNotEmpty())
    <div class="orders__container">
        <div class="cart-orders__wrapper" id="toggle-orders" style="cursor: pointer;">
            <div class="cart-orders__header">
            <div class="orders__heading">
                <p class="orders__heading-text">
                    Эти товары уже оплатили
                </p>
                <span class="arrow">▼</span>
            </div>
            <div id="orders-content" style="display: none;">
                @foreach($productSold as $item)
                    <div class="cart-orders__wrapper cart-item">
                        <div class="order__wrapper">
                            <div class="product-item">
                                @if($item->images->isNotEmpty())
                                <div class="product-cart">
                                    <img class="image-cart" src="{{ asset('storage/product/'
                                . $item->created_at->format('Y/m')
                                . '/' . $item->id . '/' . $item->images->first()?->product_image) }}"
                                         alt="Изображение">
                                </div>
                                @else
                                    <div class="no__image-cart">Photo</div>
                                @endif
                                <div class="product-cart">
                                    <h4>Название:</h4> {{ $item->name }}
                                </div>
                                <div class="product-cart">
                                    <h4>Цена:</h4> {{ $item->price }} р.
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            </div>
        </div>
    </div>
    @endif
    {{ $product->withQueryString()->links() }}
@endsection
