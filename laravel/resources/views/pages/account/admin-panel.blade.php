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
                <p class="admin__item-description">
                    Количество товаров на сайте: {{ $productCount }}
                </p>
            </div>
        </div>
        <div class="admin__data-wrapper">
            <p class="heading">
                Пользователи
            </p>
            <div class="admin__item-wrapper">
                <p class="admin__item-description">
                    Количество пользователей на сайте: {{ $usersCount }}
                </p>
            </div>
        </div>
    </section>
@endsection
