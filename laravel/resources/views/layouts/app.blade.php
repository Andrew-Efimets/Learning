<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <script src="https://api-maps.yandex.ru/v3/?apikey=b051c3c4-14ef-40f6-a2cd-52681dbf70a5&lang=ru_RU"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header class="header">
    @include('partials.products.header')
</header>

@if(session('error'))
    <div class="error__item">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="success__item">
        {{ session('success') }}
    </div>
@endif

<div class="content">
    @yield('content')
</div>

<footer class="footer">
    @include('partials.products.footer')
</footer>
</body>
</html>
