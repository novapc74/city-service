import axios from "axios";
import {validateForm} from "../utils/validateForm";
export default class Form {
    constructor(parent, popups = null) {
        this.parent = parent
        this.formPopup = popups?.form
        this.responsePopup = popups?.response
        this.url = `/feedback/${this.parent.dataset.form}`
        this.options = {
            headers: {
                "X-Requested-With": 'XMLHttpRequest'
            }
        }
        this.form = null
        this.validation = null
        this.successMessage = 'Спасибо! Заявка отправлена.'
        this.errorMessage = 'Пожалуйста, проверьте введенные данные и повторите попытку позже. Если проблема сохраняется, свяжитесь с нами напрямую для получения дополнительной помощи.'
        this.init()
    }

    init() {
        this.getForm()
    }

    getForm() {
        axios.get(this.url, this.options).then(({data}) => {
            this.parent.innerHTML = data
            this.form = this.parent.querySelector('form')
            this.validate(this.form)
        }).catch(error => console.log(error))
    }

    validate(form) {
        this.validation = validateForm(form)
        this.validation.onSuccess(() => {
            this.send()
            this.validation.refresh()
        })
    }

    send() {
        const formData = new FormData(this.form)
        axios.post(this.url, formData, this.options).then(({data}) => {
            if (data.success) {
                console.log(this.successMessage)

                // message.textContent = messageSuccess
            } else {
                console.log(this.errorMessage)
                // message.textContent = messageError
            }

            this.getForm()
        }).catch((e) => {
            console.log(e)
            console.log(this.errorMessage)
            // message.textContent = messageError
        })
        this.formPopup && this.formPopup.close()
        this.responsePopup && this.responsePopup.open()
    }
}