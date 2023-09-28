import Swiper from 'swiper/bundle';

export default function swipers() {
    if (document.querySelector('.reviews__swiper')) {
        new Swiper('.reviews__swiper', {
            slidesPerView: 1,
            speed: 1000,
            navigation: {
                nextEl: '.reviews__controls .swiper-button_next',
                prevEl: '.reviews__controls .swiper-button_prev'
            }
        })
    }
}