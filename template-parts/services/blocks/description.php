<?php
/**
 * Описание услуги секция
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

// Helper уже убрал префикс _service_description_, поэтому ключи без description_
$title    = $section_data['title'] ?? '';
$text     = $section_data['text'] ?? '';
$image_id = isset($section_data['image']) ? (int) $section_data['image'] : 0;

if (!$title && !$text && !$image_id) {
    return;
}
?>
<section class="section section--service-description service-description">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-6">
				<?php if ($image_id) : ?>
					<div class="service-description__image">
						<?php echo wp_get_attachment_image($image_id, 'large', false, ['class' => 'service-description__img']); ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-sm-12 col-lg-6">
				<div class="service-description__content">
					<?php if ($title) : ?>
						<h2 class="service-description__title"><?php echo esc_html($title); ?></h2>
					<?php endif; ?>
					<?php if ($text) : ?>
						<div class="service-description__text">
							<?php echo wp_kses_post( wpautop( $text ) ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>

