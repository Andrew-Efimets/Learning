<div class="header_container">
    <div class="header_container_up">
        <div class="header_logo_wrapper">
            <a href="{{ route('products.index') }}">
                <img src="{{ asset('storage/images/10.jpg') }}" alt="Логотип компании" class="header_logo">
            </a>
        </div>
        <div class="header_name">
            <a href="{{ route('products.index') }}" class="header_name_item">
                ваши вещи
            </a>
        </div>
        <nav class="header_nav">
            <ul class="header_menu">
                @auth
                    <li class="header_logo_wrapper">
                        <img src="{{ asset('storage/images/account.png') }}" alt="аккаунт" class="header_logo">
                    </li>
                    <li class="header_menu-item">
                        <p class="header_menu-user">{{ $user->name }}</p>
                    </li>
                    <li class="header_menu-item">
                        <a class="header_menu-link" href="{{ route('account') }}">Личный кабинет</a>
                    </li>
                    <li class="header_menu-item">
                        <a class="header_menu-link" href="{{ route('logout') }}">Выход</a>
                    </li>
                @else
                    <li class="header_menu-item">
                        <a class="header_menu-link" href="{{ route('login') }}">Вход</a>
                    </li>
                    <li class="header_menu-item">
                        <a class="header_menu-link" href="{{ route('register') }}">Регистрация</a>
                    </li>
                @endauth
            </ul>
        </nav>
    </div>
</div>
<section class="search_create">
    <form method="GET" action="{{ route('products.search') }}" class="search_wrapper">
        <input type="text" name="search" class="search_field" placeholder="Поиск">
        <button type="submit" class="search_button_wrapper">
            <img src="{{ asset('storage/images/search.png') }}" alt="Кнопка" class="search_button">
        </button>
    </form>
    <form method="GET" action="{{ route('products.create') }}" class="button_wrapper_header">
        <button class="action_button" type="submit">Подать объявление</button>
    </form>
</section>
