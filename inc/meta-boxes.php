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
    $qualification = get_post_meta($post->ID, 'doctor_qualification', true);
    $video_url = get_post_meta($post->ID, 'doctor_video_url', true);
    $certs = get_post_meta($post->ID, 'doctor_certs_json', true);
    $photo_2 = get_post_meta($post->ID, 'doctor_photo_2', true);
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
        <tr>
            <th><label for="doctor_show_on_home"><?php _e('Показывать на главной', 'mokrenko'); ?></label></th>
            <td>
                <input type="checkbox" id="doctor_show_on_home" name="doctor_show_on_home" value="1" <?php checked(get_post_meta($post->ID, 'doctor_show_on_home', true), '1'); ?> />
                <label for="doctor_show_on_home"><?php _e('Показывать в слайдере на главной странице', 'mokrenko'); ?></label>
            </td>
        </tr>
        <tr>
            <th><label for="doctor_photo_2"><?php _e('Фото 2', 'mokrenko'); ?></label></th>
            <td>
                <button type="button" id="select-doctor-photo-2"><?php _e('Выбрать изображение', 'mokrenko'); ?></button>
                <div id="doctor-photo-2-preview">
                    <?php if ($photo_2): ?>
                        <?php echo wp_get_attachment_image($photo_2, 'thumbnail'); ?>
                    <?php endif; ?>
                </div>
                <input type="hidden" id="doctor_photo_2" name="doctor_photo_2" value="<?php echo esc_attr($photo_2); ?>" />
                <p class="description"><?php _e('Дополнительное фото врача для страницы врача (посреди текстового описания)', 'mokrenko'); ?></p>
            </td>
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
            <th><label for="doctor_content"><?php _e('Подробная информация', 'mokrenko'); ?></label></th>
            <td>
                <?php
                wp_editor($post->post_content, 'doctor_content', [
                    'textarea_rows' => 8,
                    'media_buttons' => true,
                    'teeny' => false,
                    'textarea_name' => 'content',
                    'wpautop' => true,
                    'tinymce' => [
                        'forced_root_block' => 'p'
                    ]
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

    <!-- Повышение квалификации (простое текстовое поле) -->
    <h3><?php _e('Повышение квалификации', 'mokrenko'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="doctor_qualification"><?php _e('Повышение квалификации', 'mokrenko'); ?></label></th>
            <td>
                <textarea id="doctor_qualification" name="doctor_qualification" rows="6" style="width: 100%;"><?php echo esc_textarea($qualification); ?></textarea>
                <p class="description"><?php _e('Введите повышение квалификации с разбивкой на параграфы. Например:<br>2020 - Курс по имплантации<br>2021 - Семинар по протезированию', 'mokrenko'); ?></p>
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
            <td>
                <div class="case-description-fields">
                    <div class="case-description-checklist">
                        <h4><?php _e('Проблемы (заполните нужное количество):', 'mokrenko'); ?></h4>
                        <?php
                        $problems_data = get_post_meta($post->ID, 'case_problems_dynamic', true);
                        $problems_data = $problems_data ? json_decode($problems_data, true) : [];
                        
                        // Создаем 4 поля для проблем
                        for ($i = 0; $i < 4; $i++): 
                            $problem_text = isset($problems_data[$i]) ? $problems_data[$i] : '';
                            $problem_enabled = !empty($problem_text);
                        ?>
                            <div class="dynamic-field-group">
                                <label class="dynamic-field-label">
                                    <input type="checkbox" name="case_problem_enabled[]" value="<?php echo $i; ?>" 
                                           <?php checked($problem_enabled); ?> class="dynamic-field-checkbox" />
                                    <span class="dynamic-field-number"><?php echo $i + 1; ?></span>
                                </label>
                                <input type="text" name="case_problem_text[]" value="<?php echo esc_attr($problem_text); ?>" 
                                       placeholder="<?php _e('Опишите проблему...', 'mokrenko'); ?>" 
                                       class="dynamic-field-input" <?php echo $problem_enabled ? '' : 'disabled'; ?> />
                            </div>
                        <?php endfor; ?>
                    </div>
                    
                </div>
            </td>
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
            <td>
                <div class="case-description-fields">
                    <div class="case-description-checklist">
                        <h4><?php _e('Решения (заполните нужное количество):', 'mokrenko'); ?></h4>
                        <?php
                        $solutions_data = get_post_meta($post->ID, 'case_solutions_dynamic', true);
                        $solutions_data = $solutions_data ? json_decode($solutions_data, true) : [];
                        
                        // Создаем 4 поля для решений
                        for ($i = 0; $i < 4; $i++): 
                            $solution_text = isset($solutions_data[$i]) ? $solutions_data[$i] : '';
                            $solution_enabled = !empty($solution_text);
                        ?>
                            <div class="dynamic-field-group">
                                <label class="dynamic-field-label">
                                    <input type="checkbox" name="case_solution_enabled[]" value="<?php echo $i; ?>" 
                                           <?php checked($solution_enabled); ?> class="dynamic-field-checkbox" />
                                    <span class="dynamic-field-number"><?php echo $i + 1; ?></span>
                                </label>
                                <input type="text" name="case_solution_text[]" value="<?php echo esc_attr($solution_text); ?>" 
                                       placeholder="<?php _e('Опишите решение...', 'mokrenko'); ?>" 
                                       class="dynamic-field-input" <?php echo $solution_enabled ? '' : 'disabled'; ?> />
                            </div>
                        <?php endfor; ?>
                    </div>
                    
                </div>
            </td>
        </tr>
    </table>

    <style>
    .case-description-fields {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        background: #fafafa;
    }
    .case-description-checklist {
        margin-bottom: 20px;
    }
    .case-description-checklist h4 {
        margin-top: 0;
        margin-bottom: 15px;
        color: #333;
        font-size: 14px;
        font-weight: 600;
    }
    .dynamic-field-group {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
        padding: 10px;
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        transition: all 0.2s ease;
    }
    .dynamic-field-group:hover {
        background: #f8f9fa;
        border-color: #0073aa;
    }
    .dynamic-field-label {
        display: flex;
        align-items: center;
        margin-right: 12px;
        cursor: pointer;
    }
    .dynamic-field-checkbox {
        margin-right: 8px;
    }
    .dynamic-field-number {
        display: inline-block;
        width: 24px;
        height: 24px;
        background: #f0f0f0;
        border-radius: 50%;
        text-align: center;
        line-height: 24px;
        font-size: 12px;
        font-weight: bold;
        color: #666;
    }
    .dynamic-field-group:has(.dynamic-field-checkbox:checked) .dynamic-field-number {
        background: #0073aa;
        color: #fff;
    }
    .dynamic-field-input {
        flex: 1;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 8px 12px;
        font-family: inherit;
        transition: all 0.2s ease;
    }
    .dynamic-field-input:disabled {
        background: #f5f5f5;
        color: #999;
        cursor: not-allowed;
    }
    .dynamic-field-input:focus {
        border-color: #0073aa;
        box-shadow: 0 0 0 1px #0073aa;
        outline: none;
    }
    </style>

    <script>
    jQuery(document).ready(function($) {
        // Управление динамическими полями
        function toggleFieldInput(checkbox, input) {
            if (checkbox.is(':checked')) {
                input.prop('disabled', false);
                input.focus();
            } else {
                input.prop('disabled', true);
                input.val('');
            }
        }
        
        // Обработчики для чекбоксов проблем
        $('.dynamic-field-checkbox[name="case_problem_enabled[]"]').on('change', function() {
            var input = $(this).closest('.dynamic-field-group').find('.dynamic-field-input[name="case_problem_text[]"]');
            toggleFieldInput($(this), input);
        });
        
        // Обработчики для чекбоксов решений
        $('.dynamic-field-checkbox[name="case_solution_enabled[]"]').on('change', function() {
            var input = $(this).closest('.dynamic-field-group').find('.dynamic-field-input[name="case_solution_text[]"]');
            toggleFieldInput($(this), input);
        });
        
        // Инициализация при загрузке страницы
        $('.dynamic-field-checkbox').each(function() {
            var input = $(this).closest('.dynamic-field-group').find('.dynamic-field-input');
            toggleFieldInput($(this), input);
        });
        
    });
    </script>
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

    // Сохранение второго фото врача
    if (isset($_POST['doctor_photo_2'])) {
        update_post_meta($post_id, 'doctor_photo_2', absint($_POST['doctor_photo_2']));
    }

    $show_on_home = isset($_POST['doctor_show_on_home']) ? '1' : '0';
    update_post_meta($post_id, 'doctor_show_on_home', $show_on_home);

    // Сохранение образования (простое текстовое поле)
    if (isset($_POST['doctor_education'])) {
        update_post_meta($post_id, 'doctor_education', wp_kses_post($_POST['doctor_education']));
    }

    // Сохранение повышения квалификации (простое текстовое поле)
    if (isset($_POST['doctor_qualification'])) {
        update_post_meta($post_id, 'doctor_qualification', wp_kses_post($_POST['doctor_qualification']));
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


    // Сохранение категорий
    if (isset($_POST['case_categories'])) {
        $categories = array_map('sanitize_text_field', $_POST['case_categories']);
        update_post_meta($post_id, 'case_categories', json_encode($categories));
    } else {
        update_post_meta($post_id, 'case_categories', '');
    }

    // Сохранение динамических проблем
    $problems_data = [];
    if (isset($_POST['case_problem_enabled']) && isset($_POST['case_problem_text'])) {
        $enabled_indices = array_map('intval', $_POST['case_problem_enabled']);
        $problem_texts = array_map('sanitize_textarea_field', $_POST['case_problem_text']);
        
        foreach ($enabled_indices as $index) {
            if (isset($problem_texts[$index]) && !empty(trim($problem_texts[$index]))) {
                $problems_data[$index] = trim($problem_texts[$index]);
            }
        }
    }
    update_post_meta($post_id, 'case_problems_dynamic', wp_json_encode($problems_data, JSON_UNESCAPED_UNICODE));

    // Сохранение динамических решений
    $solutions_data = [];
    if (isset($_POST['case_solution_enabled']) && isset($_POST['case_solution_text'])) {
        $enabled_indices = array_map('intval', $_POST['case_solution_enabled']);
        $solution_texts = array_map('sanitize_textarea_field', $_POST['case_solution_text']);
        
        foreach ($enabled_indices as $index) {
            if (isset($solution_texts[$index]) && !empty(trim($solution_texts[$index]))) {
                $solutions_data[$index] = trim($solution_texts[$index]);
            }
        }
    }
    update_post_meta($post_id, 'case_solutions_dynamic', wp_json_encode($solutions_data, JSON_UNESCAPED_UNICODE));
}
