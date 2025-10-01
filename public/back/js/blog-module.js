import { request } from '../../front/js/utils.js';
import RemoveManager from './remove-module.js'
class BlogController {
    constructor() {
        this.create_form = document.querySelector("form#create-blogs-form")
        if(this.create_form) {
            this.create_form.addEventListener("submit", this.create.bind(this))
        }

        this.edit_form = document.querySelector("form#edit-blogs-form")
        if(this.edit_form) {
            this.edit_form.addEventListener("submit", this.edit.bind(this))
        }
        
        RemoveManager.addListener(this.remove.bind(this))
    }

    async remove(id)
    {
        const response = await request(`/dashboard/blogs/${id}`, 'DELETE')
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

        images.forEach(image => {
            formData.append("images[]", image.id)
        });

        const response = await request('/dashboard/blogs', 'POST', formData)
        if(response.success) {
            this.show_success(response.data.message)
            
            location.href = response.data.redirectUrl
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

        images.forEach(image => {
            formData.append("images[]", image.id)
        });

        const response = await request(`/dashboard/blogs/${id}`, 'PUT', formData)

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

export default new BlogController();