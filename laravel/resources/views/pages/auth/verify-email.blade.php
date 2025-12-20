@extends('layouts.app')

@section('content')

    <div class="notification__wrapper">
        <p class="notification">
            Для создания объявлений и доступа к полному функционалу, пожалуйста, подтвердите адрес вашей почты.
        </p>

        <p class="notification">
            Мы отправили ссылку на вашу почту. Если вы не получили письмо, нажмите кнопку ниже.
        </p>
        <div class="button__wrapper">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button class="button" type="submit">Отправить письмо повторно</button>
            </form>
        </div>
    </div>
@endsection
