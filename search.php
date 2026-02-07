<?php
/**
 * Search results
 */
add_filter('body_class', function($classes) {
	$classes[] = 'page-has-top';
	return $classes;
});
get_header();
?>

<?php get_template_part('template-parts/page-top'); ?>

<section class="section section--breadcrumbs">
	<div class="container">
		<div class="breadcrumbs">
			<a href="<?php echo esc_url(home_url('/')); ?>" class="breadcrumbs__link">Главная</a>
			<span class="breadcrumbs__separator">→</span>
			<span class="breadcrumbs__current">Результаты поиска</span>
		</div>
	</div>
</section>

<section class="section section--search-results search-results">
	<div class="container">
		<h1 class="search-results__title">Результаты поиска: <?php echo esc_html(get_search_query()); ?></h1>
		<?php if (have_posts()) : ?>
			<ul class="search-results__list">
				<?php while (have_posts()) : the_post(); ?>
					<li class="search-results__item">
						<a href="<?php the_permalink(); ?>" class="search-results__link"><?php the_title(); ?></a>
						<?php if (get_the_excerpt()) : ?>
							<p class="search-results__excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 25)); ?></p>
						<?php endif; ?>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php
			the_posts_pagination([
				'prev_text' => '← Назад',
				'next_text' => 'Вперед →',
			]);
			?>
		<?php else : ?>
			<p class="search-results__empty">По вашему запросу ничего не найдено.</p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
