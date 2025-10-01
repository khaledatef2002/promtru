import { request } from '../../front/js/utils.js';

class AuthManager {
    constructor() {
        this.login_form = document.querySelector("#login-form")
        if (this.login_form) {
            this.login_form.addEventListener("submit", this.login.bind(this))
            this.login_button = this.login_form.querySelector("button[type='submit']")
        }
    }

    async login(e) {
        e.preventDefault()

        this.login_button.setAttribute("disabled", "disabled")
        const formData = new FormData(this.login_form)

        const response = await request(`/dashboard/login`, 'POST', formData)
        if(response.success) {
            this.show_success(response.data.message)
            location.reload()
        } else {
            this.show_error(response.message)
            this.login_button.removeAttribute("disabled")
        }
    }

    show_success(message) {
        Swal.fire({
            title: "تم بنجاح",
            text: message,
            icon: "success"
        });         
    }

    show_error(message) {
        Swal.fire({
            title: "حدث خطاْ",
            text: message,
            icon: "error"
        });         
    }
}

export default new AuthManager();