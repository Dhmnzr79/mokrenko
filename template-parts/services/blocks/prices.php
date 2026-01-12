<?php
/**
 * Prices секция услуги
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
$items = $section_data['items'] ?? [];
if (!is_array($items)) $items = [];

// фильтр пустых строк
$items = array_values(array_filter($items, function($item) {
	if (!is_array($item)) return false;
	return !empty($item['name']) || !empty($item['price']) || !empty($item['old_price']);
}));

if (empty($items)) {
	return;
}

$has_format_price = function_exists('format_price');
?>
<section class="section section--service-prices service-prices">
	<div class="container">
		<div class="prices__category">
			<h2 class="prices__category-title"><?php echo esc_html($title ?: 'Цены'); ?></h2>
			<div class="prices__list">
				<?php
				$total = count($items);
				foreach ($items as $i => $item) :
					$is_last = ($i === $total - 1);
					$name = isset($item['name']) ? (string)$item['name'] : '';
					$price_raw = isset($item['price']) ? (string)$item['price'] : '';
					$old_price_raw = isset($item['old_price']) ? (string)$item['old_price'] : '';
					$has_discount = ($old_price_raw !== '');

					$price = $has_format_price ? format_price($price_raw) : $price_raw;
					$old_price = ($has_format_price && $old_price_raw !== '') ? format_price($old_price_raw) : $old_price_raw;
				?>
					<div class="prices__item<?php echo $is_last ? ' prices__item--last' : ''; ?>">
						<div class="prices__service"><?php echo esc_html($name); ?></div>
						<?php if ($has_discount) : ?>
							<div class="prices__price prices__price--discount">
								<div class="prices__price-old"><?php echo esc_html($old_price); ?></div>
								<div class="prices__price-new"><?php echo esc_html($price); ?></div>
							</div>
						<?php else : ?>
							<div class="prices__price"><?php echo esc_html($price); ?></div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>







