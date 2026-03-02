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

        const categoryBtns = dropdown.querySelectorAll('.services-dropdown__category-btn');
        const panels = dropdown.querySelectorAll('.services-dropdown__panel');

        const close = function () {
            dropdown.style.display = 'none';
            btn.setAttribute('aria-expanded', 'false');
        };

        const open = function () {
            dropdown.style.display = 'flex';
            btn.setAttribute('aria-expanded', 'true');
        };

        categoryBtns.forEach(function (categoryBtn) {
            categoryBtn.addEventListener('click', function () {
                const panelId = categoryBtn.getAttribute('data-panel');
                if (!panelId) return;

                categoryBtns.forEach(function (b) {
                    b.classList.remove('services-dropdown__category-btn--active');
                });
                categoryBtn.classList.add('services-dropdown__category-btn--active');

                panels.forEach(function (panel) {
                    const isActive = panel.id === panelId;
                    panel.classList.toggle('services-dropdown__panel--active', isActive);
                    panel.setAttribute('aria-hidden', isActive ? 'false' : 'true');
                });
            });
        });

        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            const isOpen = dropdown.style.display === 'flex';
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
