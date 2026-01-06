<?php
/**
 * Метабоксы для услуг
 */

add_action('add_meta_boxes', 'add_service_meta_boxes');

function add_service_meta_boxes() {
    add_meta_box(
        'service_sections',
        __('Управление секциями', 'mokrenko'),
        'render_service_sections_meta_box',
        'service',
        'side',
        'high'
    );
    
    // Метабокс для Hero секции (показывается только если секция включена)
    add_meta_box(
        'service_hero',
        __('Hero секция', 'mokrenko'),
        'render_service_hero_meta_box',
        'service',
        'normal',
        'high'
    );
    
    // Метабокс для Benefits секции
    add_meta_box(
        'service_benefits',
        __('Преимущества (Benefits)', 'mokrenko'),
        'render_service_benefits_meta_box',
        'service',
        'normal',
        'high'
    );
    
    // Метабокс для Clinic Benefits секции
    add_meta_box(
        'service_clinic_benefits',
        __('Общие плюсы клиники', 'mokrenko'),
        'render_service_clinic_benefits_meta_box',
        'service',
        'normal',
        'high'
    );

    // Метабокс для секции "Цены"
    add_meta_box(
        'service_prices',
        __('Цены', 'mokrenko'),
        'render_service_prices_meta_box',
        'service',
        'normal',
        'high'
    );
    
    // Метабокс для CTA секции
    add_meta_box(
        'service_cta',
        __('Призыв к действию (CTA)', 'mokrenko'),
        'render_service_cta_meta_box',
        'service',
        'normal',
        'high'
    );
    
    // Метабокс для Work Stages секции
    add_meta_box(
        'service_work_stages',
        __('Этапы работ', 'mokrenko'),
        'render_service_work_stages_meta_box',
        'service',
        'normal',
        'high'
    );

    // Метабокс для секции "Что входит в услугу"
    add_meta_box(
        'service_what_included',
        __('Что входит в услугу', 'mokrenko'),
        'render_service_what_included_meta_box',
        'service',
        'normal',
        'high'
    );

    // Метабокс для секции "Инфо-блоки"
    add_meta_box(
        'service_info_blocks',
        __('Инфо-блоки', 'mokrenko'),
        'render_service_info_blocks_meta_box',
        'service',
        'normal',
        'high'
    );

    // Метабокс для секции "Показания и противопоказания"
    add_meta_box(
        'service_indications',
        __('Показания и противопоказания', 'mokrenko'),
        'render_service_indications_meta_box',
        'service',
        'normal',
        'high'
    );
}

/**
 * Рендер метабокса для управления секциями
 */
function render_service_sections_meta_box($post) {
    wp_nonce_field('service_sections_nonce', 'service_sections_nonce');
    
    $enabled_sections = get_service_enabled_sections($post->ID);
    $sections_config = get_service_sections_config();
    
    ?>
    <div class="service-sections-control">
        <p><strong>Выберите секции для отображения:</strong></p>
        <ul style="list-style: none; margin: 0; padding: 0;">
            <?php foreach ($sections_config as $slug => $config) : ?>
                <li style="margin-bottom: 8px;">
                    <label>
                        <input 
                            type="checkbox" 
                            name="service_sections_enabled[]" 
                            value="<?php echo esc_attr($slug); ?>"
                            <?php checked(in_array($slug, $enabled_sections)); ?>
                        >
                        <?php echo esc_html($config['label']); ?>
                        <?php if ($config['type'] === 'unique') : ?>
                            <span style="color: #999; font-size: 11px;">(уникальная)</span>
                        <?php endif; ?>
                    </label>
                </li>
            <?php endforeach; ?>
        </ul>
        <p class="description">
            Отметьте секции, которые должны отображаться на странице услуги.
        </p>
    </div>
    <?php
}

/**
 * Сохранение метабокса секций
 */
add_action('save_post_service', 'save_service_sections_meta_box');

function save_service_sections_meta_box($post_id) {
    // Проверка nonce
    if (!isset($_POST['service_sections_nonce']) || 
        !wp_verify_nonce($_POST['service_sections_nonce'], 'service_sections_nonce')) {
        return;
    }
    
    // Проверка autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Проверка прав
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Сохранение включенных секций
    $enabled = isset($_POST['service_sections_enabled']) 
        ? array_map('sanitize_text_field', $_POST['service_sections_enabled'])
        : [];
    
    update_post_meta($post_id, '_service_sections_enabled', $enabled);
}

/**
 * Рендер метабокса Hero секции
 */
function render_service_hero_meta_box($post) {
    wp_nonce_field('service_hero_nonce', 'service_hero_nonce');
    
    // Получаем данные Hero секции
    $hero_title = get_post_meta($post->ID, '_service_hero_title', true);
    $hero_subtitle = get_post_meta($post->ID, '_service_hero_subtitle', true);
    $hero_benefits = get_post_meta($post->ID, '_service_hero_benefits', true);
    $hero_benefits = $hero_benefits ? (is_array($hero_benefits) ? $hero_benefits : json_decode($hero_benefits, true)) : [];
    if (!is_array($hero_benefits)) $hero_benefits = [];
    
    // Заполняем пустые слоты для 3 индексов
    while (count($hero_benefits) < 3) {
        $hero_benefits[] = ['icon' => '', 'text' => ''];
    }
    
    $hero_image = get_post_meta($post->ID, '_service_hero_image', true);
    $hero_info_title = get_post_meta($post->ID, '_service_hero_info_title', true);
    $hero_info_text = get_post_meta($post->ID, '_service_hero_info_text', true);
    $hero_extra_line = get_post_meta($post->ID, '_service_hero_extra_line', true);
    $hero_button_text = get_post_meta($post->ID, '_service_hero_button_text', true);
    $hero_button_link = get_post_meta($post->ID, '_service_hero_button_link', true);
    
    ?>
    <div class="service-hero-meta-box">
        <table class="form-table">
            <tr>
                <th><label for="service_hero_title"><?php _e('Заголовок', 'mokrenko'); ?></label></th>
                <td>
                    <input type="text" id="service_hero_title" name="service_hero_title" value="<?php echo esc_attr($hero_title); ?>" style="width: 100%;" />
                    <p class="description"><?php _e('Основной заголовок Hero секции', 'mokrenko'); ?></p>
                </td>
            </tr>
            <tr>
                <th><label for="service_hero_subtitle"><?php _e('Расшифровка заголовка', 'mokrenko'); ?></label></th>
                <td>
                    <textarea id="service_hero_subtitle" name="service_hero_subtitle" rows="2" style="width: 100%;"><?php echo esc_textarea($hero_subtitle); ?></textarea>
                    <p class="description"><?php _e('Подзаголовок или краткое описание', 'mokrenko'); ?></p>
                </td>
            </tr>
        </table>
        
        <h3><?php _e('Преимущества (3 индекса)', 'mokrenko'); ?></h3>
        <table class="form-table">
            <?php for ($i = 0; $i < 3; $i++) : 
                $benefit = isset($hero_benefits[$i]) ? $hero_benefits[$i] : ['icon' => '', 'text' => ''];
                $benefit_icon = isset($benefit['icon']) ? $benefit['icon'] : '';
                $benefit_text = isset($benefit['text']) ? $benefit['text'] : '';
            ?>
            <tr>
                <th><label><?php printf(__('Преимущество %d', 'mokrenko'), $i + 1); ?></label></th>
                <td>
                    <div style="display: flex; gap: 10px; align-items: flex-start;">
                        <div style="flex: 0 0 200px;">
                            <button type="button" class="button select-hero-benefit-icon" data-index="<?php echo $i; ?>">
                                <?php _e('Выбрать иконку', 'mokrenko'); ?>
                            </button>
                            <div class="hero-benefit-icon-preview" data-index="<?php echo $i; ?>" style="margin-top: 10px;">
                                <?php if ($benefit_icon) : ?>
                                    <?php echo wp_get_attachment_image($benefit_icon, 'thumbnail'); ?>
                                    <button type="button" class="button remove-hero-benefit-icon" data-index="<?php echo $i; ?>" style="margin-top: 5px;"><?php _e('Удалить', 'mokrenko'); ?></button>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="service_hero_benefits[<?php echo $i; ?>][icon]" class="hero-benefit-icon-input" data-index="<?php echo $i; ?>" value="<?php echo esc_attr($benefit_icon); ?>" />
                        </div>
                        <div style="flex: 1;">
                            <input type="text" name="service_hero_benefits[<?php echo $i; ?>][text]" value="<?php echo esc_attr($benefit_text); ?>" placeholder="<?php _e('Текст преимущества...', 'mokrenko'); ?>" style="width: 100%;" />
                        </div>
                    </div>
                </td>
            </tr>
            <?php endfor; ?>
        </table>
        
        <h3><?php _e('Фото услуги', 'mokrenko'); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="service_hero_image"><?php _e('Изображение', 'mokrenko'); ?></label></th>
                <td>
                    <button type="button" class="button" id="select-hero-image"><?php _e('Выбрать изображение', 'mokrenko'); ?></button>
                    <div id="hero-image-preview" style="margin-top: 10px;">
                        <?php if ($hero_image) : ?>
                            <?php echo wp_get_attachment_image($hero_image, 'medium'); ?>
                            <button type="button" class="button" id="remove-hero-image" style="margin-top: 5px;"><?php _e('Удалить', 'mokrenko'); ?></button>
                        <?php endif; ?>
                    </div>
                    <input type="hidden" id="service_hero_image" name="service_hero_image" value="<?php echo esc_attr($hero_image); ?>" />
                    <p class="description"><?php _e('Уникальное фото для этой услуги (будет отображаться через img, не background)', 'mokrenko'); ?></p>
                </td>
            </tr>
        </table>
        
        <h3><?php _e('Мини-индекс поверх фото', 'mokrenko'); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="service_hero_info_title"><?php _e('Заголовок мини-индекса', 'mokrenko'); ?></label></th>
                <td>
                    <input type="text" id="service_hero_info_title" name="service_hero_info_title" value="<?php echo esc_attr($hero_info_title); ?>" style="width: 100%;" />
                </td>
            </tr>
            <tr>
                <th><label for="service_hero_info_text"><?php _e('Текст мини-индекса', 'mokrenko'); ?></label></th>
                <td>
                    <textarea id="service_hero_info_text" name="service_hero_info_text" rows="3" style="width: 100%;"><?php echo esc_textarea($hero_info_text); ?></textarea>
                </td>
            </tr>
        </table>
        
        <h3><?php _e('Дополнительная строка (между индексами и кнопкой)', 'mokrenko'); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="service_hero_extra_line"><?php _e('Текст строки', 'mokrenko'); ?></label></th>
                <td>
                    <input type="text" id="service_hero_extra_line" name="service_hero_extra_line" value="<?php echo esc_attr($hero_extra_line); ?>" style="width: 100%;" />
                </td>
            </tr>
        </table>

        <h3><?php _e('Кнопка', 'mokrenko'); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="service_hero_button_text"><?php _e('Текст кнопки', 'mokrenko'); ?></label></th>
                <td>
                    <input type="text" id="service_hero_button_text" name="service_hero_button_text" value="<?php echo esc_attr($hero_button_text); ?>" style="width: 100%;" placeholder="<?php _e('Например: Записаться на консультацию', 'mokrenko'); ?>" />
                </td>
            </tr>
            <tr>
                <th><label for="service_hero_button_link"><?php _e('Ссылка кнопки (опционально)', 'mokrenko'); ?></label></th>
                <td>
                    <input type="url" id="service_hero_button_link" name="service_hero_button_link" value="<?php echo esc_attr($hero_button_link); ?>" style="width: 100%;" placeholder="<?php _e('Оставьте пустым для открытия попапа', 'mokrenko'); ?>" />
                    <p class="description"><?php _e('Если пусто, кнопка откроет попап (data-popup="open")', 'mokrenko'); ?></p>
                </td>
            </tr>
        </table>
    </div>
    <?php
}

