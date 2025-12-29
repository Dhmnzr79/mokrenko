<?php
/**
 * Template Name: Портфолио
 */
get_header();
?>

<section class="section section--page-intro-mobile page-intro-mobile">
	<div class="container">
		<div class="page-intro-mobile__box">
			<h1>До и После: Результаты, которыми мы гордимся</h1>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/mokrenko_first_mobile.png" alt="Доктор Мокренко" class="page-intro-mobile__image">
		</div>
		<div class="page-intro-mobile__benefits">
			<div class="page-intro-mobile__benefit-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="Галочка" class="page-intro-mobile__benefit-icon">
				<p>Реальные кейсы с фото, комментариями врача и сроками лечения</p>
			</div>
			<div class="page-intro-mobile__benefit-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="Галочка" class="page-intro-mobile__benefit-icon">
				<p>Посмотрите, каких результатов можно достичь — даже в сложных случаях.</p>
			</div>
			<div class="page-intro-mobile__benefit-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="Галочка" class="page-intro-mobile__benefit-icon">
				<p>Все фото сделаны в клинике. Никаких стоков — только честные результаты.</p>
			</div>
		</div>
		<button class="btn page-intro-mobile__cta-btn" data-popup="open">
			Записаться на консультацию
			<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка">
		</button>
	</div>
</section>

<section class="section section--page-intro page-intro">
	<div class="container">
		<div class="page-intro__box bg-gradient-brand">
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
			<div class="page-intro__layout">
				<div class="page-intro__content">
					<h1>До и После: Результаты, которыми мы гордимся</h1>
					<div class="page-intro__benefits">
						<div class="page-intro__benefit-item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="page-intro__benefit-icon">
							<p>Реальные кейсы с фото, комментариями врача и сроками лечения</p>
						</div>
						<div class="page-intro__benefit-item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="page-intro__benefit-icon">
							<p>Посмотрите, каких результатов можно достичь — даже в сложных случаях.</p>
						</div>
						<div class="page-intro__benefit-item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="page-intro__benefit-icon">
							<p>Все фото сделаны в клинике. Никаких стоков — только честные результаты.</p>
						</div>
					</div>
					<button class="btn page-intro__cta-btn" data-popup="open">
						Записаться на консультацию
						<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка">
					</button>
				</div>
				<div class="page-intro__info">
					<h4>Главный врач:</h4>
					<p>Елена Мокренко - стоматолог-ортопед с опытом работы более 33-х лет</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section section--breadcrumbs">
	<div class="container">
		<div class="breadcrumbs">
			<a href="/" class="breadcrumbs__link">Главная</a>
			<span class="breadcrumbs__separator">→</span>
			<span class="breadcrumbs__current">Портфолио</span>
		</div>
	</div>
</section>

<?php
// Функция для получения кейсов по категории
function get_cases_by_category($category_key) {
	$all_cases = get_posts([
		'post_type' => 'case',
		'posts_per_page' => -1,
		'post_status' => 'publish'
	]);
	
	$filtered_cases = [];
	foreach ($all_cases as $case) {
		$categories = get_post_meta($case->ID, 'case_categories', true);
		if ($categories) {
			$categories_array = json_decode($categories, true);
			if (is_array($categories_array) && in_array($category_key, $categories_array)) {
				$filtered_cases[] = $case;
			}
		}
	}
	
	return $filtered_cases;
}

// Массив разделов с их ключами и названиями
$portfolio_sections = [
	'all_on_4' => 'Алл-он-4',
	'crowns' => 'Коронки',
	'prosthetics' => 'Протезирование',
	'implantation' => 'Имплантация'
];

// Выводим секции для каждого раздела
foreach ($portfolio_sections as $category_key => $section_title):
	$cases = get_cases_by_category($category_key);
	
	// Пропускаем секцию, если нет кейсов
	if (empty($cases)) {
		continue;
	}
	
	$has_multiple = count($cases) > 1;
?>

<section class="section section--portfolio-category portfolio-category">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="portfolio-category__header">
					<h2><?php echo esc_html($section_title); ?></h2>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<?php if ($has_multiple): ?>
					<!-- Слайдер если больше 1 кейса -->
					<div class="slider">
						<div class="slider__container">
							<div class="slider__track">
								<?php
								foreach ($cases as $index => $case) {
									echo '<div class="slider__slide' . ($index === 0 ? ' slider__slide--active' : '') . '">';
									get_template_part('template-parts/case/showcase', null, ['case_id' => $case->ID]);
									echo '</div>';
								}
								?>
							</div>
						</div>
						<div class="slider__nav">
							<button class="slider__prev" type="button">←</button>
							<button class="slider__next" type="button">→</button>
						</div>
					</div>
				<?php else: ?>
					<!-- Статично если 1 кейс -->
					<?php
					get_template_part('template-parts/case/showcase', null, ['case_id' => $cases[0]->ID]);
					?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php endforeach; ?>

<?php
get_footer();
?>

