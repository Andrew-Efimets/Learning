@extends('layouts.app')
@section('title', 'Ваши вещи')

@section('content')
    @csrf
    <section class="sort_wrapper">
        <form method="get" action="{{ route('products.index') }}" class="sort-form" id="sort-form">
        @include('partials.products.sort')
        </form>
    </section>
    <section class="content_wrapper">
        <div class="filter_category_wrapper">
            @include('partials.products.left-side')
        </div>
        @include('partials.products.product-card')
    </section>
    {{ $product->withQueryString()->links() }}
@endsection
