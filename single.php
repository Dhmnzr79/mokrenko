<?php
/**
 * Template for single blog post
 */

// Добавляем класс body для скрытия обычного header
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
			<a href="/" class="breadcrumbs__link">Главная</a>
			<span class="breadcrumbs__separator">→</span>
			<a href="<?php echo esc_url(get_page_url_by_template('page-blog.php')); ?>" class="breadcrumbs__link">Блог</a>
			<span class="breadcrumbs__separator">→</span>
			<span class="breadcrumbs__current"><?php the_title(); ?></span>
		</div>
	</div>
</section>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<section class="section section--blog-single blog-single">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-8">
				<article class="blog-single__article">
					<header class="blog-single__header">
						<div class="blog-single__meta">
							<span class="blog-single__date"><?php echo get_the_date('d.m.Y'); ?></span>
						</div>
						<h1 class="blog-single__title"><?php the_title(); ?></h1>
					</header>
					
					<?php if (has_post_thumbnail()) : ?>
						<div class="blog-single__image">
							<?php the_post_thumbnail('large', ['class' => 'blog-single__img']); ?>
						</div>
					<?php endif; ?>
					
					<div class="blog-single__content">
						<?php the_content(); ?>
					</div>
				</article>
			</div>
			<div class="col-sm-12 col-lg-4">
				<aside class="blog-single__sidebar">
					<div class="blog-single__back">
						<a href="<?php echo esc_url(get_page_url_by_template('page-blog.php')); ?>" class="blog-single__back-link">← Вернуться к блогу</a>
					</div>
				</aside>
			</div>
		</div>
	</div>
</section>
<?php endwhile; endif; ?>

<?php get_footer(); ?>

