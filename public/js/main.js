document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelector('.menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');

    menuToggle.addEventListener('click', function () {
        mobileMenu.classList.toggle('active');
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) {
            mobileMenu.classList.remove('active');
        }
    });
});
