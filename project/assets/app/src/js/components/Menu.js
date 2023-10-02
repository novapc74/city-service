import toggleWindowScroll from "../utils/toggleWindowScroll";
import {addClass, removeClass} from "../utils/classMethods";

export default class Menu {
    constructor(menu, burger, logo = null) {
        this.menu = menu
        this.burger = burger
        this.logo = logo
        this.opened = false

        this.init()
    }

    init() {
        this.burger.addEventListener('click', () => {
            this.opened ? this.close() : this.open()
        })
    }

    close() {
        removeClass(this.burger, 'active')
        removeClass(this.menu, 'active')
        removeClass(this.logo, 'active')
        toggleWindowScroll(true)
        this.opened = false
    }

    open() {
        addClass(this.burger, 'active')
        addClass(this.menu, 'active')
        addClass(this.logo, 'active')
        toggleWindowScroll(false)
        this.opened = true
    }
}
