@extends('layouts.app')
@section('title', 'Ваши вещи')

@section('content')
    @csrf
    <section class="sort__wrapper">
        <form method="get" action="{{ route('category.show', $category) }}" class="sort__form" id="sort-form">
            @include('partials.products.sort')
        </form>
    </section>
    <div class="heading__container">
        <p class="heading">
            Категория {{ $category->name }}
        </p>
    </div>
    <section class="content__wrapper">
        @include('partials.products.left-side')
        @include('partials.products.product-card')
    </section>
    {{ $product->withQueryString()->links() }}
@endsection
