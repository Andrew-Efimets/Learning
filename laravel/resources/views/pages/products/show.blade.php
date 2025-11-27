@extends('layouts.app')
@section('title', $product->name)

@section('content')
    @auth
        @if($product->user_id == $user->id)
            <form method="GET" action="{{ route('products.edit', $product->id) }}" class="button_wrapper">
                @csrf
                <button class="action_button" type="submit">Редактировать объявление</button>
            </form>
        @endif
    @endauth
    <section class="content_wrapper">
        <div class="category_wrapper">
            <div class="category_title">
                <p class="category_title_item">
                    Категории
                </p>
            </div>
            @foreach($categories as $category)
                <div class="category_item_wrapper">
                    <a class="category_item" href="{{ route('category.show', $category->id) }}">{{$category->name}}</a>
                </div>
            @endforeach
        </div>
        <div class="product_show_wrapper">
            <div class="product_show">
                @if($product->photo_exist == null)
                    <div class="product_image_wrapper_show">
                        <div class="no_image_show">
                            Photo
                        </div>
                    </div>
                @else
                    <div class="slider">
                        <div class="slider_line">
                            @foreach($productImages as $image)
                                <img class="slider_img"
                                     src="{{ asset('storage/product/' . $product->id . '/' . $image->product_image) }}"
                                     alt="Изображение" id="{{$image->id}}">
                            @endforeach
                        </div>
                        <button class="slider_btn_prev">&#9668;</button>
                        <button class="slider_btn_next">&#9658;</button>
                    </div>
                @endif
                <div class="product_information_show">
                    <div class="product_price_wrapper">
                        <p class="product_price">{{$product->price}} р.</p>
                    </div>
                    <div class="product_name_wrapper_show">
                        <p class="product_name_show">{{$product->name}}</p>
                    </div>
                    <div class="date_wrapper">
                        <p class="date">{{$product->created_at->translatedFormat('d F, H:i')}}</p>
                    </div>
                </div>
            </div>
            <div class="show_description">
                <p class="product_name_show">Описание</p>
                <p class="product_description">{{$product->description}}</p>
            </div>
        </div>
    </section>
@endsection
