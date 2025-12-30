<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail</title>
    <style>
        body {
            font-family: "Montserrat", sans-serif;
            display: flex;
            flex-direction: column;
            background-color: #f4f4f4;
        }

        .heading {
            color: #0a0a0a;
            font-size: 18px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .button__wrapper {
            width: 100%;
            padding: 20px 0;
            border: none;
            line-height: 22px;
            display: flex;
            justify-content: center;
            column-gap: 20px;
            margin: 0 auto;
        }

        .button {
            all: unset;
            background: darkgreen;
            color: #FFFFFF;
            padding: 10px 40px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            justify-content: center;
        }

        .notification__wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .notification {
            font-size: 16px;
            font-weight: 500;
            text-align: center;
        }

        .mail__wrapper {
            margin: auto;
            width: 600px;
            height: 600px;
            display: flex;
            flex-direction: column;
            text-align: center;
            justify-content: space-between;
            border: darkgreen 2px solid;
            border-radius: 10px;
        }

        .header__container {
            background-color: darkgreen;
        }

        .header__name-item {
            text-decoration: none;
            text-transform: uppercase;
            font-size: 22px;
            color: #FFFFFF;
            font-weight: bold;
            transition: all 0.3s linear;
        }

        .footer {
            font-family: "Montserrat", sans-serif;
            padding: 15px 0;
            background-color: darkgreen;
        }

        .footer__container {
            color: #fff;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="mail__container">
    <div class="mail__wrapper">
        <div class="header__container">
            <h1 class="header__name-item">Ваши вещи</h1>
        </div>
        <div class="mail__content">
            <h2 class="heading">Здравствуйте, {{ $user->name }}!</h2>
            <div class="notification__wrapper">
                <p class="notification">
                    Это письмо отправлено для сброса пароля на сайте "Ваши вещи".
                    Перейдите по ссылке ниже, чтобы изменить пароль.
                </p>
            </div>
            <div class="button__wrapper">
                <a href="{{ $url }}" class="button">
                    Ссылка
                </a>
            </div>

            <p class="notification">
                Ссылка действительна в течение 60 минут.
            </p>
            <p class="notification">
                Если вы не запрашивали сброс пароля, просто проигнорируйте это письмо.
            </p>
        </div>
        <div class="footer">
            <p class="footer__container">Все права защищены</p>
        </div>
    </div>
</div>
</body>
</html>
