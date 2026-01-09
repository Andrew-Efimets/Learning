@extends('layouts.app')
@section('title', $product->name)

@section('content')
    <section class="content__wrapper">
        @include('partials.products.left-side')
        <div class="product-show__wrapper">
            <div class="product-show">
                @if($product->photo_exist === null)
                    <div class="image-show__wrapper">
                        <div class="no__image-show">
                            Photo
                        </div>
                    </div>
                @else
                    <div class="slider">
                        <div class="slider__line">
                            @foreach($product->images as $image)
                                <img class="slider__img"
                                     src="{{ asset('storage/product/'
                                        . $product->created_at->format('Y/m')
                                        . '/' . $product->id . '/' . $image->product_image) }}"
                                     alt="Изображение" id="{{$image->id}}">
                            @endforeach
                        </div>
                        <button class="slider__btn-prev">&#9668;</button>
                        <button class="slider__btn-next">&#9658;</button>
                    </div>
                @endif
                <div class="product-show__information">
                    <div class="product__price-wrapper">
                        <p class="product__price">{{ $product->price }} р.</p>
                    </div>
                    <div class="heading__container">
                        <p class="heading">{{ $product->name }}</p>
                    </div>
                    <div class="date__wrapper">
                        <p class="date">{{ $product->city?->city }}</p>
                    </div>
                    <div class="date__wrapper">
                        <p class="date">{{ $product->created_at->translatedFormat('d F, H:i') }}</p>
                    </div>
                    @auth
                    <div class="heading__container">
                        <p class="heading__h4">Продавец</p>
                        <p class="text">{{ $product->user->name }}</p>
                    </div>
                    <div class="heading__container">
                        <p class="heading__h4">Номер телефона для связи</p>
                        <p class="text">{{ $product->user->phone }}</p>
                    </div>
                        @if($product->user_id !== auth()->id())
                            <button
                                class="product__button {{ $product->is_in_cart ? 'in-cart' : 'add-to-cart' }}"
                                data-id="{{ $product->id }}"
                                {{ $product->is_in_cart ? 'disabled' : '' }}
                                style="{{ $product->is_in_cart ? 'background-color: #5b6559;' : '' }}"
                            >
                                {{ $product->is_in_cart ? 'В корзине ✓' : 'Оплатить на сайте' }}
                            </button>
                        @else
                            <button class="product__button" disabled style="background-color: #5b6559">
                                Ваше объявление
                            </button>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="heading__container">
                <p class="heading">Описание</p>
                <p class="product__description">{{ $product->description }}</p>
            </div>
            <div class="map" id="map" data-address="{{ json_encode($product->city?->city) }}"
                 data-marker-url="{{ asset('storage/images/map-marker.png') }}">
            </div>
        </div>
    </section>
    @can('update', $product)
            <form method="GET" action="{{ route('products.edit', $product) }}" class="button__wrapper">
                <button class="button" type="submit">Редактировать объявление</button>
            </form>
    @endcan
@endsection
