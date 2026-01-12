document.addEventListener('DOMContentLoaded', function () {
    const menus = document.querySelectorAll('.hero__menu-burger');
    if (!menus.length) return;

    menus.forEach(function (menu) {
        const btn = menu.querySelector('.hero__burger-btn');
        if (!btn) return;

        let dropdown = menu.querySelector('.services-dropdown');
        const controlsId = btn.getAttribute('aria-controls');
        if (!dropdown && controlsId) {
            dropdown = document.getElementById(controlsId);
        }
        if (!dropdown) return;

        const close = () => {
            dropdown.style.display = 'none';
            btn.setAttribute('aria-expanded', 'false');
        };

        const open = () => {
            dropdown.style.display = 'block';
            btn.setAttribute('aria-expanded', 'true');
        };

        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            const isOpen = dropdown.style.display === 'block';
            if (isOpen) close();
            else open();
        });

        document.addEventListener('click', function (e) {
            if (!dropdown.contains(e.target) && !btn.contains(e.target)) {
                close();
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                close();
            }
        });
    });
});


