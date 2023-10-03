import Swiper from 'swiper/bundle';
import {addClass, removeClass} from "../utils/classMethods";

export default function swipers() {
    if (document.querySelector('.reviews__swiper')) {
        new Swiper('.reviews__swiper', {
            slidesPerView: 1,
            speed: 1000,
            navigation: {
                disabledClass: 'swiper-button_disabled',
                nextEl: '.reviews__controls .swiper-button_next',
                prevEl: '.reviews__controls .swiper-button_prev'
            }
        })
    }

    const defaultSwipers = [...document.querySelectorAll('.swiper-section')]
    if (defaultSwipers.length) {
        defaultSwipers.forEach(swiper => {
            const swiperContainer = swiper.querySelector('.swiper-section__swiper'),
                swiperPagination = swiper.querySelector('.swiper-section__pagination'),
                buttonPrev = swiper.querySelector('.swiper-section__controls .swiper-button_prev'),
                buttonNext = swiper.querySelector('.swiper-section__controls .swiper-button_next'),
                currentFraction = swiper.querySelector('.swiper-section__fraction_current'),
                totalFraction =  swiper.querySelector('.swiper-section__fraction_total')

            new Swiper(swiperContainer, {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: false,
                speed: 1000,
                pagination: {
                    el: swiperPagination,
                    type: 'progressbar',
                },
                navigation: {
                    disabledClass: 'swiper-button_disabled',
                    nextEl: buttonNext,
                    prevEl: buttonPrev
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    1366: {
                        slidesPerView: 2,
                        spaceBetween: 13
                    }
                },

                on: {
                    realIndexChange: function (evt) {
                        currentFraction.textContent = evt.realIndex + 1 < 10 ? `0${evt.realIndex + 1}` : evt.realIndex + 1
                    },
                    init: function (evt) {
                        currentFraction.textContent = evt.realIndex + 1 < 10 ? `0${evt.realIndex + 1}` : evt.realIndex + 1
                        totalFraction.textContent = evt.slides.length < 10 ? `0${evt.slides.length}` : evt.slides.length
                        evt.isLocked && addClass(swiperPagination.parentElement, 'hidden')
                    },
                    breakpoint: function (evt) {
                        evt.isLocked ? addClass(swiperPagination.parentElement, 'hidden') : removeClass(swiperPagination.parentElement, 'hidden')
                    },
                }
            })
        })
    }
}