# Отчёт по реализованному SEO (тема Mokrenko)

Дата отчёта: февраль 2025.

---

## 1. Title (document_title)

**Файл:** `functions.php` — фильтры `document_title_separator`, `document_title_parts`.

- **Разделитель:** `|`.
- **Название сайта:** «Стоматологическая клиника Елены Мокренко».
- **Ограничение длины title:** до 60 символов (обрезка с «…»).

| Тип страницы | Формат title |
|--------------|--------------|
| Главная | Стоматологическая клиника Елены Мокренко (без site после разделителя) |
| 404 | Страница не найдена \| Стоматологическая клиника Елены Мокренко |
| Поиск | Результаты поиска: {запрос} \| Стоматологическая клиника Елены Мокренко |
| Услуга (service) | {Название услуги} в Москве \| Стоматологическая клиника Елены Мокренко |
| Пост блога (post) | {Заголовок поста} \| Стоматологическая клиника Елены Мокренко |
| Врач (doctor) | {Имя врача} \| Стоматологическая клиника Елены Мокренко |
| Обычная страница (page) | {Заголовок страницы} \| Стоматологическая клиника Елены Мокренко |
| Остальные | title + site, длина ограничена |

---

## 2. Meta description

**Файл:** `functions.php` — хук `wp_head`, приоритет 1.

Выводится один тег `<meta name="description" content="…">`. Длина ограничена 160 символами (157 + «…»).

| Тип страницы | Источник/шаблон описания |
|--------------|--------------------------|
| Главная | Фиксированный текст про стоматологию в Москве, запись на консультацию |
| Услуга (service) | Поле `_service_meta_description` или шаблон: «{Название} в стоматологической клинике в Москве. Цены, этапы…» |
| Страница (page) | Excerpt или «{Заголовок} — Стоматологическая клиника Елены Мокренко в Москве. Запись на консультацию» |
| Врач (doctor) | Сборка: имя, должность, опыт (лет), «Приём и консультация в клинике» |
| Пост блога (post) | Excerpt или первые 160 символов контента |
| 404 | Фиксированный текст «Запрашиваемая страница не найдена…» |
| Поиск | «Результаты поиска по запросу «{запрос}» на сайте…» |

Для услуг мета-описание задаётся в метабоксе (SEO) в админке; fallback — шаблон выше.

---

## 3. Canonical

**Файл:** `functions.php` — хук `wp_head`, приоритет 1.

Один тег `<link rel="canonical" href="…">` на запрос. Ошибки (например, `get_term_link`) не выводятся.

| Условие | Canonical URL |
|---------|----------------|
| Любая singular (страница, пост, услуга, врач и т.д.) | `get_permalink()` |
| Главная | `home_url('/')` |
| Лента блога (is_home) | `get_permalink(page_for_posts)` |
| Рубрика / метка / таксономия | `get_term_link(get_queried_object())` |
| Архив типа поста | `get_post_type_archive_link(get_post_type())` |
| Остальное | `home_url(add_query_arg(null, null))` |

---

## 4. Meta robots (index / noindex)

**Файл:** `functions.php` — хелпер `mokrenko_should_noindex_garbage_url()`, два хука в `wp_head` (приоритеты 2 и 3).

- Для **индексируемых** страниц: `<meta name="robots" content="index, follow" />`.
- Для **неиндексируемых**: `<meta name="robots" content="noindex, follow" />`.

**Условия noindex (мусорные / служебные URL):**

| Условие | Описание |
|---------|----------|
| `is_404()` | Страница не найдена |
| `is_search()` | Результаты поиска |
| `is_page_template('page-thank-you.php')` | Страница благодарности после формы |
| `is_author()` | Архив автора |
| `is_date()` | Архив по дате |
| `is_paged()` | Вторая и далее страницы пагинации (page/2, …) |
| `is_tax('specialty')` | Архив таксономии «специальность» |
| `is_tax('clinic')` | Архив таксономии «клиника» |
| `is_tax('service_category')` | Архив категорий услуг |
| `is_category()` | Рубрики постов |
| `is_tag()` | Метки постов |

Всё остальное (главная, страницы, услуги, врачи, посты блога, лента блога) получает `index, follow`.

---

## 5. Редиректы (template_redirect)

**Файл:** `functions.php` — хук `template_redirect`, приоритет 1.

| Условие | Действие |
|---------|----------|
| `is_singular('case')` | 301 на страницу портфолио (`page-portfolio.php`); если её нет — на главную |

Одиночные кейсы не показываются; в поиске и sitemap они не участвуют (см. ниже).

---

## 6. Поиск по сайту (pre_get_posts)

**Файл:** `functions.php` — хук `pre_get_posts`.

- Только главный запрос и только на `is_search()`.
- Из поиска исключён тип записей **case** (кейсы не отображаются в результатах поиска).

---

## 7. XML Sitemap (исключения)

**Файл:** `functions.php` — фильтры ядра WordPress.

