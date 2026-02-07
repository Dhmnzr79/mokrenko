<?php
/**
 * 404 Not Found
 * SEO: noindex, follow; уникальные title и meta description в functions.php
 */
add_filter('body_class', function($classes) {
	$classes[] = 'page-has-top';
	return $classes;
});
get_header();
?>

<?php get_template_part('template-parts/page-top'); ?>

<section class="section section--not-found not-found">
	<div class="container">
		<div class="not-found__image">
			<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/svg/404.svg" alt="Ошибка 404 — страница не найдена" width="410" height="213" class="not-found__img">
		</div>
		<h1 class="not-found__title">Страница не найдена</h1>
		<p class="not-found__text">Запрашиваемая страница не существует или была перемещена. Вы можете перейти на главную или в нужный раздел сайта.</p>
		<nav class="not-found__nav" aria-label="Навигация по сайту">
			<ul class="not-found__list">
				<li><div class="link-underline-slide-wrap"><a href="<?php echo esc_url(home_url('/')); ?>" class="not-found__link link-underline-slide">Главная</a></div></li>
				<li><div class="link-underline-slide-wrap"><a href="<?php echo esc_url(get_page_url_by_template('page-about.php')); ?>" class="not-found__link link-underline-slide">О клинике</a></div></li>
				<li><div class="link-underline-slide-wrap"><a href="<?php echo esc_url(get_page_url_by_template('page-contacts.php')); ?>" class="not-found__link link-underline-slide">Контакты</a></div></li>
			</ul>
		</nav>
	</div>
</section>

<?php
get_footer();
