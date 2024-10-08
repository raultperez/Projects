document.addEventListener('DOMContentLoaded', function () {

    var hamburguesa = document.getElementById('bandera');
    var header = document.querySelector('header');
    var nav = document.querySelector('nav');

    hamburguesa.addEventListener('change', function () {
        if (this.checked) {
            header.classList.add('header-expanded');
            nav.classList.add('nav-expanded');
        } else {
            header.classList.remove('header-expanded');
            nav.classList.remove('nav-expanded');
        }
    });

});
