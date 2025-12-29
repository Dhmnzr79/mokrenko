<?php
/**
 * Benefits секция услуги (Плюсы услуги)
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

// Получаем данные Benefits секции
$items = $section_data['items'] ?? [];
if (!is_array($items)) $items = [];

// Фильтруем только заполненные карточки
$items = array_filter($items, function($item) {
    return !empty($item['title']) || !empty($item['text']);
});

if (empty($items)) {
    return;
}
?>
<section class="section section--service-benefits service-benefits">
	<div class="container">
		<div class="row">
			<?php foreach ($items as $index => $item) : 
				$icon_id = isset($item['icon']) ? absint($item['icon']) : 0;
				$title = isset($item['title']) ? $item['title'] : '';
				$text = isset($item['text']) ? $item['text'] : '';
			?>
				<div class="col-sm-6 col-lg-3">
					<div class="service-benefits__card">
						<?php if ($icon_id) : ?>
							<div class="service-benefits__icon">
								<?php echo wp_get_attachment_image($icon_id, 'medium', false, ['class' => 'service-benefits__icon-img']); ?>
							</div>
						<?php endif; ?>
						
						<?php if ($title) : ?>
							<h3 class="service-benefits__title"><?php echo esc_html($title); ?></h3>
						<?php endif; ?>
						
						<?php if ($text) : ?>
							<p class="service-benefits__text"><?php echo esc_html($text); ?></p>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
