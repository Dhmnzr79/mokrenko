<?php
/**
 * Шаблон для отображения кейса портфолио
 * Использует 12-колоночную сетку: 8/4 + 4/4/4
 */

$case_id = $args['case_id'] ?? get_the_ID();
$slider = $args['slider'] ?? false;
$slider_class = $args['slider_class'] ?? '';

$case = get_post($case_id);
if (!$case || $case->post_type !== 'case') {
    return;
}

// Получаем данные кейса
$doctor_id = get_post_meta($case_id, 'case_doctor_id', true);
$before_image = get_post_meta($case_id, 'case_before_image', true);
$before_desc = get_post_meta($case_id, 'case_before_desc', true);
$after_image = get_post_meta($case_id, 'case_after_image', true);
$after_desc = get_post_meta($case_id, 'case_after_desc', true);
$duration = get_post_meta($case_id, 'case_duration', true);

// Получаем данные врача
$doctor = $doctor_id ? get_post($doctor_id) : null;
$doctor_name = $doctor ? $doctor->post_title : '';
$doctor_position = $doctor ? get_post_meta($doctor_id, 'doctor_position', true) : '';
$doctor_photo = $doctor ? get_the_post_thumbnail_url($doctor_id, 'thumbnail') : '';
$doctor_link = $doctor ? get_permalink($doctor_id) : '#';

if (!$doctor_id || !$before_image || !$after_image) {
    return;
}
?>

<div class="case-showcase<?php echo esc_attr($slider_class); ?>">
    <!-- Row 1: Заголовок + мини-виджет -->
    <div class="row row--head">
        <div class="col-sm-12 col-lg-8">
            <h2><?php echo esc_html($case->post_title); ?></h2>
        </div>
        <div class="col-sm-12 col-lg-4">
            <div class="case-mini-widget">
                <?php if ($doctor_photo): ?>
                    <img src="<?php echo esc_url($doctor_photo); ?>" alt="<?php echo esc_attr($doctor_name); ?>" class="case-mini-widget__avatar">
                <?php endif; ?>
                <div class="case-mini-widget__info">
                    <span class="case-mini-widget__rating">★★★★★</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 2: Карточка врача + ДО + ПОСЛЕ -->
    <div class="row row--case">
        <!-- Карточка врача -->
        <div class="col-sm-12 col-lg-4">
            <div class="case-card case-card--doctor">
                <?php if ($doctor_photo): ?>
                    <div class="case-card__photo">
                        <img src="<?php echo esc_url($doctor_photo); ?>" alt="<?php echo esc_attr($doctor_name); ?>">
                    </div>
                <?php endif; ?>
                <div class="case-card__content">
                    <h3 class="case-card__name"><?php echo esc_html($doctor_name); ?></h3>
                    <p class="case-card__position"><?php echo esc_html($doctor_position); ?></p>
                    <a href="<?php echo esc_url($doctor_link); ?>" class="case-card__link">
                        <?php _e('Подробнее о враче', 'mokrenko'); ?> →
                    </a>
                </div>
            </div>
        </div>

        <!-- ДО -->
        <div class="col-sm-12 col-lg-4">
            <div class="case-panel case-panel--before">
                <div class="case-panel__image">
                    <?php echo wp_get_attachment_image($before_image, 'medium_large', false, ['class' => 'case-panel__img']); ?>
                    <div class="case-panel__badge case-panel__badge--before"><?php _e('До', 'mokrenko'); ?></div>
                </div>
                <div class="case-panel__content">
                    <h4 class="case-panel__title"><?php _e('Проблема:', 'mokrenko'); ?></h4>
                    <p class="case-panel__desc"><?php echo esc_html($before_desc); ?></p>
                </div>
            </div>
        </div>

        <!-- ПОСЛЕ -->
        <div class="col-sm-12 col-lg-4">
            <div class="case-panel case-panel--after">
                <div class="case-panel__image">
                    <?php echo wp_get_attachment_image($after_image, 'medium_large', false, ['class' => 'case-panel__img']); ?>
                    <div class="case-panel__badge case-panel__badge--after"><?php _e('После', 'mokrenko'); ?></div>
                </div>
                <div class="case-panel__content">
                    <h4 class="case-panel__title"><?php _e('Решение:', 'mokrenko'); ?></h4>
                    <p class="case-panel__desc"><?php echo esc_html($after_desc); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Срок выполнения -->
    <?php if ($duration): ?>
        <div class="case-duration">
            <span class="case-duration__icon">📅</span>
            <span class="case-duration__text"><?php echo esc_html($duration); ?></span>
        </div>
    <?php endif; ?>
</div>
