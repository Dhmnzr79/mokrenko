<?php
$post_id = $args['post_id'] ?? 0;
$section_data = $args['section_data'] ?? [];

$title = $section_data['title'] ?? '';
$subtitle = $section_data['subtitle'] ?? '';
$cards = $section_data['cards'] ?? [];
if (!is_array($cards)) $cards = [];
$feature_card = $section_data['feature_card'] ?? [];
if (!is_array($feature_card)) $feature_card = [];

// Фильтруем заполненные карточки
$cards = array_filter($cards, function($card) {
    return !empty($card['title']) || !empty($card['text']);
});

if (empty($title) && empty($cards) && empty($feature_card)) {
    return;
}
?>
<section class="section section--service-clinic-benefits service-clinic-benefits">
	<div class="container">
		<?php if ($title || $subtitle) : ?>
			<div class="service-clinic-benefits__header">
				<?php if ($title) : ?>
					<h2 class="service-clinic-benefits__title"><?php echo esc_html($title); ?></h2>
				<?php endif; ?>
				<?php if ($subtitle) : ?>
					<p class="service-clinic-benefits__subtitle"><?php echo esc_html($subtitle); ?></p>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		
		<div class="row">
			<?php if (!empty($cards)) : ?>
				<div class="col-sm-12 col-lg-8">
					<div class="row">
						<?php foreach ($cards as $index => $card) : 
							$icon_id = isset($card['icon']) ? absint($card['icon']) : 0;
							$card_title = isset($card['title']) ? $card['title'] : '';
							$card_text = isset($card['text']) ? $card['text'] : '';
						?>
							<div class="col-sm-6">
								<div class="service-clinic-benefits__card">
									<?php if ($icon_id) : ?>
										<div class="service-clinic-benefits__card-icon">
											<?php echo wp_get_attachment_image($icon_id, 'medium', false, ['class' => 'service-clinic-benefits__card-icon-img']); ?>
										</div>
									<?php endif; ?>
									
									<?php if ($card_title) : ?>
										<h3 class="service-clinic-benefits__card-title"><?php echo esc_html($card_title); ?></h3>
									<?php endif; ?>
									
									<?php if ($card_text) : ?>
										<p class="service-clinic-benefits__card-text"><?php echo esc_html($card_text); ?></p>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
			
			<?php if (!empty($feature_card)) : 
				$feature_icon_id = isset($feature_card['icon']) ? absint($feature_card['icon']) : 0;
				$feature_icon_mime = $feature_icon_id ? get_post_mime_type($feature_icon_id) : '';
				$feature_icon_is_svg = ($feature_icon_mime === 'image/svg+xml');
				$feature_title = isset($feature_card['title']) ? $feature_card['title'] : '';
				$feature_text = isset($feature_card['text']) ? $feature_card['text'] : '';
				$button_text = isset($feature_card['button_text']) ? $feature_card['button_text'] : '';
				$button_link = isset($feature_card['button_link']) ? $feature_card['button_link'] : '';
			?>
				<div class="col-sm-12 col-lg-4">
					<div class="service-clinic-benefits__feature-card">
						<?php if ($feature_icon_id) : ?>
							<?php if ($feature_icon_is_svg) : ?>
								<div class="service-clinic-benefits__feature-icon">
									<?php echo wp_get_attachment_image($feature_icon_id, 'medium', false, ['class' => 'service-clinic-benefits__feature-icon-img']); ?>
								</div>
							<?php else : ?>
								<div class="service-clinic-benefits__feature-icon service-clinic-benefits__feature-icon--image">
									<?php echo wp_get_attachment_image($feature_icon_id, 'large', false, ['class' => 'service-clinic-benefits__feature-icon-img service-clinic-benefits__feature-icon-img--image']); ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>
						
						<div class="service-clinic-benefits__feature-content">
							<?php if ($feature_title) : ?>
								<h3 class="service-clinic-benefits__feature-title"><?php echo esc_html($feature_title); ?></h3>
							<?php endif; ?>
							
							<?php if ($feature_text) : ?>
								<p class="service-clinic-benefits__feature-text"><?php echo esc_html($feature_text); ?></p>
							<?php endif; ?>
							
							<?php if ($button_text) : ?>
								<?php if ($button_link) : ?>
									<a href="<?php echo esc_url($button_link); ?>" class="btn service-clinic-benefits__feature-btn">
										<?php echo esc_html($button_text); ?>
										<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка">
									</a>
								<?php else : ?>
									<button class="btn service-clinic-benefits__feature-btn" data-popup="open">
										<?php echo esc_html($button_text); ?>
										<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка">
									</button>
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>