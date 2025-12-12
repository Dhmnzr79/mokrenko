<?php
/**
 * Template Name: Врачи
 */
get_header();
?>

<section class="section section--page-intro-mobile page-intro-mobile">
	<div class="container">
		<div class="page-intro-mobile__box">
			<h1>Наши врачи</h1>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/mokrenko_first_mobile.png" alt="Доктор Мокренко" class="page-intro-mobile__image">
		</div>
		<div class="page-intro-mobile__benefits">
			<div class="page-intro-mobile__benefit-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="Галочка" class="page-intro-mobile__benefit-icon">
				<p>Беспроцентная рассрочка 0% на 12 мес.</p>
			</div>
			<div class="page-intro-mobile__benefit-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="Галочка" class="page-intro-mobile__benefit-icon">
				<p>Высококлассные врачи с опытом более<br>10 лет</p>
			</div>
			<div class="page-intro-mobile__benefit-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="Галочка" class="page-intro-mobile__benefit-icon">
				<p>Честные цены без накруток и скрытых<br>платежей</p>
			</div>
		</div>
		<button class="btn page-intro-mobile__cta-btn">
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
			<div class="page-intro__layout">
				<div class="page-intro__content">
					<h1>Наши врачи</h1>
					<div class="page-intro__benefits">
						<div class="page-intro__benefit-item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="page-intro__benefit-icon">
							<p>Беспроцентная рассрочка 0% на 12 мес.</p>
						</div>
						<div class="page-intro__benefit-item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="page-intro__benefit-icon">
							<p>Высококлассные врачи с опытом более<br>10 лет</p>
						</div>
						<div class="page-intro__benefit-item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="page-intro__benefit-icon">
							<p>Честные цены без накруток и скрытых<br>платежей</p>
						</div>
					</div>
					<button class="btn page-intro__cta-btn">
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
			<span class="breadcrumbs__current">Врачи</span>
		</div>
	</div>
</section>

<section class="section section--doctors">
	<div class="container">
		<div class="row">
			<?php
			$doctors = get_posts([
				'post_type' => 'doctor',
				'posts_per_page' => -1,
				'post_status' => 'publish',
				'orderby' => 'menu_order',
				'order' => 'ASC'
			]);
			
			if ($doctors):
				foreach ($doctors as $doctor):
			?>
				<div class="col-sm-12 col-lg-4">
					<?php
					get_template_part('template-parts/doctor/card-slider', null, [
						'doctor_id' => $doctor->ID
					]);
					?>
				</div>
			<?php
				endforeach;
			endif;
			?>
		</div>
	</div>
</section>

<?php get_footer(); ?>

