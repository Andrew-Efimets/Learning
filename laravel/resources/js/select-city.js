import $ from 'jquery';
import select2 from 'select2';
import 'select2/dist/css/select2.min.css';

// Принудительно регистрируем плагин в jQuery
select2($);

// Делаем jQuery глобальным (иногда плагины ищут его в window)
window.jQuery = window.$ = $;

$(document).ready(function() {
    const citySelect = $('#city_id');

    // Проверка, что элемент существует и функция select2 доступна
    if (citySelect.length > 0 && typeof citySelect.select2 === 'function') {
        citySelect.select2({
            placeholder: "Начните вводить город...",
            allowClear: true,
            language: {
                noResults: () => "Город не найден"
            },
            containerCssClass: "field",
            width: '100%'
        });
    } else {
        console.error("Select2 или элемент #city_id не найден");
    }
});
