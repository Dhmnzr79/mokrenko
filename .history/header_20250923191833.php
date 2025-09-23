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
			<div class="col-sm-6 col-lg-3 header__logo">
				<a href="<?php echo esc_url(home_url('/')); ?>" class="header__brand">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svg/logo.svg" alt="Стоматологическая Клиника Елены Мокренко" class="header__logo-img">
				</a>
			</div>
			<div class="col-sm-6 col-lg-3 header__address">
				<div class="header__info">Адрес</div>
			</div>
			<div class="col-sm-6 col-lg-3 header__hours">
				<div class="header__info">Время работы</div>
			</div>
			<div class="col-sm-6 col-lg-3 header__contact">
				<div class="header__info">Телефон/WhatsApp</div>
			</div>
		</div>
	</div>
</header>
<main class="site-main">
