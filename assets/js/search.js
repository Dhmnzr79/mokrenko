// Поиск в меню
document.addEventListener('DOMContentLoaded', function() {
    const searchBtn = document.querySelector('.hero__search-btn');
    const searchContainer = document.querySelector('.hero__menu-search');
    
    if (searchBtn && searchContainer) {
        // Создаем выпадающее меню
        const dropdown = document.createElement('div');
        dropdown.className = 'search__dropdown';
        dropdown.innerHTML = `
            <form class="search__form" method="get" action="/">
                <input type="search" name="s" placeholder="Поиск по сайту..." class="search__input">
                <button type="submit" class="search__submit">
                    <img src="/mokrenko/wp-content/themes/mokrenko/assets/svg/link_arrow_1.svg" alt="Найти" class="search__icon">
                </button>
            </form>
        `;
        searchContainer.appendChild(dropdown);
        
        searchBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            
            if (dropdown.style.display === 'block') {
                const input = dropdown.querySelector('.search__input');
                if (input) input.focus();
            }
        });
        
        // Закрытие при клике вне
        document.addEventListener('click', function(e) {
            if (!searchContainer.contains(e.target)) {
                dropdown.style.display = 'none';
            }
        });
        
        // Закрытие по Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                dropdown.style.display = 'none';
            }
        });
    }
});
