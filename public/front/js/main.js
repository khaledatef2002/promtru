function checkScroll() {
    const navbar = document.querySelector('.navbar');

    if (window.scrollY > 201) {
        navbar.classList.add('floating-nav');
    } else {
        navbar.classList.remove('floating-nav');
    }
}

window.addEventListener('DOMContentLoaded', checkScroll);
window.addEventListener('scroll', checkScroll);