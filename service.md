1. Общая идея
Есть кастомный тип service с модульными секциями.
Для услуг мы генерируем тексты в JSON, а тема импортирует их в метаполя и включает нужные секции.
Сейчас импортируем только тексты, без цен и картинок.
2. Где импорт
В админке WordPress: «Инструменты → Импорт услуг».
Импортёр реализован в inc/services-import.php, подключён в functions.php.
Импорт работает с:
файлом, содержащим один объект услуги { ... }, или
файлом вида { "services": [ { ... }, { ... } ] }.
3. Формат JSON для одной услуги
{
  "slug": "odnoetapnaya-implantatsiya-zubov",
  "title": "Одноэтапная имплантация зубов",
  "excerpt": "Краткое SEO-описание (2–3 предложения).",
  "service_category": ["implantation"],

  "hero": {
    "title": "",
    "subtitle": "",
    "benefits": ["", "", ""],
    "extra_line": "",
    "button_text": "",
    "button_note": ""
  },

  "benefits": {
    "icon_url": "http://localhost:8084/wp-content/uploads/2025/12/benefit_chk.svg",
    "items": [
      { "title": "", "text": "" },
      { "title": "", "text": "" },
      { "title": "", "text": "" },
      { "title": "", "text": "" }
    ]
  },

  "clinic_benefits": {
    "title": "",
    "subtitle": "",
    "left_cards": [
      { "title": "", "text": "" },
      { "title": "", "text": "" },
      { "title": "", "text": "" },
      { "title": "", "text": "" }
    ],
    "feature_card": {
      "icon_url": "http://localhost:8084/wp-content/uploads/2025/12/service_icon_big.svg",
      "title": "",
      "text": "",
      "cta": ""
    }
  },

  "cta": {
    "title": "",
    "subtitle": "",
    "bullets": ["", "", "", ""]
  },

  "work_stages": {
    "title": "",
    "subtitle": "",
    "stage_1": {
      "title": "",
      "checklist": [
        { "title": "", "description": "" },
        { "title": "", "description": "" },
        { "title": "", "description": "" }
      ]
    },
    "stage_2": {
      "title": "",
      "checklist": [
        { "title": "", "description": "" },
        { "title": "", "description": "" },
        { "title": "", "description": "" }
      ]
    }
  },

  "what_included": {
    "title": "",
    "items": [
      { "title": "", "description": "" },
      { "title": "", "description": "" },
      { "title": "", "description": "" },
      { "title": "", "description": "" }
    ]
  },

  "info_blocks": [
    {
      "title": "",
      "subtitle": "",
      "items": ["", "", "", ""]
    }
  ],

  "cta_2": {
    "title": "",
    "subtitle": "",
    "button_text": "",
    "button_link": ""
  },

  "indications": {
    "left_title": "",
    "left_items": ["", "", ""],
    "right_title": "",
    "right_items": ["", "", ""]
  },

  "seo": {
    "meta_description": ""
  }
}
slug: всегда задаю я вручную, не генерировать автоматически. Формат — латиница, kebab-case, совпадает с ЧПУ на сайте.
service_category: массив slug’ов таксономии service_category (если термы не существуют, импортёр создаст их по slug).
4. Что куда мапится при импорте
Импортёр для каждой услуги:
Создаёт/обновляет запись service:
slug → post_name
title → post_title
excerpt → post_excerpt
service_category[] → таксономия service_category
Hero:
hero.title → _service_hero_title
hero.subtitle → _service_hero_subtitle
hero.benefits[] → _service_hero_benefits (массив объектов {icon: 0, text: ...})
hero.extra_line → _service_hero_extra_line
hero.button_text → _service_hero_button_text
hero.button_note → _service_hero_info_text (подпись под кнопкой)
Преимущества услуги (benefits):
benefits.items[] → _service_benefits_items (каждый {title, text, icon:0})
Плюсы клиники (clinic_benefits):
clinic_benefits.title → _service_clinic_benefits_title
clinic_benefits.subtitle → _service_clinic_benefits_subtitle
left_cards[] → _service_clinic_benefits_cards ({title, text, icon:0})
feature_card → _service_clinic_benefits_feature_card ({title, text, button_text=cta, button_link=""})
CTA:
cta.title → _service_cta_title
cta.subtitle → _service_cta_subtitle
cta.bullets[] → _service_cta_cards (каждый {text} без заголовка)
Этапы (work_stages):
work_stages.title → _service_work_stages_title
work_stages.subtitle → _service_work_stages_subtitle
stage_1 / stage_2 → _service_work_stages_stage_1 / _service_work_stages_stage_2
(структура: {title, image:0, checklist:[{title, description}]})
Инфо‑блоки (info_blocks):
Каждый элемент → один блок в _service_info_blocks_blocks:
title, subtitle, items[] → title, subtitle, items:[{text}]
image, reverse, footer_text, button_* сейчас не используются → по умолчанию image:0, reverse:0, position:'after_what-included', footer_text:'', button_*:''.
Показания/противопоказания (indications):
left_title → _service_indications_left_title
left_items[] → _service_indications_left_items (массив строк)
right_title → _service_indications_right_title
right_items[] → _service_indications_right_items
SEO:
seo.meta_description → _service_meta_description
5. Какие секции включаются автоматически
После импорта услуге ставится:
_service_sections_enabled = [  'hero',  'benefits',  'clinic-benefits',  'cta',  'work-stages',  'what-included',  'info-blocks',  'indications',];
what-included пока можно оставлять пустым или заполнять руками.
Для услуг с 1 этапом по договорённости:
автогенерация этапов не используется, вместо этого вручную можно делать инфо‑блок.
6. Сейчас НЕ делаем
Не импортируем:
блок «Цены» (_service_prices_*);
картинки и иконки (все image/icon = 0, потом можно выставить руками или доработать импорт);
cta-2 и связанные поля.
Все мед/финансовые формулировки в текстах считаем согласованными с заказчиком.