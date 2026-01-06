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
            <div class="payment__field">
                <p class="heading">
                    Ваша итоговая сумма
                </p>
            </div>
            <div class="payment__field">
                <h3>
                    {{ $totalPrice }} р.
                </h3>
            </div>
            <div class="">
                <form action="{{ route('credit-card') }}" method="post" class="payment__form" id="payment-form">
                    @csrf
                    <input type="hidden" name="totalPrice" value="{{ $totalPrice }}">
                    <div class="field__wrapper">
                        <div class="card__data">
                            <label for="card-element" class="notification">
                                Данные карты (Номер, Срок действия, CVC)
                            </label>
                        </div>
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
    <div class="timer__wrapper" id="timer-data">
        <p class="timer__notification">Для оплаты у вас осталось</p>
        <p class="timer" id="timer">10:00</p>
        <p>мин</p>
    </div>
@endsection
