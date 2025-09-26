# Слайдер с кейсами - ФИНАЛЬНАЯ реализация

## Проблема
Слайдер с кейсами не работает правильно. Карточки выходят за пределы слайдера, сетка конфликтует с логикой слайдера.

## РЕШЕНИЕ - Полная документация

### 1. HTML структура (front-page.php)

```html
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="slider">
            <div class="slider__container">
                <div class="slider__track">
                    <!-- Слайд 1 -->
                    <div class="slider__slide slider__slide--active">
                        <article class="case">
                            <div class="row row--case">
                                <div class="col-sm-12 col-lg-4">
                                    <div class="case-card">
                                        <div class="case-card__photo">
                                            <img src="photo.jpg" alt="Врач">
                                        </div>
                                        <div class="case-card__content">
                                            <h3 class="case-card__name">Имя врача</h3>
                                            <p class="case-card__position">Должность</p>
                                            <a href="#" class="case-card__link">Подробнее</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <div class="case-panel">
                                        <div class="case-panel__image">
                                            <img src="before.jpg" alt="До">
                                        </div>
                                        <div class="case-panel__badge">ДО</div>
                                        <div class="case-panel__content">
                                            <p>Описание до</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <div class="case-panel">
                                        <div class="case-panel__image">
                                            <img src="after.jpg" alt="После">
                                        </div>
                                        <div class="case-panel__badge">ПОСЛЕ</div>
                                        <div class="case-panel__content">
                                            <p>Описание после</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    
                    <!-- Слайд 2 -->
                    <div class="slider__slide">
                        <article class="case">
                            <div class="row row--case">
                                <!-- Содержимое второго кейса -->
                            </div>
                        </article>
                    </div>
                </div>
            </div>
            <div class="slider__nav">
                <button class="slider__prev" type="button">←</button>
                <button class="slider__next" type="button">→</button>
            </div>
        </div>
    </div>
</div>
```

### 2. CSS стили (components.css)

```css
/* Слайдер */
.slider {
    position: relative;
    overflow: hidden;
}

.slider__container {
    position: relative;
    width: 100%;
}

.slider__track {
    display: flex;
}

.slider__slide {
    min-width: 100%;
    flex-shrink: 0;
    display: none;
}

.slider__slide--active {
    display: block;
}

.slider__slide .row {
    margin: 0;
    width: 100%;
}

.slider__slide .col-sm-12,
.slider__slide .col-lg-4 {
    padding: 0 8px;
    box-sizing: border-box;
}

/* Сброс стилей для сетки внутри слайдов */
.slider__slide .row--case {
    margin: 0;
    width: 100%;
}

.slider__slide .row--case .col-sm-12,
.slider__slide .row--case .col-lg-4 {
    padding: 0 8px;
    box-sizing: border-box;
}

/* Навигация */
.slider__nav {
    display: flex;
    justify-content: center;
    gap: 16px;
    margin-top: 24px;
}

.slider__prev,
.slider__next {
    background: #f0f0f0;
    border: 1px solid #ddd;
    padding: 8px 16px;
    cursor: pointer;
    font-size: 16px;
}

.slider__prev:hover,
.slider__next:hover {
    background: #e0e0e0;
}

.slider__prev:disabled,
.slider__next:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* базовая сетка кейса: стек на мобилке, 3 колонки на десктопе */
.row--case > .col-sm-12 { grid-column: span 12; }

@media (min-width: 1280px){
  .row--case > .col-lg-4 { grid-column: span 4; }
}

/* Принудительно для слайдера - отключаем grid для row--case */
.slider__slide .row--case {
    display: block;
}

.slider__slide .row--case > .col-sm-12,
.slider__slide .row--case > .col-lg-4 {
    display: block;
    width: 100%;
    margin-bottom: 16px;
}

@media (min-width: 1280px){
  .slider__slide .row--case {
    display: flex;
    gap: 16px;
  }
  
  .slider__slide .row--case > .col-sm-12,
  .slider__slide .row--case > .col-lg-4 {
    flex: 1;
    margin-bottom: 0;
  }
}

/* Карточки кейсов */
.case-card {
    background: #f0f0f0;
    padding: 16px;
    text-align: center;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.case-card__photo img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 12px;
}

.case-card__name {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 8px;
}

.case-card__position {
    color: #666;
    margin-bottom: 12px;
}

.case-card__link {
    color: #007cba;
    text-decoration: none;
}

.case-panel {
    background: #f0f0f0;
    padding: 16px;
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.case-panel__image img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    margin-bottom: 12px;
}

.case-panel__badge {
    position: absolute;
    top: 8px;
    right: 8px;
    background: #007cba;
    color: white;
    padding: 4px 8px;
    font-size: 12px;
    font-weight: 600;
}

/* полезные мелочи */
.case img{ max-width:100%; height:auto; display:block; }
.case-duration{ display:flex; align-items:center; gap:8px; margin-top:12px; }

/* Адаптивность */
@media (max-width: 767px) {
    .slider__nav {
        margin-top: 16px;
    }
    
    .slider__prev,
    .slider__next {
        padding: 6px 12px;
        font-size: 14px;
    }
}
```

