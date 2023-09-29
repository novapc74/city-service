import axios from "axios";

export default class Form {
    constructor(parent) {
        this.parent = parent
        this.init()
    }

    init() {
        axios.get(`/feedback/${this.parent.dataset.form}`, {
            headers: {
                "X-Requested-With": 'XMLHttpRequest'
            }
        }).then(({ data }) => {
            this.parent.innerHTML = data
        })
    }
}