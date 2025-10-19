document.addEventListener('DOMContentLoaded', function() {
  const allLightboxItems = document.querySelectorAll('[data-lightbox]');
  const videoItems = document.querySelectorAll('[data-lightbox="video"]');
  
  if (allLightboxItems.length === 0) return;
  
  const lightbox = document.createElement('div');
  lightbox.className = 'lightbox';
  lightbox.innerHTML = `
    <button class="lightbox__close" aria-label="Закрыть">&times;</button>
    <button class="lightbox__prev" aria-label="Предыдущее">‹</button>
    <div class="lightbox__content">
      <img src="" alt="" class="lightbox__image">
      <div class="lightbox__video"></div>
    </div>
    <button class="lightbox__next" aria-label="Следующее">›</button>
  `;
  document.body.appendChild(lightbox);
  
  const lightboxImage = lightbox.querySelector('.lightbox__image');
  const lightboxVideo = lightbox.querySelector('.lightbox__video');
  const closeBtn = lightbox.querySelector('.lightbox__close');
  const prevBtn = lightbox.querySelector('.lightbox__prev');
  const nextBtn = lightbox.querySelector('.lightbox__next');
  
  let currentIndex = 0;
  let currentGallery = [];
  
  function getYouTubeEmbedUrl(url) {
    const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
    const match = url.match(regExp);
    return (match && match[2].length === 11) ? `https://www.youtube.com/embed/${match[2]}?autoplay=1` : null;
  }
  
  function openLightbox(index, galleryGroup) {
    currentIndex = index;
    currentGallery = galleryGroup;
    lightboxImage.src = currentGallery[index].src;
    lightboxImage.alt = currentGallery[index].alt;
    lightboxImage.style.display = 'block';
    lightboxVideo.style.display = 'none';
    prevBtn.style.display = 'block';
    nextBtn.style.display = 'block';
    lightbox.classList.add('lightbox--active');
    document.body.style.overflow = 'hidden';
  }
  
  function openVideoLightbox(videoUrl) {
    const embedUrl = getYouTubeEmbedUrl(videoUrl);
    if (!embedUrl) return;
    
    lightboxImage.style.display = 'none';
    lightboxVideo.style.display = 'block';
    lightboxVideo.innerHTML = `<iframe src="${embedUrl}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>`;
    prevBtn.style.display = 'none';
    nextBtn.style.display = 'none';
    lightbox.classList.add('lightbox--active');
    document.body.style.overflow = 'hidden';
  }
  
  function closeLightbox() {
    lightbox.classList.remove('lightbox--active');
    lightboxVideo.innerHTML = '';
    prevBtn.style.display = 'block';
    nextBtn.style.display = 'block';
    document.body.style.overflow = '';
  }
  
  function showPrev() {
    currentIndex = (currentIndex - 1 + currentGallery.length) % currentGallery.length;
    lightboxImage.src = currentGallery[currentIndex].src;
    lightboxImage.alt = currentGallery[currentIndex].alt;
  }
  
  function showNext() {
    currentIndex = (currentIndex + 1) % currentGallery.length;
    lightboxImage.src = currentGallery[currentIndex].src;
    lightboxImage.alt = currentGallery[currentIndex].alt;
  }
  
  // Группируем элементы по значению data-lightbox
  const galleries = {};
  allLightboxItems.forEach(item => {
    const galleryName = item.dataset.lightbox;
    if (galleryName === 'video') return; // Пропускаем видео
    
    if (!galleries[galleryName]) {
      galleries[galleryName] = [];
    }
    galleries[galleryName].push(item);
  });
  
  // Добавляем обработчики для каждой галереи
  Object.keys(galleries).forEach(galleryName => {
    const items = galleries[galleryName];
    const galleryImages = items.map(item => ({
      src: item.href,
      alt: item.querySelector('img').alt
    }));
    
    items.forEach((item, index) => {
      item.addEventListener('click', function(e) {
        e.preventDefault();
        openLightbox(index, galleryImages);
      });
    });
  });
  
  videoItems.forEach(item => {
    item.addEventListener('click', function(e) {
      e.preventDefault();
      const videoUrl = item.getAttribute('href') || item.dataset.videoUrl;
      openVideoLightbox(videoUrl);
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

