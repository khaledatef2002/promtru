import { request } from './../../front/js/utils.js';

class WebsiteSettingManager {
    constructor() {
        this.edit_form = document.querySelector("form#edit-website-settings-form")
        if(this.edit_form) {
            this.edit_form.addEventListener("submit", this.edit.bind(this))
        }
    }


    async edit(e) {
        e.preventDefault()

        this.edit_form.querySelector("button[type='submit']").setAttribute("disabled", "disabled")
        
        const formData = new FormData(this.edit_form)

        const response = await request(`/dashboard/website_setting/1`, 'PUT', formData)
        if(response.success) {
            this.show_success(response.data.message)
        } else {
            this.show_error(response.message)
        }
        this.edit_form.querySelector("button[type='submit']").removeAttribute("disabled")
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

export default new WebsiteSettingManager();