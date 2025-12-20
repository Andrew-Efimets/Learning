@extends('layouts.app')
@section('title', 'Ваши вещи')

@section('content')
    @csrf
    <section class="sort__wrapper">
        <form method="get" action="{{ route('home') }}" class="sort__form" id="sort-form">
        @include('partials.products.sort')
        </form>
    </section>
    <section class="content__wrapper">
        <div class="filter__container">
            @include('partials.products.left-side')
        </div>
        @include('partials.products.product-card')
    </section>
    {{ $product->withQueryString()->links() }}
@endsection
