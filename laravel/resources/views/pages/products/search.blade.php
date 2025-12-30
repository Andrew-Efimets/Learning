@extends('layouts.app')
@section('title', 'Ваши вещи')

@section('content')
    <section class="sort__wrapper">
        <form method="get" action="{{ route('products.search') }}" class="sort__form" id="sort-form">
            @include('partials.products.sort')
        </form>
    </section>
    <section class="content__wrapper">
        @include('partials.products.left-side')
        @if($product->isNotEmpty())
            @include('partials.products.product-card')
        @else
            <div class="nodata__container">
                <div class="nodata__wrapper">
                    <img src="{{ asset('storage/images/nodata.png') }}" alt="Нет данных" class="nodata__img">
                </div>
                <p class="nodata__item">
                    Ничего не найдено
                </p>
            </div>
        @endif
    </section>
    {{ $product->withQueryString()->links() }}
@endsection
