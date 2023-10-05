import dropdowns from "./dropdowns";
import swipers from "./swipers";
import forms from "./forms";
import mobileMenu from "./mobileMenu";
import copy from "./copy";
import {addClass, removeClass} from "../utils/classMethods";
import reviews from "./reviews";
document.addEventListener('DOMContentLoaded', () => {
    mobileMenu()
    dropdowns()
    reviews()
    swipers()
    forms()
    copy()

    if(document.querySelector('[data-header]')) {
        let scrollValue = 0
        const header = document.querySelector('[data-header]')
        window.addEventListener('scroll', (evt) => {
            const st = window.scrollY || document.documentElement.scrollTop
            st > scrollValue ? addClass(header, 'hidden') : removeClass(header, 'hidden')
            scrollValue = st === 0 ? 0 : st;
        })
    }
})