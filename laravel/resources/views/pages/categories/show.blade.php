@extends('layouts.app')
@section('title', 'Ваши вещи')

@section('content')
    @csrf
    <section class="sort_wrapper">
        <form method="get" action="{{ route('category.show', $categoryItem) }}" class="sort-form" id="sort-form">
            @include('partials.products.sort')
        </form>
    </section>
    <div class="category_title">
        <p class="category_title_item">
            Категория {{$categoryItem->name}}
        </p>
    </div>
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
            @include('partials.products.filter')
        </div>
        <div class="products">
            @foreach($product as $item)
                <div class="product">
                    @foreach($productImages as $image)
                        @if($item->id == $image->product_id)
                            <div class="product_image_wrapper">
                                <img class="product_image_item"
                                     src="{{ asset('storage/product/' . $item->id . '/' . $image->product_image) }}"
                                     alt="Изображение">
                            </div>
                            @break
                        @endif
                    @endforeach
                    @if($item->id !== $image->product_id)
                        <div class="product_image_wrapper">
                            <div class="no_image">
                                Photo
                            </div>
                        </div>
                    @endif
                    <div class="product_information">
                        <div class="product_price_wrapper">
                            <p class="product_price">{{$item->price}} р.</p>
                        </div>
                        <div class="product_name_wrapper">
                            <a class="product_name"
                               href="{{ route('product_item.show', ['category_id' => $item->category_id, 'id' => $item->id]) }}">
                                {{$item->name}}
                            </a>
                        </div>
                        <div class="date_wrapper">
                            <p class="date">{{$item->created_at->translatedFormat('d F, H:i')}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    {{ $product->withQueryString()->links() }}
@endsection
