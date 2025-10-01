import { request } from './../../front/js/utils.js';
import RemoveManager from './remove-module.js'
class PartnersManager {
    constructor() {
        this.create_form = document.querySelector("form#create-partner-form")
        if(this.create_form) {
            this.create_form.addEventListener("submit", this.create.bind(this))
        }

        this.edit_form = document.querySelector("form#edit-partner-form")
        if(this.edit_form) {
            this.edit_form.addEventListener("submit", this.edit.bind(this))
        }
        
        RemoveManager.addListener(this.remove.bind(this))
    }

    async remove(id)
    {
        const response = await request(`/dashboard/partners/${id}`, 'DELETE')
        if(response.success) {
            this.show_success(response.data.message)
            table.ajax.reload(null, false)
        } else {
            this.show_error(response.message)
        }
    }

    async create(e) {
        e.preventDefault()
        this.create_form.querySelector("button[type='submit']").setAttribute("disabled", "disabled")
        
        const formData = new FormData(this.create_form)

        const response = await request('/dashboard/partners', 'POST', formData)
        if(response.success) {
            this.show_success(response.data.message)
            document.querySelectorAll("input").forEach(input => input.value = "")
            document.querySelectorAll("#product-img").forEach(img => img.src = "")
        } else {
            this.show_error(response.message)
        }
        this.create_form.querySelector("button[type='submit']").removeAttribute("disabled")
    }

    async edit(e) {
        e.preventDefault()

        const id = this.edit_form.getAttribute("data-id")

        this.edit_form.querySelector("button[type='submit']").setAttribute("disabled", "disabled")
        
        const formData = new FormData(this.edit_form)

        const response = await request(`/dashboard/partners/${id}`, 'PUT', formData)
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

export default new PartnersManager();