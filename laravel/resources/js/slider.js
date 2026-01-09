const slider = document.querySelector('.slider')
const sliderImages = document.querySelectorAll('.slider__img')
const sliderLine = document.querySelector('.slider__line')

const sliderBtnNext = document.querySelector('.slider__btn-next')
const sliderBtnPrev = document.querySelector('.slider__btn-prev')

if (slider) {
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
            sliderCount = sliderImages.length - 1;
        }

        rollSlider();
    }

    function rollSlider() {
        sliderLine.style.transform = `translateX(${-sliderCount * sliderWidth}px)`;
    }
}
