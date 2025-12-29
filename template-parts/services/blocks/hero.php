<?php
/**
 * Hero секция услуги
 * 
 * @var array $args {
 *     @type int    $post_id
 *     @type string $section_slug
 *     @type array  $meta
 *     @type array  $section_data
 * }
 */

$post_id = $args['post_id'] ?? 0;
$section_data = $args['section_data'] ?? [];

// Получаем данные Hero секции
// Helper функция уже убрала префикс _service_hero_, поэтому ключи без hero_
$title = $section_data['title'] ?? get_the_title($post_id);
$subtitle = $section_data['subtitle'] ?? '';
$benefits = $section_data['benefits'] ?? [];
if (!is_array($benefits)) $benefits = [];
$image_id = $section_data['image'] ?? 0;
$info_title = $section_data['info_title'] ?? '';
$info_text = $section_data['info_text'] ?? '';
$button_text = $section_data['button_text'] ?? '';
$button_link = $section_data['button_link'] ?? '';

// Отладочная информация для админов
if (current_user_can('manage_options') && isset($_GET['debug_hero'])) {
    echo '<div style="background: #fff3cd; padding: 15px; margin: 20px; border: 2px solid #ffc107;">';
    echo '<h3>🔍 Отладка Hero секции</h3>';
    echo '<p><strong>Section Data:</strong></p>';
    echo '<pre>' . print_r($section_data, true) . '</pre>';
    echo '<p><strong>Title:</strong> ' . esc_html($title) . '</p>';
    echo '<p><strong>Subtitle:</strong> ' . esc_html($subtitle) . '</p>';
    echo '<p><strong>Benefits:</strong> ' . (empty($benefits) ? 'Нет' : count($benefits)) . '</p>';
    echo '<p><strong>Image ID:</strong> ' . esc_html($image_id) . '</p>';
    echo '</div>';
}
?>
<section class="section section--service-hero service-hero">
	<div class="container">
		<div class="service-hero__box bg-gradient-brand">
			<?php get_template_part('template-parts/page-top'); ?>
			
			<div class="service-hero__layout">
				<div class="service-hero__content">
					<?php if ($title) : ?>
						<h1><?php echo esc_html($title); ?></h1>
					<?php endif; ?>
					
					<?php if ($subtitle) : ?>
						<p class="service-hero__subtitle"><?php echo esc_html($subtitle); ?></p>
					<?php endif; ?>
					
					<?php if (!empty($benefits)) : ?>
						<div class="service-hero__benefits">
							<?php foreach ($benefits as $benefit) : 
								if (empty($benefit['text'])) continue;
								$icon_id = isset($benefit['icon']) ? absint($benefit['icon']) : 0;
							?>
								<div class="service-hero__benefit-item">
									<?php if ($icon_id) : ?>
										<?php echo wp_get_attachment_image($icon_id, 'thumbnail', false, ['class' => 'service-hero__benefit-icon']); ?>
									<?php else : ?>
										<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="service-hero__benefit-icon">
									<?php endif; ?>
									<p><?php echo esc_html($benefit['text']); ?></p>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
					
					<?php if ($button_text) : ?>
						<?php if ($button_link) : ?>
							<a href="<?php echo esc_url($button_link); ?>" class="btn service-hero__cta-btn">
								<?php echo esc_html($button_text); ?>
								<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка">
							</a>
						<?php else : ?>
							<button class="btn service-hero__cta-btn" data-popup="open">
								<?php echo esc_html($button_text); ?>
								<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка">
							</button>
						<?php endif; ?>
					<?php endif; ?>
				</div>
				
				<?php if ($image_id || $info_title || $info_text) : ?>
					<div class="service-hero__info-wrapper">
						<?php if ($image_id) : ?>
							<div class="service-hero__image">
								<?php echo wp_get_attachment_image($image_id, 'large', false, ['class' => 'service-hero__img']); ?>
							</div>
						<?php endif; ?>
						
						<?php if ($info_title || $info_text) : ?>
							<div class="service-hero__info">
								<?php if ($info_title) : ?>
									<h4><?php echo esc_html($info_title); ?></h4>
								<?php endif; ?>
								<?php if ($info_text) : ?>
									<p><?php echo esc_html($info_text); ?></p>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

