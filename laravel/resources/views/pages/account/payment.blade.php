@extends('layouts.app')
@section('title', 'Оплата')

@section('content')
    <div class="heading__container">
        <p class="heading">
            Оплата товаров
        </p>
    </div>
    <section class="content__wrapper">
        <div class="payment__container">
            <div class="heading__container">
                <p class="heading">
                    Ваша итоговая сумма
                </p>
            </div>
            <div class="heading__container">
                <p class="heading">
                    {{ $totalPrice }}
                </p>
            </div>
            <div class="">
                <form action="{{ route('credit-card') }}" method="post" class="payment__form" id="payment-form">
                    @csrf
                    <input type="hidden" name="totalPrice" value="{{ $totalPrice }}">
                    <div class="field__wrapper">
                        <label for="card-element" class="field__heading">
                            <p class="field__heading">Данные карты (Номер, Срок действия, CVC)</p>
                        </label>
                        <div id="card-element" class="field"></div>
                        <div id="card-errors" role="alert" style="color: red;"></div>
                    </div>

                    <script src="https://js.stripe.com/v3/"></script>
                    <script>
                        window.stripePublicKey = "{{ config('services.stripe.public_key') }}";
                    </script>
                    @vite(['resources/js/stripe-handler.js'])

                    <div class="text-right">
                        <button id="card-button" class="button" type="submit">
                            Оплатить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
