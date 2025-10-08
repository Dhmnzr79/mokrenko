document.addEventListener('DOMContentLoaded', function() {
  const galleryItems = document.querySelectorAll('[data-lightbox="gallery"]');
  
  if (galleryItems.length === 0) return;
  
  const lightbox = document.createElement('div');
  lightbox.className = 'lightbox';
  lightbox.innerHTML = `
    <button class="lightbox__close" aria-label="Закрыть">&times;</button>
    <button class="lightbox__prev" aria-label="Предыдущее">‹</button>
    <div class="lightbox__content">
      <img src="" alt="" class="lightbox__image">
    </div>
    <button class="lightbox__next" aria-label="Следующее">›</button>
  `;
  document.body.appendChild(lightbox);
  
  const lightboxImage = lightbox.querySelector('.lightbox__image');
  const closeBtn = lightbox.querySelector('.lightbox__close');
  const prevBtn = lightbox.querySelector('.lightbox__prev');
  const nextBtn = lightbox.querySelector('.lightbox__next');
  
  let currentIndex = 0;
  const images = Array.from(galleryItems).map(item => ({
    src: item.href,
    alt: item.querySelector('img').alt
  }));
  
  function openLightbox(index) {
    currentIndex = index;
    lightboxImage.src = images[index].src;
    lightboxImage.alt = images[index].alt;
    lightbox.classList.add('lightbox--active');
    document.body.style.overflow = 'hidden';
  }
  
  function closeLightbox() {
    lightbox.classList.remove('lightbox--active');
    document.body.style.overflow = '';
  }
  
  function showPrev() {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    lightboxImage.src = images[currentIndex].src;
    lightboxImage.alt = images[currentIndex].alt;
  }
  
  function showNext() {
    currentIndex = (currentIndex + 1) % images.length;
    lightboxImage.src = images[currentIndex].src;
    lightboxImage.alt = images[currentIndex].alt;
  }
  
  galleryItems.forEach((item, index) => {
    item.addEventListener('click', function(e) {
      e.preventDefault();
      openLightbox(index);
    });
  });
  
  closeBtn.addEventListener('click', closeLightbox);
  prevBtn.addEventListener('click', showPrev);
  nextBtn.addEventListener('click', showNext);
  
  lightbox.addEventListener('click', function(e) {
    if (e.target === lightbox) {
      closeLightbox();
    }
  });
  
  document.addEventListener('keydown', function(e) {
    if (!lightbox.classList.contains('lightbox--active')) return;
    
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') showPrev();
    if (e.key === 'ArrowRight') showNext();
  });
});

