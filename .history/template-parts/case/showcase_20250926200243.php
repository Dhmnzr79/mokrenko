<?php
/**
 * Шаблон кейса (универсальный компонент)
 * Паттерн 205 - 4/4/4 (врач | ДО | ПОСЛЕ)
 */

$case_id = $args['case_id'] ?? get_the_ID();
if (!$case_id) return;

// Получаем данные кейса
$doctor_id = get_post_meta($case_id, 'case_doctor_id', true);
$before_image = get_post_meta($case_id, 'case_before_image', true);
$before_desc = get_post_meta($case_id, 'case_before_desc', true);
$after_image = get_post_meta($case_id, 'case_after_image', true);
$after_desc = get_post_meta($case_id, 'case_after_desc', true);
$duration = get_post_meta($case_id, 'case_duration', true);

// Получаем данные врача
$doctor = get_post($doctor_id);
if (!$doctor) return;

$doctor_position = get_post_meta($doctor_id, 'doctor_position', true);
$doctor_photo = get_the_post_thumbnail($doctor_id, 'thumbnail');
$doctor_link = get_permalink($doctor_id);
?>

<article class="case">
    <!-- row: 4 / 4 / 4 -->
    <div class="row row--case">
        <div class="col-sm-12 col-lg-4">
            <div class="case-card">
                <div class="case-card__photo">
                    <?php if ($doctor_photo): ?>
                        <?php echo $doctor_photo; ?>
                    <?php else: ?>
                        <img src="https://via.placeholder.com/150x150/f0f0f0/666666?text=Фото" alt="<?php echo esc_attr($doctor->post_title); ?>">
                    <?php endif; ?>
                </div>
                <div class="case-card__content">
                    <h3 class="case-card__name"><?php echo esc_html($doctor->post_title); ?></h3>
                    <p class="case-card__position"><?php echo esc_html($doctor_position); ?></p>
                    <a href="<?php echo esc_url($doctor_link); ?>" class="case-card__link">Подробнее</a>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4">
            <div class="case-panel">
                <div class="case-panel__image">
                    <?php if ($before_image): ?>
                        <?php echo wp_get_attachment_image($before_image, 'medium'); ?>
                    <?php else: ?>
                        <img src="https://via.placeholder.com/300x200/f0f0f0/666666?text=ДО" alt="До лечения">
                    <?php endif; ?>
                </div>
                <div class="case-panel__badge">ДО</div>
                <div class="case-panel__content">
                    <p><?php echo esc_html($before_desc); ?></p>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4">
            <div class="case-panel">
                <div class="case-panel__image">
                    <?php if ($after_image): ?>
                        <?php echo wp_get_attachment_image($after_image, 'medium'); ?>
                    <?php else: ?>
                        <img src="https://via.placeholder.com/300x200/f0f0f0/666666?text=ПОСЛЕ" alt="После лечения">
                    <?php endif; ?>
                </div>
                <div class="case-panel__badge">ПОСЛЕ</div>
                <div class="case-panel__content">
                    <p><?php echo esc_html($after_desc); ?></p>
                </div>
            </div>
        </div>
    </div>
</article>