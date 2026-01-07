initMap();

async function initMap() {
    await ymaps3.ready;

    const { YMap, YMapDefaultSchemeLayer, YMapMarker, YMapDefaultFeaturesLayer} = ymaps3;

    const mapElement = document.getElementById('map');
    const markerUrl = mapElement.dataset.markerUrl;
    const addressData = mapElement.dataset.address;
    let city = null;

    if (addressData) {
        try {
            city = JSON.parse(addressData);
        } catch (e) {
            console.error('Ошибка парсинга JSON для адреса:', e);
        }
    }

    const map = new YMap(
        mapElement,

        {
            location: {
                center: [27.5667, 53.9],
                zoom: 11
            }
        }
    );

    map.addChild(new YMapDefaultSchemeLayer());
    map.addChild(new YMapDefaultFeaturesLayer());

    if (city) {
        try {
            const searchResult = await ymaps3.search({ text: city });

            if (searchResult.length > 0) {
                const firstGeoObject = searchResult[0];
                const coords = firstGeoObject.geometry.coordinates;
                console.log(coords)

                const customMarkerContent = document.createElement('img');
                customMarkerContent.src = markerUrl;
                customMarkerContent.alt = 'Marker';
                customMarkerContent.style.width = '32px';
                customMarkerContent.style.height = '32px';

                const marker = new YMapMarker(
                    { coordinates: coords },
                    customMarkerContent
                );

                map.addChild(marker);

                map.setLocation({
                    center: coords,
                    zoom: 11
                });

            } else {
                console.error('Адрес не найден: ' + city);
            }
        } catch (e) {
            console.error('Ошибка при геокодировании:', e);
        }
    } else {
        console.warn('Переменная city пуста.');
    }
}


const slider = document.querySelector('.slider')
const sliderImages = document.querySelectorAll('.slider__img')
const sliderLine = document.querySelector('.slider__line')

const sliderBtnNext = document.querySelector('.slider__btn-next')
const sliderBtnPrev = document.querySelector('.slider__btn-prev')

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
