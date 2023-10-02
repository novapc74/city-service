import Menu from "../components/Menu";

export default function mobileMenu() {
    const burger = document.querySelector('[data-burger]'),
        menu = document.querySelector('[data-mobile-menu]'),
        logo = document.querySelector('[data-logo]')

    console.log(burger, menu)
    if(burger && menu) {
        window.mobileMenu = new Menu(menu, burger, logo)
    }
}