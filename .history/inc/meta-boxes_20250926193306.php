<?php
/**
 * Метабоксы для врачей и кейсов
 */

// Метабокс для врачей
add_action('add_meta_boxes', 'theme_add_doctor_meta_box');
function theme_add_doctor_meta_box() {
    add_meta_box(
        'doctor_meta',
        __('Данные врача', 'mokrenko'),
        'theme_doctor_meta_box_callback',
        'doctor',
        'normal',
        'high'
    );
}

function theme_doctor_meta_box_callback($post) {
    wp_nonce_field('doctor_meta_nonce', 'doctor_meta_nonce');
    
    $position = get_post_meta($post->ID, 'doctor_position', true);
    $experience = get_post_meta($post->ID, 'doctor_experience_years', true);
    $fact_1 = get_post_meta($post->ID, 'doctor_fact_1', true);
    $fact_2 = get_post_meta($post->ID, 'doctor_fact_2', true);
    $fact_3 = get_post_meta($post->ID, 'doctor_fact_3', true);
    $education = get_post_meta($post->ID, 'doctor_education', true);
    $video_url = get_post_meta($post->ID, 'doctor_video_url', true);
    $certs = get_post_meta($post->ID, 'doctor_certs_json', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="doctor_position"><?php _e('Должность', 'mokrenko'); ?></label></th>
            <td><input type="text" id="doctor_position" name="doctor_position" value="<?php echo esc_attr($position); ?>" style="width: 100%;" /></td>
        </tr>
        <tr>
            <th><label for="doctor_experience_years"><?php _e('Стаж (лет)', 'mokrenko'); ?></label></th>
            <td><input type="number" id="doctor_experience_years" name="doctor_experience_years" value="<?php echo esc_attr($experience); ?>" min="0" max="50" /></td>
        </tr>
        <tr>
            <th><label for="doctor_fact_1"><?php _e('Факт о враче 1', 'mokrenko'); ?></label></th>
            <td><input type="text" id="doctor_fact_1" name="doctor_fact_1" value="<?php echo esc_attr($fact_1); ?>" style="width: 100%;" placeholder="<?php _e('Например: Более 1000 операций', 'mokrenko'); ?>" /></td>
        </tr>
        <tr>
            <th><label for="doctor_fact_2"><?php _e('Факт о враче 2', 'mokrenko'); ?></label></th>
            <td><input type="text" id="doctor_fact_2" name="doctor_fact_2" value="<?php echo esc_attr($fact_2); ?>" style="width: 100%;" placeholder="<?php _e('Например: Кандидат медицинских наук', 'mokrenko'); ?>" /></td>
        </tr>
        <tr>
            <th><label for="doctor_fact_3"><?php _e('Факт о враче 3', 'mokrenko'); ?></label></th>
            <td><input type="text" id="doctor_fact_3" name="doctor_fact_3" value="<?php echo esc_attr($fact_3); ?>" style="width: 100%;" placeholder="<?php _e('Например: Член международной ассоциации', 'mokrenko'); ?>" /></td>
        </tr>
        <tr>
            <th><label for="doctor_video_url"><?php _e('Видео (YouTube URL)', 'mokrenko'); ?></label></th>
            <td><input type="url" id="doctor_video_url" name="doctor_video_url" value="<?php echo esc_attr($video_url); ?>" style="width: 100%;" placeholder="https://youtube.com/watch?v=..." /></td>
        </tr>
    </table>

    <!-- Краткое превью и подробная информация -->
    <h3><?php _e('Дополнительная информация', 'mokrenko'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="excerpt"><?php _e('Краткое превью', 'mokrenko'); ?></label></th>
            <td>
                <textarea id="excerpt" name="excerpt" rows="3" style="width: 100%;"><?php echo esc_textarea($post->post_excerpt); ?></textarea>
                <p class="description"><?php _e('Краткое описание врача для карточек и списков', 'mokrenko'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="content"><?php _e('Подробная информация', 'mokrenko'); ?></label></th>
            <td>
                <?php
                wp_editor($post->post_content, 'content', [
                    'textarea_rows' => 8,
                    'media_buttons' => true,
                    'teeny' => false
                ]);
                ?>
                <p class="description"><?php _e('Полная информация о враче, достижениях, методах работы', 'mokrenko'); ?></p>
            </td>
        </tr>
    </table>

    <!-- Образование (простое текстовое поле) -->
    <h3><?php _e('Образование', 'mokrenko'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="doctor_education"><?php _e('Образование', 'mokrenko'); ?></label></th>
            <td>
                <textarea id="doctor_education" name="doctor_education" rows="6" style="width: 100%;"><?php echo esc_textarea($education); ?></textarea>
                <p class="description"><?php _e('Введите образование с разбивкой на параграфы. Например:<br>2010-2016 - Московский медицинский университет<br>2016-2018 - Ординатура по стоматологии', 'mokrenko'); ?></p>
            </td>
        </tr>
    </table>

    <!-- Сертификаты (галерея) -->
    <h3><?php _e('Сертификаты', 'mokrenko'); ?></h3>
    <div id="certs-gallery">
        <button type="button" id="select-certs"><?php _e('Выбрать сертификаты', 'mokrenko'); ?></button>
        <div id="certs-preview"></div>
        <textarea name="doctor_certs_json" id="doctor_certs_json" style="display: none;"><?php echo esc_textarea($certs); ?></textarea>
    </div>

    <style>
    .education-item { margin-bottom: 10px; padding: 10px; border: 1px solid #ddd; }
    .education-item input { margin-right: 10px; }
    #certs-preview img { max-width: 100px; margin: 5px; }
    </style>
    <?php
}

// Метабокс для кейсов
add_action('add_meta_boxes', 'theme_add_case_meta_box');
function theme_add_case_meta_box() {
    add_meta_box(
        'case_meta',
        __('Данные кейса', 'mokrenko'),
        'theme_case_meta_box_callback',
        'case',
        'normal',
        'high'
    );
}

function theme_case_meta_box_callback($post) {
    wp_nonce_field('case_meta_nonce', 'case_meta_nonce');
    
    $doctor_id = get_post_meta($post->ID, 'case_doctor_id', true);
    $before_image = get_post_meta($post->ID, 'case_before_image', true);
    $before_desc = get_post_meta($post->ID, 'case_before_desc', true);
    $after_image = get_post_meta($post->ID, 'case_after_image', true);
    $after_desc = get_post_meta($post->ID, 'case_after_desc', true);
    $duration = get_post_meta($post->ID, 'case_duration', true);
    $show_on_home = get_post_meta($post->ID, 'case_show_on_home', true);
    $categories = get_post_meta($post->ID, 'case_categories', true);

    // Получаем список врачей
    $doctors = get_posts([
        'post_type' => 'doctor',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ]);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="case_doctor_id"><?php _e('Врач', 'mokrenko'); ?></label></th>
            <td>
                <select id="case_doctor_id" name="case_doctor_id" style="width: 100%;">
                    <option value=""><?php _e('Выберите врача', 'mokrenko'); ?></option>
                    <?php foreach ($doctors as $doctor): ?>
                        <option value="<?php echo $doctor->ID; ?>" <?php selected($doctor_id, $doctor->ID); ?>>
                            <?php echo esc_html($doctor->post_title); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="case_duration"><?php _e('Срок выполнения', 'mokrenko'); ?></label></th>
            <td><input type="text" id="case_duration" name="case_duration" value="<?php echo esc_attr($duration); ?>" style="width: 100%;" placeholder="<?php _e('Например: Срок 5 месяцев', 'mokrenko'); ?>" /></td>
        </tr>
        <tr>
            <th><label for="case_show_on_home"><?php _e('Показывать на главной', 'mokrenko'); ?></label></th>
            <td>
                <input type="checkbox" id="case_show_on_home" name="case_show_on_home" value="1" <?php checked($show_on_home, '1'); ?> />
                <label for="case_show_on_home"><?php _e('Показывать в слайдере на главной странице', 'mokrenko'); ?></label>
            </td>
        </tr>
        <tr>
            <th><label for="case_categories"><?php _e('Категории кейса', 'mokrenko'); ?></label></th>
            <td>
                <?php
                $case_categories = [
                    'prosthetics' => 'Протезирование',
                    'treatment' => 'Лечение зубов',
                    'removable' => 'Съемные протезы',
                    'implantation' => 'Имплантация зубов',
                    'dental_prosthetics' => 'Протезирование зубов',
                    'crowns' => 'Коронки',
                    'all_on_6' => 'Имплантация All-on-6',
                    'all_on_4' => 'Имплантация All-on-4'
                ];
                $selected_categories = $categories ? json_decode($categories, true) : [];
                ?>
                <?php foreach ($case_categories as $key => $label): ?>
                    <label style="display: block; margin-bottom: 5px;">
                        <input type="checkbox" name="case_categories[]" value="<?php echo esc_attr($key); ?>" <?php checked(in_array($key, $selected_categories)); ?> />
                        <?php echo esc_html($label); ?>
                    </label>
                <?php endforeach; ?>
            </td>
        </tr>
    </table>

    <h3><?php _e('ДО лечения', 'mokrenko'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="case_before_image"><?php _e('Фото "До"', 'mokrenko'); ?></label></th>
            <td>
                <button type="button" id="select-before-image"><?php _e('Выбрать изображение', 'mokrenko'); ?></button>
                <div id="before-image-preview">
                    <?php if ($before_image): ?>
                        <?php echo wp_get_attachment_image($before_image, 'thumbnail'); ?>
                    <?php endif; ?>
                </div>
                <input type="hidden" id="case_before_image" name="case_before_image" value="<?php echo esc_attr($before_image); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="case_before_desc"><?php _e('Описание проблемы', 'mokrenko'); ?></label></th>
            <td><textarea id="case_before_desc" name="case_before_desc" rows="4" style="width: 100%;"><?php echo esc_textarea($before_desc); ?></textarea></td>
        </tr>
    </table>

    <h3><?php _e('ПОСЛЕ лечения', 'mokrenko'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="case_after_image"><?php _e('Фото "После"', 'mokrenko'); ?></label></th>
            <td>
                <button type="button" id="select-after-image"><?php _e('Выбрать изображение', 'mokrenko'); ?></button>
                <div id="after-image-preview">
                    <?php if ($after_image): ?>
                        <?php echo wp_get_attachment_image($after_image, 'thumbnail'); ?>
                    <?php endif; ?>
                </div>
                <input type="hidden" id="case_after_image" name="case_after_image" value="<?php echo esc_attr($after_image); ?>" />
            </td>
        </tr>
        <tr>
            <th><label for="case_after_desc"><?php _e('Описание решения', 'mokrenko'); ?></label></th>
            <td><textarea id="case_after_desc" name="case_after_desc" rows="4" style="width: 100%;"><?php echo esc_textarea($after_desc); ?></textarea></td>
        </tr>
    </table>
    <?php
}

// Сохранение метаполей врача
add_action('save_post', 'theme_save_doctor_meta');
function theme_save_doctor_meta($post_id) {
    if (!isset($_POST['doctor_meta_nonce']) || !wp_verify_nonce($_POST['doctor_meta_nonce'], 'doctor_meta_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (get_post_type($post_id) !== 'doctor') {
        return;
    }

    $fields = ['doctor_position', 'doctor_experience_years', 'doctor_fact_1', 'doctor_fact_2', 'doctor_fact_3', 'doctor_video_url'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }

    // Сохранение образования (простое текстовое поле)
    if (isset($_POST['doctor_education'])) {
        update_post_meta($post_id, 'doctor_education', wp_kses_post($_POST['doctor_education']));
    }

    // Сохранение excerpt и content (стандартные поля WordPress) - объединяем в один вызов
    $update_data = ['ID' => $post_id];
    
    if (isset($_POST['excerpt'])) {
        $update_data['post_excerpt'] = sanitize_textarea_field($_POST['excerpt']);
    }
    
    if (isset($_POST['content'])) {
        $update_data['post_content'] = wp_kses_post($_POST['content']);
    }
    
    // Обновляем только если есть данные для обновления
    if (count($update_data) > 1) {
        wp_update_post($update_data);
    }

    // Сохранение сертификатов (JSON)
    if (isset($_POST['doctor_certs_json'])) {
        $certs = json_decode($_POST['doctor_certs_json'], true);
        if (is_array($certs)) {
            $certs = array_map('absint', $certs);
            update_post_meta($post_id, 'doctor_certs_json', json_encode($certs));
        }
    }
}

// Сохранение метаполей кейса
add_action('save_post', 'theme_save_case_meta');
function theme_save_case_meta($post_id) {
    if (!isset($_POST['case_meta_nonce']) || !wp_verify_nonce($_POST['case_meta_nonce'], 'case_meta_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (get_post_type($post_id) !== 'case') {
        return;
    }

    $fields = [
        'case_doctor_id' => 'absint',
        'case_before_image' => 'absint',
        'case_after_image' => 'absint',
        'case_duration' => 'sanitize_text_field',
        'case_show_on_home' => 'rest_sanitize_boolean'
    ];

    foreach ($fields as $field => $sanitize) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, $sanitize($_POST[$field]));
        }
    }

    // Сохранение описаний
    $descriptions = ['case_before_desc', 'case_after_desc'];
    foreach ($descriptions as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, wp_kses_post($_POST[$field]));
        }
    }

    // Сохранение категорий
    if (isset($_POST['case_categories'])) {
        $categories = array_map('sanitize_text_field', $_POST['case_categories']);
        update_post_meta($post_id, 'case_categories', json_encode($categories));
    } else {
        update_post_meta($post_id, 'case_categories', '');
    }
}
