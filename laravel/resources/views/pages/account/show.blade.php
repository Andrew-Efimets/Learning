@extends('layouts.app')
@section('title', 'Ваши объявления')

@section('content')
    <section class="sort__wrapper">
        <form method="get" action="{{ route('account') }}" class="sort__form" id="sort-form">
            @include('partials.products.sort')
        </form>
    </section>
    <div class="heading__container">
        <p class="heading">Ваши объявления</p>
    </div>
    <section class="content__wrapper">
        @include('partials.products.left-side')
        <div class="right-side__container">
            @if ($product->isNotEmpty())
                @include('partials.products.product-card')
            @else
                <div class="notification__wrapper">
                    <p class="notification">У вас пока нет объявлений.</p>
                    <p class="notification">Вы можете подать новое прямо сейчас!</p>
                </div>
            @endif

            {{-- Секция: Товары уже оплатили --}}
            @if($productSold->isNotEmpty())
                <div class="orders__container accordion-item">
                    <div class="cart-orders__wrapper toggle-trigger" style="cursor: pointer;">
                        <div class="cart-orders__header">
                            <div class="orders__heading">
                                <p class="orders__heading-text">Эти товары вам оплатили</p>
                                <span class="arrow">▼</span>
                            </div>
                        </div>
                    </div>
                    <div class="orders-content" style="display: none;">
                        @foreach($productSold as $item)
                            <div class="cart-orders__wrapper cart-item">
                                <div class="order__wrapper">
                                    <div class="product-item">
                                        @if($item->images->isNotEmpty())
                                            <div class="product-cart">
                                                <img class="image-cart" src="{{ asset('storage/product/' . $item->created_at->format('Y/m') . '/' . $item->id . '/' . $item->images->first()?->product_image) }}" alt="Изображение">
                                            </div>
                                        @else
                                            <div class="no__image-cart">Photo</div>
                                        @endif
                                        <div class="product-cart"><h4>Название:</h4> {{ $item->name }}</div>
                                        <div class="product-cart"><h4>Цена:</h4> {{ $item->price }} р.</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Секция: Оплаченные покупки --}}
            @if($orders->isNotEmpty())
                <div class="orders__container accordion-item">
                    <div class="cart-orders__wrapper toggle-trigger" style="cursor: pointer;">
                        <div class="cart-orders__header">
                            <div class="orders__heading">
                                <p class="orders__heading-text">Ваши покупки</p>
                                <span class="arrow">▼</span>
                            </div>
                        </div>
                    </div>
                    <div class="orders-content" style="display: none;">
                        @foreach($orders as $order)
                            <div class="order__wrapper">
                                <div class="order-item">
                                    <div class="notification">Номер заказа: №{{ $order->order_number }}</div>
                                    <div class="notification">Дата оплаты: {{ $order->created_at->translatedFormat('d F, H:i') }}</div>
                                    <div class="notification">Оплачено: {{ $order->total_price }} р.</div>
                                </div>
                                @foreach($order->products as $orderItem)
                                    <div class="order-item__data" style="margin-left: 20px;">
                                        <div class="description">Товар: {{ $orderItem->name }}</div>
                                        <div class="description">Цена: {{ $orderItem->price }}</div>
                                        <div class="description">Продавец: {{ $orderItem->user->name }}</div>
                                        <div class="description">Телефон: {{ $orderItem->user->phone }}</div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
    {{ $product->withQueryString()->links() }}
@endsection
