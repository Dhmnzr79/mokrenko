<?php
/**
 * Компактная карточка врача для слайдера
 */

$doctor_id = $args['doctor_id'] ?? 0;
if (!$doctor_id || get_post_type($doctor_id) !== 'doctor') {
    return;
}

$doctor = get_post($doctor_id);
$position = get_post_meta($doctor_id, 'doctor_position', true);
$experience = get_post_meta($doctor_id, 'doctor_experience_years', true);
$photo = get_the_post_thumbnail_url($doctor_id, 'medium');
$link = get_permalink($doctor_id);
?>

<div class="doctor-card-slider">
    <?php if ($photo): ?>
        <div class="doctor-card-slider__photo">
            <img src="<?php echo esc_url($photo); ?>" alt="<?php echo esc_attr($doctor->post_title); ?>" class="doctor-card-slider__img">
        </div>
    <?php endif; ?>
    
    <a href="<?php echo esc_url($link); ?>" class="doctor-card-slider__link">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/svg/link_arrow_1.svg" alt="Подробнее" class="doctor-card-slider__arrow">
    </a>
    
    <div class="doctor-card-slider__content">
        <div class="doctor-card-slider__header">
            <h3 class="doctor-card-slider__name"><?php echo esc_html($doctor->post_title); ?></h3>
            <?php if ($position): ?>
                <p class="doctor-card-slider__position"><?php echo esc_html($position); ?></p>
            <?php endif; ?>
        </div>
        
        <?php if ($experience): ?>
            <p class="doctor-card-slider__experience">Опыт: <?php echo esc_html($experience); ?> лет</p>
        <?php endif; ?>
    </div>
</div>

