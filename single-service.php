<?php
/**
 * Template for single service post type
 * Шаблон страницы услуги
 * 
 * Единый шаблон для всех услуг.
 * Собирает страницу из включенных секций.
 */

// Принудительно проверяем, что это услуга
if (get_post_type() !== 'service') {
    // Если это не услуга, используем стандартный single.php
    // Но сначала покажем предупреждение для админов
    if (current_user_can('manage_options')) {
        get_header();
        echo '<div style="background: #f8d7da; padding: 20px; margin: 20px; border: 2px solid #dc3545;">';
        echo '<h2>⚠️ Ошибка: Это не услуга!</h2>';
        echo '<p><strong>Текущий тип:</strong> ' . get_post_type() . '</p>';
        echo '<p><strong>Нужный тип:</strong> service</p>';
        echo '<p>Создайте услугу через: <strong>Услуги → Добавить новую</strong></p>';
        echo '</div>';
        get_footer();
        return;
    }
    // Для обычных пользователей - редирект на стандартный шаблон
    locate_template('single.php', true);
    return;
}

get_header();

// Стандартный цикл WordPress для single post
if (have_posts()) : while (have_posts()) : the_post();
    
    $post_id = get_the_ID();
    $enabled_sections = get_service_enabled_sections($post_id);
    $sections_config = get_service_sections_config();
    $sections_order = get_service_sections_order();

// Отладочная информация для Этапа 2 (всегда показываем админам)
if (current_user_can('manage_options')) {
    echo '<div style="background: #fff3cd; padding: 15px; margin: 20px; border: 2px solid #ffc107; position: relative; z-index: 9999;">';
    echo '<h3>🔍 Отладка секций (Этап 2)</h3>';
    echo '<p><strong>Post ID:</strong> ' . esc_html($post_id) . '</p>';
    echo '<p><strong>Post Type:</strong> ' . esc_html(get_post_type()) . '</p>';
    echo '<p><strong>Включенные секции:</strong> ' . (empty($enabled_sections) ? '<span style="color: red;">НЕТ (это проблема!)</span>' : '<span style="color: green;">' . implode(', ', $enabled_sections) . '</span>') . '</p>';
    echo '<p><strong>Порядок секций:</strong> ' . implode(' → ', $sections_order) . '</p>';
    echo '<p><strong>Всего секций в реестре:</strong> ' . count($sections_config) . '</p>';
    
    // Проверяем meta напрямую
    $meta_direct = get_post_meta($post_id, '_service_sections_enabled', true);
    echo '<p><strong>Meta напрямую:</strong> ';
    if (empty($meta_direct)) {
        echo '<span style="color: red;">ПУСТО (секции не сохранены!)</span>';
    } else {
        echo '<pre>' . print_r($meta_direct, true) . '</pre>';
    }
    echo '</p>';
    
    echo '<p><strong>Секции, которые должны отобразиться:</strong> ';
    $to_render = [];
    foreach ($sections_order as $section_slug) {
        if (in_array($section_slug, $enabled_sections)) {
            $to_render[] = $section_slug;
        }
    }
    echo empty($to_render) ? '<span style="color: red;">НИ ОДНОЙ</span>' : implode(', ', $to_render);
    echo '</p>';
    echo '</div>';
}

// Рендерим только включенные секции в фиксированном порядке
$rendered_count = 0;
foreach ($sections_order as $section_slug) {
    // Проверяем, включена ли секция
    if (!in_array($section_slug, $enabled_sections)) {
        continue;
    }
    
    // Проверяем, существует ли конфигурация секции
    $section_config = $sections_config[$section_slug] ?? null;
    if (!$section_config) {
        if (current_user_can('manage_options')) {
            echo '<div style="background: #f8d7da; padding: 10px; margin: 10px; border: 1px solid #dc3545;">';
            echo '⚠️ Секция "' . esc_html($section_slug) . '" не найдена в реестре!';
            echo '</div>';
        }
        continue;
    }
    
    // На Этапе 2 не проверяем наличие данных - рендерим все включенные секции
    // Проверка данных будет добавлена на Этапе 3, когда блоки будут реализованы
    // if (!has_service_section_data($post_id, $section_slug)) {
    //     continue;
    // }
    
    // Рендерим секцию
    $template_path = "template-parts/services/blocks/{$section_config['template']}";
    
    if (current_user_can('manage_options')) {
        $section_data_debug = get_service_section_data($post_id, $section_slug);
        echo '<div style="background: #d1ecf1; padding: 5px; margin: 5px 0; border-left: 3px solid #0c5460; font-size: 12px;">';
        echo '🔄 Рендерим секцию: ' . esc_html($section_slug) . ' → ' . esc_html($template_path);
        if ($section_slug === 'hero' && !empty($section_data_debug)) {
            echo '<br>📊 Данные Hero: ' . count($section_data_debug) . ' полей';
        }
        echo '</div>';
    }
    
    get_template_part($template_path, null, [
        'post_id' => $post_id,
        'section_slug' => $section_slug,
        'meta' => get_service_meta($post_id),
        'section_data' => get_service_section_data($post_id, $section_slug)
    ]);
    
    $rendered_count++;
}

// Если ничего не отрендерилось
if ($rendered_count === 0 && current_user_can('manage_options')) {
    echo '<div style="background: #f8d7da; padding: 20px; margin: 20px; border: 2px solid #dc3545;">';
    echo '<h3>❌ Проблема: Ни одна секция не отрендерилась!</h3>';
    echo '<p>Возможные причины:</p>';
    echo '<ul>';
    echo '<li>Секции не включены (проверь чекбоксы в админке)</li>';
    echo '<li>Секции не сохранились (попробуй сохранить услугу заново)</li>';
    echo '<li>Проблема с загрузкой meta-данных</li>';
    echo '</ul>';
    echo '</div>';
}

endwhile; endif;

get_footer();