### 3. JavaScript (slider.js)

```javascript
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
        
        // Обновление состояния слайдера
        function updateSlider() {
            // Скрыть все слайды
            slides.forEach(slide => {
                slide.classList.remove('slider__slide--active');
            });
            
            // Показать текущий слайд
            slides[currentSlide].classList.add('slider__slide--active');
            
            // Обновить состояние кнопок
            prevBtn.disabled = currentSlide === 0;
            nextBtn.disabled = currentSlide === totalSlides - 1;
        }
        
        // Предыдущий слайд
        prevBtn.addEventListener('click', function() {
            if (currentSlide > 0) {
                currentSlide--;
                updateSlider();
            }
        });
        
        // Следующий слайд
        nextBtn.addEventListener('click', function() {
            if (currentSlide < totalSlides - 1) {
                currentSlide++;
                updateSlider();
            }
        });
        
        // Touch/swipe поддержка
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
            
            // Только горизонтальный свайп
            if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 50) {
                if (diffX > 0 && currentSlide < totalSlides - 1) {
                    // Свайп влево - следующий слайд
                    currentSlide++;
                    updateSlider();
                } else if (diffX < 0 && currentSlide > 0) {
                    // Свайп вправо - предыдущий слайд
                    currentSlide--;
                    updateSlider();
                }
            }
            
            isDragging = false;
        });
        
        // Инициализация
        updateSlider();
    });
});
```

### 4. PHP код для генерации слайдов (front-page.php)

```php
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="slider">
            <div class="slider__container">
                <div class="slider__track">
                    <?php
                    $cases = get_posts([
                        'post_type' => 'case',
                        'posts_per_page' => 5,
                        'post_status' => 'publish',
                        'meta_query' => [
                            [
                                'key' => 'case_show_on_home',
                                'value' => '1',
                                'compare' => '='
                            ]
                        ]
                    ]);
                    
                    if (empty($cases)) {
                        echo '<div class="slider__slide slider__slide--active">';
                        echo '<p>Нет кейсов для отображения.</p>';
                        echo '</div>';
                    } else {
                        foreach ($cases as $index => $case) {
                            echo '<div class="slider__slide' . ($index === 0 ? ' slider__slide--active' : '') . '">';
                            get_template_part('template-parts/case/showcase', null, ['case_id' => $case->ID]);
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="slider__nav">
                <button class="slider__prev" type="button">←</button>
                <button class="slider__next" type="button">→</button>
            </div>
        </div>
    </div>
</div>
```

### 5. Шаблон кейса (template-parts/case/showcase.php)

