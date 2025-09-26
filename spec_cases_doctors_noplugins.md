# ТЗ (без плагинов): Кейсы и Врачи — CPT, метаполя, шаблоны, адаптив

> Главный блок сайта. **Ни одного плагина.** Всё — на чистом WP: CPT, `register_post_meta`, метабоксы, media frame, короткие шорткоды, шаблоны.  
> Сетка: 12 колонок, брейки **768 / 1280 / 1400**, десктопный gap **30px**, `h2=44px`, `h3=22px`.

---

## 1) Модель данных

### 1.1. CPT `doctor` (Карточка врача) — отдельно от кейсов
**supports:** `title` (ФИО), `editor` (Подробная инфа), `thumbnail` (фото), `excerpt` (краткое превью).  
**(опц.) таксономии:** `specialty` (специализация, иерархич.), `clinic` (филиал, неиерарх.).

**Метаполя (native, без ACF):**
- `doctor_position` — Должность (string)
- `doctor_experience_years` — Опыт, лет (integer)
- `doctor_fact_1` / `doctor_fact_2` / `doctor_fact_3` — 3 индекса/факта (string)
- `doctor_education_json` — Образование (JSON-массив объектов `{year, desc}`)
- `doctor_video_url` — Видео (oEmbed/YouTube URL, string)
- `doctor_certs_json` — Галерея сертификатов (JSON-массив attachment ID)

> Фото врача = `featured image`. Краткое превью = `excerpt`. Подробная инфа = `content`.

---

### 1.2. CPT `case` (Кейс портфолио) — отдельный тип
**supports:** `title` (заголовок кейса), `thumbnail` (опц.), `editor` (опц.).

**Метаполя (native):**
- `case_doctor_id` — Связь с врачом (integer, post_id `doctor`)
- `case_before_image` — ID медиабиблиотеки (integer)
- `case_before_desc` — Описание ДО (string)
- `case_after_image` — ID медиабиблиотеки (integer)
- `case_after_desc` — Описание ПОСЛЕ (string)
- `case_duration` — Срок выполнения (string)

> Связь **односторонняя**: `case` → `doctor`. На странице врача делаем выборку всех `case` по `case_doctor_id`.

---

## 2) Админка: метабоксы и хранение

### 2.1. Регистрация меты
Все поля регистрируем через `register_post_meta()` с `show_in_rest:true`, `single:true`, строгой схемой:
- строки: `type:'string'`, `sanitize_callback:'sanitize_text_field'` (для длинных описаний — `wp_kses_post`).
- числа: `type:'integer'`, `sanitize_callback:'absint'`.
- JSON-поля: `type:'string'`, в `save_post` валидируем `json_decode()`.

### 2.2. Метабоксы
- `add_meta_box('doctor_meta', …)` — форма для врача.  
  - Поля: должность, стаж, 3 факта, видео-URL, **репитер “Образование”** (JS‑кнопка “Добавить”), **галерея сертификатов** (wp.media multiple).  
  - Хранение “репитеров”/галереи — в hidden `<textarea>` с JSON (`doctor_education_json`, `doctor_certs_json`).
- `add_meta_box('case_meta', …)` — форма для кейса.  
  - Поля: выбор врача (`<select>` по CPT `doctor`), до/после (картинка + описание), срок.

**JS (vanilla) для админки:**
- `assets/admin/admin-cases-doctors.js` — хэндлеры кнопок “Добавить образование/сертификат”, открытие `wp.media`, синхронизация hidden JSON.  
- Подключать **только** на экранах `post.php`/`post-new.php` для `doctor` и `case`.

**Сохранение:**
- `save_post_doctor` и `save_post_case`: проверка nonce, `current_user_can`, сбор формы, валидация, `update_post_meta`.  
- JSON-поля — валидировать (`json_decode`), нормализовать массив (ID → `absint`), сериализовать обратно.

---

## 3) Вывод на фронте: шаблоны и шорткоды

### 3.1. Шаблон кейса (универсальный компонент)
Файл: `template-parts/case/showcase.php` (без контейнера).  
Структура внутри:
- **row (`row row--case`, паттерн 205 — 4/4/4):**  
  - колонка 1 — карточка врача (фото, ФИО, должность, ссылка).  
  - колонка 2 — ДО (картинка + описание).  
  - колонка 3 — ПОСЛЕ (картинка + описание).  
- Срок (`case_duration`) — бейдж справа внизу колонки 2

**Адаптив:**
- В статичном блоке (вне слайдера) — на мобилке `row--case` горизонтальная лента (scroll-snap, 3 панели 100% ширины).  
- В слайдере — добавляем модификатор `.case--in-slider`: на мобилке **выключаем** горизонтальный скролл и стекаем панели вертикально.

