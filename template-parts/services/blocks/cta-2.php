<?php
/**
 * CTA-2 секция услуги
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

$title = $section_data['title'] ?? '';
$subtitle = $section_data['subtitle'] ?? '';
$button_text = $section_data['button_text'] ?? '';
$button_link = $section_data['button_link'] ?? '';

if (!$title && !$subtitle && !$button_text) {
	return;
}
?>
<section class="section section--service-cta-2 service-cta-2">
	<div class="container">
		<div class="service-cta-2__box">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/cta_2_bg.png" alt="" class="service-cta-2__bg" aria-hidden="true">
			<div class="service-cta-2__row">				
				<div class="service-cta-2__content">
					<?php if ($title) : ?>
						<h2 class="service-cta-2__title"><?php echo esc_html($title); ?></h2>
					<?php endif; ?>
					<?php if ($subtitle) : ?>
						<p class="service-cta-2__subtitle"><?php echo esc_html($subtitle); ?></p>
					<?php endif; ?>
				</div>
            <?php if ($button_text) : ?>
					<?php if ($button_link) : ?>
						<a href="<?php echo esc_url($button_link); ?>" class="btn service-cta-2__btn">
							<?php echo esc_html($button_text); ?>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка">
						</a>
					<?php else : ?>
						<button class="btn service-cta-2__btn" data-popup="open">
							<?php echo esc_html($button_text); ?>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка">
						</button>
					<?php endif; ?>
				<?php endif; ?>            
			</div>
		</div>
	</div>
</section>





