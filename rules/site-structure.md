# Структура сайта для SEO-промпта

## 1. Типы страниц (обязательно)

### Главная
- ✅ Обычная страница (page)
- Шаблон: `front-page.php`
- Определение: `is_front_page()`

### Услуги
- ✅ CPT: `service`
- Slug: `/services/...`
- Шаблон: `single-service.php`
- Определение: `is_singular('service')`
- Архив: отключен (`has_archive => false`)

### Страница врача
- ✅ CPT: `doctor`
- Slug: `/doctor/...`
- Шаблон: `single-doctor.php`
- Определение: `is_singular('doctor')`
- Архив: отключен (`has_archive => false`)

### О клинике
- ✅ Обычная страница (page)
- Шаблон: `page-about.php`
- Определение: `is_page_template('page-about.php')` или по slug

### Контакты
- ✅ Обычная страница (page)
- Шаблон: `page-contacts.php`
- Определение: `is_page_template('page-contacts.php')` или по slug

### Блог / статьи
- ✅ Обычная страница для архива: `page-blog.php`
- ✅ Стандартный post type: `post`
- Шаблон поста: `single.php`
- Определение: 
  - Архив: `is_page_template('page-blog.php')`
  - Пост: `is_single() && get_post_type() === 'post'`

### Отзывы
- ✅ Обычная страница (page)
- Шаблон: `page-reviews.php`
- Определение: `is_page_template('page-reviews.php')` или по slug
- CPT `reviews` существует, но отдельные страницы отзывов не используются (только на странице отзывов)

---

## 2. ЧПУ-логика (очень важно)

### Услуги
- ✅ Лежат в `/services/...`
- Пример: `/services/koronka-na-zub/`
- Таксономия: `service_category`
- Slug таксономии: `/services/category/...`
- Пример: `/services/category/implantation/`

### Врачи
- ✅ Лежат в `/doctor/...`
- Пример: `/doctor/ivanov-ivan/`
- Таксономии:
  - `specialty` (специализация) — slug: `/specialty/...`
  - `clinic` (клиники) — slug: `/clinic/...`

### Детекция по URL/шаблону
- Услуги: `is_singular('service')` или URL начинается с `/services/`
- Врачи: `is_singular('doctor')` или URL начинается с `/doctor/`
- Обычные страницы: `is_page()` + проверка шаблона через `get_page_template_slug()`

---

## 3. Сквозные данные клиники (1 раз)

### Название клиники
**Стоматологическая клиника Елены Мокренко**
- Используется в `document_title_parts` (functions.php, строка 481)
- Варианты НЕ используются — только этот вариант

### Город
**Москва**

### Адрес
**г. Москва, ул. Проспект Мира 75, стр. 1 (м.Рижская)**
- Единый формат адреса на всех страницах сайта
- Метро: Рижская (5-7 мин), Проспект Мира (10-15 мин)

### Телефон
**+7 (495) 003-54-76**
- WhatsApp: +7 (985) 054-93-39

### График работы
**Ежедневно с 10:00 до 21:00**

### Соцсети
✅ **Да, есть:**
- Telegram: `https://t.me/mokrenko_msk`
- WhatsApp: `https://wa.me/79850549339`
- VK: `https://vk.com/mokrenko_msk`
- YouTube: `https://www.youtube.com/@mokrenko_msk`

### Дополнительные данные
- Email: `mokrenko-msk@yandex.ru`
- Юридическое название: ООО «Стоматологическая клиника Елены Мокренко»
- ИНН: 7702421620
- ОГРН: 1177746857320

---

## 4. Врачи — структура (очень желательно)

### Модель данных врача

У каждого врача есть:

#### Обязательные поля:
- ✅ **Имя** — `get_the_title()` (post title)
- ✅ **Должность** — метаполе `doctor_position`
- ✅ **Опыт** — метаполе `doctor_experience_years` (в годах)

#### Дополнительные поля:
- ✅ **Фото** — `get_the_post_thumbnail_url()` (featured image)
- ✅ **Второе фото** — метаполе `doctor_photo_2`
- ✅ **Страница врача** — есть (`single-doctor.php`)
- ✅ **Краткое превью** — `get_the_excerpt()`
- ✅ **Подробная информация** — `get_the_content()`
- ✅ **3 факта о враче** — метаполя `doctor_fact_1`, `doctor_fact_2`, `doctor_fact_3`
- ✅ **Образование** — метаполе `doctor_education` (текст с параграфами)
- ✅ **Повышение квалификации** — метаполе `doctor_qualification` (текст с параграфами)
- ✅ **Сертификаты** — метаполе `doctor_certs_json` (JSON массив ID изображений)
- ✅ **Видео** — метаполе `doctor_video_url` (YouTube URL)

#### Таксономии:
- ✅ **Специализация** — таксономия `specialty`
- ✅ **Клиника** — таксономия `clinic`

#### Привязка к услугам
- ❌ Прямой связи нет
- Кейсы привязаны к врачам через метаполе `case_doctor_id`

### Использование Schema
- **Physician** — использовать только на странице врача (`is_singular('doctor')`)
- На других страницах врачи не должны получать Schema Physician

---

## 5. FAQ / хлебные крошки (да / нет)

### FAQ
- ❌ **FAQ нет на услугах**
- ❌ **FAQ нет на других страницах**
- В коде не найдено блоков FAQ или FAQPage Schema

### Хлебные крошки
- ✅ **Хлебные крошки есть**
- Используются на всех страницах (кроме главной):
  - `single-doctor.php` (строка 108-118)
  - `page-contacts.php` (строка 17-25)
  - `page-prices.php` (строка 70-78)
  - `page-about.php` (строка 70-78)
  - `page-doctors.php` (строка 70-78)
  - `page-portfolio.php` (строка 70-78)
  - `page-blog.php` (строка 70-78)
  - `page-reviews.php` (строка 87-95)
  - `single.php` (строка 17-25)
- Формат: `Главная → [Раздел] → [Текущая страница]`
- Класс: `.breadcrumbs`

### Рекомендация для Cursor
- **Не лепить FAQPage Schema по умолчанию** — на сайте нет FAQ
- Хлебные крошки можно использовать для BreadcrumbList Schema

---

## Дополнительная информация

### Другие CPT
- `case` (кейсы) — не имеют отдельных страниц, используются только в шорткодах
- `reviews` (отзывы) — не имеют отдельных страниц, только на странице отзывов

### Таксономии услуг
- `service_category` — иерархическая таксономия
- Примеры категорий: Имплантация зубов, Протезирование, Реставрация
- Slug: `/services/category/...`

### Определение типа страницы в коде
```php
// Услуги
is_singular('service')

// Врачи
is_singular('doctor')

// Обычные страницы
is_page() + get_page_template_slug()

// Блог (посты)
is_single() && get_post_type() === 'post'

// Главная
is_front_page()
```
