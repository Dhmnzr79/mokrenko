<?php
/**
 * Шорткоды для врачей и кейсов
 */

// Шорткод: один кейс
add_shortcode('case_showcase', 'theme_case_showcase_shortcode');
function theme_case_showcase_shortcode($atts) {
    $atts = shortcode_atts([
        'id' => 0,
        'slider' => '0'
    ], $atts);

    $case_id = intval($atts['id']);
    $slider = $atts['slider'] === '1';
    
    if (!$case_id || get_post_type($case_id) !== 'case') {
        return '';
    }

    $slider_class = $slider ? ' case--in-slider' : '';
    
    ob_start();
    get_template_part('template-parts/case/showcase', null, [
        'case_id' => $case_id,
        'slider' => $slider,
        'slider_class' => $slider_class
    ]);
    return ob_get_clean();
}

// Шорткод: кейсы врача
add_shortcode('cases_by_doctor', 'theme_cases_by_doctor_shortcode');
function theme_cases_by_doctor_shortcode($atts) {
    $atts = shortcode_atts([
        'doctor' => 0,
        'limit' => 6,
        'slider' => '0'
    ], $atts);

    $doctor_id = intval($atts['doctor']);
    $limit = intval($atts['limit']);
    $slider = $atts['slider'] === '1';

    if (!$doctor_id) {
        return '';
    }

    $cases = get_posts([
        'post_type' => 'case',
        'posts_per_page' => $limit,
        'meta_query' => [
            [
                'key' => 'case_doctor_id',
                'value' => $doctor_id,
                'compare' => '='
            ]
        ]
    ]);

    if (empty($cases)) {
        return '';
    }

    $slider_class = $slider ? ' case--in-slider' : '';
    
    ob_start();
    foreach ($cases as $case) {
        get_template_part('template-parts/case/showcase', null, [
            'case_id' => $case->ID,
            'slider' => $slider,
            'slider_class' => $slider_class
        ]);
    }
    return ob_get_clean();
}

// Шорткод: карточка врача
add_shortcode('doctor_card', 'theme_doctor_card_shortcode');
function theme_doctor_card_shortcode($atts) {
    $atts = shortcode_atts([
        'id' => 0
    ], $atts);

    $doctor_id = intval($atts['id']);
    if (!$doctor_id || get_post_type($doctor_id) !== 'doctor') {
        return '';
    }

    ob_start();
    get_template_part('template-parts/doctor/card', null, ['doctor_id' => $doctor_id]);
    return ob_get_clean();
}

// Шорткод: портфолио врача
add_shortcode('doctor_portfolio', 'theme_doctor_portfolio_shortcode');
function theme_doctor_portfolio_shortcode($atts) {
    $atts = shortcode_atts([
        'doctor' => 'current',
        'limit' => 10,
        'slider' => '1'
    ], $atts);

    $doctor_id = 0;
    if ($atts['doctor'] === 'current') {
        global $post;
        if ($post && $post->post_type === 'doctor') {
            $doctor_id = $post->ID;
        }
    } else {
        $doctor_id = intval($atts['doctor']);
    }

    if (!$doctor_id) {
        return '';
    }

    $cases = get_posts([
        'post_type' => 'case',
        'posts_per_page' => intval($atts['limit']),
        'meta_query' => [
            [
                'key' => 'case_doctor_id',
                'value' => $doctor_id,
                'compare' => '='
            ]
        ]
    ]);

    if (empty($cases)) {
        return '';
    }

    ob_start();
    ?>
    <div class="doctor-portfolio">
        <div class="doctor-portfolio__header">
            <h2><?php _e('Портфолио врача:', 'mokrenko'); ?></h2>
            <div class="doctor-portfolio__nav">
                <button class="js-prev" type="button">←</button>
                <button class="js-next" type="button">→</button>
            </div>
        </div>
        <div class="doctor-portfolio__slider">
            <?php foreach ($cases as $case): ?>
                <div class="doctor-portfolio__slide">
                    <?php
                    $before_image = get_post_meta($case->ID, 'case_before_image', true);
                    $before_desc = get_post_meta($case->ID, 'case_before_desc', true);
                    $after_image = get_post_meta($case->ID, 'case_after_image', true);
                    $after_desc = get_post_meta($case->ID, 'case_after_desc', true);
                    ?>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="case-panel case-panel--before">
                                <div class="case-panel__image">
                                    <?php if ($before_image): ?>
                                        <?php echo wp_get_attachment_image($before_image, 'medium_large', false, ['class' => 'case-panel__img']); ?>
                                    <?php endif; ?>
                                    <div class="case-panel__badge case-panel__badge--before"><?php _e('До', 'mokrenko'); ?></div>
                                </div>
                                <div class="case-panel__content">
                                    <h4 class="case-panel__title"><?php _e('Проблема:', 'mokrenko'); ?></h4>
                                    <p class="case-panel__desc"><?php echo esc_html($before_desc); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="case-panel case-panel--after">
                                <div class="case-panel__image">
                                    <?php if ($after_image): ?>
                                        <?php echo wp_get_attachment_image($after_image, 'medium_large', false, ['class' => 'case-panel__img']); ?>
                                    <?php endif; ?>
                                    <div class="case-panel__badge case-panel__badge--after"><?php _e('После', 'mokrenko'); ?></div>
                                </div>
                                <div class="case-panel__content">
                                    <h4 class="case-panel__title"><?php _e('Решение:', 'mokrenko'); ?></h4>
                                    <p class="case-panel__desc"><?php echo esc_html($after_desc); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
