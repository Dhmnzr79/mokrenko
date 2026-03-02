<?php
/**
 * Template part: Hero Menu (desktop)
 */
?>
<div class="hero__menu">
	<div class="hero__menu-burger">
		<?php
		$dropdown_id = 'servicesDropdown-' . wp_unique_id();
		$terms = get_terms([
			'taxonomy' => 'service_category',
			'hide_empty' => false,
			'orderby' => 'name',
			'order' => 'ASC',
		]);
		$has_terms = !is_wp_error($terms) && !empty($terms);

		if ($has_terms) {
			usort($terms, function($a, $b) {
				$pa = 10;
				$pb = 10;

				$slugA = (string) $a->slug;
				$slugB = (string) $b->slug;

				// Имплантация
				if (strpos($slugA, 'imlantaciya') === 0 || strpos($slugA, 'implantaciya') === 0) {
					$pa = 0;
				} elseif (strpos($slugA, 'protezy-i-koronki') === 0 || strpos($slugA, 'protezy') === 0) {
					// Протезирование
					$pa = 1;
				}

				if (strpos($slugB, 'imlantaciya') === 0 || strpos($slugB, 'implantaciya') === 0) {
					$pb = 0;
				} elseif (strpos($slugB, 'protezy-i-koronki') === 0 || strpos($slugB, 'protezy') === 0) {
					$pb = 1;
				}

				if ($pa === $pb) {
					return strcasecmp($a->name, $b->name);
				}

				return $pa <=> $pb;
			});
		}
		?>
		<button class="hero__burger-btn" aria-expanded="false" aria-controls="<?php echo esc_attr($dropdown_id); ?>">
			<span class="hero__burger-icon"></span>
			<span class="hero__burger-text">Услуги</span>
		</button>
		<div class="services-dropdown" id="<?php echo esc_attr($dropdown_id); ?>" style="display:none;">
			<?php if ($has_terms) : ?>
				<nav class="services-dropdown__categories" aria-label="Категории услуг">
					<ul class="services-dropdown__category-list">
						<?php foreach ($terms as $i => $term) : ?>
							<li class="services-dropdown__category-item">
								<button type="button" class="services-dropdown__category-btn<?php echo $i === 0 ? ' services-dropdown__category-btn--active' : ''; ?>" data-panel="services-panel-<?php echo (int) $term->term_id; ?>">
									<?php echo esc_html($term->name); ?>
								</button>
							</li>
						<?php endforeach; ?>
					</ul>
				</nav>
				<div class="services-dropdown__content">
					<?php foreach ($terms as $i => $term) :
						$panel_id = 'services-panel-' . (int) $term->term_id;
						$q = new WP_Query([
							'post_type' => 'service',
							'posts_per_page' => -1,
							'post_status' => 'publish',
							'tax_query' => [
								[
									'taxonomy' => 'service_category',
									'field' => 'term_id',
									'terms' => [$term->term_id],
								],
							],
							'orderby' => [
								'menu_order' => 'ASC',
								'title' => 'ASC',
							],
							'no_found_rows' => true,
						]);
						?>
						<div class="services-dropdown__panel<?php echo $i === 0 ? ' services-dropdown__panel--active' : ''; ?>" id="<?php echo esc_attr($panel_id); ?>" role="tabpanel" aria-hidden="<?php echo $i === 0 ? 'false' : 'true'; ?>">
							<?php if ($q->have_posts()) : ?>
								<ul class="services-dropdown__list">
									<?php while ($q->have_posts()) : $q->the_post(); ?>
										<li class="services-dropdown__item">
											<a class="services-dropdown__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</li>
									<?php endwhile; ?>
								</ul>
							<?php else : ?>
								<div class="services-dropdown__empty">Пока нет услуг</div>
							<?php endif; ?>
						</div>
						<?php
						wp_reset_postdata();
					endforeach; ?>
				</div>
			<?php else : ?>
				<div class="services-dropdown__empty">Пока нет категорий</div>
			<?php endif; ?>
		</div>
	</div>
	<nav class="hero__menu-nav">
		<a href="<?php echo esc_url(get_page_url_by_template('page-about.php')); ?>" class="hero__menu-link">О клинике</a>
		<a href="<?php echo esc_url(get_page_url_by_template('page-portfolio.php')); ?>" class="hero__menu-link">Портфолио</a>
		<a href="<?php echo esc_url(get_page_url_by_template('page-doctors.php')); ?>" class="hero__menu-link">Врачи</a>
		<a href="<?php echo esc_url(get_page_url_by_template('page-prices.php')); ?>" class="hero__menu-link">Прайс</a>
		<a href="<?php echo esc_url(get_page_url_by_template('page-blog.php')); ?>" class="hero__menu-link">Блог</a>
		<a href="<?php echo esc_url(get_page_url_by_template('page-reviews.php')); ?>" class="hero__menu-link">Отзывы</a>
		<a href="<?php echo esc_url(get_page_url_by_template('page-contacts.php')); ?>" class="hero__menu-link">Контакты</a>
	</nav>
	<div class="hero__menu-search" data-search-action="<?php echo esc_url(home_url('/')); ?>" data-theme-uri="<?php echo esc_url(get_stylesheet_directory_uri()); ?>">
		<button class="hero__search-btn" type="button">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/search.svg" alt="" class="hero__search-icon">
		</button>
	</div>
</div>
