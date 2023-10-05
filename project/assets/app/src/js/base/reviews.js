import Popup from "../components/Popup";

export default function reviews() {
    const reviewPopup = document.querySelector(`[data-modal="review-popup"]`)
    if (reviewPopup) {
        const openFn = (target, popup) => {
            popup.querySelector('.review-popup__image img').src = target.closest('[data-image]').dataset.image
        }
        const closeFn = (popup) => {
            popup.querySelector('.review-popup__image img').src = ''
        }
        new Popup(reviewPopup, {openFn: (evt) => openFn(evt.target, reviewPopup), closeFn: () => closeFn(reviewPopup)})
    }

}

