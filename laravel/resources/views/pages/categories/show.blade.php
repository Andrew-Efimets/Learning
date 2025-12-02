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
        @include('partials.products.left-side')
        @include('partials.products.product-card')
    </section>
    {{ $product->withQueryString()->links() }}
@endsection
