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
    // Для любых других типов используем стандартный single.php без вывода отладки
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

// Рендерим только включенные секции в фиксированном порядке
$rendered_count = 0;
$after_indications_inserted = false;
foreach ($sections_order as $section_slug) {
    // Проверяем, включена ли секция
    if (!in_array($section_slug, $enabled_sections)) {
        continue;
    }
    
    // Проверяем, существует ли конфигурация секции
    $section_config = $sections_config[$section_slug] ?? null;
    if (!$section_config) {
        continue;
    }
    
    // На Этапе 2 не проверяем наличие данных - рендерим все включенные секции
    // Проверка данных будет добавлена на Этапе 3, когда блоки будут реализованы
    // if (!has_service_section_data($post_id, $section_slug)) {
    //     continue;
    // }
    
    // Рендерим секцию
    $template_path = "template-parts/services/blocks/{$section_config['template']}";
    
    get_template_part($template_path, null, [
        'post_id' => $post_id,
        'section_slug' => $section_slug,
        'meta' => get_service_meta($post_id),
        'section_data' => get_service_section_data($post_id, $section_slug)
    ]);
    
    $rendered_count++;

    if (in_array('info-blocks', $enabled_sections)) {
        $info_blocks_data = get_service_section_data($post_id, 'info-blocks');
        $all_blocks = isset($info_blocks_data['blocks']) && is_array($info_blocks_data['blocks']) ? $info_blocks_data['blocks'] : [];
        $position = 'after_' . $section_slug;

        $blocks_for_position = array_values(array_filter($all_blocks, function($block) use ($position) {
            if (!is_array($block)) return false;
            $block_position = isset($block['position']) ? (string)$block['position'] : '';
            if ($block_position === '') $block_position = 'after_what-included';
            return $block_position === $position;
        }));

        if (!empty($blocks_for_position)) {
            get_template_part('template-parts/services/blocks/info-blocks', null, [
                'post_id' => $post_id,
                'section_slug' => 'info-blocks',
                'meta' => get_service_meta($post_id),
                'section_data' => ['blocks' => $blocks_for_position]
            ]);
        }
    }

    // После блока "Противопоказания" (indications) добавляем общие template-parts в заданном порядке
    if ($section_slug === 'indications' && !$after_indications_inserted) {
        get_template_part('template-parts/section/social-proof');
        get_template_part('template-parts/section/awards');
        get_template_part('template-parts/section/location');
        get_template_part('template-parts/section/contacts');
        $after_indications_inserted = true;
    }
}

// Если ничего не отрендерилось — просто ничего не выводим (без отладки)

endwhile; endif;

get_footer();

