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
	</div>
</header>

<!-- Мобильная шапка -->
<header class="site-header site-header--mobile">
	<div class="container">
		<div class="row header__row header__row--mobile">
			<div class="header__mobile-logo">
				<a href="<?php echo esc_url(home_url('/')); ?>" class="header__brand">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svg/logo_mobile.svg" alt="Стоматологическая Клиника Елены Мокренко" class="header__logo-img">
				</a>
			</div>
			<div class="header__mobile-actions">
				<a href="tel:+74950035476" class="header__mobile-phone">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svg/phone.svg" alt="Позвонить" class="header__mobile-icon">
				</a>
				<button class="header__mobile-menu" aria-label="Меню">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svg/burger.svg" alt="Меню" class="header__mobile-icon">
				</button>
			</div>
		</div>
	</div>
</header>

<main class="site-main">