/**
 * Сохранение метабокса Hero секции
 */
add_action('save_post_service', 'save_service_hero_meta_box');

function save_service_hero_meta_box($post_id) {
    // Проверка nonce
    if (!isset($_POST['service_hero_nonce']) || 
        !wp_verify_nonce($_POST['service_hero_nonce'], 'service_hero_nonce')) {
        return;
    }
    
    // Проверка autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Проверка прав
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Сохранение полей Hero секции
    if (isset($_POST['service_hero_title'])) {
        update_post_meta($post_id, '_service_hero_title', sanitize_text_field($_POST['service_hero_title']));
    }
    
    if (isset($_POST['service_hero_subtitle'])) {
        update_post_meta($post_id, '_service_hero_subtitle', sanitize_textarea_field($_POST['service_hero_subtitle']));
    }
    
    // Сохранение преимуществ (массив)
    if (isset($_POST['service_hero_benefits']) && is_array($_POST['service_hero_benefits'])) {
        $benefits = [];
        foreach ($_POST['service_hero_benefits'] as $benefit) {
            if (!empty($benefit['text'])) {
                $benefits[] = [
                    'icon' => isset($benefit['icon']) ? absint($benefit['icon']) : '',
                    'text' => sanitize_text_field($benefit['text'])
                ];
            }
        }
        update_post_meta($post_id, '_service_hero_benefits', $benefits);
    } else {
        delete_post_meta($post_id, '_service_hero_benefits');
    }
    
    if (isset($_POST['service_hero_image'])) {
        update_post_meta($post_id, '_service_hero_image', absint($_POST['service_hero_image']));
    }
    
    if (isset($_POST['service_hero_info_title'])) {
        update_post_meta($post_id, '_service_hero_info_title', sanitize_text_field($_POST['service_hero_info_title']));
    }
    
    if (isset($_POST['service_hero_info_text'])) {
        update_post_meta($post_id, '_service_hero_info_text', sanitize_textarea_field($_POST['service_hero_info_text']));
    }

    if (isset($_POST['service_hero_extra_line'])) {
        update_post_meta($post_id, '_service_hero_extra_line', sanitize_text_field($_POST['service_hero_extra_line']));
    }
    
    if (isset($_POST['service_hero_button_text'])) {
        update_post_meta($post_id, '_service_hero_button_text', sanitize_text_field($_POST['service_hero_button_text']));
    }
    
    if (isset($_POST['service_hero_button_link'])) {
        update_post_meta($post_id, '_service_hero_button_link', esc_url_raw($_POST['service_hero_button_link']));
    }
}

/**
 * Рендер метабокса Benefits секции
 */
function render_service_benefits_meta_box($post) {
    wp_nonce_field('service_benefits_nonce', 'service_benefits_nonce');
    
    $benefits_items = get_post_meta($post->ID, '_service_benefits_items', true);
    $benefits_items = $benefits_items ? (is_array($benefits_items) ? $benefits_items : json_decode($benefits_items, true)) : [];
    if (!is_array($benefits_items)) $benefits_items = [];
    
    // Заполняем пустые слоты для 4 карточек
    while (count($benefits_items) < 4) {
        $benefits_items[] = ['icon' => 0, 'title' => '', 'text' => ''];
    }
    
    ?>
    <div class="service-benefits-meta-box">
        <p class="description"><?php _e('Заполните 4 карточки преимуществ. Каждая карточка содержит иконку, заголовок и текст.', 'mokrenko'); ?></p>
        
        <table class="form-table">
            <?php for ($i = 0; $i < 4; $i++) : 
                $item = isset($benefits_items[$i]) ? $benefits_items[$i] : ['icon' => 0, 'title' => '', 'text' => ''];
                $item_icon = isset($item['icon']) ? absint($item['icon']) : 0;
                $item_title = isset($item['title']) ? $item['title'] : '';
                $item_text = isset($item['text']) ? $item['text'] : '';
            ?>
            <tr>
                <th><label><?php printf(__('Карточка %d', 'mokrenko'), $i + 1); ?></label></th>
                <td>
                    <div style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 4px;">
                        <div style="display: flex; gap: 15px; margin-bottom: 15px; align-items: flex-start;">
                            <div style="flex: 0 0 200px;">
                                <button type="button" class="button select-benefits-icon" data-index="<?php echo $i; ?>">
                                    <?php _e('Выбрать иконку', 'mokrenko'); ?>
                                </button>
                                <div class="benefits-icon-preview" data-index="<?php echo $i; ?>" style="margin-top: 10px;">
                                    <?php if ($item_icon) : ?>
                                        <?php echo wp_get_attachment_image($item_icon, 'thumbnail'); ?>
                                        <button type="button" class="button remove-benefits-icon" data-index="<?php echo $i; ?>" style="margin-top: 5px;"><?php _e('Удалить', 'mokrenko'); ?></button>
                                    <?php endif; ?>
                                </div>
                                <input type="hidden" name="service_benefits_items[<?php echo $i; ?>][icon]" class="benefits-icon-input" data-index="<?php echo $i; ?>" value="<?php echo esc_attr($item_icon); ?>" />
                            </div>
                            <div style="flex: 1;">
                                <label style="display: block; margin-bottom: 5px; font-weight: 600;"><?php _e('Заголовок', 'mokrenko'); ?></label>
                                <input type="text" name="service_benefits_items[<?php echo $i; ?>][title]" value="<?php echo esc_attr($item_title); ?>" placeholder="<?php _e('Заголовок карточки...', 'mokrenko'); ?>" style="width: 100%; margin-bottom: 10px;" />
                                <label style="display: block; margin-bottom: 5px; font-weight: 600;"><?php _e('Текст', 'mokrenko'); ?></label>
                                <textarea name="service_benefits_items[<?php echo $i; ?>][text]" rows="3" placeholder="<?php _e('Текст карточки...', 'mokrenko'); ?>" style="width: 100%;"><?php echo esc_textarea($item_text); ?></textarea>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <?php endfor; ?>
        </table>
    </div>
    <?php
}

