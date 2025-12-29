/**
 * Управление попапами для стоматологической клиники
 */

// Глобальные переменные
let currentPopup = null;
let isClosing = false;

/**
 * Открытие попапа
 * @param {string} popupId - ID попапа для открытия
 */
function openPopup(popupId = 'popup-1') {
    if (isClosing) return;
    
    const popup = document.getElementById(popupId);
    if (!popup) return;
    
    currentPopup = popup;
    
    // Блокируем скролл
    document.body.classList.add('popup-open');
    
    // Показываем попап
    popup.classList.add('show');
    
    // Фокус на первое поле
    setTimeout(() => {
        const firstField = popup.querySelector('input');
        if (firstField) firstField.focus();
    }, 300);
    
    // Обработчики событий
    setupPopupEvents(popup);
}

/**
 * Закрытие попапа
 */
function closePopup() {
    if (!currentPopup || isClosing) return;
    
    isClosing = true;
    
    // Анимация закрытия
    currentPopup.classList.add('closing');
    
    setTimeout(() => {
        currentPopup.classList.remove('show', 'closing');
        document.body.classList.remove('popup-open');
        currentPopup = null;
        isClosing = false;
    }, 280);
}

/**
 * Настройка обработчиков событий для попапа
 * @param {HTMLElement} popup - Элемент попапа
 */
function setupPopupEvents(popup) {
    // Закрытие по клику на overlay
    popup.addEventListener('click', (e) => {
        if (e.target === popup) {
            closePopup();
        }
    });
    
    // Закрытие по Escape
    document.addEventListener('keydown', handleEscape);
    
    // Закрытие по клику на кнопку закрытия
    const closeBtn = popup.querySelector('.popup-close');
    if (closeBtn) {
        closeBtn.addEventListener('click', closePopup);
    }
    
    // Обработка формы
    const form = popup.querySelector('.popup-form');
    if (form) {
        form.addEventListener('submit', handleFormSubmit);
    }
}

/**
 * Обработка нажатия Escape
 * @param {KeyboardEvent} e - Событие клавиатуры
 */
function handleEscape(e) {
    if (e.key === 'Escape' && currentPopup) {
        closePopup();
    }
}

/**
 * Обработка отправки формы
 * @param {Event} e - Событие формы
 */
function handleFormSubmit(e) {
    e.preventDefault();
    
    const form = e.target;
    const formData = new FormData(form);
    
    // Валидация
    if (!validateForm(formData)) {
        return;
    }
    
    // Отправка данных (здесь будет AJAX запрос)
    submitForm(formData);
}

/**
 * Валидация формы
 * @param {FormData} formData - Данные формы
 * @returns {boolean} - Результат валидации
 */
function validateForm(formData) {
    const name = formData.get('name');
    const phone = formData.get('phone');
    
    // Проверка имени
    if (!name || name.trim().length < 2) {
        showError('Введите корректное имя');
        return false;
    }
    
    // Проверка телефона
    const phoneRegex = /^\+7\s?\(?(\d{3})\)?\s?(\d{3})-?(\d{2})-?(\d{2})$/;
    if (!phone || !phoneRegex.test(phone.replace(/\s/g, ''))) {
        showError('Введите корректный номер телефона');
        return false;
    }
    
    return true;
}

/**
 * Отправка формы
 * @param {FormData} formData - Данные формы
 */
function submitForm(formData) {
    // Показываем индикатор загрузки
    const submitBtn = currentPopup.querySelector('.popup-cta');
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Отправляем...';
    submitBtn.disabled = true;
    
    // Здесь будет AJAX запрос
    // Пока что имитируем отправку
    setTimeout(() => {
        submitBtn.textContent = 'Отправлено!';
        
        setTimeout(() => {
            closePopup();
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        }, 1000);
    }, 1500);
}

/**
 * Показать ошибку
 * @param {string} message - Сообщение об ошибке
 */
function showError(message) {
    // Удаляем предыдущие ошибки
    const existingError = currentPopup.querySelector('.popup-error');
    if (existingError) {
        existingError.remove();
    }
    
    // Создаем элемент ошибки
    const error = document.createElement('div');
    error.className = 'popup-error';
    error.textContent = message;
    
    // Вставляем ошибку после формы
    const form = currentPopup.querySelector('.popup-form');
    form.appendChild(error);
    
    // Удаляем ошибку через 5 секунд
    setTimeout(() => {
        if (error.parentNode) {
            error.remove();
        }
    }, 5000);
}

/**
 * Маска для телефона
 */
function setupPhoneMask() {
    const phoneInputs = document.querySelectorAll('input[type="tel"]');
    
    phoneInputs.forEach(input => {
        input.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            
            if (value.length === 0) {
                e.target.value = '';
                return;
            }
            
            if (value.length === 1 && value[0] !== '7') {
                value = '7' + value;
            }
            
            if (value.length > 11) {
                value = value.slice(0, 11);
            }
            
            // Форматирование
            let formatted = '+7';
            if (value.length > 1) {
                formatted += ' (' + value.slice(1, 4);
                if (value.length > 4) {
                    formatted += ') ' + value.slice(4, 7);
                    if (value.length > 7) {
                        formatted += '-' + value.slice(7, 9);
                        if (value.length > 9) {
                            formatted += '-' + value.slice(9, 11);
                        }
                    }
                }
            }
            
            e.target.value = formatted;
        });
    });
}

// Инициализация при загрузке страницы
document.addEventListener('DOMContentLoaded', () => {
    setupPhoneMask();
    
    // Добавляем обработчики на все кнопки с data-popup
    document.querySelectorAll('[data-popup="open"]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            openPopup();
        });
    });
    
    // Добавляем обработчики на все ссылки услуг для открытия popup-2
    document.querySelectorAll('.service-link').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            openPopup('popup-2');
        });
    });
    
    // Обработка успешной отправки CF7 формы
    document.addEventListener('wpcf7mailsent', function(event) {
        const form = event.target;
        const popup = form.closest('.popup-overlay');
        
        // Получаем URL страницы благодарности из data-атрибута или используем дефолтный
        const thankYouUrl = document.body.dataset.thankYouUrl || '/thank-you/';
        
        if (popup) {
            // Если форма в попапе - закрываем попап и делаем редирект
            setTimeout(() => {
                closePopup();
                window.location.href = thankYouUrl;
            }, 1000);
        } else {
            // Если форма не в попапе (на странице) - просто делаем редирект
            setTimeout(() => {
                window.location.href = thankYouUrl;
            }, 1000);
        }
    }, false);
});

// Экспорт функций для использования в HTML
window.openPopup = openPopup;
window.closePopup = closePopup;





