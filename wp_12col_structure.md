# WP структура и шаблон: 12-колоночная сетка

Цель: быстрый старт темы/чайлд-темы с 12-колоночной флюидной сеткой.
Брейки: **768 / 1280 / 1400**. Gap на десктопе: **30px**. Типографика: **h2 = 44px**, **h3 = 22px**.

## Структура папок (минимум)
```
/assets/css/
  base.css
  layout.css
  components.css
  utilities.css
  pages/
    home.css
    blog.css
```

## Подключение стилей (фрагмент `functions.php`)
```php
<?php
add_action('wp_enqueue_scripts', function () {
  $ver = wp_get_theme()->get('Version');
  $uri = get_stylesheet_directory_uri() . '/assets/css/';

  wp_enqueue_style('theme-base',       $uri.'base.css',       [], $ver);
  wp_enqueue_style('theme-layout',     $uri.'layout.css',     ['theme-base'], $ver);
  wp_enqueue_style('theme-components', $uri.'components.css', ['theme-layout'], $ver);
  wp_enqueue_style('theme-utilities',  $uri.'utilities.css',  ['theme-components'], $ver);
});
```

## `base.css` (переменные, reset, типографика)
```css
:root{
  --brk-sm: 768px;
  --brk-lg: 1280px;
  --brk-xl: 1400px;

  --container-max: 1400px;
  --gutter-mob: 16px;
  --gutter-desk: 24px;

  --col-gap-mob: 16px;
  --col-gap-desk: 30px; /* десктопный gap */
}

html { box-sizing: border-box; }
*,*::before,*::after { box-sizing: inherit; }

body { margin:0; font-family: system-ui, -apple-system, Segoe UI, Roboto, Inter, Arial, sans-serif; line-height:1.5; color:#111; }

/* Заголовки (десктопные размеры обязательны) */
h2 { font-size: clamp(28px, 4vw, 44px); line-height: 1.2; }
h3 { font-size: clamp(18px, 2.4vw, 22px); line-height: 1.3; }
```

## `layout.css` (контейнер + 12 колонок)
```css
/* Контейнер */
.container{
  width: min(var(--container-max), 100% - 2*var(--gutter-mob));
  margin-inline: auto;
}

@media (min-width: var(--brk-lg)){
  .container{ width: min(var(--container-max), 100% - 2*var(--gutter-desk)); }
}

/* 12-колоночная grid-сетка */
.row{
  display: grid;
  grid-template-columns: repeat(12, minmax(0, 1fr));
  gap: var(--col-gap-mob);
}

@media (min-width: var(--brk-lg)){
  .row{ gap: var(--col-gap-desk); } /* 30px */
}

/* Колонки: синтаксис .col-<n>, .col-sm-<n>, .col-lg-<n>, .col-xl-<n> */
[class^="col-"], [class*=" col-"] { min-width: 0; }

/* Мобилка (по умолчанию — на всю ширину) */
.col-1, .col-2, .col-3, .col-4, .col-5, .col-6,
.col-7, .col-8, .col-9, .col-10, .col-11, .col-12 { grid-column: span 12; }

/* ≥768 */
@media (min-width: var(--brk-sm)){
  .col-sm-1  { grid-column: span 1; }
  .col-sm-2  { grid-column: span 2; }
  .col-sm-3  { grid-column: span 3; }
  .col-sm-4  { grid-column: span 4; }
  .col-sm-5  { grid-column: span 5; }
  .col-sm-6  { grid-column: span 6; }
  .col-sm-7  { grid-column: span 7; }
  .col-sm-8  { grid-column: span 8; }
  .col-sm-9  { grid-column: span 9; }
  .col-sm-10 { grid-column: span 10; }
  .col-sm-11 { grid-column: span 11; }
  .col-sm-12 { grid-column: span 12; }
}

/* ≥1280 */
@media (min-width: var(--brk-lg)){
  .col-lg-1  { grid-column: span 1; }
  .col-lg-2  { grid-column: span 2; }
  .col-lg-3  { grid-column: span 3; }
  .col-lg-4  { grid-column: span 4; }
  .col-lg-5  { grid-column: span 5; }
  .col-lg-6  { grid-column: span 6; }
  .col-lg-7  { grid-column: span 7; }
  .col-lg-8  { grid-column: span 8; }
  .col-lg-9  { grid-column: span 9; }
  .col-lg-10 { grid-column: span 10; }
  .col-lg-11 { grid-column: span 11; }
  .col-lg-12 { grid-column: span 12; }
}

/* ≥1400 — опциональные уточнения для xl */
@media (min-width: var(--brk-xl)){
  .row--tight-xl { gap: 20px; } /* пример модификатора строки для ultra-wide */
}
```

## Пример разметки (12 колонок)
```html
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-lg-4">
        <!-- карточка -->
      </div>
      <div class="col-sm-6 col-lg-8">
        <!-- контент -->
      </div>
    </div>
  </div>
</section>
```

## Утилиты (минимум)
```css
.section { padding-block: 48px; }
@media (min-width: var(--brk-lg)){ .section { padding-block: 72px; } }

.text-center { text-align: center !important; }
.hidden { display: none !important; }
.visually-hidden {
  position:absolute!important; width:1px; height:1px; margin:-1px; border:0; padding:0;
  clip: rect(0 0 0 0); overflow:hidden;
}
```

## Рекомендации по использованию
- Для карточек/галерей используйте классы `.row` + `.col-*/.col-sm-*/.col-lg-*`.
- Межколоночные отступы контролируются **переменными** (`--col-gap-*`), не задавайте `margin` на колонках.
- Заголовки `h2`/`h3` соблюдают указанные размеры на десктопе; допускается плавная адаптация на мобиле через `clamp()`.
