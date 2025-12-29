<?php
get_header();
?>
<section class="section section--hero-mobile hero-mobile">
	<div class="container">
		<div class="hero-mobile__box">
			<h1>Стоматология Елены Мокренко</h1>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/mokrenko_first_mobile.png" alt="Доктор Мокренко" class="hero-mobile__image">
		</div>

		<div class="hero__rating">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/rating_main.svg" alt="Рейтинг" class="hero__rating-icon">
						<p class="hero__rating-text">Наш рейтинг на независимых порталах</p>
					</div>
		<div class="hero-mobile__features">
			<div class="hero-mobile__feature-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="Галочка" class="hero-mobile__feature-icon">
				<p>Гарантия полной безболезненности</p>
			</div>
			<div class="hero-mobile__feature-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="Галочка" class="hero-mobile__feature-icon">
				<p>Честные цены без накруток и скрытых платежей</p>
			</div>
			<div class="hero-mobile__feature-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="Галочка" class="hero-mobile__feature-icon">
				<p>Высококлассные врачи с опытом более 10 лет</p>
			</div>

		</div>
		<div class="hero__cta">
						<h3>Запишитесь на осмотр и получите</h3>
						<p>Полное обследование рта, а также полной анализ вашего организма по нашей методике</p>
					<button class="btn hero__cta-btn" data-popup="open">
							Записаться на консультацию
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка" class="hero__cta-arrow">
						</button>
					</div>
	</div>
</section>

<section class="section section--hero hero">
	<div class="container">
		<div class="hero__box bg-gradient-brand hero__box--with-doctor">
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
			<div class="hero__layout">
				<div class="hero__content">
					<h1>Стоматология Елены Мокренко</h1>
					<div class="hero__rating">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/rating_main.svg" alt="Рейтинг" class="hero__rating-icon">
						<p class="hero__rating-text">Наш рейтинг на независимых порталах</p>
					</div>
					<div class="hero__cta">
						<h3>Запишитесь на осмотр и получите</h3>
						<p>Полное обследование рта, а также полной анализ вашего организма по нашей методике</p>
					<button class="btn hero__cta-btn" data-popup="open">
							Записаться на консультацию
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка" class="hero__cta-arrow">
						</button>
					</div>
				</div>
				<div class="hero__features">
					<div class="hero__feature-item">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="hero__feature-icon">
						<p>Гарантия полной безболезненности</p>
					</div>
					<div class="hero__feature-item">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="hero__feature-icon">
						<p>Честные цены без накруток и скрытых платежей</p>
					</div>
					<div class="hero__feature-item">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="hero__feature-icon">
						<p>Высококлассные врачи с опытом более 10 лет</p>
					</div>
					<div class="hero__doctor-info">
						<h4>Главный врач:</h4>
						<p>Елена Мокренко - стоматолог-ортопед с опытом работы более 33-х лет</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>




