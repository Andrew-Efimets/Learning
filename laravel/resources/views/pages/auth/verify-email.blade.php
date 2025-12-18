@extends('layouts.app')

@section('content')
    <div class="">
        Для создания объявлений и доступа к полному функционалу, пожалуйста, подтвердите адрес вашей почты.
    </div>

    <p>Мы отправили ссылку на вашу почту. Если вы не получили письмо, нажмите кнопку ниже.</p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">Отправить письмо повторно</button>
    </form>
@endsection
