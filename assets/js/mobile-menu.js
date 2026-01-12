(function() {
    'use strict';

    const mobileMenuBtn = document.querySelector('.header__mobile-menu');
    const mobileMenu = document.querySelector('.mobile-menu');
    const mobileMenuClose = document.querySelector('.mobile-menu__close');
    const mobileMenuOverlay = document.querySelector('.mobile-menu__overlay');
    const mobileMenuBack = document.querySelector('.mobile-menu__back');
    const mobileMenuTitle = document.querySelector('.mobile-menu__title');
    const body = document.body;

    if (!mobileMenuBtn || !mobileMenu) {
        return;
    }

    const panels = mobileMenu.querySelectorAll('.mobile-menu__panel');
    const rootPanel = mobileMenu.querySelector('#mobileMenuRoot');
    let stack = rootPanel ? [rootPanel] : [];

    function showPanel(panel) {
        if (!panel) return;

        panels.forEach(p => {
            p.hidden = (p !== panel);
        });

        if (mobileMenuTitle) {
            mobileMenuTitle.textContent = panel.dataset.title || 'Меню';
        }

        if (mobileMenuBack) {
            mobileMenuBack.hidden = (panel === rootPanel);
        }
    }

    function openMenu() {
        mobileMenu.classList.add('mobile-menu--open');
        body.style.overflow = 'hidden';

        if (rootPanel) {
            stack = [rootPanel];
            showPanel(rootPanel);
        }
    }

    function closeMenu() {
        mobileMenu.classList.remove('mobile-menu--open');
        body.style.overflow = '';

        if (rootPanel) {
            stack = [rootPanel];
            showPanel(rootPanel);
        }
    }

    mobileMenuBtn.addEventListener('click', openMenu);
    
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', closeMenu);
    }
    
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', closeMenu);
    }

    // Закрытие меню при клике на ссылку
    const menuLinks = document.querySelectorAll('.mobile-menu__link');
    menuLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    mobileMenu.addEventListener('click', function(e) {
        const next = e.target.closest('.mobile-menu__next');
        if (next) {
            const sel = next.getAttribute('data-target');
            if (!sel) return;
            const target = mobileMenu.querySelector(sel);
            if (!target) return;
            stack.push(target);
            showPanel(target);
        }
    });

    if (mobileMenuBack) {
        mobileMenuBack.addEventListener('click', function() {
            if (!rootPanel) return;
            if (stack.length > 1) {
                stack.pop();
                showPanel(stack[stack.length - 1]);
            }
        });
    }
})();