<section class="section section--reviews reviews">
	<div class="container">
		<div class="row reviews__header">
			<div class="col-sm-8 col-lg-8">
				<h2>Наш приоритет - высокое качество услуг, счастливые и здоровые пациенты</h2>
			</div>
			<div class="col-sm-4 col-lg-4">
				<div class="reviews__stats">
					<div class="reviews__faces">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/circle_face_01.jpg" alt="Фото пациента 1" class="reviews__face">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/circle_face_06.jpg" alt="Фото пациента 2" class="reviews__face">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/circle_face_07.jpg" alt="Фото пациента 3" class="reviews__face">
					</div>
					<div class="reviews__rating">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/rating_stars.svg" alt="Рейтинг звезды" class="reviews__stars">
						<p class="reviews__rating-text">Более 20 000 улыбок подарили мы за 19 лет работы</p>
					</div>
				</div>
			</div>
	</div>
	
	<?php
	$reviews = get_posts([
		'post_type' => 'reviews',
		'posts_per_page' => 3,
		'post_status' => 'publish',
		'meta_query' => [
			[
				'key' => '_reviews_show_on_home',
				'value' => '1',
				'compare' => '='
			]
		]
	]);
	?>
	
	<div class="reviews__desktop">
		<div class="row">
			<?php
			if (empty($reviews)) {
				echo '<div class="col-sm-12 col-lg-12">';
				echo '<p>Нет отзывов для отображения. Отметьте отзывы для показа на главной в админке.</p>';
				echo '</div>';
			} else {
				foreach ($reviews as $review) {
					$fio = get_post_meta($review->ID, '_reviews_fio', true);
					$video_url = get_post_meta($review->ID, '_reviews_video_url', true);
					$thumbnail_id = get_post_thumbnail_id($review->ID);
					$thumbnail_url = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'large') : '';
					?>
					<div class="col-sm-12 col-lg-4">
						<div class="review-card" <?php if ($thumbnail_url): ?>style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');"<?php endif; ?>>
							<h3 class="review-card__name"><?php echo esc_html($fio); ?></h3>
							<?php if ($video_url): ?>
							<a href="<?php echo esc_url($video_url); ?>" class="review-card__play" data-lightbox="video">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/play.svg" alt="Play" class="review-card__play-icon">
							</a>
							<?php endif; ?>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
	
	<div class="reviews__mobile slider">
		<div class="row slider__track">
			<?php
			if (empty($reviews)) {
				echo '<div class="col-sm-12 col-lg-12">';
				echo '<p>Нет отзывов для отображения. Отметьте отзывы для показа на главной в админке.</p>';
				echo '</div>';
			} else {
				foreach ($reviews as $review) {
					$fio = get_post_meta($review->ID, '_reviews_fio', true);
					$video_url = get_post_meta($review->ID, '_reviews_video_url', true);
					$thumbnail_id = get_post_thumbnail_id($review->ID);
					$thumbnail_url = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'large') : '';
					?>
					<div class="col-sm-12 col-lg-4 slider__slide">
						<div class="review-card" <?php if ($thumbnail_url): ?>style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');"<?php endif; ?>>
							<h3 class="review-card__name"><?php echo esc_html($fio); ?></h3>
							<?php if ($video_url): ?>
							<a href="<?php echo esc_url($video_url); ?>" class="review-card__play" data-lightbox="video">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/play.svg" alt="Play" class="review-card__play-icon">
							</a>
							<?php endif; ?>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>
		<button class="slider__prev" aria-label="Предыдущий отзыв">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</button>
		<button class="slider__next" aria-label="Следующий отзыв">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</button>
	</div>
	</div>
</section>

<section class="section section--chief-doctor chief-doctor">
	<div class="container">
		<div class="row chief-doctor__header">
			<div class="col-sm-12 col-lg-12">
				<h2 class="chief-doctor__title">Клиника основана стоматологом-ортопедом <br><span class="chief-doctor__name">Еленой Мокренко</span></h2>
			</div>
		</div>
		
		<div class="row chief-doctor__content">
			<div class="col-sm-12 col-lg-6">
				<div class="row">
					<div class="col-sm-12 col-lg-12">
						<div class="chief-doctor__block-210">
							<p class="chief-doctor__description">Владеет в совершенстве современными методами профилактики, диагностики и лечения в области ортопедии. Обучает выпускников медицинских университетов.</p>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-12 col-lg-6">
						<div class="chief-doctor__block-209-1">
							<div class="achievement-item">
								<div class="achievement-icon">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="achievement-icon__img">
								</div>
								<p>Эксперт в корректировке формы, цвета и украшении зубов</p>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6">
						<div class="chief-doctor__block-209-2">
							<div class="achievement-item">
								<div class="achievement-icon">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="achievement-icon__img">
								</div>
								<p>Сертифицированный специалист по установке люминиров с 12-летним опытом</p>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-12 col-lg-6">
						<div class="chief-doctor__block-209-3">
							<div class="achievement-item">
								<div class="achievement-icon">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="achievement-icon__img">
								</div>
								<p>Участник Стоматологической Ассоциации России</p>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6">
						<div class="chief-doctor__block-209-4">
							<div class="achievement-item">
								<div class="achievement-icon">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="achievement-icon__img">
								</div>
								<p>Участник American Dental Academy: повышение квалификации и обмен опытом с лучшими американскими и европейскими стоматологами</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-6">
				<div class="chief-doctor__photo">
					<div class="chief-doctor__icon">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/mokrenko_icon_01.svg" alt="Иконка Мокренко" class="chief-doctor__icon-img">
					</div>
					<div class="chief-doctor__experience">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/33_index.svg" alt="33 года опыта" class="chief-doctor__experience-icon">
						<p class="chief-doctor__experience-text">Стоматолог-ортопед высшей категории с опытом более 33 лет</p>
					</div>
					

				</div>
			</div>
		</div>
	</div>
</section>

<section class="section section--services services">
	<div class="container">
		<div class="row services__grid">
			<div class="col-sm-12 col-lg-4">
				<div class="service-card service-card--header">
					<h2>Лечим зубы и дарим <span class="services__highlight">самые красивые улыбки</span> в Москве</h2>
					<p>Честные и доступные цены без экономии на качестве</p>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="service-card service-card--gradient">
					<h3>Восстановить зуб</h3>
					<div class="service-links">
						<a href="#" class="service-link">Коронка на зуб</a>
						<a href="#" class="service-link">Импланты зубов</a>
						<a href="#" class="service-link">Протезирование зубов</a>
						<a href="#" class="service-link">Реставрация зубов</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="service-card service-card--light-green">
					<h3>Вылечить зубы</h3>
					<div class="service-links">
						<a href="#" class="service-link">Лечение зубов</a>
						<a href="#" class="service-link">Удаление зубов</a>
						<a href="#" class="service-link">Лечение десен</a>
						<a href="#" class="service-link">Чистка зубов</a>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row services__header">
			<div class="col-sm-12 col-lg-4">
				<div class="service-card service-card--gradient">
					<h3>Вставить все зубы</h3>
					<div class="service-links">
						<a href="#" class="service-link">Все зубы за 1 день All-on-4</a>
						<a href="#" class="service-link">Имплантация All-on-6</a>
						<a href="#" class="service-link">Несъёмные протезы</a>
						<a href="#" class="service-link">Съёмные протезы</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-8">
				<div class="service-card service-card--light-green service-card--bg">
					<h3>Красивая улыбка</h3>
					<div class="service-links">
						<a href="#" class="service-link">Виниры на зубы</a>
						<a href="#" class="service-link">Брекеты</a>
						<a href="#" class="service-link">Отбеливание зубов</a>
						<a href="#" class="service-link">Чистка Air Flow</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section section--doctors doctors">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-8">
				<h2>Врачи <span class="doctors__highlight">международного уровня</span>, которым можно доверять</h2>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="doctors__stats">
					<div class="doctors__faces">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/doc_face_01.jpg" alt="Фото врача 1" class="doctors__face">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/doc_face_02.jpg" alt="Фото врача 2" class="doctors__face">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/doc_face_03.jpg" alt="Фото врача 3" class="doctors__face">
					</div>
					<p class="doctors__stats-text">Ведущие специалисты с опытом работы от 10 лет!</p>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="slider slider--two">
					<div class="slider__container">
						<div class="slider__track">
							<?php
							$doctors = get_posts([
								'post_type' => 'doctor',
								'posts_per_page' => -1,
								'post_status' => 'publish',
								'meta_query' => [
									[
										'key' => 'doctor_show_on_home',
										'value' => '1',
										'compare' => '='
									]
								]
							]);
							
							if (empty($doctors)) {
								echo '<div class="col-sm-12 col-lg-4 slider__slide slider__slide--active">';
								echo '<p>Нет врачей для отображения. Отметьте врачей для показа на главной в админке.</p>';
								echo '</div>';
							} else {
								foreach ($doctors as $index => $doctor) {
									echo '<div class="col-sm-12 col-lg-4 slider__slide' . ($index === 0 ? ' slider__slide--active' : '') . '">';
									get_template_part('template-parts/doctor/card-slider', null, ['doctor_id' => $doctor->ID]);
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

<section class="section section--benefits benefits">
	<div class="container">
		<div class="row benefits__row-201">
			<div class="col-sm-12 col-lg-8">
				<div class="benefits__main">
					<div class="row">
						<div class="col-sm-12 col-lg-12">
							<div class="benefits__header">
								<h2>Выбор клиники - <br><span class="benefits__highlight">ключевой этап</span> в лечении зубов</h2>
								<p class="benefits__subtitle">Наша цель — укрепить здоровье ваших зубов</p>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top:16px">
						<div class="col-sm-12 col-lg-6">
							<div class="benefits__feature benefits__feature--gradient">
								<div class="benefits__feature-icon">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/plus_icon_01.svg" alt="Иконка плюс" class="benefits__icon">
								</div>
								<h3>Честные цены без накруток и скрытых платежей</h3>
								<p>Цены на сайте соответствуют ценам в клинике. Не навязываем лишних услуг и не вносим скрытые платежи в договор. У нас честный подход.</p>
							</div>
						</div>
						<div class="col-sm-12 col-lg-6">
							<div class="benefits__feature benefits__feature--light-green">
								<div class="benefits__feature-icon">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/plus_icon_02.svg" alt="Иконка лечения" class="benefits__icon">
								</div>
								<h3>Качественное лечение с гарантией по договору</h3>
								<p>Делаем только качественно и на века. Если по нашей вине у вас выпала пломба, коронка или имплант - мы исправим все абсолютно бесплатно в тот же день.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="benefits__card benefits__card--gradient">
					<div class="benefits__card-content">
						<div class="benefits__card-icon benefits__card-icon--lab">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/plus_icon_bg.jpg" alt="Фон иконки" class="benefits__icon-bg">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/plus_icon_03.svg" alt="Иконка лаборатории" class="benefits__icon-main">
						</div>
						<div class="benefits__card-bottom">
							<h3>Собственная лаборатория и оборудование</h3>
							<div class="benefits__feature-item">
								<h4>Компьютерная томограмма:</h4>
								<p>Мы делаем все снимки в день обращения прямо в нашей клинике</p>
							</div>
							<div class="benefits__feature-item">
								<h4>Аппарат Cerec:</h4>
								<p>Изготавливаем коронки при вас в клинике за 45 минут</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		
		<div class="row benefits__row-205">
			<div class="col-sm-12 col-lg-4">
				<div class="benefits__card benefits__card--light-green">
					<div class="benefits__card-content">
						<div class="benefits__card-icon">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/plus_icon_04.svg" alt="Иконка без боли" class="benefits__icon">
						</div>
						<h3>Лечение без боли</h3>
						<p>Вы ничего не почувствуете. Швейцарские медикаменты и 30-летний опыт главного врача позволяют гарантировать полное отсутствие боли</p>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="benefits__card benefits__card--image">
					<div class="benefits__card-content">
						<div class="benefits__card-image">
							
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="benefits__card benefits__card--light-green">
					<div class="benefits__card-content">
						<div class="benefits__card-icon">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/plus_icon_05.svg" alt="Иконка рассрочки" class="benefits__icon">
						</div>
						<h3>Рассрочка платежа</h3>
						<p>Беспроцентная рассрочка на 6-12 месяцев</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section section--doctors-works doctors-works">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="doctors-works__header">
					<h2>Доверяйте своё здоровье врачам <span class="doctors-works__highlight">с подтвержденным опытом</span></h2>
					<p>А не низким «завлекающим» ценам и красивым словам</p>
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
								'posts_per_page' => 5,
								'post_status' => 'publish',
								'meta_query' => [
									[
										'key' => 'case_show_on_home',
										'value' => '1',
										'compare' => '='
									]
								]
							]);
							
							if (empty($cases)) {
								echo '<div class="slider__slide slider__slide--active">';
								echo '<p>Нет кейсов для отображения. Отметьте кейсы для показа на главной в админке.</p>';
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

<?php get_template_part('template-parts/section/social-proof'); ?>

<?php get_template_part('template-parts/section/awards'); ?>

<?php get_template_part('template-parts/section/consult'); ?>

<?php get_template_part('template-parts/section/location'); ?>

<?php get_template_part('template-parts/section/gallery'); ?>

<?php get_template_part('template-parts/section/contacts'); ?>

<?php get_footer(); ?>
