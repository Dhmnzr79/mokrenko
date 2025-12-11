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

<div class="page-top">
	<div class="container">
		<div class="row header__row">
			<div class="col-sm-6 col-lg-3 header__logo">
				<a href="<?php echo esc_url(home_url('/')); ?>" class="header__brand">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svg/logo.svg" alt="Стоматологическая Клиника Елены Мокренко" class="header__logo-img">
				</a>
			</div>
			<div class="col-sm-6 col-lg-3 header__address">
				<div class="header__info">		
					<div class="header__info-text">Москва, Проспект<br>Мира, д. 75, стр. 1</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3 header__hours">
				<div class="header__info">
					<div class="header__info-text">Работаем ежедневно<br>с 10:00 до 21:00</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3 header__contact">
				<div class="header__info">
					<div class="header__contact-item">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svg/whatsapp.svg" alt="WhatsApp" class="header__contact-icon">
						<a href="tel:+74950035476" class="header__contact-phone">+7 (495) 003-54-76</a>
					</div>
				</div>
			</div>
		</div>
		<div class="hero__menu">
			<div class="hero__menu-burger">
				<button class="hero__burger-btn">
					<span class="hero__burger-icon"></span>
					<span class="hero__burger-text">Услуги</span>
				</button>
			</div>
			<nav class="hero__menu-nav">
				<a href="<?php echo esc_url(get_page_url_by_template('page-about.php')); ?>" class="hero__menu-link">О клинике</a>
				<a href="#" class="hero__menu-link">Портфолио</a>
				<a href="<?php echo esc_url(get_page_url_by_template('page-doctors.php')); ?>" class="hero__menu-link">Врачи</a>
				<a href="<?php echo esc_url(get_page_url_by_template('page-prices.php')); ?>" class="hero__menu-link">Прайс</a>
				<a href="#" class="hero__menu-link">Акции</a>
				<a href="<?php echo esc_url(get_page_url_by_template('page-blog.php')); ?>" class="hero__menu-link">Блог</a>
				<a href="<?php echo esc_url(get_page_url_by_template('page-reviews.php')); ?>" class="hero__menu-link">Отзывы</a>
				<a href="<?php echo esc_url(get_page_url_by_template('page-contacts.php')); ?>" class="hero__menu-link">Контакты</a>
			</nav>
			<div class="hero__menu-search">
				<button class="hero__search-btn">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/search.svg" alt="Поиск" class="hero__search-icon">
				</button>
			</div>
		</div>
	</div>
</div>

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

