<?php
/**
 * Описание услуги секция
 * 
 * @var array $args
 */
$post_id = $args['post_id'] ?? 0;
$section_data = $args['section_data'] ?? [];
?>
<section class="service-description" data-section="description">
    <div class="container">
        <div class="service-description__debug" style="padding: 20px; background: #f0f0f0; margin: 20px 0; border: 2px dashed #ccc;">
            <h2 style="margin: 0 0 10px 0; color: #333;">🔧 Описание услуги секция (Этап 2 - проверка рендера)</h2>
            <p style="margin: 0; color: #666;">
                <strong>Post ID:</strong> <?php echo esc_html($post_id); ?><br>
                <strong>Section Slug:</strong> <?php echo esc_html($args['section_slug'] ?? 'N/A'); ?><br>
                <strong>Данные секции:</strong> <?php echo empty($section_data) ? 'Нет данных (это нормально на Этапе 2)' : 'Есть данные'; ?>
            </p>
        </div>
    </div>
</section>

