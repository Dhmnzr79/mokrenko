<?php
/**
 * Регистрация meta-полей для услуг
 */

add_action('init', 'register_service_meta_fields');

function register_service_meta_fields() {
    // Основное поле для включенных секций
    register_post_meta('service', '_service_sections_enabled', [
        'type' => 'array',
        'sanitize_callback' => 'sanitize_service_sections_enabled',
        'show_in_rest' => true,
        'single' => true,
        'default' => []
    ]);
    
    // Поля Hero секции
    $hero_fields = [
        '_service_hero_title' => [
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'show_in_rest' => true,
            'single' => true
        ],
        '_service_hero_subtitle' => [
            'type' => 'string',
            'sanitize_callback' => 'sanitize_textarea_field',
            'show_in_rest' => true,
            'single' => true
        ],
        '_service_hero_benefits' => [
            'type' => 'array',
            'sanitize_callback' => 'sanitize_service_hero_benefits',
            'show_in_rest' => true,
            'single' => true
        ],
        '_service_hero_image' => [
            'type' => 'integer',
            'sanitize_callback' => 'absint',
            'show_in_rest' => true,
            'single' => true
        ],
        '_service_hero_info_title' => [
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'show_in_rest' => true,
            'single' => true
        ],
        '_service_hero_info_text' => [
            'type' => 'string',
            'sanitize_callback' => 'sanitize_textarea_field',
            'show_in_rest' => true,
            'single' => true
        ],
        '_service_hero_button_text' => [
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'show_in_rest' => true,
            'single' => true
        ],
        '_service_hero_button_link' => [
            'type' => 'string',
            'sanitize_callback' => 'esc_url_raw',
            'show_in_rest' => true,
            'single' => true
        ],
    ];
    
    foreach ($hero_fields as $field => $args) {
        register_post_meta('service', $field, $args);
    }
    
    // Поля Benefits секции
    register_post_meta('service', '_service_benefits_items', [
        'type' => 'array',
        'sanitize_callback' => 'sanitize_service_benefits_items',
        'show_in_rest' => true,
        'single' => true,
        'default' => []
    ]);

    // Поля секции "Общие плюсы клиники"
    register_post_meta('service', '_service_clinic_benefits_title', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'show_in_rest' => true,
        'single' => true,
    ]);
    register_post_meta('service', '_service_clinic_benefits_subtitle', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_textarea_field',
        'show_in_rest' => true,
        'single' => true,
    ]);
    register_post_meta('service', '_service_clinic_benefits_cards', [
        'type' => 'array',
        'sanitize_callback' => 'sanitize_service_clinic_benefits_cards',
        'show_in_rest' => true,
        'single' => true,
        'default' => [],
    ]);
    register_post_meta('service', '_service_clinic_benefits_feature_card', [
        'type' => 'array',
        'sanitize_callback' => 'sanitize_service_clinic_benefits_feature_card',
        'show_in_rest' => true,
        'single' => true,
        'default' => [],
    ]);

    // Поля CTA секции
    register_post_meta('service', '_service_cta_title', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'show_in_rest' => true,
        'single' => true,
    ]);

    register_post_meta('service', '_service_cta_subtitle', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_textarea_field',
        'show_in_rest' => true,
        'single' => true,
    ]);

    register_post_meta('service', '_service_cta_cards', [
        'type' => 'array',
        'sanitize_callback' => 'sanitize_service_cta_cards',
        'show_in_rest' => true,
        'single' => true,
        'default' => [],
    ]);

    // Поля Work Stages секции
    register_post_meta('service', '_service_work_stages_title', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'show_in_rest' => true,
        'single' => true,
    ]);

    register_post_meta('service', '_service_work_stages_subtitle', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_textarea_field',
        'show_in_rest' => true,
        'single' => true,
    ]);

    register_post_meta('service', '_service_work_stages_stage_1', [
        'type' => 'array',
        'sanitize_callback' => 'sanitize_service_work_stages_stage',
        'show_in_rest' => true,
        'single' => true,
        'default' => [],
    ]);

    register_post_meta('service', '_service_work_stages_stage_2', [
        'type' => 'array',
        'sanitize_callback' => 'sanitize_service_work_stages_stage',
        'show_in_rest' => true,
        'single' => true,
        'default' => [],
    ]);

}

/**
 * Санитизация массива преимуществ Hero секции
 */
