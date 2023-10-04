import Menu from "../components/Menu";

export default function mobileMenu() {
    const burger = document.querySelector('[data-burger]'),
        menu = document.querySelector('[data-mobile-menu]'),
        header = document.querySelector('[data-header]')

    if(burger && menu) {
        window.mobileMenu = new Menu(menu, burger, header)
    }
}