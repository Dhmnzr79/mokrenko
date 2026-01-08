<?php
/**
 * Template part: Page Top Menu (menu only)
 * Используется внутри hero-блоков, где НЕ нужна повторная "шапка" (header__row),
 * а нужно только меню.
 */
?>
<div class="page-top__menu-wrapper">
	<div class="hero__menu">
		<div class="hero__menu-burger">
			<button class="hero__burger-btn">
				<span class="hero__burger-icon"></span>
				<span class="hero__burger-text">Услуги</span>
			</button>
		</div>
		<nav class="hero__menu-nav">
			<a href="<?php echo esc_url(get_page_url_by_template('page-about.php')); ?>" class="hero__menu-link">О клинике</a>
			<a href="<?php echo esc_url(get_page_url_by_template('page-portfolio.php')); ?>" class="hero__menu-link">Портфолио</a>
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







