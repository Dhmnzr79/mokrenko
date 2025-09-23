<?php
/**
 * Theme Header
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header">
	<div class="container">
		<div class="row header__row">
			<div class="col-sm-6 col-lg-2 header__logo">
				<a href="<?php echo esc_url(home_url('/')); ?>" class="header__brand">Лого</a>
			</div>
			<nav class="col-sm-12 col-lg-8 header__nav" aria-label="Основное меню">
				<?php
				wp_nav_menu([
					'theme_location' => 'menu_primary',
					'container'      => false,
					'menu_class'      => 'menu menu--primary',
					'fallback_cb'     => false,
				]);
				?>
			</nav>
			<div class="col-sm-6 col-lg-2 header__actions">
				<button class="header__burger" aria-label="Меню"></button>
				<button class="header__search" aria-label="Поиск"></button>
			</div>
		</div>
	</div>
</header>
<main class="site-main">
