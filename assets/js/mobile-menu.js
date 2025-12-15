(function() {
    'use strict';

    const mobileMenuBtn = document.querySelector('.header__mobile-menu');
    const mobileMenu = document.querySelector('.mobile-menu');
    const mobileMenuClose = document.querySelector('.mobile-menu__close');
    const mobileMenuOverlay = document.querySelector('.mobile-menu__overlay');
    const body = document.body;

    if (!mobileMenuBtn || !mobileMenu) {
        return;
    }

    function openMenu() {
        mobileMenu.classList.add('mobile-menu--open');
        body.style.overflow = 'hidden';
    }

    function closeMenu() {
        mobileMenu.classList.remove('mobile-menu--open');
        body.style.overflow = '';
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
})();

