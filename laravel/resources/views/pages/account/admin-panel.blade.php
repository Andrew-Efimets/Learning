@extends('layouts.app')
@section('title', 'Ваши объявления')

@section('content')
    <section class="admin__container">
        <div class="admin__heading-wrapper">
            <p class="admin__heading">
                Панель администратора
            </p>
        </div>
        <div class="admin__data-wrapper">
            <p class="heading">
                Товары
            </p>
            <div class="admin__item-wrapper">
                <p class="admin__item-description orders__heading-text">
                    Количество товаров на сайте: {{ $productCount }}
                </p>
            </div>
        </div>
        <div class="admin__data-wrapper">
            <p class="heading">
                Пользователи
            </p>
            <div class="admin__item-wrapper">
                <p class="admin__item-description orders__heading-text">
                    Количество пользователей на сайте: {{ $usersCount }}
                </p>
            </div>
        </div>
        <div class="admin__data-wrapper">
            <p class="heading">
                Заказы
            </p>
            <div class="admin__item-wrapper">
                <p class="admin__item-description orders__heading-text">
                    Количество заказов на сайте: {{ $ordersCount }}
                </p>
            </div>
        </div>
        <div class="admin__data-wrapper">
            <p class="heading">
                Итого оплачено
            </p>
            <div class="admin__item-wrapper">
                <p class="admin__item-description orders__heading-text">
                    Сумма оплаты заказов на сайте: {{ $sumTotalPrice }} р.
                </p>
            </div>
        </div>
    </section>
@endsection
