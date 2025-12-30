<div class="header__container">
    <div class="header__container-up">
        <div class="header__logo-wrapper">
            <a href="{{ route('home') }}" class="header__logo-link">
                <img src="{{ asset('storage/images/10.jpg') }}" alt="Логотип компании" class="header__logo">
            </a>
        </div>
        <div class="header__name">
            <a href="{{ route('home') }}" class="header__name-item">
                ваши вещи
            </a>
        </div>
        <nav class="header__nav">
            <ul class="header__menu">
                @auth
                    <li class="header__logo-wrapper">
                        <a href="{{ route('personal.data') }}">
                        <img src="{{ asset('storage/images/account.png') }}" alt="аккаунт" class="header__account">
                        </a>
                    </li>
                    <li class="header__menu-item">
                        <a href="{{ route('personal.data') }}" class="header__menu-user">{{ Auth::user()->name }}</a>
                    </li>
                    @if(Auth::user()->role === 'admin')
                        <li class="header__menu-item">
                            <a class="header__menu-link" href="{{ route('account.admin') }}">Панель администратора</a>
                        </li>
                    @else
                        <li class="header__menu-item">
                            <a class="header__menu-link" href="{{ route('account') }}">Личный кабинет</a>
                        </li>
                        <li class="header__logo-wrapper">
                            <img src="{{ asset('storage/images/cart.png') }}" alt="корзина" class="header__cart">
                        </li>
                        <li class="header__menu-item">
                            <a class="header__menu-link" href="{{ route('cart.index') }}">Корзина</a>
                        </li>
                    @endif
                    <li class="header__menu-item">
                        <a class="header__menu-link" href="{{ route('logout') }}">Выход</a>
                    </li>
                @else
                    <li class="header__menu-item">
                        <a class="header__menu-link" href="{{ route('login') }}">Вход</a>
                    </li>
                    <li class="header__menu-item">
                        <a class="header__menu-link" href="{{ route('register') }}">Регистрация</a>
                    </li>
                @endauth
            </ul>
        </nav>
    </div>
</div>
<section class="search__container">
    <form method="GET" action="{{ route('products.search') }}" class="search__wrapper">
        <input type="text" name="search" class="search__field" placeholder="Поиск">
        <button type="submit" class="search__button-wrapper">
            <img src="{{ asset('storage/images/search.png') }}" alt="Кнопка" class="search__button">
        </button>
    </form>
    <form method="GET" action="{{ route('products.create') }}" class="button__wrapper">
        <button class="button" type="submit">Подать объявление</button>
    </form>
</section>
