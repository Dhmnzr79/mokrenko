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
		<button class="btn page-intro-mobile__cta-btn" data-popup="open">
			Записаться на консультацию
			<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка">
		</button>
	</div>
</section>

<section class="section section--page-intro page-intro">
	<div class="container">
		<div class="page-intro__box bg-gradient-brand">
			<?php get_template_part('template-parts/hero/menu'); ?>
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

<?php get_template_part('template-parts/section/consult'); ?>

<?php get_footer(); ?>

