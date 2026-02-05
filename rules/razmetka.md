Ты — senior SEO Schema.org архитектор и WordPress/PHP разработчик. 
Твоя задача: спроектировать и внедрить корректную микроразметку Schema.org на сайте стоматологической клиники на WordPress.

ОБЯЗАТЕЛЬНО:
- Формат микроразметки: ТОЛЬКО JSON-LD (script type="application/ld+json").
- Не использовать Microdata/RDFa.
- Не выдумывать данные: использовать только то, что реально есть в шаблонах/полях WP.
- Не делать Schema-спам: одна страница = одна главная сущность. Доп. сущности — только если есть соответствующий контент.
- Исключить FAQPage: FAQ на сайте НЕТ.
- Учитывать хлебные крошки: на всех страницах кроме главной есть .breadcrumbs (формат: Главная → Раздел → Текущая страница). Можно размечать BreadcrumbList.
- Не добавлять AggregateRating без реальных агрегированных данных (число, источник).
- Не размечать отдельные CPT “reviews” и “case” как отдельные страницы: у них нет отдельных страниц (используются внутри шорткодов/страниц).
- Архивы CPT service/doctor отключены (has_archive=false) — не размечать архивы как коллекции.

КОНТЕКСТ САЙТА (СKВОЗНЫЕ ДАННЫЕ КЛИНИКИ — ЕДИНЫЕ):
- Название (строго одно): "Стоматологическая клиника Елены Мокренко"
- Город: Москва
- Основной адрес: "г. Москва, ул. Проспект Мира 75, стр. 1 (м.Рижская)"
- Метро (можно как hasMap/areaServed/description): Рижская (5–7 мин), Проспект Мира (10–15 мин)
- Телефон: +7 (495) 003-54-76
- WhatsApp: +7 (985) 054-93-39 (и ссылка: https://wa.me/79850549339)
- Часы работы: Ежедневно 10:00–21:00
- Соцсети (SameAs):
  - https://t.me/mokrenko_msk
  - https://wa.me/79850549339
  - https://vk.com/mokrenko_msk
  - https://www.youtube.com/@mokrenko_msk
- Email: mokrenko-msk@yandex.ru
  Правило: если на странице контактов явно указан email — использовать его как основной contactPoint.email, 
- Юр.данные (если на странице контактов/о клинике реально присутствуют):
  - ООО «Стоматологическая клиника Елены Мокренко»
  - ИНН 7702421620
  - ОГРН 1177746857320
  Не вставлять, если это не отображается на сайте.

ТИПЫ СТРАНИЦ И ТОЧНАЯ ДЕТЕКЦИЯ В WP:
1) Главная:
- Обычная page, шаблон front-page.php
- Детекция: is_front_page()

2) Услуга:
- CPT: service, URL /services/..., шаблон single-service.php
- Детекция: is_singular('service')
- Архив отключен

3) Врач:
- CPT: doctor, URL /doctor/..., шаблон single-doctor.php
- Детекция: is_singular('doctor')
- Архив отключен

4) О клинике:
- page, шаблон page-about.php
- Детекция: is_page_template('page-about.php') или по slug

5) Контакты:
- page, шаблон page-contacts.php
- Детекция: is_page_template('page-contacts.php') или по slug

6) Блог (страница-архив):
- page-blog.php (страница-обертка)
- Детекция: is_page_template('page-blog.php')

7) Пост (статья):
- post type: post, шаблон single.php
- Детекция: is_single() && get_post_type() === 'post'

8) Отзывы:
- обычная page, шаблон page-reviews.php
- Детекция: is_page_template('page-reviews.php') или по slug
- CPT reviews существует, но single-страницы отзывов НЕ используются

ДОП. ТАКСОНОМИИ:
- Услуги: service_category (иерархическая), URL /services/category/... 
- Врачи: specialty (/specialty/...), clinic (/clinic/...)

