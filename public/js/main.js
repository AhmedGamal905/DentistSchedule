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
document.querySelectorAll('.logout-link').forEach(function (element) {
    element.addEventListener('click', function (event) {
        event.preventDefault();
        document.getElementById('logout-form').submit();
    });
});