/**
 * Сохранение метабокса Benefits секции
 */
add_action('save_post_service', 'save_service_benefits_meta_box');

function save_service_benefits_meta_box($post_id) {
    // Проверка nonce
    if (!isset($_POST['service_benefits_nonce']) || 
        !wp_verify_nonce($_POST['service_benefits_nonce'], 'service_benefits_nonce')) {
        return;
    }
    
    // Проверка autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Проверка прав
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Сохранение карточек преимуществ
    if (isset($_POST['service_benefits_items']) && is_array($_POST['service_benefits_items'])) {
        $items = [];
        foreach ($_POST['service_benefits_items'] as $item) {
            if (!empty($item['title']) || !empty($item['text'])) {
                $items[] = [
                    'icon' => isset($item['icon']) ? absint($item['icon']) : 0,
                    'title' => isset($item['title']) ? sanitize_text_field($item['title']) : '',
                    'text' => isset($item['text']) ? sanitize_textarea_field($item['text']) : '',
                ];
            }
        }
        update_post_meta($post_id, '_service_benefits_items', $items);
    } else {
        delete_post_meta($post_id, '_service_benefits_items');
    }
}

/**
 * Рендер метабокса Clinic Benefits секции
 */
function render_service_clinic_benefits_meta_box($post) {
    wp_nonce_field('service_clinic_benefits_nonce', 'service_clinic_benefits_nonce');
    
    // Получаем данные Clinic Benefits секции
    $title = get_post_meta($post->ID, '_service_clinic_benefits_title', true);
    $subtitle = get_post_meta($post->ID, '_service_clinic_benefits_subtitle', true);
    $cards = get_post_meta($post->ID, '_service_clinic_benefits_cards', true);
    $cards = $cards ? (is_array($cards) ? $cards : json_decode($cards, true)) : [];
    if (!is_array($cards)) $cards = [];
    
    // Заполняем пустые слоты для 4 карточек
    while (count($cards) < 4) {
        $cards[] = ['icon' => 0, 'title' => '', 'text' => ''];
    }
    
    $feature_card = get_post_meta($post->ID, '_service_clinic_benefits_feature_card', true);
    $feature_card = $feature_card ? (is_array($feature_card) ? $feature_card : json_decode($feature_card, true)) : [];
    if (!is_array($feature_card)) $feature_card = ['icon' => 0, 'title' => '', 'text' => '', 'button_text' => '', 'button_link' => ''];
    
    ?>
    <div class="service-clinic-benefits-meta-box">
        <h3><?php _e('Заголовок секции', 'mokrenko'); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="service_clinic_benefits_title"><?php _e('Заголовок', 'mokrenko'); ?></label></th>
                <td>
                    <input type="text" id="service_clinic_benefits_title" name="service_clinic_benefits_title" value="<?php echo esc_attr($title); ?>" style="width: 100%;" />
                </td>
            </tr>
            <tr>
                <th><label for="service_clinic_benefits_subtitle"><?php _e('Расшифровка заголовка', 'mokrenko'); ?></label></th>
                <td>
                    <textarea id="service_clinic_benefits_subtitle" name="service_clinic_benefits_subtitle" rows="2" style="width: 100%;"><?php echo esc_textarea($subtitle); ?></textarea>
                </td>
            </tr>
        </table>
        
        <h3><?php _e('4 карточки (левая часть)', 'mokrenko'); ?></h3>
        <p class="description"><?php _e('Заполните 4 карточки для левой части секции (8 колонок). Каждая карточка содержит иконку, заголовок и текст.', 'mokrenko'); ?></p>
        <table class="form-table">
            <?php for ($i = 0; $i < 4; $i++) : 
                $card = isset($cards[$i]) ? $cards[$i] : ['icon' => 0, 'title' => '', 'text' => ''];
                $card_icon = isset($card['icon']) ? absint($card['icon']) : 0;
                $card_title = isset($card['title']) ? $card['title'] : '';
                $card_text = isset($card['text']) ? $card['text'] : '';
            ?>
            <tr>
                <th><label><?php printf(__('Карточка %d', 'mokrenko'), $i + 1); ?></label></th>
                <td>
                    <div style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 4px;">
                        <div style="display: flex; gap: 15px; align-items: flex-start;">
                            <div style="flex: 0 0 200px;">
                                <button type="button" class="button select-clinic-benefits-card-icon" data-index="<?php echo $i; ?>">
                                    <?php _e('Выбрать иконку', 'mokrenko'); ?>
                                </button>
                                <div class="clinic-benefits-card-icon-preview" data-index="<?php echo $i; ?>" style="margin-top: 10px;">
                                    <?php if ($card_icon) : ?>
                                        <?php echo wp_get_attachment_image($card_icon, 'thumbnail'); ?>
                                        <button type="button" class="button remove-clinic-benefits-card-icon" data-index="<?php echo $i; ?>" style="margin-top: 5px;"><?php _e('Удалить', 'mokrenko'); ?></button>
                                    <?php endif; ?>
                                </div>
                                <input type="hidden" name="service_clinic_benefits_cards[<?php echo $i; ?>][icon]" class="clinic-benefits-card-icon-input" data-index="<?php echo $i; ?>" value="<?php echo esc_attr($card_icon); ?>" />
                            </div>
                            <div style="flex: 1;">
                                <label style="display: block; margin-bottom: 5px; font-weight: 600;"><?php _e('Заголовок', 'mokrenko'); ?></label>
                                <input type="text" name="service_clinic_benefits_cards[<?php echo $i; ?>][title]" value="<?php echo esc_attr($card_title); ?>" placeholder="<?php _e('Заголовок карточки...', 'mokrenko'); ?>" style="width: 100%; margin-bottom: 10px;" />
                                <label style="display: block; margin-bottom: 5px; font-weight: 600;"><?php _e('Текст', 'mokrenko'); ?></label>
                                <textarea name="service_clinic_benefits_cards[<?php echo $i; ?>][text]" rows="3" placeholder="<?php _e('Текст карточки...', 'mokrenko'); ?>" style="width: 100%;"><?php echo esc_textarea($card_text); ?></textarea>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <?php endfor; ?>
        </table>
        
        <h3><?php _e('Большая карточка (правая часть)', 'mokrenko'); ?></h3>
        <p class="description"><?php _e('Заполните большую карточку для правой части секции (4 колонки).', 'mokrenko'); ?></p>
        <table class="form-table">
            <tr>
                <th><label><?php _e('Иконка', 'mokrenko'); ?></label></th>
                <td>
                    <button type="button" class="button select-clinic-benefits-feature-icon">
                        <?php _e('Выбрать иконку', 'mokrenko'); ?>
                    </button>
                    <div class="clinic-benefits-feature-icon-preview" style="margin-top: 10px;">
                        <?php if (!empty($feature_card['icon'])) : ?>
                            <?php echo wp_get_attachment_image($feature_card['icon'], 'thumbnail'); ?>
                            <button type="button" class="button remove-clinic-benefits-feature-icon" style="margin-top: 5px;"><?php _e('Удалить', 'mokrenko'); ?></button>
                        <?php endif; ?>
                    </div>
                    <input type="hidden" name="service_clinic_benefits_feature_card[icon]" class="clinic-benefits-feature-icon-input" value="<?php echo esc_attr(isset($feature_card['icon']) ? $feature_card['icon'] : 0); ?>" />
                </td>
            </tr>
            <tr>
                <th><label for="service_clinic_benefits_feature_title"><?php _e('Заголовок', 'mokrenko'); ?></label></th>
                <td>
                    <input type="text" id="service_clinic_benefits_feature_title" name="service_clinic_benefits_feature_card[title]" value="<?php echo esc_attr(isset($feature_card['title']) ? $feature_card['title'] : ''); ?>" style="width: 100%;" />
                </td>
            </tr>
            <tr>
                <th><label for="service_clinic_benefits_feature_text"><?php _e('Текст', 'mokrenko'); ?></label></th>
                <td>
                    <textarea id="service_clinic_benefits_feature_text" name="service_clinic_benefits_feature_card[text]" rows="3" style="width: 100%;"><?php echo esc_textarea(isset($feature_card['text']) ? $feature_card['text'] : ''); ?></textarea>
                </td>
            </tr>
            <tr>
                <th><label for="service_clinic_benefits_feature_button_text"><?php _e('Текст кнопки', 'mokrenko'); ?></label></th>
                <td>
                    <input type="text" id="service_clinic_benefits_feature_button_text" name="service_clinic_benefits_feature_card[button_text]" value="<?php echo esc_attr(isset($feature_card['button_text']) ? $feature_card['button_text'] : ''); ?>" style="width: 100%;" placeholder="<?php _e('Например: Записаться на консультацию', 'mokrenko'); ?>" />
                </td>
            </tr>
            <tr>
                <th><label for="service_clinic_benefits_feature_button_link"><?php _e('Ссылка кнопки (опционально)', 'mokrenko'); ?></label></th>
                <td>
                    <input type="url" id="service_clinic_benefits_feature_button_link" name="service_clinic_benefits_feature_card[button_link]" value="<?php echo esc_attr(isset($feature_card['button_link']) ? $feature_card['button_link'] : ''); ?>" style="width: 100%;" placeholder="<?php _e('Оставьте пустым для открытия попапа', 'mokrenko'); ?>" />
                    <p class="description"><?php _e('Если пусто, кнопка откроет попап (data-popup="open")', 'mokrenko'); ?></p>
                </td>
            </tr>
        </table>
    </div>
    <?php
}

