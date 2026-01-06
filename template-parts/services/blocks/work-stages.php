<?php
/**
 * Work Stages секция услуги (Этапы работ)
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
$stage_1 = $section_data['stage_1'] ?? [];
if (!is_array($stage_1)) $stage_1 = [];
$stage_2 = $section_data['stage_2'] ?? [];
if (!is_array($stage_2)) $stage_2 = [];

// Фильтруем заполненные пункты чек-листов
$stage_1_checklist = isset($stage_1['checklist']) && is_array($stage_1['checklist']) 
    ? array_filter($stage_1['checklist'], function($item) {
        return !empty($item['title']) || !empty($item['description']);
    })
    : [];

$stage_2_checklist = isset($stage_2['checklist']) && is_array($stage_2['checklist']) 
    ? array_filter($stage_2['checklist'], function($item) {
        return !empty($item['title']) || !empty($item['description']);
    })
    : [];

if (empty($title) && empty($subtitle) && empty($stage_1) && empty($stage_2)) {
    return;
}
?>
<section class="section section--service-work-stages service-work-stages">
	<div class="container">
		<?php if ($title || $subtitle) : ?>
			<div class="service-work-stages__header">
				<?php if ($title) : ?>
					<h2 class="service-work-stages__title"><?php echo esc_html($title); ?></h2>
				<?php endif; ?>
				<?php if ($subtitle) : ?>
					<p class="service-work-stages__subtitle"><?php echo esc_html($subtitle); ?></p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php
		$stage_1_has = (!empty($stage_1['title']) || !empty($stage_1['image']) || !empty($stage_1_checklist));
		$stage_2_has = (!empty($stage_2['title']) || !empty($stage_2['image']) || !empty($stage_2_checklist));
		?>

		<?php if ($stage_1_has && $stage_2_has) : ?>
			<div class="row service-work-stages__stage">
				<div class="col-sm-12 col-lg-6">
					<div class="service-work-stages__stage-col">
						<?php if (!empty($stage_1['image'])) : ?>
							<div class="service-work-stages__image">
								<?php echo wp_get_attachment_image($stage_1['image'], 'large', false, ['class' => 'service-work-stages__img']); ?>
							</div>
						<?php endif; ?>
						<div class="service-work-stages__content">
							<?php if (!empty($stage_1['title'])) : ?>
								<h3 class="service-work-stages__stage-title"><?php echo esc_html($stage_1['title']); ?></h3>
							<?php endif; ?>
							<?php if (!empty($stage_1_checklist)) : ?>
								<ul class="service-work-stages__checklist">
									<?php foreach ($stage_1_checklist as $item) :
										$item_title = isset($item['title']) ? $item['title'] : '';
										$item_description = isset($item['description']) ? $item['description'] : '';
									?>
										<li class="service-work-stages__checklist-item">
											<?php if ($item_title) : ?>
												<h4 class="service-work-stages__checklist-title"><?php echo esc_html($item_title); ?></h4>
											<?php endif; ?>
											<?php if ($item_description) : ?>
												<p class="service-work-stages__checklist-description"><?php echo esc_html($item_description); ?></p>
											<?php endif; ?>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<div class="col-sm-12 col-lg-6">
					<div class="service-work-stages__stage-col">
						<?php if (!empty($stage_2['image'])) : ?>
							<div class="service-work-stages__image">
								<?php echo wp_get_attachment_image($stage_2['image'], 'large', false, ['class' => 'service-work-stages__img']); ?>
							</div>
						<?php endif; ?>
						<div class="service-work-stages__content">
							<?php if (!empty($stage_2['title'])) : ?>
								<h3 class="service-work-stages__stage-title"><?php echo esc_html($stage_2['title']); ?></h3>
							<?php endif; ?>
							<?php if (!empty($stage_2_checklist)) : ?>
								<ul class="service-work-stages__checklist">
									<?php foreach ($stage_2_checklist as $item) :
										$item_title = isset($item['title']) ? $item['title'] : '';
										$item_description = isset($item['description']) ? $item['description'] : '';
									?>
										<li class="service-work-stages__checklist-item">
											<?php if ($item_title) : ?>
												<h4 class="service-work-stages__checklist-title"><?php echo esc_html($item_title); ?></h4>
											<?php endif; ?>
											<?php if ($item_description) : ?>
												<p class="service-work-stages__checklist-description"><?php echo esc_html($item_description); ?></p>
											<?php endif; ?>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php elseif ($stage_1_has) : ?>
			<div class="row service-work-stages__stage">
				<div class="col-sm-12">
					<div class="service-work-stages__stage-col">
						<?php if (!empty($stage_1['image'])) : ?>
							<div class="service-work-stages__image">
								<?php echo wp_get_attachment_image($stage_1['image'], 'large', false, ['class' => 'service-work-stages__img']); ?>
							</div>
						<?php endif; ?>
						<div class="service-work-stages__content">
							<?php if (!empty($stage_1['title'])) : ?>
								<h3 class="service-work-stages__stage-title"><?php echo esc_html($stage_1['title']); ?></h3>
							<?php endif; ?>
							<?php if (!empty($stage_1_checklist)) : ?>
								<ul class="service-work-stages__checklist">
									<?php foreach ($stage_1_checklist as $item) :
										$item_title = isset($item['title']) ? $item['title'] : '';
										$item_description = isset($item['description']) ? $item['description'] : '';
									?>
										<li class="service-work-stages__checklist-item">
											<?php if ($item_title) : ?>
												<h4 class="service-work-stages__checklist-title"><?php echo esc_html($item_title); ?></h4>
											<?php endif; ?>
											<?php if ($item_description) : ?>
												<p class="service-work-stages__checklist-description"><?php echo esc_html($item_description); ?></p>
											<?php endif; ?>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php elseif ($stage_2_has) : ?>
			<div class="row service-work-stages__stage">
				<div class="col-sm-12">
					<div class="service-work-stages__stage-col">
						<?php if (!empty($stage_2['image'])) : ?>
							<div class="service-work-stages__image">
								<?php echo wp_get_attachment_image($stage_2['image'], 'large', false, ['class' => 'service-work-stages__img']); ?>
							</div>
						<?php endif; ?>
						<div class="service-work-stages__content">
							<?php if (!empty($stage_2['title'])) : ?>
								<h3 class="service-work-stages__stage-title"><?php echo esc_html($stage_2['title']); ?></h3>
							<?php endif; ?>
							<?php if (!empty($stage_2_checklist)) : ?>
								<ul class="service-work-stages__checklist">
									<?php foreach ($stage_2_checklist as $item) :
										$item_title = isset($item['title']) ? $item['title'] : '';
										$item_description = isset($item['description']) ? $item['description'] : '';
									?>
										<li class="service-work-stages__checklist-item">
											<?php if ($item_title) : ?>
												<h4 class="service-work-stages__checklist-title"><?php echo esc_html($item_title); ?></h4>
											<?php endif; ?>
											<?php if ($item_description) : ?>
												<p class="service-work-stages__checklist-description"><?php echo esc_html($item_description); ?></p>
											<?php endif; ?>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>