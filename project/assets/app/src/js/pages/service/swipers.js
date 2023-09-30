import Swiper from 'swiper/bundle';
import {addClass, removeClass} from "../../utils/classMethods";

export default function swipers() {

    const casesCategories = [...document.querySelectorAll('.cases-category')]
    if (casesCategories.length) {
        casesCategories.forEach(category => {
            const swiperContainer = category.querySelector('.cases-category__swiper'),
                swiperPagination = category.querySelector('.cases-category__pagination'),
                buttonPrev = category.querySelector('.cases-category__controls .swiper-button_prev'),
                buttonNext = category.querySelector('.cases-category__controls .swiper-button_next'),
                currentFraction = category.querySelector('.cases-category__fraction_current'),
                totalFraction =  category.querySelector('.cases-category__fraction_total')

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