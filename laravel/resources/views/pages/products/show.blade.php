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
                            @foreach($productImages as $image)
                                <img class="slider__img"
                                     src="{{ asset('storage/product/' . $product->id . '/' . $image->product_image) }}"
                                     alt="Изображение" id="{{$image->id}}">
                            @endforeach
                        </div>
                        <button class="slider__btn-prev">&#9668;</button>
                        <button class="slider__btn-next">&#9658;</button>
                    </div>
                @endif
                <div class="product-show__information">
                    <div class="product__price-wrapper">
                        <p class="product__price">{{$product->price}} р.</p>
                    </div>
                    <div class="heading__container">
                        <p class="heading">{{$product->name}}</p>
                    </div>
                    <div class="date__wrapper">
                        <p class="date">{{ $city }}</p>
                    </div>
                    <div class="date__wrapper">
                        <p class="date">{{ $product->created_at->translatedFormat('d F, H:i') }}</p>
                    </div>
                </div>
            </div>
            <div class="heading__container">
                <p class="heading">Описание</p>
                <p class="product__description">{{ $product->description }}</p>
            </div>
            <div class="map" id="map" data-address="{{ json_encode($city) }}"
                 data-marker-url="{{ asset('storage/images/map-marker.png') }}">
            </div>
        </div>
    </section>
    @can('update', $product)
            <form method="GET" action="{{ route('products.edit', ['product' => $product->id]) }}" class="button__wrapper">
                @csrf
                <button class="button" type="submit">Редактировать объявление</button>
            </form>
    @endcan
@endsection