- **Провайдер users отключён** — в sitemap не попадают URL авторов (`wp_sitemaps_add_provider`).
- **Типы записей reviews и case исключены** из sitemap (`wp_sitemaps_post_types`).
- **Страница благодарности** (шаблон `page-thank-you.php`) исключена из списка страниц в sitemap (`wp_sitemaps_posts_query_args` для `post_type === 'page'`).

В sitemap остаются: главная, страницы (pages), посты (post), услуги (service), врачи (doctor). Без users, reviews, case и thank-you.

---

## 8. Страница 404

**Файл:** `404.php`; логика SEO — в `functions.php`.

- Один H1: «Страница не найдена».
- Уникальные title и meta description задаются в `document_title_parts` и в блоке meta description в `functions.php`.
- noindex выставляется через `mokrenko_should_noindex_garbage_url()` (is_404).
- Разметка: изображение 404.svg, текст, навигационные ссылки (главная, о клинике, контакты), верхнее меню как на контактах (page-top).

---

## 9. Страница поиска

**Файл:** `search.php`; логика SEO — в `functions.php`.

- H1: «Результаты поиска: {запрос}».
- Title и meta description для поиска задаются в `functions.php`; noindex — через `mokrenko_should_noindex_garbage_url()` (is_search).
- Подключён inner.css, лейаут (в т.ч. футер) исправлен через `body.search` в стилях.

---

## 10. Разметка Schema.org (JSON-LD)

**Файл:** `inc/schema.php`; подключение в `functions.php` (`require_once inc/schema.php`). Формат: только JSON-LD (`<script type="application/ld+json">`). Дубли по `@id` не выводятся.

### 10.1. Глобально на всех страницах (приоритет 5)

- **Dentist** — клиника: название, url, logo, телефон, адрес (PostalAddress), часы работы (OpeningHoursSpecification), contactPoint, sameAs (Telegram, WhatsApp, VK, YouTube), areaServed (Москва). Email подставляется из `get_clinic_email()` (admin_email или ACF `clinic_email`). На странице контактов добавляется `hasMap` (якорь на карту).

### 10.2. Хлебные крошки (приоритет 10)

- **BreadcrumbList** — на всех страницах кроме главной. Элементы строятся в `get_breadcrumb_items()`: главная → раздел (Врачи/Блог/О клинике/Контакты/Отзывы/Цены/Портфолио/категория услуги) → текущая страница. Учитываются: single doctor, single service (с категорией), single post, page-about, page-contacts, page-blog, page-reviews, page-doctors, page-prices, page-portfolio, прочие page.

### 10.3. По типам страниц (приоритет 15)

| Страница | Тип разметки | Основные поля |
|----------|--------------|----------------|
| Главная | **WebSite** | name, url, publisher → clinic, **SearchAction** (urlTemplate с `{search_term_string}`) |
| Услуга (service) | **MedicalProcedure** | name, url, provider → clinic, description, category (service_category), medicalSpecialty: Dentistry |
| Врач (doctor) | **Physician** | name, url, worksFor → clinic, jobTitle, yearsOfExperience, description, image, medicalSpecialty (из таксономии specialty), hasCredential (образование/квалификация), video (VideoObject при наличии) |
| О клинике | **AboutPage** | mainEntity → clinic |
| Контакты | **ContactPage** | mainEntity → clinic, при наличии email — contactPoint |
| Блог (архив) | **CollectionPage** | about → Blog |
| Пост блога (post) | **BlogPosting** | headline, url, datePublished, dateModified, publisher → clinic, description, image |

Отзывы (AggregateRating / Review) не выводятся — только при наличии полных данных в будущем.

---

## 11. Вне темы (не реализовано в коде темы)

- Настройка зеркала (www / без www) и 301 — сервер / хостинг.
- robots.txt — по умолчанию WordPress или настройки хостинга/плагина.
- Подключение sitemap в панелях вебмастеров (Яндекс, Google и др.) — вручную.
- Скорость и Core Web Vitals — при необходимости отдельно.

---

## 12. Соответствие чек-листу rules/SEO.md

- **Canonical** — реализован на всех типах страниц.
- **Meta description** — для главной, страниц, услуг, врачей, постов, 404, поиска.
- **Title** — уникальные и ограниченной длины для перечисленных типов.
- **Noindex** — 404, поиск, thank-you, автор, дата, пагинация, таксономии (specialty, clinic, service_category), категории и метки.
- **Sitemap** — без users, без reviews и case, без страницы благодарности.
- **Редирект** — одиночные кейсы 301 на портфолио.
- **Поиск** — кейсы исключены из выдачи поиска по сайту.
- **Разметка Schema.org** — JSON-LD: Dentist (глобально), BreadcrumbList, WebSite + SearchAction (главная), MedicalProcedure (услуги), Physician (врачи), AboutPage, ContactPage, CollectionPage (блог), BlogPosting (посты).

Чек-лист из `rules/SEO.md` частично закрыт в коде темы; пункты по серверу, robots.txt и вебмастерам выполняются отдельно.
