<?php
/**
 * Template Name: Врачи
 */
get_header();
?>

<section class="section section--page-intro-mobile page-intro-mobile">
	<div class="container">
		<div class="page-intro-mobile__box">
			<h1>Сильная команда с опытом, результатами и именем</h1>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/mokrenko_first_mobile.png" alt="Доктор Мокренко" class="page-intro-mobile__image">
		</div>
		<div class="page-intro-mobile__benefits">
			<div class="page-intro-mobile__benefit-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="Галочка" class="page-intro-mobile__benefit-icon">
				<p>Главврач клиники — сертифицированный врач из ТОП-3 по эстетике и восстановлению зубов</p>
			</div>
			<div class="page-intro-mobile__benefit-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="Галочка" class="page-intro-mobile__benefit-icon">
				<p>Только ведущие врачи с опытом более 10 лет</p>
			</div>
			<div class="page-intro-mobile__benefit-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="Галочка" class="page-intro-mobile__benefit-icon">
				<p>В составе врачей профессора медицинских наук</p>
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
					<h1>Сильная команда с опытом, результатами и именем</h1>
					<div class="page-intro__benefits">
						<div class="page-intro__benefit-item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="page-intro__benefit-icon">
							<p>Главврач клиники — сертифицированный врач из ТОП-3 по эстетике и восстановлению зубов</p>
						</div>
						<div class="page-intro__benefit-item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="page-intro__benefit-icon">
							<p>Только ведущие врачи с опытом более 10 лет</p>
						</div>
						<div class="page-intro__benefit-item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="page-intro__benefit-icon">
							<p>В составе врачей профессора медицинских наук</p>
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

<section class="section section--consult consult">
	<div class="container">
        <div class="consult__box bg-gradient-brand consult__box--with-doctor">
            <img class="consult__bg" src="<?php echo esc_url( wp_get_upload_dir()['baseurl'] . '/2025/10/gurdzan.png' ); ?>" alt="Врач" loading="lazy">
			<div class="consult__layout">
				<div class="consult__row consult__row--title">
					<h2 class="consult__title">Запишитесь на <span class="text-contrast">бесплатный осмотр</span> <br>к нашим врачам</h2>
					
				</div>
				<div class="consult__row consult__row--cards">
					<div class="consult__card consult__card--left">
						<h3 class="consult__card-title">Что будет на осмотре?</h3>
						<ul class="consult__list">
							<li class="consult__item">
								<span class="consult__item-icon">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка">
								</span>
								<span class="consult__item-text">Цифровой 3D слепок вашей челюсти и улыбки</span>
							</li>
							<li class="consult__item">
								<span class="consult__item-icon">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка">
								</span>
								<span class="consult__item-text">Полное обследование и диагностика полости рта</span>
							</li>
							<li class="consult__item">
								<span class="consult__item-icon">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка">
								</span>
								<span class="consult__item-text">Составление детального плана лечения в 3‑х вариантах со стоимостью и сроками каждого этапа работ.</span>
							</li>
						</ul>
					</div>
					<div class="consult__card consult__card--right">
						
						<h3 class="consult__card-title">Квалифицированная консультация по оздоровлению полости рта:</h3>
						<ul class="consult__bullets">
							<li>Обследование зубов на наличие кариеса</li>
							<li>Обследование дёсен на наличие воспаления</li>
							<li>Специальное обследование на наличие запаха изо рта и установление его причин.</li>
						</ul>
					</div>
				</div>
				<div class="consult__row consult__row--cta">
					<button class="btn consult__cta-btn" data-popup="open">
						Записаться на консультацию
						<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка" class="consult__cta-arrow">
					</button>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>