/**
 * Сохранение метабокса Clinic Benefits секции
 */
add_action('save_post_service', 'save_service_clinic_benefits_meta_box');

function save_service_clinic_benefits_meta_box($post_id) {
    // Проверка nonce
    if (!isset($_POST['service_clinic_benefits_nonce']) || 
        !wp_verify_nonce($_POST['service_clinic_benefits_nonce'], 'service_clinic_benefits_nonce')) {
        return;
    }
    
    // Проверка autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Проверка прав
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Сохранение заголовка и подзаголовка
    if (isset($_POST['service_clinic_benefits_title'])) {
        update_post_meta($post_id, '_service_clinic_benefits_title', sanitize_text_field($_POST['service_clinic_benefits_title']));
    }
    
    if (isset($_POST['service_clinic_benefits_subtitle'])) {
        update_post_meta($post_id, '_service_clinic_benefits_subtitle', sanitize_textarea_field($_POST['service_clinic_benefits_subtitle']));
    }
    
    // Сохранение карточек
    if (isset($_POST['service_clinic_benefits_cards']) && is_array($_POST['service_clinic_benefits_cards'])) {
        $cards = [];
        foreach ($_POST['service_clinic_benefits_cards'] as $card) {
            if (!empty($card['title']) || !empty($card['text'])) {
                $cards[] = [
                    'icon' => isset($card['icon']) ? absint($card['icon']) : 0,
                    'title' => isset($card['title']) ? sanitize_text_field($card['title']) : '',
                    'text' => isset($card['text']) ? sanitize_textarea_field($card['text']) : '',
                ];
            }
        }
        update_post_meta($post_id, '_service_clinic_benefits_cards', $cards);
    } else {
        delete_post_meta($post_id, '_service_clinic_benefits_cards');
    }
    
    // Сохранение большой карточки
    if (isset($_POST['service_clinic_benefits_feature_card']) && is_array($_POST['service_clinic_benefits_feature_card'])) {
        $feature_card = [
            'icon' => isset($_POST['service_clinic_benefits_feature_card']['icon']) ? absint($_POST['service_clinic_benefits_feature_card']['icon']) : 0,
            'title' => isset($_POST['service_clinic_benefits_feature_card']['title']) ? sanitize_text_field($_POST['service_clinic_benefits_feature_card']['title']) : '',
            'text' => isset($_POST['service_clinic_benefits_feature_card']['text']) ? sanitize_textarea_field($_POST['service_clinic_benefits_feature_card']['text']) : '',
            'button_text' => isset($_POST['service_clinic_benefits_feature_card']['button_text']) ? sanitize_text_field($_POST['service_clinic_benefits_feature_card']['button_text']) : '',
            'button_link' => isset($_POST['service_clinic_benefits_feature_card']['button_link']) ? esc_url_raw($_POST['service_clinic_benefits_feature_card']['button_link']) : '',
        ];
        update_post_meta($post_id, '_service_clinic_benefits_feature_card', $feature_card);
    } else {
        delete_post_meta($post_id, '_service_clinic_benefits_feature_card');
    }
}

function render_service_prices_meta_box($post) {
    wp_nonce_field('service_prices_nonce', 'service_prices_nonce');
    
    $title = get_post_meta($post->ID, '_service_prices_title', true);
    $items = get_post_meta($post->ID, '_service_prices_items', true);
    $items = $items ? (is_array($items) ? $items : json_decode($items, true)) : [];
    if (!is_array($items)) $items = [];
    
    ?>
    <div class="service-prices-meta-box">
        <table class="form-table">
            <tr>
                <th><label for="service_prices_title"><?php _e('Заголовок секции', 'mokrenko'); ?></label></th>
                <td>
                    <input type="text" id="service_prices_title" name="service_prices_title" value="<?php echo esc_attr($title); ?>" placeholder="<?php _e('Цены', 'mokrenko'); ?>" style="width: 100%;" />
                </td>
            </tr>
        </table>
        
        <h3><?php _e('Позиции', 'mokrenko'); ?></h3>
        <div id="service-prices-items" data-next-index="<?php echo esc_attr(count($items)); ?>">
            <?php foreach ($items as $i => $item) :
                $item_name = isset($item['name']) ? $item['name'] : '';
                $item_price = isset($item['price']) ? $item['price'] : '';
                $item_old_price = isset($item['old_price']) ? $item['old_price'] : '';
            ?>
                <div class="service-prices-item" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 4px;">
                    <div style="display: flex; gap: 10px; align-items: flex-start;">
                        <div style="flex: 1; min-width: 0;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;"><?php _e('Название', 'mokrenko'); ?></label>
                            <input type="text" name="service_prices_items[<?php echo esc_attr($i); ?>][name]" value="<?php echo esc_attr($item_name); ?>" style="width: 100%;" />
                        </div>
                        <div style="flex: 0 0 160px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;"><?php _e('Цена', 'mokrenko'); ?></label>
                            <input type="text" name="service_prices_items[<?php echo esc_attr($i); ?>][price]" value="<?php echo esc_attr($item_price); ?>" style="width: 100%;" />
                        </div>
                        <div style="flex: 0 0 160px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;"><?php _e('Старая цена', 'mokrenko'); ?></label>
                            <input type="text" name="service_prices_items[<?php echo esc_attr($i); ?>][old_price]" value="<?php echo esc_attr($item_old_price); ?>" style="width: 100%;" />
                        </div>
                        <div style="flex: 0 0 120px; padding-top: 24px;">
                            <button type="button" class="button service-prices-remove"><?php _e('Удалить', 'mokrenko'); ?></button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <p>
            <button type="button" class="button button-secondary service-prices-add"><?php _e('Добавить цену', 'mokrenko'); ?></button>
        </p>
    </div>
    <?php
}

add_action('save_post_service', 'save_service_prices_meta_box');

