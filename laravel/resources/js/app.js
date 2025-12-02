const slider = document.querySelector('.slider')
const sliderImages = document.querySelectorAll('.slider_img')
const sliderLine = document.querySelector('.slider_line')

const sliderBtnNext = document.querySelector('.slider_btn_next')
const sliderBtnPrev = document.querySelector('.slider_btn_prev')

let sliderCount = 0;
let sliderWidth = slider.offsetWidth;

sliderBtnNext.addEventListener('click', nextSlide);
sliderBtnPrev.addEventListener('click', prevSlide);

function nextSlide() {
    sliderCount++;

    if (sliderCount >= sliderImages.length) {
        sliderCount = 0;
    }

    rollSlider();
}

function prevSlide() {
    sliderCount--;

    if (sliderCount < 0) {
        sliderCount = sliderImages.length -1;
    }

    rollSlider();
}

function rollSlider() {
    sliderLine.style.transform = `translateX(${-sliderCount * sliderWidth}px)`;
}


initMap();

async function initMap() {
    // Промис `ymaps3.ready` будет зарезолвлен, когда загрузятся все компоненты основного модуля API
    await ymaps3.ready;

    // Импортируем YMap, YMapDefaultSchemeLayer и другие компоненты
    const { YMap, YMapDefaultSchemeLayer, YMapMarker, YMapDefaultFeaturesLayer} = ymaps3;
    // const { YMapDefaultMarker } = await ymaps3.import('@yandex/ymaps3-default-ui-theme');

    const mapElement = document.getElementById('map');
    const markerUrl = mapElement.dataset.markerUrl;
    const addressData = mapElement.dataset.address;
    let address = null;

    if (addressData) {
        try {
            address = JSON.parse(addressData);
        } catch (e) {
            console.error('Ошибка парсинга JSON для адреса:', e);
        }
    }

    const map = new YMap(
        // Передаём ссылку на HTMLElement контейнера
        mapElement,

        // Передаём параметры инициализации карты
        {
            location: {
                // Координаты центра карты (будут обновлены после геокодирования)
                center: [27.5667, 53.9],
                // Уровень масштабирования
                zoom: 11
            }
        }
    );

    // Добавляем слой для отображения схематической карты
    map.addChild(new YMapDefaultSchemeLayer());
    map.addChild(new YMapDefaultFeaturesLayer());

    if (address) {
        try {
            // Выполняем геокодирование, чтобы получить координаты по адресу
            const searchResult = await ymaps3.search({ text: address });

            if (searchResult.length > 0) {
                const firstGeoObject = searchResult[0];
                const coords = firstGeoObject.geometry.coordinates;
                console.log(coords)

                const customMarkerContent = document.createElement('img');
                customMarkerContent.src = markerUrl; // Устанавливаем URL из data-атрибута
                customMarkerContent.alt = 'Marker';
                customMarkerContent.style.width = '32px';
                customMarkerContent.style.height = '32px';

                // Создаём YMapMarker с кастомным содержимым
                const marker = new YMapMarker(
                    { coordinates: coords }, // Обязательный параметр - координаты
                    customMarkerContent // Наш кастомный DOM-элемент
                );

                // Добавляем маркер на карту
                map.addChild(marker);

                // Центрируем карту на найденных координатах
                map.setLocation({
                    center: coords,
                    zoom: 11
                });

            } else {
                console.error('Адрес не найден: ' + address);
            }
        } catch (e) {
            console.error('Ошибка при геокодировании:', e);
        }
    } else {
        console.warn('Переменная address пуста.');
    }
}
