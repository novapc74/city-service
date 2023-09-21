import toggleWindowScroll from "../utils/toggleWindowScroll";
import {addClass, removeClass} from "../utils/classMethods";

export class Popup {
    constructor(classname, initiator) {
        this.popup = document.querySelector(classname)
        this.overlay = this.popup.querySelector('.default-popup__overlay')
        this.closeBtn = this.popup.querySelector('.default-popup__close-btn')
        this.cancelBtn = this.popup.querySelector('.default-popup__cancel-btn')
        this.initiator = initiator

        this.openFn = null
        this.closeFn = null

        this.init()
    }

    init() {
        const closeItems = [this.overlay, this.closeBtn, this.cancelBtn]

        document.addEventListener('click', evt => {
            if(evt.target.closest(`[data-open-modal="${this.initiator}"]`)) this.#handleOpenPopup(evt)
        })

        closeItems.forEach(el => {
            el && el.addEventListener('click', this.#handleClosePopup)
        })
    }

    #handleOpenPopup(evt) {
        evt.preventDefault()
        this.open(evt)
    }
    #handleClosePopup(evt) {
        evt.preventDefault()
        this.close(evt)
    }
    open(evt = null) {
        this.popup.style.display = 'block'
        setTimeout(() => addClass(this.popup, 'active'))
        toggleWindowScroll(0)
        this.openFn && this.openFn(evt)
    }
    close(evt = null) {
        removeClass(this.popup, 'active')
        setTimeout(() => (this.popup.style.display = 'none'), 400)
        toggleWindowScroll(1)
        this.closeFn && this.closeFn(evt)
    }
}