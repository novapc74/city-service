import Swiper from 'swiper/bundle';

export default function swipers() {
    // hero background
    if (document.querySelector('.hero__bg') && document.querySelector('.hero-thumbs__swiper')) {
        const currentFraction = document.querySelector('.hero-thumbs__fraction_current'),
            totalFraction =  document.querySelector('.hero-thumbs__fraction_total')
        // hero thumbs
        new Swiper('.hero-thumbs__swiper', {
            slidesPerView: 1,
            slideActiveClass: 'hero-thumbs__slide_active',
            loop: true,
            speed: 1000,
            effect: 'fade',
            autoplay: {
                delay: 4500,
            },
            allowTouchMove: false,
            pagination: {
                el: '.hero-thumbs__pagination',
                type: 'progressbar',
            },
            breakpoints: {
                1024: {
                    pagination: {
                        type: 'bullets',
                        bulletClass: 'hero-thumbs__bullet',
                        bulletActiveClass: 'hero-thumbs__bullet_active'
                    },
                }
            },

            on: {
                realIndexChange: function (evt) {
                    currentFraction.textContent = evt.realIndex + 1 < 10 ? `0${evt.realIndex + 1}` : evt.realIndex + 1
                },
                init: function (evt) {
                    currentFraction.textContent = evt.realIndex + 1 < 10 ? `0${evt.realIndex + 1}` : evt.realIndex + 1
                    totalFraction.textContent = evt.slides.length < 10 ? `0${evt.slides.length}` : evt.slides.length
                },
                breakpoint: function (evt) {
                    evt.pagination.init()
                },
            }
        })

        new Swiper('.hero__bg', {
            slidesPerView: 1,
            loop: true,
            speed: 1000,
            autoplay: {
                delay: 4500,
            },
            effect: "fade",
            allowTouchMove: false
        })
    }
}