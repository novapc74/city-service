import toggleWindowScroll from "../utils/toggleWindowScroll";
import {addClass, removeClass, removeExtraClass} from "../utils/classMethods";

export default function mobileMenu() {
    const sidebar = document.querySelector('.sidebar'),
        closeBtn = document.querySelector('.sidebar__close-btn'),
        burger = document.querySelector('.header__burger')

    document.addEventListener('click', (evt) => {
        const target = evt.target
        if (target.closest('[data-type="open-menu"]')) {
            const btn = target.closest('[data-type="open-menu"]')
            openSidebar(sidebar, burger, btn.dataset.sidebar)
            return
        }
        if (target.closest('[data-type="close-menu"]')) {
            closeSidebar(sidebar, burger)
        }
    })
    // sidebar.addEventListener('click', (evt) => {
    //     if (evt.target.classList.contains('sidebar__inner') || evt.target.closest('.sidebar__inner')) {
    //         return
    //     }
    //     closeSidebar(sidebar, burger)
    // })
}

export function closeSidebar(sidebar, burger) {
    // removeClass(sidebar, 'active')
    // setTimeout(() => sidebar.className = 'sidebar', 600)
    toggleWindowScroll(true)
    removeClass(burger, 'active')
    burger.dataset.type = 'open-menu'
}

export function openSidebar(sidebar, burger, className) {
    // removeExtraClass(sidebar, 'sidebar')
    // addClass(sidebar, 'active', className)
    toggleWindowScroll(false)
    addClass(burger, 'active')
    burger.dataset.type = 'close-menu'
}