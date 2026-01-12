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
<?php if (!theme_should_hide_default_header()): ?>
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
						<a href="https://wa.me/79850549339" target="_blank" rel="noopener noreferrer" class="header__contact-icon-link">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/svg/whatsapp.svg" alt="WhatsApp" class="header__contact-icon">
						</a>
						<a href="tel:+74950035476" class="header__contact-phone">+7 (495) 003-54-76</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<?php endif; ?>

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

<!-- Мобильное меню -->
<div class="mobile-menu">
	<div class="mobile-menu__overlay"></div>
	<div class="mobile-menu__content">
		<div class="mobile-menu__header">
			<button class="mobile-menu__back" type="button" aria-label="Назад" hidden>← Назад</button>
			<div class="mobile-menu__title">Меню</div>
			<button class="mobile-menu__close" aria-label="Закрыть меню">
				<span class="mobile-menu__close-icon"></span>
			</button>
		</div>
		<nav class="mobile-menu__scroller" aria-label="Мобильное меню">
			<ul class="mobile-menu__panel" id="mobileMenuRoot" data-title="Меню">
				<li><button class="mobile-menu__next" type="button" data-target="#mobileMenuServices">Услуги</button></li>
				<li><a href="<?php echo esc_url(get_page_url_by_template('page-about.php')); ?>" class="mobile-menu__link">О клинике</a></li>
				<li><a href="<?php echo esc_url(get_page_url_by_template('page-portfolio.php')); ?>" class="mobile-menu__link">Портфолио</a></li>
				<li><a href="<?php echo esc_url(get_page_url_by_template('page-doctors.php')); ?>" class="mobile-menu__link">Врачи</a></li>
				<li><a href="<?php echo esc_url(get_page_url_by_template('page-prices.php')); ?>" class="mobile-menu__link">Прайс</a></li>
				<li><a href="<?php echo esc_url(get_page_url_by_template('page-blog.php')); ?>" class="mobile-menu__link">Блог</a></li>
				<li><a href="<?php echo esc_url(get_page_url_by_template('page-reviews.php')); ?>" class="mobile-menu__link">Отзывы</a></li>
				<li><a href="<?php echo esc_url(get_page_url_by_template('page-contacts.php')); ?>" class="mobile-menu__link">Контакты</a></li>
			</ul>

			<?php
			$service_terms = get_terms([
				'taxonomy' => 'service_category',
				'hide_empty' => false,
			]);

			$terms_by_parent = [];
			if (!is_wp_error($service_terms) && !empty($service_terms)) {
				foreach ($service_terms as $t) {
					$terms_by_parent[(int) $t->parent][] = $t;
				}
			}

			$services_by_term = [];
			$services_q = new WP_Query([
				'post_type' => 'service',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC',
				'no_found_rows' => true,
				'update_post_meta_cache' => false,
				'update_post_term_cache' => true,
			]);

			if ($services_q->have_posts()) {
				while ($services_q->have_posts()) {
					$services_q->the_post();
					$term_ids = wp_get_post_terms(get_the_ID(), 'service_category', ['fields' => 'ids']);
					if (is_wp_error($term_ids) || empty($term_ids)) {
						continue;
					}
					foreach ($term_ids as $term_id) {
						$term_id = (int) $term_id;
						$services_by_term[$term_id][] = [
							'title' => get_the_title(),
							'url' => get_permalink(),
						];
					}
				}
				wp_reset_postdata();
			}
			?>

			<ul class="mobile-menu__panel" id="mobileMenuServices" data-title="Услуги" hidden>
				<?php if (!empty($terms_by_parent[0])): ?>
					<?php foreach ($terms_by_parent[0] as $top_term): ?>
						<li>
							<button class="mobile-menu__next" type="button" data-target="#mobileMenuServicesTerm<?php echo (int) $top_term->term_id; ?>">
								<?php echo esc_html($top_term->name); ?>
							</button>
						</li>
					<?php endforeach; ?>
				<?php else: ?>
					<li><span class="mobile-menu__text">Пока нет категорий услуг</span></li>
				<?php endif; ?>
			</ul>

			<?php
			$render_term_panel = function ($term) use (&$render_term_panel, $terms_by_parent, $services_by_term) {
				$term_id = (int) $term->term_id;
				$title = $term->name;
				$children = isset($terms_by_parent[$term_id]) ? $terms_by_parent[$term_id] : [];
				$services = isset($services_by_term[$term_id]) ? $services_by_term[$term_id] : [];
				?>
				<ul class="mobile-menu__panel" id="mobileMenuServicesTerm<?php echo $term_id; ?>" data-title="<?php echo esc_attr($title); ?>" hidden>
					<?php if (!empty($children)): ?>
						<?php foreach ($children as $child): ?>
							<li>
								<button class="mobile-menu__next" type="button" data-target="#mobileMenuServicesTerm<?php echo (int) $child->term_id; ?>">
									<?php echo esc_html($child->name); ?>
								</button>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>

					<?php if (!empty($services)): ?>
						<?php foreach ($services as $s): ?>
							<li><a href="<?php echo esc_url($s['url']); ?>" class="mobile-menu__link"><?php echo esc_html($s['title']); ?></a></li>
						<?php endforeach; ?>
					<?php elseif (empty($children)): ?>
						<li><span class="mobile-menu__text">Пока нет услуг</span></li>
					<?php endif; ?>
				</ul>
				<?php

				if (!empty($children)) {
					foreach ($children as $child) {
						$render_term_panel($child);
					}
				}
			};

			if (!empty($terms_by_parent[0])) {
				foreach ($terms_by_parent[0] as $top_term) {
					$render_term_panel($top_term);
				}
			}
			?>
		</nav>
	</div>
</div>

<main class="site-main">
