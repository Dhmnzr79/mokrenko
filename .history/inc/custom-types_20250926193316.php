<?php
/**
 * Регистрация CPT и метаполей для врачей и кейсов
 */

// Регистрация CPT
add_action('init', 'theme_register_custom_post_types');
function theme_register_custom_post_types() {
    // CPT: Врачи
    register_post_type('doctor', [
        'labels' => [
            'name' => __('Врачи', 'mokrenko'),
            'singular_name' => __('Врач', 'mokrenko'),
            'add_new' => __('Добавить врача', 'mokrenko'),
            'add_new_item' => __('Добавить нового врача', 'mokrenko'),
            'edit_item' => __('Редактировать врача', 'mokrenko'),
            'new_item' => __('Новый врач', 'mokrenko'),
            'view_item' => __('Просмотреть врача', 'mokrenko'),
            'search_items' => __('Поиск врачей', 'mokrenko'),
            'not_found' => __('Врачи не найдены', 'mokrenko'),
            'not_found_in_trash' => __('В корзине врачей не найдено', 'mokrenko')
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-admin-users',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'doctors']
    ]);

    // CPT: Кейсы
    register_post_type('case', [
        'labels' => [
            'name' => __('Кейсы', 'mokrenko'),
            'singular_name' => __('Кейс', 'mokrenko'),
            'add_new' => __('Добавить кейс', 'mokrenko'),
            'add_new_item' => __('Добавить новый кейс', 'mokrenko'),
            'edit_item' => __('Редактировать кейс', 'mokrenko'),
            'new_item' => __('Новый кейс', 'mokrenko'),
            'view_item' => __('Просмотреть кейс', 'mokrenko'),
            'search_items' => __('Поиск кейсов', 'mokrenko'),
            'not_found' => __('Кейсы не найдены', 'mokrenko'),
            'not_found_in_trash' => __('В корзине кейсов не найдено', 'mokrenko')
        ],
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => ['title', 'thumbnail', 'editor'],
        'show_in_rest' => true
    ]);

    // Таксономия: Специализация
    register_taxonomy('specialty', 'doctor', [
        'labels' => [
            'name' => __('Специализации', 'mokrenko'),
            'singular_name' => __('Специализация', 'mokrenko'),
            'search_items' => __('Поиск специализаций', 'mokrenko'),
            'all_items' => __('Все специализации', 'mokrenko'),
            'edit_item' => __('Редактировать специализацию', 'mokrenko'),
            'update_item' => __('Обновить специализацию', 'mokrenko'),
            'add_new_item' => __('Добавить специализацию', 'mokrenko'),
            'new_item_name' => __('Название специализации', 'mokrenko'),
            'menu_name' => __('Специализации', 'mokrenko')
        ],
        'hierarchical' => true,
        'public' => true,
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'specialty']
    ]);

    // Таксономия: Клиники
    register_taxonomy('clinic', 'doctor', [
        'labels' => [
            'name' => __('Клиники', 'mokrenko'),
            'singular_name' => __('Клиника', 'mokrenko'),
            'search_items' => __('Поиск клиник', 'mokrenko'),
            'all_items' => __('Все клиники', 'mokrenko'),
            'edit_item' => __('Редактировать клинику', 'mokrenko'),
            'update_item' => __('Обновить клинику', 'mokrenko'),
            'add_new_item' => __('Добавить клинику', 'mokrenko'),
            'new_item_name' => __('Название клиники', 'mokrenko'),
            'menu_name' => __('Клиники', 'mokrenko')
        ],
        'hierarchical' => false,
        'public' => true,
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'clinic']
    ]);
}

// Регистрация метаполей
add_action('init', 'theme_register_meta_fields');
function theme_register_meta_fields() {
    // Метаполя для врачей
    $doctor_meta_fields = [
        'doctor_position' => [
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'show_in_rest' => true,
            'single' => true
        ],
        'doctor_experience_years' => [
            'type' => 'integer',
            'sanitize_callback' => 'absint',
            'show_in_rest' => true,
            'single' => true
        ],
        'doctor_fact_1' => [
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'show_in_rest' => true,
            'single' => true
        ],
        'doctor_fact_2' => [
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'show_in_rest' => true,
            'single' => true
        ],
        'doctor_fact_3' => [
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'show_in_rest' => true,
            'single' => true
        ],
        'doctor_education' => [
            'type' => 'string',
            'sanitize_callback' => 'wp_kses_post',
            'show_in_rest' => true,
            'single' => true
        ],
        'doctor_video_url' => [
            'type' => 'string',
            'sanitize_callback' => 'esc_url_raw',
            'show_in_rest' => true,
            'single' => true
        ],
        'doctor_certs_json' => [
            'type' => 'string',
            'sanitize_callback' => 'sanitize_textarea_field',
            'show_in_rest' => true,
            'single' => true
        ]
    ];

    foreach ($doctor_meta_fields as $field => $args) {
        register_post_meta('doctor', $field, $args);
    }

    // Метаполя для кейсов
    $case_meta_fields = [
        'case_doctor_id' => [
            'type' => 'integer',
            'sanitize_callback' => 'absint',
            'show_in_rest' => true,
            'single' => true
        ],
        'case_before_image' => [
            'type' => 'integer',
            'sanitize_callback' => 'absint',
            'show_in_rest' => true,
            'single' => true
        ],
        'case_before_desc' => [
            'type' => 'string',
            'sanitize_callback' => 'wp_kses_post',
            'show_in_rest' => true,
            'single' => true
        ],
        'case_after_image' => [
            'type' => 'integer',
            'sanitize_callback' => 'absint',
            'show_in_rest' => true,
            'single' => true
        ],
        'case_after_desc' => [
            'type' => 'string',
            'sanitize_callback' => 'wp_kses_post',
            'show_in_rest' => true,
            'single' => true
        ],
        'case_duration' => [
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'show_in_rest' => true,
            'single' => true
        ],
        'case_show_on_home' => [
            'type' => 'boolean',
            'sanitize_callback' => 'rest_sanitize_boolean',
            'show_in_rest' => true,
            'single' => true
        ],
        'case_categories' => [
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'show_in_rest' => true,
            'single' => true
        ]
    ];

    foreach ($case_meta_fields as $field => $args) {
        register_post_meta('case', $field, $args);
    }
}