function sanitize_service_hero_benefits($value) {
    if (!is_array($value)) {
        return [];
    }
    
    $sanitized = [];
    foreach ($value as $benefit) {
        if (isset($benefit['text']) && !empty($benefit['text'])) {
            $sanitized[] = [
                'icon' => isset($benefit['icon']) ? absint($benefit['icon']) : '',
                'text' => sanitize_text_field($benefit['text'])
            ];
        }
    }
    
    return $sanitized;
}

/**
 * Санитизация массива карточек Benefits секции
 * 
 * @param mixed $value
 * @return array
 */
function sanitize_service_benefits_items($value) {
    if (!is_array($value)) {
        return [];
    }
    
    $sanitized = [];
    foreach ($value as $item) {
        if (is_array($item) && (!empty($item['title']) || !empty($item['text']))) {
            $sanitized[] = [
                'icon' => isset($item['icon']) ? absint($item['icon']) : 0,
                'title' => isset($item['title']) ? sanitize_text_field($item['title']) : '',
                'text' => isset($item['text']) ? sanitize_textarea_field($item['text']) : '',
            ];
        }
    }
    
    return $sanitized;
}

function sanitize_service_clinic_benefits_cards($value) {
    if (!is_array($value)) {
        return [];
    }

    $sanitized = [];

    foreach ($value as $card) {
        if (
            is_array($card) &&
            (!empty($card['title']) || !empty($card['text']))
        ) {
            $sanitized[] = [
                'icon'  => isset($card['icon']) ? absint($card['icon']) : 0,
                'title' => isset($card['title']) ? sanitize_text_field($card['title']) : '',
                'text'  => isset($card['text']) ? sanitize_textarea_field($card['text']) : '',
            ];
        }
    }

    return $sanitized;
}

function sanitize_service_clinic_benefits_feature_card($value) {
    if (!is_array($value)) {
        return [];
    }

    return [
        'icon'        => isset($value['icon']) ? absint($value['icon']) : 0,
        'title'       => isset($value['title']) ? sanitize_text_field($value['title']) : '',
        'text'        => isset($value['text']) ? sanitize_textarea_field($value['text']) : '',
        'button_text' => isset($value['button_text']) ? sanitize_text_field($value['button_text']) : '',
        'button_link' => isset($value['button_link']) ? esc_url_raw($value['button_link']) : '',
    ];
}

/**
 * Санитизация массива карточек CTA секции
 * 
 * @param mixed $value
 * @return array
 */
function sanitize_service_cta_cards($value) {
    if (!is_array($value)) {
        return [];
    }
    
    $sanitized = [];
    foreach ($value as $card) {
        if (is_array($card) && isset($card['text']) && !empty($card['text'])) {
            $sanitized[] = [
                'text' => sanitize_textarea_field($card['text']),
            ];
        }
    }
    
    return $sanitized;
}

/**
 * Санитизация данных этапа работы
 * 
 * @param mixed $value
 * @return array
 */
function sanitize_service_work_stages_stage($value) {
    if (!is_array($value)) {
        return [];
    }
    
    $sanitized = [
        'title' => isset($value['title']) ? sanitize_text_field($value['title']) : '',
        'image' => isset($value['image']) ? absint($value['image']) : 0,
        'checklist' => [],
    ];
    
    if (isset($value['checklist']) && is_array($value['checklist'])) {
        foreach ($value['checklist'] as $item) {
            if (is_array($item) && (!empty($item['title']) || !empty($item['description']))) {
                $sanitized['checklist'][] = [
                    'title' => isset($item['title']) ? sanitize_text_field($item['title']) : '',
                    'description' => isset($item['description']) ? sanitize_textarea_field($item['description']) : '',
                ];
            }
        }
    }
    
    return $sanitized;
}

/**
 * Санитизация массива включенных секций
 * 
 * @param mixed $value
 * @return array
 */
function sanitize_service_sections_enabled($value) {
    if (!is_array($value)) {
        return [];
    }
    
    // Получаем список доступных секций
    $sections_config = get_service_sections_config();
    $available_slugs = array_keys($sections_config);
    
    // Фильтруем только валидные slug'и
    $sanitized = array_filter($value, function($slug) use ($available_slugs) {
        return in_array($slug, $available_slugs);
    });
    
    return array_values($sanitized);
}

