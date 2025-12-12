<?php
get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); 
	$doctor_id = get_the_ID();
	$experience = get_post_meta($doctor_id, 'doctor_experience_years', true);
	$excerpt = get_the_excerpt();
	$photo = get_the_post_thumbnail_url($doctor_id, 'large');
	
	$photo_2 = get_post_meta($doctor_id, 'doctor_photo_2', true);
	$video_url = get_post_meta($doctor_id, 'doctor_video_url', true);
	$fact_1 = get_post_meta($doctor_id, 'doctor_fact_1', true);
	$fact_2 = get_post_meta($doctor_id, 'doctor_fact_2', true);
	$fact_3 = get_post_meta($doctor_id, 'doctor_fact_3', true);
	$education = get_post_meta($doctor_id, 'doctor_education', true);
	$qualification = get_post_meta($doctor_id, 'doctor_qualification', true);
	$certs_json = get_post_meta($doctor_id, 'doctor_certs_json', true);
	$content = get_the_content();
	
	$certs = [];
	if ($certs_json) {
		$certs_ids = json_decode($certs_json, true);
		if (is_array($certs_ids)) {
			foreach ($certs_ids as $cert_id) {
				$certs[] = wp_get_attachment_url($cert_id);
			}
		}
	}
?>

<section class="section section--doctor-hero doctor-hero">
	<div class="container">
		<div class="doctor-hero__box bg-gradient-brand">
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
			<div class="doctor-hero__layout">
				<div class="doctor-hero__content">
					<h1><?php the_title(); ?></h1>
					<?php if ($excerpt): ?>
						<div class="doctor-hero__preview">
							<p><?php echo esc_html($excerpt); ?></p>
						</div>
					<?php endif; ?>
					<?php if ($experience): ?>
						<div class="doctor-hero__experience">
							<p>Опыт: <?php echo esc_html($experience); ?> лет</p>
						</div>
					<?php endif; ?>
					<button class="btn doctor-hero__btn" data-popup="open">
						Записаться к врачу
						<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка">
					</button>
				</div>
				<?php if ($photo): ?>
					<div class="doctor-hero__photo">
						<img src="<?php echo esc_url($photo); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="doctor-hero__img">
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<section class="section section--breadcrumbs">
	<div class="container">
		<div class="breadcrumbs">
			<a href="/" class="breadcrumbs__link">Главная</a>
			<span class="breadcrumbs__separator">→</span>
			<a href="<?php echo esc_url(get_page_url_by_template('page-doctors.php')); ?>" class="breadcrumbs__link">Врачи</a>
			<span class="breadcrumbs__separator">→</span>
			<span class="breadcrumbs__current"><?php the_title(); ?></span>
		</div>
	</div>
</section>

<section class="section section--doctor-info doctor-info">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-6">
				<div class="doctor-info__photo-wrapper">
					<?php if ($photo_2): ?>
						<div class="doctor-info__photo-container">
							<?php echo wp_get_attachment_image($photo_2, 'large', false, ['class' => 'doctor-info__photo']); ?>
							<?php if ($video_url): ?>
								<a href="<?php echo esc_url($video_url); ?>" class="doctor-info__video-btn" data-lightbox="video">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/play.svg" alt="Смотреть видео" class="doctor-info__video-icon">
									<span class="doctor-info__video-text">Смотреть видео</span>
								</a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			
			<div class="col-sm-12 col-lg-6">
				<?php if ($fact_1 || $fact_2 || $fact_3): ?>
					<div class="doctor-info__facts">
						<?php if ($fact_1): ?>
							<div class="doctor-info__fact"><?php echo esc_html($fact_1); ?></div>
						<?php endif; ?>
						<?php if ($fact_2): ?>
							<div class="doctor-info__fact"><?php echo esc_html($fact_2); ?></div>
						<?php endif; ?>
						<?php if ($fact_3): ?>
							<div class="doctor-info__fact"><?php echo esc_html($fact_3); ?></div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				
				<?php if ($content): ?>
					<div class="doctor-info__content">
						<h2 class="doctor-info__title">Подробная информация</h2>
						<div class="doctor-info__text">
							<?php echo wpautop(wp_kses_post($content)); ?>
						</div>
					</div>
				<?php endif; ?>
				
				<?php if ($education): ?>
					<div class="doctor-info__education">
						<h2 class="doctor-info__title">Образование</h2>
						<div class="doctor-info__text doctor-info__text--education">
							<?php 
							$education_lines = explode("\n", $education);
							foreach ($education_lines as $line) {
								$line = trim($line);
								if (!empty($line)) {
									echo '<div class="doctor-info__education-line">' . wp_kses_post($line) . '</div>';
								}
							}
							?>
						</div>
					</div>
				<?php endif; ?>
				
				<?php if ($qualification): ?>
					<div class="doctor-info__education">
						<h2 class="doctor-info__title">Повышение квалификации</h2>
						<div class="doctor-info__text doctor-info__text--education">
							<?php 
							$qualification_lines = explode("\n", $qualification);
							foreach ($qualification_lines as $line) {
								$line = trim($line);
								if (!empty($line)) {
									echo '<div class="doctor-info__education-line">' . wp_kses_post($line) . '</div>';
								}
							}
							?>
						</div>
					</div>
				<?php endif; ?>
				
				<?php if (!empty($certs)): ?>
					<div class="doctor-info__certs">
						<h2 class="doctor-info__title">Сертификаты</h2>
						<div class="slider doctor-info__certs-slider">
							<div class="slider__container">
								<div class="slider__track">
									<?php foreach ($certs as $index => $cert_url): ?>
										<div class="slider__slide<?php echo $index === 0 ? ' slider__slide--active' : ''; ?>">
											<a href="<?php echo esc_url($cert_url); ?>" class="doctor-info__cert-link" data-lightbox="doctor-certs">
												<img src="<?php echo esc_url($cert_url); ?>" alt="Сертификат" class="doctor-info__cert-img">
											</a>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
							<div class="slider__nav">
								<button class="slider__prev" type="button">←</button>
								<button class="slider__next" type="button">→</button>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<section class="section section--doctors-works doctors-works">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="doctors-works__header">
					<h2>Работы врача</h2>
					<p>Реальные результаты лечения наших пациентов</p>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="slider">
					<div class="slider__container">
						<div class="slider__track">
							<?php
							$cases = get_posts([
								'post_type' => 'case',
								'posts_per_page' => -1,
								'post_status' => 'publish',
								'meta_query' => [
									[
										'key' => 'case_doctor_id',
										'value' => $doctor_id,
										'compare' => '='
									]
								]
							]);
							
							if (empty($cases)) {
								echo '<div class="slider__slide slider__slide--active">';
								echo '<p>У данного врача пока нет опубликованных кейсов.</p>';
								echo '</div>';
							} else {
								foreach ($cases as $index => $case) {
									echo '<div class="slider__slide' . ($index === 0 ? ' slider__slide--active' : '') . '">';
									get_template_part('template-parts/case/showcase', null, ['case_id' => $case->ID]);
									echo '</div>';
								}
							}
							?>
						</div>
					</div>
					<div class="slider__nav">
						<button class="slider__prev" type="button">←</button>
						<button class="slider__next" type="button">→</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>

