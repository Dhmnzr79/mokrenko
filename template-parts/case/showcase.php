<?php
$case_id = $args['case_id'] ?? get_the_ID();
if (!$case_id) return;
$doctor_id = get_post_meta($case_id, 'case_doctor_id', true);
$before_image = get_post_meta($case_id, 'case_before_image', true);
$before_desc = get_post_meta($case_id, 'case_before_desc', true);
$after_image = get_post_meta($case_id, 'case_after_image', true);
$after_desc = get_post_meta($case_id, 'case_after_desc', true);
$duration = get_post_meta($case_id, 'case_duration', true);

// Получаем динамические проблемы и решения
$problems_data = get_post_meta($case_id, 'case_problems_dynamic', true);
$problems_data = $problems_data ? json_decode($problems_data, true) : [];

$solutions_data = get_post_meta($case_id, 'case_solutions_dynamic', true);
$solutions_data = $solutions_data ? json_decode($solutions_data, true) : [];

$doctor = get_post($doctor_id);
if (!$doctor) return;

$doctor_position = get_post_meta($doctor_id, 'doctor_position', true);
$doctor_photo = get_the_post_thumbnail($doctor_id, 'thumbnail');
$doctor_link = get_permalink($doctor_id);
?>

<article class="case">
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
                    <div class="case-card__link-wrap">
                        <a href="<?php echo esc_url($doctor_link); ?>" class="case-card__link">Подробнее</a>
                    </div>
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
                    <div class="case-panel__label case-panel__label--before">До</div>
                </div>
                <div class="case-panel__badge">Проблема</div>
                <div class="case-panel__content">
                    <?php if (!empty($problems_data)): ?>
                        <div class="case-panel__checklist">
                            <?php foreach ($problems_data as $problem_text): ?>
                                <div class="case-panel__checklist-item case-panel__checklist-item--problem">
                                    <span class="case-panel__checklist-icon">✓</span>
                                    <span class="case-panel__checklist-text"><?php echo esc_html($problem_text); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
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
                    <div class="case-panel__label case-panel__label--after">После</div>
                </div>
                <div class="case-panel__badge">Решение</div>
                <div class="case-panel__content">
                    <?php if (!empty($solutions_data)): ?>
                        <div class="case-panel__checklist">
                            <?php foreach ($solutions_data as $solution_text): ?>
                                <div class="case-panel__checklist-item case-panel__checklist-item--solution">
                                    <span class="case-panel__checklist-icon">✓</span>
                                    <span class="case-panel__checklist-text"><?php echo esc_html($solution_text); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</article>