<div style="font-family: Arial, sans-serif; border: 1px solid #eee; padding: 20px;">
    <h2>Добро пожаловать, {{ $user->name }}!</h2>
    <p>Чтобы начать пользоваться всеми функциями сайта "Ваши вещи", подтвердите вашу почту:</p>
    <a href="{{ $url }}" style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
        Активировать аккаунт
    </a>
    <p style="margin-top: 20px; font-size: 12px; color: #777;">Ссылка действительна в течение 60 минут.</p>
</div>
