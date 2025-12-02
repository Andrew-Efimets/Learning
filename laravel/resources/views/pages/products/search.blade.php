@extends('layouts.app')
@section('title', 'Ваши вещи')

@section('content')
    @csrf
    <section class="sort_wrapper">
        <form method="get" action="{{ route('products.search') }}" class="sort-form" id="sort-form">
            @include('partials.products.sort')
        </form>
    </section>
    <section class="content_wrapper">
        @include('partials.products.left-side')
        @if($product->isNotEmpty())
            @include('partials.products.product-card')
        @else
            <div class="search_nodata">
                <div class="nodata_img_wrapper">
                    <img src="{{ asset('storage/images/nodata.png') }}" alt="Нет данных" class="nodata_img">
                </div>
                <p class="search_nodata_item">
                    Ничего не найдено
                </p>
            </div>
        @endif
    </section>
    {{ $product->withQueryString()->links() }}
@endsection
