@extends('layouts.app')
@section('title', 'Ваши объявления')

@section('content')
    @csrf
    <section class="sort_wrapper">
        <form method="get" action="{{ route('account', $user->id) }}" class="sort-form" id="sort-form">
            @include('partials.products.sort')
        </form>
    </section>
    <div class="category_title">
        <p class="category_title_item">
            Ваши объявления
        </p>
    </div>
    <section class="content_wrapper">
        @include('partials.products.left-side')
        @if ($product->isNotEmpty())
            @include('partials.products.product-card')
        @else
            <div class="notification_wrapper">
                <p class="notification">
                    У вас пока нет объявлений.
                </p>
                <p class="notification">
                    Вы можете подать новое прямо сейчас!
                </p>
            </div>
        @endif
    </section>
    {{ $product->withQueryString()->links() }}
@endsection
