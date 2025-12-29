<?php
/**
 * Регистрация Custom Post Type для услуг
 */

add_action('init', 'register_service_post_type');

function register_service_post_type() {
    register_post_type('service', [
        'labels' => [
            'name' => __('Услуги', 'mokrenko'),
            'singular_name' => __('Услуга', 'mokrenko'),
            'add_new' => __('Добавить услугу', 'mokrenko'),
            'add_new_item' => __('Добавить новую услугу', 'mokrenko'),
            'edit_item' => __('Редактировать услугу', 'mokrenko'),
            'new_item' => __('Новая услуга', 'mokrenko'),
            'view_item' => __('Просмотреть услугу', 'mokrenko'),
            'search_items' => __('Искать услуги', 'mokrenko'),
            'not_found' => __('Услуги не найдены', 'mokrenko'),
            'not_found_in_trash' => __('В корзине услуг не найдено', 'mokrenko')
        ],
        'public' => true,
        'has_archive' => false, // Архив отключен, как рекомендовано
        'menu_icon' => 'dashicons-admin-tools',
        'menu_position' => 26,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest' => true,
        'rewrite' => [
            'slug' => 'services',
            'with_front' => false
        ],
        'publicly_queryable' => true,
        'query_var' => true,
        'has_archive' => false,
    ]);
}

