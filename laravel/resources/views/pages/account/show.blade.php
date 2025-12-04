@extends('layouts.app')
@section('title', 'Ваши объявления')

@section('content')
    @csrf
    <section class="sort__wrapper">
        <form method="get" action="{{ route('account', $user->id) }}" class="sort__form" id="sort-form">
            @include('partials.products.sort')
        </form>
    </section>
    <div class="heading__container">
        <p class="heading">
            Ваши объявления
        </p>
    </div>
    <section class="content__wrapper">
        @include('partials.products.left-side')
        @if ($product->isNotEmpty())
            @include('partials.products.product-card')
        @else
            <div class="notification__wrapper">
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
