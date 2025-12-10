/**
 * Slider functionality
 * Simple slider without autoplay
 */

document.addEventListener('DOMContentLoaded', function() {
    const sliders = document.querySelectorAll('.slider');
    
    sliders.forEach(function(slider) {
        const track = slider.querySelector('.slider__track');
        const slides = slider.querySelectorAll('.slider__slide');
        const prevBtn = slider.querySelector('.slider__prev');
        const nextBtn = slider.querySelector('.slider__next');
        
        if (!track || !slides.length || !prevBtn || !nextBtn) return;
        
        const isCarousel = slider.classList.contains('slider--two') || slider.classList.contains('slider--social');
        let currentSlide = 0;
        const totalSlides = slides.length;
        
        // Для карусели: сколько карточек видно
        let visibleSlides = 1;
        if (isCarousel) {
            if (slider.classList.contains('slider--two')) {
                visibleSlides = window.innerWidth >= 768 ? 3 : 1;
            } else if (slider.classList.contains('slider--social')) {
                visibleSlides = window.innerWidth >= 768 ? 2 : 1;
            }
        }
        
        // Update slider state
        function updateSlider() {
            if (isCarousel) {
                // Карусель: сдвигаем track
                const slideWidth = slides[0].offsetWidth;
                const trackStyle = window.getComputedStyle(track);
                const gap = parseInt(trackStyle.gap) || 30;
                const offset = currentSlide * (slideWidth + gap);
                track.style.transform = `translateX(-${offset}px)`;
                
                // Update button states
                prevBtn.disabled = currentSlide === 0;
                nextBtn.disabled = currentSlide >= totalSlides - visibleSlides;
            } else {
                // Обычный слайдер: переключаем по --active
                slides.forEach((slide, index) => {
                    slide.classList.toggle('slider__slide--active', index === currentSlide);
                });
                
                // Update button states
                prevBtn.disabled = currentSlide === 0;
                nextBtn.disabled = currentSlide === totalSlides - 1;
            }
        }
        
        // Previous slide
        prevBtn.addEventListener('click', function() {
            if (currentSlide > 0) {
                currentSlide--;
                updateSlider();
            }
        });
        
        // Next slide
        nextBtn.addEventListener('click', function() {
            if (currentSlide < totalSlides - 1) {
                currentSlide++;
                updateSlider();
            }
        });
        
        // Touch/swipe support for mobile
        let startX = 0;
        let startY = 0;
        let isDragging = false;
        let moveX = 0;
        let moveY = 0;
        
        track.addEventListener('touchstart', function(e) {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
            moveX = startX;
            moveY = startY;
            isDragging = false; // Пока не определили направление
        }, {passive: true});
        
        track.addEventListener('touchmove', function(e) {
            moveX = e.touches[0].clientX;
            moveY = e.touches[0].clientY;
            
            const diffX = Math.abs(moveX - startX);
            const diffY = Math.abs(moveY - startY);
            
            // Определяем направление только после небольшого движения
            if (!isDragging && (diffX > 10 || diffY > 10)) {
                // Если движение больше горизонтальное - это наш свайп
                if (diffX > diffY) {
                    isDragging = true;
                    e.preventDefault();
                }
                // Иначе это вертикальный скролл - не трогаем
            }
            
            // Если уже определили что это горизонтальный свайп
            if (isDragging) {
                e.preventDefault();
            }
        });
        
        track.addEventListener('touchend', function(e) {
            if (!isDragging) return;
            
            const diffX = startX - moveX;
            const diffY = startY - moveY;
            
            // Only trigger if horizontal swipe is greater than vertical
            if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 50) {
                if (diffX > 0 && currentSlide < totalSlides - 1) {
                    // Swipe left - next slide
                    currentSlide++;
                    updateSlider();
                } else if (diffX < 0 && currentSlide > 0) {
                    // Swipe right - previous slide
                    currentSlide--;
                    updateSlider();
                }
            }
            
            isDragging = false;
        }, {passive: true});
        
        // Пересчитываем при изменении размера окна (для карусели)
        if (isCarousel) {
            window.addEventListener('resize', function() {
                let newVisibleSlides = 1;
                if (slider.classList.contains('slider--two')) {
                    newVisibleSlides = window.innerWidth >= 768 ? 3 : 1;
                } else if (slider.classList.contains('slider--social')) {
                    newVisibleSlides = window.innerWidth >= 768 ? 2 : 1;
                }
                
                if (newVisibleSlides !== visibleSlides) {
                    visibleSlides = newVisibleSlides;
                    // Корректируем текущий слайд если нужно
                    if (currentSlide > totalSlides - visibleSlides) {
                        currentSlide = Math.max(0, totalSlides - visibleSlides);
                    }
                    updateSlider();
                }
            });
        }
        
        // Initialize slider
        updateSlider();
    });
});
