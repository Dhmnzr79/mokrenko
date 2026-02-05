<?php
/**
 * Template Name: Цены
 */
get_header();
?>

<section class="section section--page-intro-mobile page-intro-mobile">
	<div class="container">
		<div class="page-intro-mobile__box">
			<p class="page-intro-mobile__title">Доступная стоматология с экспертным подходом</p>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/mokrenko_first_mobile.png" alt="Доктор Мокренко" class="page-intro-mobile__image">
		</div>
		<div class="page-intro-mobile__benefits">
			<div class="page-intro-mobile__benefit-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="" class="page-intro-mobile__benefit-icon">
				<p>Беспроцентная рассрочка 0% на 12 мес.</p>
			</div>
			<div class="page-intro-mobile__benefit-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="" class="page-intro-mobile__benefit-icon">
				<p>Высококлассные врачи с опытом более<br>10 лет</p>
			</div>
			<div class="page-intro-mobile__benefit-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="" class="page-intro-mobile__benefit-icon">
				<p>Честные цены без накруток и скрытых<br>платежей</p>
			</div>
		</div>
		<button class="btn page-intro-mobile__cta-btn" data-popup="open">
			Записаться на консультацию
			<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="">
		</button>
	</div>
</section>

<section class="section section--page-intro page-intro">
	<div class="container">
		<div class="page-intro__box bg-gradient-brand">
			<?php get_template_part('template-parts/hero/menu'); ?>
			<div class="page-intro__layout">
				<div class="page-intro__content">
					<h1>Доступная стоматология с экспертным подходом</h1>
					<div class="page-intro__benefits">
						<div class="page-intro__benefit-item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="" class="page-intro__benefit-icon">
							<p>Беспроцентная рассрочка 0% на 12 мес.</p>
						</div>
						<div class="page-intro__benefit-item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="" class="page-intro__benefit-icon">
							<p>Высококлассные врачи с опытом более<br>10 лет</p>
						</div>
						<div class="page-intro__benefit-item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="" class="page-intro__benefit-icon">
							<p>Честные цены без накруток и скрытых<br>платежей</p>
						</div>
					</div>
					<button class="btn page-intro__cta-btn" data-popup="open">
						Записаться на консультацию
						<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="">
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
			<span class="breadcrumbs__current">Цены</span>
		</div>
	</div>
</section>

<section class="section section--prices prices">
	<div class="container">
		<?php echo do_shortcode('[clinic_prices]'); ?>
	</div>
</section>

<!-- Contacts Section -->
<section class="section section--contacts contacts">
	<div class="container">
		<div class="contacts__box">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/mokrenko_first.png" alt="Главный врач клиники - Елена Мокренко" class="contacts__bg">
			<div class="row">
				<div class="col-sm-12 col-lg-6">
					<!-- Пустая колонка для фото -->
				</div>
				<div class="col-sm-12 col-lg-6">
					<div class="contacts__content-block">
						<h2>Контакты</h2>
						<ul class="contacts__list">
							<li data-emoji="📍">г. Москва, ул. Проспект Мира 75, стр. 1 (м.Рижская)</li>
							<li data-emoji="📞"><a href="tel:+74950035476">+7 (495) 003-54-76</a></li>
							<li data-emoji="✉️">mokrenko-msk@yandex.ru</li>
							<li data-emoji="🕒">Пн-Пт: 9:00 - 21:00<br>Сб-Вс: 10:00 - 18:00</li>
						</ul>
						<div class="contacts__question">
							<h3>Остались вопросы?</h3>
							<p>Задайте свой вопрос, и мы бесплатно проконсультируем Вас в течении 5 минут</p>
						</div>
						<button class="btn contacts__cta-btn">
							Записаться на приём
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="" class="contacts__cta-arrow">
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>

