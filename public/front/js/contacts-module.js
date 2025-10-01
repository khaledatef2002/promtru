import { request } from './utils.js'

class ContactsController {
    constructor() {
        this.send_contacts_form = document.querySelector("#send-contacts")
        if (this.send_contacts_form) {
            this.send_contacts_form.addEventListener("submit", this.send_contacts.bind(this))
            this.send_contacts_button = this.send_contacts_form.querySelector("button[type='submit']")
        }
    }

    async send_contacts(e) {
        e.preventDefault()
        
        this.send_contacts_button.setAttribute("disabled", "disabled")
        const formData = new FormData(this.send_contacts_form)
        console.log(this.send_contacts_form)

        const response = await request(`/contacts`, 'POST', formData)
        if(response.success) {
            this.show_success(response.data.message)
            this.send_contacts_form.querySelectorAll('input:not([type="submit"])').forEach(input => input.value = '')
            this.send_contacts_form.querySelector('textarea').value = ''
        } else {
            this.show_error(response.message)
        }
        this.send_contacts_button.removeAttribute("disabled")
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

export default new ContactsController()