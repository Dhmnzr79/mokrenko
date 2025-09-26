<?php
/**
 * Шаблон для карточки врача
 */

$doctor_id = $args['doctor_id'] ?? 0;
if (!$doctor_id || get_post_type($doctor_id) !== 'doctor') {
    return;
}

$doctor = get_post($doctor_id);
$position = get_post_meta($doctor_id, 'doctor_position', true);
$experience = get_post_meta($doctor_id, 'doctor_experience_years', true);
$fact_1 = get_post_meta($doctor_id, 'doctor_fact_1', true);
$fact_2 = get_post_meta($doctor_id, 'doctor_fact_2', true);
$fact_3 = get_post_meta($doctor_id, 'doctor_fact_3', true);
$video_url = get_post_meta($doctor_id, 'doctor_video_url', true);
$education = get_post_meta($doctor_id, 'doctor_education', true);
$photo = get_the_post_thumbnail_url($doctor_id, 'medium');
$excerpt = get_the_excerpt($doctor_id);
$link = get_permalink($doctor_id);
?>

<div class="doctor-card">
    <div class="doctor-card__photo">
        <?php if ($photo): ?>
            <img src="<?php echo esc_url($photo); ?>" alt="<?php echo esc_attr($doctor->post_title); ?>" class="doctor-card__img">
        <?php endif; ?>
    </div>
    
    <div class="doctor-card__content">
        <h3 class="doctor-card__name"><?php echo esc_html($doctor->post_title); ?></h3>
        
        <?php if ($position): ?>
            <p class="doctor-card__position"><?php echo esc_html($position); ?></p>
        <?php endif; ?>
        
        <?php if ($experience): ?>
            <p class="doctor-card__experience">
                <span class="doctor-card__label"><?php _e('Стаж:', 'mokrenko'); ?></span>
                <span class="doctor-card__value"><?php echo esc_html($experience); ?> <?php _e('лет', 'mokrenko'); ?></span>
            </p>
        <?php endif; ?>
        
        <?php if ($excerpt): ?>
            <div class="doctor-card__excerpt">
                <h4><?php _e('Краткое превью:', 'mokrenko'); ?></h4>
                <p><?php echo esc_html($excerpt); ?></p>
            </div>
        <?php endif; ?>
        
        <?php if ($doctor->post_content): ?>
            <div class="doctor-card__content-full">
                <h4><?php _e('Подробная информация:', 'mokrenko'); ?></h4>
                <div class="doctor-card__description">
                    <?php echo wp_kses_post($doctor->post_content); ?>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- Факты о враче -->
        <?php if ($fact_1 || $fact_2 || $fact_3): ?>
            <div class="doctor-card__facts">
                <?php if ($fact_1): ?>
                    <div class="doctor-card__fact"><?php echo esc_html($fact_1); ?></div>
                <?php endif; ?>
                <?php if ($fact_2): ?>
                    <div class="doctor-card__fact"><?php echo esc_html($fact_2); ?></div>
                <?php endif; ?>
                <?php if ($fact_3): ?>
                    <div class="doctor-card__fact"><?php echo esc_html($fact_3); ?></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <!-- Видео -->
        <?php if ($video_url): ?>
            <div class="doctor-card__video">
                <a href="<?php echo esc_url($video_url); ?>" target="_blank" class="doctor-card__video-link">
                    📹 <?php _e('Видео о враче', 'mokrenko'); ?>
                </a>
            </div>
        <?php endif; ?>
        
        <div class="doctor-card__actions">
            <a href="<?php echo esc_url($link); ?>" class="doctor-card__link">
                <?php _e('Подробнее о враче', 'mokrenko'); ?> →
            </a>
        </div>
    </div>
</div>
