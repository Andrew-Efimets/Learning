document.addEventListener('DOMContentLoaded', function () {
    let timeLeft = 10 * 60;
    const display = document.getElementById('timer');
    const payButton = document.getElementById('card-button');
    const notification = document.getElementById('timer-data')

    const timer = setInterval(function () {
        let minutes = Math.floor(timeLeft / 60);
        let seconds = timeLeft % 60;

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timeLeft < 0) {
            clearInterval(timer);
            display.textContent = "00:00";

            payButton.disabled = true;
            payButton.textContent = "Время истекло";
            payButton.style.backgroundColor = "#5b6559";

            notification.textContent("Время бронирования истекло. Товары возвращены в продажу.");
            notification.style.color = 'red';

            setTimeout(() => {
                window.location.href = "{{ route('cart.index') }}";
            }, 2000);
        }
    }, 1000);
});