ГЛАВНЫЙ ПРИНЦИП ВНЕДРЕНИЯ:
A) Вынести сквозную разметку клиники в ОДНО место, подключаемое на всех страницах:
- например в header.php через wp_head, либо через отдельную функцию + add_action('wp_head', ...).
B) Страничную разметку добавлять в зависимости от типа страницы (условиями WP).

========================
ЧТО ИМЕННО НУЖНО СДЕЛАТЬ
========================

ШАГ 1 — ГЛОБАЛЬНАЯ СКВОЗНАЯ MICRODATA (ОДИН РАЗ НА САЙТ)
Добавь один JSON-LD блок (в wp_head) для сущности клиники:
- @type: Dentist (или MedicalBusiness). Для стоматологии предпочтительнее Dentist.
- Обязательные поля:
  - @id: абсолютный URL сайта + "#clinic" (пример: https://example.ru/#clinic)
  - name
  - url
  - logo (если есть ссылка на логотип)
  - image (если есть основное изображение)
  - telephone
  - address (PostalAddress: streetAddress, addressLocality, addressCountry если можно определить)
  - openingHoursSpecification (дни недели все 7 + opens/closes)
  - contactPoint (ContactPoint: telephone, contactType="customer service", availableLanguage=["ru"], email если подтвержден)
  - sameAs (соцсети)
  - areaServed: "Москва"
- Если на сайте есть карта (url), можно добавить hasMap.
- Не добавлять review/rating.

ШАГ 2 — ХЛЕБНЫЕ КРОШКИ (BreadcrumbList)
На всех страницах кроме главной:
- Сгенерируй BreadcrumbList JSON-LD.
- Данные брать из DOM/структуры .breadcrumbs или из WP-логики:
  - itemListElement: ListItem с position, name, item (URL)
- Строго обеспечить корректные URL (абсолютные) и позиции.
- Если в breadcrumbs нет ссылки на текущую страницу — добавить её как последний элемент без кликабельности нельзя в JSON-LD (в JSON-LD item нужен), поэтому укажи item как canonical URL текущей страницы.

ШАГ 3 — МИКРОРАЗМЕТКА ПО ТИПАМ СТРАНИЦ:

(1) Главная (is_front_page)
Главная сущность уже описана глобально как Dentist/MedicalBusiness.
На главной НЕ создавать второй Dentist.
Разрешено:
- WebSite (опционально) с SearchAction, если на сайте реально есть поиск (кнопка/форма). 
  Если поиска нет или это только иконка без реальной search endpoint — не добавлять SearchAction.
- WebPage (опционально) как "@type":"WebPage" с mainEntity ссылкой на #clinic.

(2) Услуга (is_singular('service'))
Главная сущность страницы: MedicalProcedure (предпочтительно) ИЛИ Service (если контент не про процедуру).
Правило выбора:
- Если услуга — стоматологическая процедура/лечение (имплантация, коронки и т.п.) → MedicalProcedure.
Поля:
- @id: canonical + "#procedure"
- name: заголовок страницы (get_the_title())
- description: excerpt или краткое описание (если есть)
- provider: ссылка на клинику (@id "#clinic")
- url: canonical
- medicalSpecialty: "Dentistry"
- bodyLocation (опционально): "Teeth" / "Mouth" (если уместно, не обязательно)
- category/keywords (опционально): из таксономии service_category (если есть у записи)
Запрещено:
- FAQPage (его нет)
- Product/Offer, если нет реальных цен/предложений в структурированном виде
- Physician на услугах (см. правило ниже)

(3) Врач (is_singular('doctor'))
Главная сущность: Physician
СТРОГО: Physician использовать ТОЛЬКО на страницах doctor.
Источники данных (из WP):
- name: get_the_title()
- jobTitle: метаполе doctor_position
- yearsOfExperience: метаполе doctor_experience_years (число)
- image: featured image (get_the_post_thumbnail_url), при наличии
- url: canonical
- description: excerpt или краткое (если есть)
- worksFor: клиника (#clinic)
- medicalSpecialty: из taxonomy specialty (имена терминов), если есть
- hasCredential (опционально): можно размечать образование/квалификацию, но только если есть поля doctor_education/doctor_qualification и они выводятся на странице
- video (VideoObject) — только если doctor_video_url существует и реально выводится/используется
Не размечать сертификаты как отдельные сущности, если нет прямых URL изображений/страниц; можно добавить как "hasCredential" текстом или "subjectOf" если аккуратно.

(4) О клинике (page-about.php)
Главная сущность: AboutPage (как WebPage subtype) или WebPage + mainEntity (#clinic)
Рекомендация:
- @type: "AboutPage"
- mainEntity: #clinic
- Не плодить Organization/Dentist второй раз.

(5) Контакты (page-contacts.php)
Главная сущность: ContactPage или WebPage + mainEntity (#clinic)
- @type: "ContactPage"
- mainEntity: #clinic
Если на странице контактов есть дополнительные контакты (email, whatsapp как contactPoint), можно дополнить contactPoint в глобальной сущности или добавить второй ContactPoint на этой странице (но не дублировать всю клинику).

(6) Страница блога-архива (page-blog.php)
Главная сущность: CollectionPage или Blog
- @type: "CollectionPage"
- about: "Blog" (опционально)
Не размечать список постов как ItemList, если шаблон не выводит явный список с ссылками (если выводит — можно ItemList).

(7) Пост (single.php, post type=post)
Главная сущность: BlogPosting (или Article)
Поля:
- headline: title
- description: excerpt
- datePublished / dateModified (из WP)
- author: если на сайте отображается автор — использовать Person с name; если нет — не выдумывать, можно привязать к Organization (#clinic) как publisher
- publisher: #clinic
- mainEntityOfPage: canonical
- image: featured image если есть

(8) Страница отзывов (page-reviews.php)
Не добавлять AggregateRating.
Если на странице реально выводятся отзывы как сущности (имя, текст, дата) — можно размечать несколько Review, но только если данные полные.
Если отзывы представлены как видео с именем пациента (как на главной) — допускается VideoObject, но Review лучше не делать без текста/оценки/источника.

ШАГ 4 — ТЕХНИЧЕСКИЕ ТРЕБОВАНИЯ К КОДУ
- JSON-LD должен быть валидным JSON (двойные кавычки, без trailing commas).
- URL всегда абсолютные (home_url()).
- Использовать canonical URL страницы (get_permalink()).
- Не создавать дубли скриптов на одной странице.
- Размещать JSON-LD в head через wp_head (предпочтительно) или сразу перед </head>.
- Реализовать как функции:
  - render_global_clinic_schema()
  - render_breadcrumb_schema()
  - render_page_specific_schema()
И подключить через add_action('wp_head', ...).

ШАГ 5 — ВАЛИДАЦИЯ
- После внедрения: убедиться, что нет ошибок в Schema Validator.
- Убедиться, что на страницах doctor есть Physician, а на остальных — нет.
- Убедиться, что FAQPage нигде не появился.
- Убедиться, что BreadcrumbList не появляется на главной.
- Убедиться, что глобальная сущность клиники (#clinic) одна на всём сайте.

========================
ФОРМАТ ВЫПОЛНЕНИЯ В CURSOR
========================
1) Сначала перечисли, в каких файлах темы нужно внести изменения:
- header.php / functions.php / отдельный include (предложи лучший вариант по проекту)
2) Затем предложи конкретный план внедрения (коротко).
3) Затем внеси изменения в код (PHP), добавив функции и хуки.
4) В конце покажи пример JSON-LD, который будет формироваться на:
- главной
- услуге
- враче
- записи блога
(примеры должны соответствовать правилам и полям WP).

Если в текущем коде уже есть какая-то микроразметка — НЕ дополняй поверх. Сначала найди/удали или отключи дубли, и только потом внедряй новую.