### 3.2. Шорткоды
- `[case_showcase id="123" slider="0|1"]` — один кейс; если `slider=1` → добавляем класс `.case--in-slider`.
- `[cases_by_doctor doctor="456" limit="6" slider="0|1"]` — список кейсов врача.
- `[doctor_card id="123"]` — мини‑карточка врача.
- `[doctor_portfolio doctor="current|123" limit="10" slider="1"]` — лента ДО/ПОСЛЕ врача (блок на странице врача).

Все шорткоды возвращают строку, валидируют аргументы, тихо выходят при пустых данных.

### 3.3. Мини‑CSS (добавить к теме)
- Классы карточек: `.case-card`, `.doctor-mini`, `.case-panel--doctor|--before|--after`, `.case-duration`.  
- Snap‑лента и вариант `.case--in-slider` (см. ранее).  
- Никаких стилей на `.row`/`.container`; только внутренности.

---

## 4) Готовые промпты для Cursor

### P0. Подготовка файлов
> Создай файлы и подключения:  
> - `inc/custom-types.php`, `inc/meta-boxes.php`, `inc/shortcodes.php`, `assets/admin/admin-cases-doctors.js`, `assets/admin/admin-cases-doctors.css`, `template-parts/case/showcase.php`, `template-parts/doctor/card.php`.  
> Подключи их из `functions.php`. Префикс функций: `theme_`. Комментарии PHPDoc, i18n.

### P1. CPT + мета (регистрация, без плагинов)
> В `inc/custom-types.php` зарегистрируй CPT `doctor` и `case`.  
> В `init` через `register_post_meta()` объяви ВСЕ поля из раздела 1 (строки/числа/JSON). Укажи `show_in_rest:true`, `single:true`, `auth_callback` по умолчанию.  
> В `inc/meta-boxes.php` добавь два метабокса: `doctor_meta`, `case_meta` с формами и nonce.  
> В `save_post_*` провалидацируй и сохрани мету. Не используй плагины.

### P2. Admin JS + media frame
> В `assets/admin/admin-cases-doctors.js` реализуй:  
> - кнопка “Добавить образование”: добавляет поля `year/desc`, собирает JSON в hidden `doctor_education_json`.  
> - кнопка “Добавить сертификаты”: открывает `wp.media({multiple:true})`, пишет массив ID в `doctor_certs_json`.  
> - для `case`: кнопки “Выбрать ДО/ПОСЛЕ” через `wp.media` → ID в соответствующие поля.  
> Скрипт и CSS подключать **только** на экранах `doctor` и `case` (через `admin_enqueue_scripts` с проверкой `get_current_screen()`).
 
### P3. Компонент и шорткоды
> В `template-parts/case/showcase.php` сверстай компонент кейса (row 1: 8/4, row 2: 4/4/4). Внутри используй `get_post_meta` для полей кейса + `get_post()` врача.  
> В `template-parts/doctor/card.php` сделай мини‑карточку врача.  
> В `inc/shortcodes.php` реализуй `[case_showcase]`, `[cases_by_doctor]`, `[doctor_card]`, `[doctor_portfolio]` с выборками `WP_Query`. Аргументы валидируй, `esc_url`, `esc_html`.  
> Добавь мини‑CSS для snap‑ленты и варианта `.case--in-slider` в общий CSS темы.

### P4. Сетка и адаптив (напоминание)
> Используй 12‑колоночную сетку из проекта, брейки 768/1280/1400, `gap` 30px, размеры `h2=44`, `h3=22`. Не смешивай `.col-*` и стили карточек. Контекст ≤ 1 уровень, без `!important`.

---

## 5) Acceptance (что должно быть на выходе)

- [ ] CPT `doctor`, `case` зарегистрированы, красивые слаги.  
- [ ] Все поля зарегистрированы через `register_post_meta`, отображаются и сохраняются из метабоксов.  
- [ ] Медиа‑выбор для изображений, JSON‑репитеры работают, сохранение безопасно (nonce/capability).  
- [ ] `template-parts/case/showcase.php` и `template-parts/doctor/card.php` готовы.  
- [ ] Шорткоды работают и валидируют входные данные.  
- [ ] Адаптив и поведение в слайдере/статике как описано.  
- [ ] Код разложен по файлам, префиксы, i18n, комментарии.

---

## 6) Подсказки по UX в админке
- В списке `doctor` добавь колонки “Стаж”, “Специальность” (если введёшь таксономию).  
- В списке `case` — колонку “Врач”.  
- На метабоксах подпиши примеры ввода, сделай превью выбранных изображений.

---

## 7) Роадмап (позже, опционально)
- Добавить REST‑эндпоинт `/wp-json/theme/v1/doctor/{id}/cases`.  
- Ленивая загрузка изображений.  
- Микророзметка `Person` для врача и `MedicalProcedure` для кейса (если релевантно).