function save_service_prices_meta_box($post_id) {
    if (!isset($_POST['service_prices_nonce']) ||
        !wp_verify_nonce($_POST['service_prices_nonce'], 'service_prices_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['service_prices_title'])) {
        update_post_meta($post_id, '_service_prices_title', sanitize_text_field($_POST['service_prices_title']));
    }
    
    if (isset($_POST['service_prices_items']) && is_array($_POST['service_prices_items'])) {
        $items = [];
        
        foreach ($_POST['service_prices_items'] as $item) {
            if (!is_array($item)) {
                continue;
            }
            
            $name = isset($item['name']) ? sanitize_text_field($item['name']) : '';
            $price = isset($item['price']) ? sanitize_text_field($item['price']) : '';
            $old_price = isset($item['old_price']) ? sanitize_text_field($item['old_price']) : '';
            
            if ($name === '' && $price === '' && $old_price === '') {
                continue;
            }
            
            $items[] = [
                'name' => $name,
                'price' => $price,
                'old_price' => $old_price,
            ];
        }
        
        if (!empty($items)) {
            update_post_meta($post_id, '_service_prices_items', $items);
        } else {
            delete_post_meta($post_id, '_service_prices_items');
        }
    } else {
        delete_post_meta($post_id, '_service_prices_items');
    }
}

/**
 * Рендер метабокса CTA секции
 */
function render_service_cta_meta_box($post) {
    wp_nonce_field('service_cta_nonce', 'service_cta_nonce');
    
    $cta_title = get_post_meta($post->ID, '_service_cta_title', true);
    $cta_subtitle = get_post_meta($post->ID, '_service_cta_subtitle', true);
    $cta_cards = get_post_meta($post->ID, '_service_cta_cards', true);
    $cta_cards = $cta_cards ? (is_array($cta_cards) ? $cta_cards : json_decode($cta_cards, true)) : [];
    if (!is_array($cta_cards)) $cta_cards = [];
    
    // Заполняем пустые слоты для 4 карточек
    while (count($cta_cards) < 4) {
        $cta_cards[] = ['text' => ''];
    }
    
    ?>
    <div class="service-cta-meta-box">
        <h3><?php _e('Левая часть (6 колонок)', 'mokrenko'); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="service_cta_title"><?php _e('Заголовок', 'mokrenko'); ?></label></th>
                <td>
                    <input type="text" id="service_cta_title" name="service_cta_title" value="<?php echo esc_attr($cta_title); ?>" style="width: 100%;" />
                </td>
            </tr>
            <tr>
                <th><label for="service_cta_subtitle"><?php _e('Расшифровка', 'mokrenko'); ?></label></th>
                <td>
                    <textarea id="service_cta_subtitle" name="service_cta_subtitle" rows="3" style="width: 100%;"><?php echo esc_textarea($cta_subtitle); ?></textarea>
                </td>
            </tr>
        </table>
        
        <h3><?php _e('Правая часть (6 колонок) - 4 карточки', 'mokrenko'); ?></h3>
        <p class="description"><?php _e('Заполните 4 карточки. Каждая карточка содержит только текст.', 'mokrenko'); ?></p>
        <table class="form-table">
            <?php for ($i = 0; $i < 4; $i++) : 
                $card_text = isset($cta_cards[$i]['text']) ? $cta_cards[$i]['text'] : '';
            ?>
            <tr>
                <th><label><?php printf(__('Карточка %d', 'mokrenko'), $i + 1); ?></label></th>
                <td>
                    <textarea name="service_cta_cards[<?php echo $i; ?>][text]" rows="3" placeholder="<?php _e('Текст карточки...', 'mokrenko'); ?>" style="width: 100%;"><?php echo esc_textarea($card_text); ?></textarea>
                </td>
            </tr>
            <?php endfor; ?>
        </table>
        <p class="description">
            <strong><?php _e('Примечание:', 'mokrenko'); ?></strong> <?php _e('Тексты формы ("Оставьте заявку" и т.п.) прописаны в шаблоне и не редактируются здесь.', 'mokrenko'); ?>
        </p>
    </div>
    <?php
}

/**
 * Сохранение метабокса CTA секции
 */
add_action('save_post_service', 'save_service_cta_meta_box');

function save_service_cta_meta_box($post_id) {
    if (!isset($_POST['service_cta_nonce']) || 
        !wp_verify_nonce($_POST['service_cta_nonce'], 'service_cta_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['service_cta_title'])) {
        update_post_meta($post_id, '_service_cta_title', sanitize_text_field($_POST['service_cta_title']));
    }
    
    if (isset($_POST['service_cta_subtitle'])) {
        update_post_meta($post_id, '_service_cta_subtitle', sanitize_textarea_field($_POST['service_cta_subtitle']));
    }
    
    if (isset($_POST['service_cta_cards']) && is_array($_POST['service_cta_cards'])) {
        $cards = [];
        foreach ($_POST['service_cta_cards'] as $card) {
            if (!empty($card['text'])) {
                $cards[] = [
                    'text' => sanitize_textarea_field($card['text']),
                ];
            }
        }
        update_post_meta($post_id, '_service_cta_cards', $cards);
    } else {
        delete_post_meta($post_id, '_service_cta_cards');
    }
}

/**
 * Рендер метабокса Work Stages секции
 */
function render_service_work_stages_meta_box($post) {
    wp_nonce_field('service_work_stages_nonce', 'service_work_stages_nonce');
    
    $title = get_post_meta($post->ID, '_service_work_stages_title', true);
    $subtitle = get_post_meta($post->ID, '_service_work_stages_subtitle', true);
    $stage_1 = get_post_meta($post->ID, '_service_work_stages_stage_1', true);
    $stage_1 = $stage_1 ? (is_array($stage_1) ? $stage_1 : json_decode($stage_1, true)) : [];
    if (!is_array($stage_1)) $stage_1 = ['title' => '', 'image' => 0, 'checklist' => []];
    
    $stage_2 = get_post_meta($post->ID, '_service_work_stages_stage_2', true);
    $stage_2 = $stage_2 ? (is_array($stage_2) ? $stage_2 : json_decode($stage_2, true)) : [];
    if (!is_array($stage_2)) $stage_2 = ['title' => '', 'image' => 0, 'checklist' => []];
    
    // Заполняем чек-листы минимум 3 пунктами
    if (!isset($stage_1['checklist']) || !is_array($stage_1['checklist'])) {
        $stage_1['checklist'] = [];
    }
    while (count($stage_1['checklist']) < 3) {
        $stage_1['checklist'][] = ['title' => '', 'description' => ''];
    }
    
    if (!isset($stage_2['checklist']) || !is_array($stage_2['checklist'])) {
        $stage_2['checklist'] = [];
    }
    while (count($stage_2['checklist']) < 3) {
        $stage_2['checklist'][] = ['title' => '', 'description' => ''];
    }
    
    ?>
    <div class="service-work-stages-meta-box">
        <h3><?php _e('Заголовок секции', 'mokrenko'); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="service_work_stages_title"><?php _e('Заголовок', 'mokrenko'); ?></label></th>
                <td>
                    <input type="text" id="service_work_stages_title" name="service_work_stages_title" value="<?php echo esc_attr($title); ?>" style="width: 100%;" />
                </td>
            </tr>
            <tr>
                <th><label for="service_work_stages_subtitle"><?php _e('Расшифровка', 'mokrenko'); ?></label></th>
                <td>
                    <textarea id="service_work_stages_subtitle" name="service_work_stages_subtitle" rows="2" style="width: 100%;"><?php echo esc_textarea($subtitle); ?></textarea>
                </td>
            </tr>
        </table>
        
        <h3><?php _e('Этап 1', 'mokrenko'); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="service_work_stages_stage_1_title"><?php _e('Заголовок этапа', 'mokrenko'); ?></label></th>
                <td>
                    <input type="text" id="service_work_stages_stage_1_title" name="service_work_stages_stage_1[title]" value="<?php echo esc_attr($stage_1['title'] ?? ''); ?>" style="width: 100%;" />
                </td>
            </tr>
            <tr>
                <th><label><?php _e('Картинка', 'mokrenko'); ?></label></th>
                <td>
                    <button type="button" class="button select-work-stages-stage-1-image">
                        <?php _e('Выбрать изображение', 'mokrenko'); ?>
                    </button>
                    <div class="work-stages-stage-1-image-preview" style="margin-top: 10px;">
                        <?php if (!empty($stage_1['image'])) : ?>
                            <?php echo wp_get_attachment_image($stage_1['image'], 'medium'); ?>
                            <button type="button" class="button remove-work-stages-stage-1-image" style="margin-top: 5px;"><?php _e('Удалить', 'mokrenko'); ?></button>
                        <?php endif; ?>
                    </div>
                    <input type="hidden" name="service_work_stages_stage_1[image]" class="work-stages-stage-1-image-input" value="<?php echo esc_attr($stage_1['image'] ?? 0); ?>" />
                </td>
            </tr>
            <tr>
                <th><label><?php _e('Чек-лист этапа', 'mokrenko'); ?></label></th>
                <td>
                    <div id="work-stages-stage-1-checklist">
                        <?php foreach ($stage_1['checklist'] as $i => $item) : ?>
                            <div class="work-stages-checklist-item" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 4px;">
                                <label style="display: block; margin-bottom: 5px; font-weight: 600;"><?php _e('Заголовок пункта', 'mokrenko'); ?></label>
                                <input type="text" name="service_work_stages_stage_1[checklist][<?php echo $i; ?>][title]" value="<?php echo esc_attr($item['title'] ?? ''); ?>" placeholder="<?php _e('Заголовок...', 'mokrenko'); ?>" style="width: 100%; margin-bottom: 10px;" />
                                <label style="display: block; margin-bottom: 5px; font-weight: 600;"><?php _e('Описание', 'mokrenko'); ?></label>
                                <textarea name="service_work_stages_stage_1[checklist][<?php echo $i; ?>][description]" rows="2" placeholder="<?php _e('Описание...', 'mokrenko'); ?>" style="width: 100%;"><?php echo esc_textarea($item['description'] ?? ''); ?></textarea>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </td>
            </tr>
        </table>
        
        <h3><?php _e('Этап 2', 'mokrenko'); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="service_work_stages_stage_2_title"><?php _e('Заголовок этапа', 'mokrenko'); ?></label></th>
                <td>
                    <input type="text" id="service_work_stages_stage_2_title" name="service_work_stages_stage_2[title]" value="<?php echo esc_attr($stage_2['title'] ?? ''); ?>" style="width: 100%;" />
                </td>
            </tr>
            <tr>
                <th><label><?php _e('Картинка', 'mokrenko'); ?></label></th>
                <td>
                    <button type="button" class="button select-work-stages-stage-2-image">
                        <?php _e('Выбрать изображение', 'mokrenko'); ?>
                    </button>
                    <div class="work-stages-stage-2-image-preview" style="margin-top: 10px;">
                        <?php if (!empty($stage_2['image'])) : ?>
                            <?php echo wp_get_attachment_image($stage_2['image'], 'medium'); ?>
                            <button type="button" class="button remove-work-stages-stage-2-image" style="margin-top: 5px;"><?php _e('Удалить', 'mokrenko'); ?></button>
                        <?php endif; ?>
                    </div>
                    <input type="hidden" name="service_work_stages_stage_2[image]" class="work-stages-stage-2-image-input" value="<?php echo esc_attr($stage_2['image'] ?? 0); ?>" />
                </td>
            </tr>
            <tr>
                <th><label><?php _e('Чек-лист этапа', 'mokrenko'); ?></label></th>
                <td>
                    <div id="work-stages-stage-2-checklist">
                        <?php foreach ($stage_2['checklist'] as $i => $item) : ?>
                            <div class="work-stages-checklist-item" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 4px;">
                                <label style="display: block; margin-bottom: 5px; font-weight: 600;"><?php _e('Заголовок пункта', 'mokrenko'); ?></label>
                                <input type="text" name="service_work_stages_stage_2[checklist][<?php echo $i; ?>][title]" value="<?php echo esc_attr($item['title'] ?? ''); ?>" placeholder="<?php _e('Заголовок...', 'mokrenko'); ?>" style="width: 100%; margin-bottom: 10px;" />
                                <label style="display: block; margin-bottom: 5px; font-weight: 600;"><?php _e('Описание', 'mokrenko'); ?></label>
                                <textarea name="service_work_stages_stage_2[checklist][<?php echo $i; ?>][description]" rows="2" placeholder="<?php _e('Описание...', 'mokrenko'); ?>" style="width: 100%;"><?php echo esc_textarea($item['description'] ?? ''); ?></textarea>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <?php
}

/**
 * Сохранение метабокса Work Stages секции
 */
add_action('save_post_service', 'save_service_work_stages_meta_box');

function save_service_work_stages_meta_box($post_id) {
    if (!isset($_POST['service_work_stages_nonce']) || 
        !wp_verify_nonce($_POST['service_work_stages_nonce'], 'service_work_stages_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['service_work_stages_title'])) {
        update_post_meta($post_id, '_service_work_stages_title', sanitize_text_field($_POST['service_work_stages_title']));
    }
    
    if (isset($_POST['service_work_stages_subtitle'])) {
        update_post_meta($post_id, '_service_work_stages_subtitle', sanitize_textarea_field($_POST['service_work_stages_subtitle']));
    }
    
    if (isset($_POST['service_work_stages_stage_1']) && is_array($_POST['service_work_stages_stage_1'])) {
        $stage_1 = [
            'title' => isset($_POST['service_work_stages_stage_1']['title']) ? sanitize_text_field($_POST['service_work_stages_stage_1']['title']) : '',
            'image' => isset($_POST['service_work_stages_stage_1']['image']) ? absint($_POST['service_work_stages_stage_1']['image']) : 0,
            'checklist' => [],
        ];
        
        if (isset($_POST['service_work_stages_stage_1']['checklist']) && is_array($_POST['service_work_stages_stage_1']['checklist'])) {
            foreach ($_POST['service_work_stages_stage_1']['checklist'] as $item) {
                if (is_array($item) && (!empty($item['title']) || !empty($item['description']))) {
                    $stage_1['checklist'][] = [
                        'title' => isset($item['title']) ? sanitize_text_field($item['title']) : '',
                        'description' => isset($item['description']) ? sanitize_textarea_field($item['description']) : '',
                    ];
                }
            }
        }
        
        update_post_meta($post_id, '_service_work_stages_stage_1', $stage_1);
    }
    
    if (isset($_POST['service_work_stages_stage_2']) && is_array($_POST['service_work_stages_stage_2'])) {
        $stage_2 = [
            'title' => isset($_POST['service_work_stages_stage_2']['title']) ? sanitize_text_field($_POST['service_work_stages_stage_2']['title']) : '',
            'image' => isset($_POST['service_work_stages_stage_2']['image']) ? absint($_POST['service_work_stages_stage_2']['image']) : 0,
            'checklist' => [],
        ];
        
        if (isset($_POST['service_work_stages_stage_2']['checklist']) && is_array($_POST['service_work_stages_stage_2']['checklist'])) {
            foreach ($_POST['service_work_stages_stage_2']['checklist'] as $item) {
                if (is_array($item) && (!empty($item['title']) || !empty($item['description']))) {
                    $stage_2['checklist'][] = [
                        'title' => isset($item['title']) ? sanitize_text_field($item['title']) : '',
                        'description' => isset($item['description']) ? sanitize_textarea_field($item['description']) : '',
                    ];
                }
            }
        }
        
        update_post_meta($post_id, '_service_work_stages_stage_2', $stage_2);
    }
}

/**
 * Рендер метабокса секции "Что входит в услугу"
 */
function render_service_what_included_meta_box($post) {
    wp_nonce_field('service_what_included_nonce', 'service_what_included_nonce');

    $section_title = get_post_meta($post->ID, '_service_what_included_title', true);

    $items = get_post_meta($post->ID, '_service_what_included_items', true);
    $items = $items ? (is_array($items) ? $items : json_decode($items, true)) : [];
    if (!is_array($items)) {
        $items = [];
    }

    // Заполняем пустые слоты (чтобы контент-менеджеру было проще)
    while (count($items) < 6) {
        $items[] = ['title' => '', 'description' => ''];
    }

    ?>
    <div class="service-what-included-meta-box">
        <p class="description">
            <?php _e('Заполните заголовок (слева) и пункты: каждый пункт — заголовок + описание.', 'mokrenko'); ?>
        </p>

        <table class="form-table">
            <tr>
                <th><label for="service_what_included_title"><?php _e('Заголовок слева', 'mokrenko'); ?></label></th>
                <td>
                    <input type="text" id="service_what_included_title" name="service_what_included_title" value="<?php echo esc_attr($section_title); ?>" style="width: 100%;" />
                    <p class="description"><?php _e('Выводится в левой колонке блока (может отличаться у разных услуг).', 'mokrenko'); ?></p>
                </td>
            </tr>
            <?php for ($i = 0; $i < 6; $i++) :
                $item = isset($items[$i]) && is_array($items[$i]) ? $items[$i] : ['title' => '', 'description' => ''];
                $item_title = isset($item['title']) ? $item['title'] : '';
                $item_description = isset($item['description']) ? $item['description'] : '';
            ?>
                <tr>
                    <th><label><?php printf(__('Пункт %d', 'mokrenko'), $i + 1); ?></label></th>
                    <td>
                        <div style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 4px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;"><?php _e('Заголовок', 'mokrenko'); ?></label>
                            <input
                                type="text"
                                name="service_what_included_items[<?php echo $i; ?>][title]"
                                value="<?php echo esc_attr($item_title); ?>"
                                style="width: 100%; margin-bottom: 10px;"
                                placeholder="<?php _e('Заголовок пункта...', 'mokrenko'); ?>"
                            />

                            <label style="display: block; margin-bottom: 5px; font-weight: 600;"><?php _e('Описание', 'mokrenko'); ?></label>
                            <textarea
                                name="service_what_included_items[<?php echo $i; ?>][description]"
                                rows="3"
                                style="width: 100%;"
                                placeholder="<?php _e('Описание пункта...', 'mokrenko'); ?>"
                            ><?php echo esc_textarea($item_description); ?></textarea>
                        </div>
                    </td>
                </tr>
            <?php endfor; ?>
        </table>
    </div>
    <?php
}

/**
 * Сохранение метабокса секции "Что входит в услугу"
 */
add_action('save_post_service', 'save_service_what_included_meta_box');

function save_service_what_included_meta_box($post_id) {
    if (!isset($_POST['service_what_included_nonce']) ||
        !wp_verify_nonce($_POST['service_what_included_nonce'], 'service_what_included_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['service_what_included_title'])) {
        update_post_meta($post_id, '_service_what_included_title', sanitize_text_field($_POST['service_what_included_title']));
    }

    if (isset($_POST['service_what_included_items']) && is_array($_POST['service_what_included_items'])) {
        $items = [];
        foreach ($_POST['service_what_included_items'] as $item) {
            if (!is_array($item)) {
                continue;
            }

            $title = isset($item['title']) ? sanitize_text_field($item['title']) : '';
            $description = isset($item['description']) ? sanitize_textarea_field($item['description']) : '';

            if ($title === '' && $description === '') {
                continue;
            }

            $items[] = [
                'title' => $title,
                'description' => $description,
            ];
        }

        update_post_meta($post_id, '_service_what_included_items', $items);
    } else {
        delete_post_meta($post_id, '_service_what_included_items');
    }
}

/**
 * Рендер метабокса секции "Инфо-блоки"
 */
function render_service_info_blocks_meta_box($post) {
    wp_nonce_field('service_info_blocks_nonce', 'service_info_blocks_nonce');

    $blocks = get_post_meta($post->ID, '_service_info_blocks_blocks', true);
    $blocks = $blocks ? (is_array($blocks) ? $blocks : json_decode($blocks, true)) : [];
    if (!is_array($blocks)) {
        $blocks = [];
    }
    
    $positions = [
        'after_hero' => 'После Hero',
        'after_benefits' => 'После Преимуществ',
        'after_clinic-benefits' => 'После Общих плюсов клиники',
        'after_description' => 'После Описания',
        'after_prices' => 'После Цен',
        'after_cta' => 'После CTA',
        'after_work-stages' => 'После Этапов работ',
        'after_what-included' => 'После Что входит',
        'after_indications' => 'После Показаний',
        'after_reviews' => 'После Отзывов',
    ];

    ?>
    <div class="service-info-blocks-meta-box">
        <div id="service-info-blocks" data-next-index="<?php echo esc_attr(count($blocks)); ?>">
            <?php foreach ($blocks as $b => $block) :
                if (!is_array($block)) continue;
                $image = isset($block['image']) ? absint($block['image']) : 0;
                $title = isset($block['title']) ? (string)$block['title'] : '';
                $subtitle = isset($block['subtitle']) ? (string)$block['subtitle'] : '';
                $footer_text = isset($block['footer_text']) ? (string)$block['footer_text'] : '';
                $button_text = isset($block['button_text']) ? (string)$block['button_text'] : '';
                $button_link = isset($block['button_link']) ? (string)$block['button_link'] : '';
                $reverse = !empty($block['reverse']) ? 1 : 0;
                $position = isset($block['position']) ? (string)$block['position'] : '';
                if ($position === '' || !isset($positions[$position])) $position = 'after_what-included';

                $items = isset($block['items']) && is_array($block['items']) ? $block['items'] : [];
                if (!is_array($items)) $items = [];
            ?>
                <div class="service-info-blocks-item" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 4px;">
                    <div style="display:flex; justify-content: space-between; align-items: center; gap: 10px;">
                        <h3 style="margin: 0;"><?php echo esc_html(sprintf(__('Инфо-блок %d', 'mokrenko'), $b + 1)); ?></h3>
                        <button type="button" class="button service-info-blocks-remove"><?php _e('Удалить блок', 'mokrenko'); ?></button>
                    </div>

                    <table class="form-table">
                        <tr>
                            <th><label><?php _e('Позиция', 'mokrenko'); ?></label></th>
                            <td>
                                <select name="service_info_blocks_blocks[<?php echo esc_attr($b); ?>][position]" style="width: 100%;">
                                    <?php foreach ($positions as $val => $label) : ?>
                                        <option value="<?php echo esc_attr($val); ?>" <?php selected($position, $val); ?>><?php echo esc_html($label); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><label><?php _e('Картинка справа', 'mokrenko'); ?></label></th>
                            <td>
                                <label>
                                    <input type="checkbox" name="service_info_blocks_blocks[<?php echo esc_attr($b); ?>][reverse]" value="1" <?php checked($reverse, 1); ?> />
                                    <?php _e('Поменять местами картинку и контент', 'mokrenko'); ?>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th><label><?php _e('Картинка', 'mokrenko'); ?></label></th>
                            <td>
                                <button type="button" class="button select-info-block-image" data-block="<?php echo esc_attr($b); ?>">
                                    <?php _e('Выбрать изображение', 'mokrenko'); ?>
                                </button>
                                <div class="info-block-image-preview" data-block="<?php echo esc_attr($b); ?>" style="margin-top: 10px;">
                                    <?php if ($image) : ?>
                                        <?php echo wp_get_attachment_image($image, 'medium'); ?>
                                        <button type="button" class="button remove-info-block-image" data-block="<?php echo esc_attr($b); ?>" style="margin-top: 5px;"><?php _e('Удалить', 'mokrenko'); ?></button>
                                    <?php endif; ?>
                                </div>
                                <input type="hidden" name="service_info_blocks_blocks[<?php echo esc_attr($b); ?>][image]" class="info-block-image-input" data-block="<?php echo esc_attr($b); ?>" value="<?php echo esc_attr($image); ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th><label><?php _e('Заголовок', 'mokrenko'); ?></label></th>
                            <td>
                                <input type="text" name="service_info_blocks_blocks[<?php echo esc_attr($b); ?>][title]" value="<?php echo esc_attr($title); ?>" style="width: 100%;" />
                            </td>
                        </tr>
                        <tr>
                            <th><label><?php _e('Расшифровка', 'mokrenko'); ?></label></th>
                            <td>
                                <textarea name="service_info_blocks_blocks[<?php echo esc_attr($b); ?>][subtitle]" rows="3" style="width: 100%;"><?php echo esc_textarea($subtitle); ?></textarea>
                            </td>
                        </tr>
                    </table>

                    <h4 style="margin: 16px 0 8px;"><?php _e('Чек-лист', 'mokrenko'); ?></h4>
                    <div class="service-info-blocks-checklist" data-block="<?php echo esc_attr($b); ?>">
                        <?php foreach ($items as $i => $item) :
                            $text = is_array($item) && isset($item['text']) ? (string)$item['text'] : '';
                        ?>
                            <div class="service-info-blocks-checklist-item" style="display:flex; gap:10px; margin-bottom:10px;">
                                <input type="text" name="service_info_blocks_blocks[<?php echo esc_attr($b); ?>][items][<?php echo esc_attr($i); ?>][text]" value="<?php echo esc_attr($text); ?>" style="width: 100%;" placeholder="<?php _e('Текст пункта...', 'mokrenko'); ?>" />
                                <button type="button" class="button service-info-blocks-checklist-remove"><?php _e('Удалить', 'mokrenko'); ?></button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <p style="margin: 0 0 12px;">
                        <button type="button" class="button button-secondary service-info-blocks-checklist-add" data-block="<?php echo esc_attr($b); ?>"><?php _e('Добавить пункт', 'mokrenko'); ?></button>
                    </p>

                    <table class="form-table">
                        <tr>
                            <th><label><?php _e('Завершающий текст', 'mokrenko'); ?></label></th>
                            <td>
                                <textarea name="service_info_blocks_blocks[<?php echo esc_attr($b); ?>][footer_text]" rows="2" style="width: 100%;"><?php echo esc_textarea($footer_text); ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th><label><?php _e('Текст кнопки', 'mokrenko'); ?></label></th>
                            <td>
                                <input type="text" name="service_info_blocks_blocks[<?php echo esc_attr($b); ?>][button_text]" value="<?php echo esc_attr($button_text); ?>" style="width: 100%;" />
                            </td>
                        </tr>
                        <tr>
                            <th><label><?php _e('Ссылка кнопки', 'mokrenko'); ?></label></th>
                            <td>
                                <input type="text" name="service_info_blocks_blocks[<?php echo esc_attr($b); ?>][button_link]" value="<?php echo esc_attr($button_link); ?>" style="width: 100%;" />
                            </td>
                        </tr>
                    </table>
                </div>
            <?php endforeach; ?>
        </div>

        <p style="margin: 0;">
            <button type="button" class="button button-secondary service-info-blocks-add"><?php _e('Добавить инфо-блок', 'mokrenko'); ?></button>
        </p>
    </div>
    <?php
}

/**
 * Сохранение метабокса секции "Инфо-блоки"
 */
add_action('save_post_service', 'save_service_info_blocks_meta_box');

function save_service_info_blocks_meta_box($post_id) {
    if (!isset($_POST['service_info_blocks_nonce']) ||
        !wp_verify_nonce($_POST['service_info_blocks_nonce'], 'service_info_blocks_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['service_info_blocks_blocks']) && is_array($_POST['service_info_blocks_blocks'])) {
        $blocks = [];

        foreach ($_POST['service_info_blocks_blocks'] as $block) {
            if (!is_array($block)) {
                continue;
            }

            $image = isset($block['image']) ? absint($block['image']) : 0;
            $title = isset($block['title']) ? sanitize_text_field($block['title']) : '';
            $subtitle = isset($block['subtitle']) ? sanitize_textarea_field($block['subtitle']) : '';
            $footer_text = isset($block['footer_text']) ? sanitize_textarea_field($block['footer_text']) : '';
            $button_text = isset($block['button_text']) ? sanitize_text_field($block['button_text']) : '';
            $button_link = isset($block['button_link']) ? esc_url_raw($block['button_link']) : '';
            $reverse = !empty($block['reverse']) ? 1 : 0;
            $position = isset($block['position']) ? sanitize_text_field($block['position']) : '';
            if ($position === '') $position = 'after_what-included';

            $items = [];
            if (isset($block['items']) && is_array($block['items'])) {
                foreach ($block['items'] as $item) {
                    if (!is_array($item)) {
                        continue;
                    }
                    $text = isset($item['text']) ? sanitize_text_field($item['text']) : '';
                    if ($text === '') {
                        continue;
                    }
                    $items[] = ['text' => $text];
                }
            }

            if ($image === 0 && $title === '' && $subtitle === '' && empty($items) && $footer_text === '' && $button_text === '' && $button_link === '') {
                continue;
            }

            $blocks[] = [
                'image' => $image,
                'title' => $title,
                'subtitle' => $subtitle,
                'reverse' => $reverse,
                'items' => $items,
                'footer_text' => $footer_text,
                'button_text' => $button_text,
                'button_link' => $button_link,
                'position' => $position,
            ];
        }

        update_post_meta($post_id, '_service_info_blocks_blocks', $blocks);
    } else {
        delete_post_meta($post_id, '_service_info_blocks_blocks');
    }
}

/**
 * Рендер метабокса секции "Показания и противопоказания"
 */
function render_service_indications_meta_box($post) {
    wp_nonce_field('service_indications_nonce', 'service_indications_nonce');

    $left_title = get_post_meta($post->ID, '_service_indications_left_title', true);
    $right_title = get_post_meta($post->ID, '_service_indications_right_title', true);

    $left_items = get_post_meta($post->ID, '_service_indications_left_items', true);
    if (!is_array($left_items)) $left_items = [];
    $right_items = get_post_meta($post->ID, '_service_indications_right_items', true);
    if (!is_array($right_items)) $right_items = [];

    $left_items_text = implode("\n", $left_items);
    $right_items_text = implode("\n", $right_items);
    ?>
    <div class="service-indications-meta-box">
        <p class="description">
            <?php _e('Каждая строка в списке — отдельный пункт. На фронтенде выводится с "—" в начале строки через CSS.', 'mokrenko'); ?>
        </p>

        <table class="form-table">
            <tr>
                <th><label for="service_indications_left_title"><?php _e('Заголовок слева (показания)', 'mokrenko'); ?></label></th>
                <td><input type="text" id="service_indications_left_title" name="service_indications_left_title" value="<?php echo esc_attr($left_title); ?>" style="width: 100%;" /></td>
            </tr>
            <tr>
                <th><label for="service_indications_left_items"><?php _e('Список слева (каждая строка = пункт)', 'mokrenko'); ?></label></th>
                <td><textarea id="service_indications_left_items" name="service_indications_left_items" rows="8" style="width: 100%;"><?php echo esc_textarea($left_items_text); ?></textarea></td>
            </tr>

            <tr>
                <th><label for="service_indications_right_title"><?php _e('Заголовок справа (противопоказания)', 'mokrenko'); ?></label></th>
                <td><input type="text" id="service_indications_right_title" name="service_indications_right_title" value="<?php echo esc_attr($right_title); ?>" style="width: 100%;" /></td>
            </tr>
            <tr>
                <th><label for="service_indications_right_items"><?php _e('Список справа (каждая строка = пункт)', 'mokrenko'); ?></label></th>
                <td><textarea id="service_indications_right_items" name="service_indications_right_items" rows="8" style="width: 100%;"><?php echo esc_textarea($right_items_text); ?></textarea></td>
            </tr>
        </table>
    </div>
    <?php
}

/**
 * Сохранение метабокса секции "Показания и противопоказания"
 */
add_action('save_post_service', 'save_service_indications_meta_box');

function save_service_indications_meta_box($post_id) {
    if (!isset($_POST['service_indications_nonce']) ||
        !wp_verify_nonce($_POST['service_indications_nonce'], 'service_indications_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['service_indications_left_title'])) {
        update_post_meta($post_id, '_service_indications_left_title', sanitize_text_field($_POST['service_indications_left_title']));
    }
    if (isset($_POST['service_indications_right_title'])) {
        update_post_meta($post_id, '_service_indications_right_title', sanitize_text_field($_POST['service_indications_right_title']));
    }

    $left_items = [];
    if (isset($_POST['service_indications_left_items'])) {
        $lines = preg_split("/\r\n|\r|\n/", (string)$_POST['service_indications_left_items']);
        foreach ($lines as $line) {
            $line = sanitize_text_field($line);
            if ($line !== '') {
                $left_items[] = $line;
            }
        }
    }
    update_post_meta($post_id, '_service_indications_left_items', $left_items);

    $right_items = [];
    if (isset($_POST['service_indications_right_items'])) {
        $lines = preg_split("/\r\n|\r|\n/", (string)$_POST['service_indications_right_items']);
        foreach ($lines as $line) {
            $line = sanitize_text_field($line);
            if ($line !== '') {
                $right_items[] = $line;
            }
        }
    }
    update_post_meta($post_id, '_service_indications_right_items', $right_items);
}