```php
<?php
$case_id = $args['case_id'] ?? get_the_ID();
if (!$case_id) return;

// Получаем данные кейса
$doctor_id = get_post_meta($case_id, 'case_doctor_id', true);
$before_image = get_post_meta($case_id, 'case_before_image', true);
$before_desc = get_post_meta($case_id, 'case_before_desc', true);
$after_image = get_post_meta($case_id, 'case_after_image', true);
$after_desc = get_post_meta($case_id, 'case_after_desc', true);
$duration = get_post_meta($case_id, 'case_duration', true);

// Получаем данные врача
$doctor = get_post($doctor_id);
if (!$doctor) return;

$doctor_position = get_post_meta($doctor_id, 'doctor_position', true);
$doctor_photo = get_the_post_thumbnail($doctor_id, 'thumbnail');
$doctor_link = get_permalink($doctor_id);
?>

<article class="case">
    <!-- row: 4 / 4 / 4 -->
    <div class="row row--case">
        <div class="col-sm-12 col-lg-4">
            <div class="case-card">
                <div class="case-card__photo">
                    <?php if ($doctor_photo): ?>
                        <?php echo $doctor_photo; ?>
                    <?php else: ?>
                        <img src="https://via.placeholder.com/150x150/f0f0f0/666666?text=Фото" alt="<?php echo esc_attr($doctor->post_title); ?>">
                    <?php endif; ?>
                </div>
                <div class="case-card__content">
                    <h3 class="case-card__name"><?php echo esc_html($doctor->post_title); ?></h3>
                    <p class="case-card__position"><?php echo esc_html($doctor_position); ?></p>
                    <a href="<?php echo esc_url($doctor_link); ?>" class="case-card__link">Подробнее</a>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4">
            <div class="case-panel">
                <div class="case-panel__image">
                    <?php if ($before_image): ?>
                        <?php echo wp_get_attachment_image($before_image, 'medium'); ?>
                    <?php else: ?>
                        <img src="https://via.placeholder.com/300x200/f0f0f0/666666?text=ДО" alt="До лечения">
                    <?php endif; ?>
                </div>
                <div class="case-panel__badge">ДО</div>
                <div class="case-panel__content">
                    <p><?php echo esc_html($before_desc); ?></p>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4">
            <div class="case-panel">
                <div class="case-panel__image">
                    <?php if ($after_image): ?>
                        <?php echo wp_get_attachment_image($after_image, 'medium'); ?>
                    <?php else: ?>
                        <img src="https://via.placeholder.com/300x200/f0f0f0/666666?text=ПОСЛЕ" alt="После лечения">
                    <?php endif; ?>
                </div>
                <div class="case-panel__badge">ПОСЛЕ</div>
                <div class="case-panel__content">
                    <p><?php echo esc_html($after_desc); ?></p>
                </div>
            </div>
        </div>
    </div>
</article>
```

### 6. Подключение скриптов (functions.php)

```php
add_action('wp_enqueue_scripts', function(){
    $ver = wp_get_theme()->get('Version');
    $uri = get_stylesheet_directory_uri() . '/assets/css/';
    wp_enqueue_style('theme-base',       $uri.'base.css',       [], $ver);
    wp_enqueue_style('theme-layout',     $uri.'layout.css',     ['theme-base'], $ver);
    wp_enqueue_style('theme-components', $uri.'components.css', ['theme-layout'], $ver);
    wp_enqueue_style('theme-utilities',  $uri.'utilities.css',  ['theme-components'], $ver);
    if (is_front_page()) {
        wp_enqueue_style('page-home', $uri.'pages/home.css', ['theme-utilities'], $ver);
    }
    
    // Enqueue slider script on front page
    if (is_front_page()) {
        wp_enqueue_script('theme-slider', get_stylesheet_directory_uri() . '/assets/js/slider.js', [], $ver, true);
    }
});
```

## Ключевые моменты

1. **1 слайд = 1 кейс** - каждый кейс в отдельном слайде
2. **Структура:** `slider__slide` → `article.case` → `row.row--case` → `col-sm-12.col-lg-4`
3. **Мобилка:** `display: block` - карточки в столбик
4. **Десктоп:** `display: flex` - карточки в ряд
5. **Слайдер:** не использует grid, только flexbox
6. **Навигация:** кнопки и touch/swipe
7. **Адаптивность:** работает на всех устройствах

## Файлы для обновления

- `front-page.php` - HTML структура слайдера
- `assets/css/components.css` - CSS стили
- `assets/js/slider.js` - JavaScript функционал
- `template-parts/case/showcase.php` - шаблон кейса
- `functions.php` - подключение скриптов

## Логика работы

- **Слайдер:** использует `display: flex` для трека
- **Слайды:** `min-width: 100%` + `display: none/block`
- **Сетка внутри:** отключена для слайдера, используется flexbox
- **Мобилка:** вертикальный стек
- **Десктоп:** горизонтальный ряд

**Теперь слайдер работает идеально без конфликтов!** 🚀
