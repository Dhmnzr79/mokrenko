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
        
        let currentSlide = 0;
        const totalSlides = slides.length;
        
        // Update slider state
        function updateSlider() {
            // Update slide visibility
            slides.forEach((slide, index) => {
                slide.classList.toggle('slider__slide--active', index === currentSlide);
            });
            
            // Update button states
            prevBtn.disabled = currentSlide === 0;
            nextBtn.disabled = currentSlide === totalSlides - 1;
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
        
        track.addEventListener('touchstart', function(e) {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
            isDragging = true;
        });
        
        track.addEventListener('touchmove', function(e) {
            if (!isDragging) return;
            e.preventDefault();
        });
        
        track.addEventListener('touchend', function(e) {
            if (!isDragging) return;
            
            const endX = e.changedTouches[0].clientX;
            const endY = e.changedTouches[0].clientY;
            const diffX = startX - endX;
            const diffY = startY - endY;
            
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
        });
        
        // Initialize slider
        updateSlider();
    });
});
