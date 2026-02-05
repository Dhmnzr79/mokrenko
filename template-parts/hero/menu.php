<?php
/**
 * Template part: Hero Menu (desktop)
 */
?>
<div class="hero__menu">
	<div class="hero__menu-burger">
		<?php $dropdown_id = 'servicesDropdown-' . wp_unique_id(); ?>
		<button class="hero__burger-btn" aria-expanded="false" aria-controls="<?php echo esc_attr($dropdown_id); ?>">
			<span class="hero__burger-icon"></span>
			<span class="hero__burger-text">Услуги</span>
		</button>
		<div class="services-dropdown" id="<?php echo esc_attr($dropdown_id); ?>" style="display:none;">
			<?php
			$terms = get_terms([
				'taxonomy' => 'service_category',
				'hide_empty' => false,
				'orderby' => 'name',
				'order' => 'ASC',
			]);

			if (!is_wp_error($terms) && !empty($terms)) :
				foreach ($terms as $term) :
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
					<div class="services-dropdown__group">
						<div class="services-dropdown__title"><?php echo esc_html($term->name); ?></div>
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
				endforeach;
			else :
				?>
				<div class="services-dropdown__empty">Пока нет категорий</div>
				<?php
			endif;
			?>
		</div>
	</div>
	<nav class="hero__menu-nav">
		<a href="<?php echo esc_url(get_page_url_by_template('page-about.php')); ?>" class="hero__menu-link">О клинике</a>
		<a href="<?php echo esc_url(get_page_url_by_template('page-portfolio.php')); ?>" class="hero__menu-link">Портфолио</a>
		<a href="<?php echo esc_url(get_page_url_by_template('page-doctors.php')); ?>" class="hero__menu-link">Врачи</a>
		<a href="<?php echo esc_url(get_page_url_by_template('page-prices.php')); ?>" class="hero__menu-link">Прайс</a>
		<a href="<?php echo esc_url(home_url('/')); ?>" class="hero__menu-link">Акции</a>
		<a href="<?php echo esc_url(get_page_url_by_template('page-blog.php')); ?>" class="hero__menu-link">Блог</a>
		<a href="<?php echo esc_url(get_page_url_by_template('page-reviews.php')); ?>" class="hero__menu-link">Отзывы</a>
		<a href="<?php echo esc_url(get_page_url_by_template('page-contacts.php')); ?>" class="hero__menu-link">Контакты</a>
	</nav>
	<div class="hero__menu-search">
		<button class="hero__search-btn">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/search.svg" alt="" class="hero__search-icon">
		</button>
	</div>
</div>


