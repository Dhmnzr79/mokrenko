<?php
/**
 * Регистрация таксономии для услуг
 * 
 * Таксономия service_category позволяет группировать услуги по категориям
 * Используется для меню, навигации и SEO
 */

add_action('init', 'register_service_taxonomy', 0);

function register_service_taxonomy() {
    register_taxonomy('service_category', 'service', [
        'labels' => [
            'name' => __('Категории услуг', 'mokrenko'),
            'singular_name' => __('Категория услуги', 'mokrenko'),
            'search_items' => __('Искать категории', 'mokrenko'),
            'all_items' => __('Все категории', 'mokrenko'),
            'parent_item' => __('Родительская категория', 'mokrenko'),
            'parent_item_colon' => __('Родительская категория:', 'mokrenko'),
            'edit_item' => __('Редактировать категорию', 'mokrenko'),
            'update_item' => __('Обновить категорию', 'mokrenko'),
            'add_new_item' => __('Добавить новую категорию', 'mokrenko'),
            'new_item_name' => __('Название новой категории', 'mokrenko'),
            'menu_name' => __('Категории', 'mokrenko'),
        ],
        'hierarchical' => true, // Иерархическая (как категории постов)
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true, // Показывать колонку в списке услуг
        'show_in_nav_menus' => true, // Доступна в меню навигации
        'show_tag_cloud' => false,
        'rewrite' => [
            'slug' => 'services/category',
            'with_front' => false,
            'hierarchical' => true
        ],
        'query_var' => true,
        'show_in_rest' => true, // Поддержка Gutenberg
    ]);
}




