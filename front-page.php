<?php
get_header();
?>
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
					<a href="#" class="hero__menu-link">О клинике</a>
					<a href="#" class="hero__menu-link">Портфолио</a>
					<a href="#" class="hero__menu-link">Врачи</a>
					<a href="#" class="hero__menu-link">Прайс</a>
					<a href="#" class="hero__menu-link">Акции</a>
					<a href="#" class="hero__menu-link">Блог</a>
					<a href="#" class="hero__menu-link">Отзывы</a>
					<a href="#" class="hero__menu-link">Контакты</a>
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
							<button class="hero__cta-btn">
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
		
		<div class="row">
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
				<div class="slider">
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
								echo '<div class="slider__slide slider__slide--active">';
								echo '<p>Нет врачей для отображения. Отметьте врачей для показа на главной в админке.</p>';
								echo '</div>';
							} else {
								$chunks = array_chunk($doctors, 3);
								foreach ($chunks as $index => $chunk) {
									echo '<div class="slider__slide' . ($index === 0 ? ' slider__slide--active' : '') . '">';
									echo '<div class="row">';
									foreach ($chunk as $doctor) {
										echo '<div class="col-sm-12 col-lg-4">';
										get_template_part('template-parts/doctor/card-slider', null, ['doctor_id' => $doctor->ID]);
										echo '</div>';
									}
									echo '</div>';
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

<section class="section section--awards awards">
	<div class="container">
		<div class="row awards__grid">
			<div class="col-sm-6 col-lg-3">
				<div class="award-card award-card--header">
					<h2>Наши <span class="award-card__highlight">награды</span></h2>
					<p>Нажмите на иконку, чтобы перейти на портал и прочитать все отзывы</p>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="award-card award-card--ratings">
					<div class="award-card__rating-item">
						<div class="award-card__logo">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/уandex_logo.svg" alt="Яндекс">
						</div>
						<div class="award-card__rating">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/like.svg" alt="Like" class="award-card__rating-icon">
							<span>Рейтинг 4,7 из 5</span>
						</div>
					</div>
					<div class="award-card__rating-item">
						<div class="award-card__logo">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/google_logo.svg" alt="Google">
						</div>
						<div class="award-card__rating">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/like.svg" alt="Like" class="award-card__rating-icon">
							<span>Рейтинг 4,8 из 5</span>
						</div>
					</div>
					<div class="award-card__rating-item">
						<div class="award-card__logo">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/zoon_logo.svg" alt="Zoon">
						</div>
						<div class="award-card__rating">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/like.svg" alt="Like" class="award-card__rating-icon">
							<span>Рейтинг 4,9 из 5</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="award-card">
					<div class="award-card__content">
						<div class="award-card__icon">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/ya_logo.svg" alt="Яндекс">
						</div>
						
						<p>Выбор пользователей Яндекса</p>
					</div>
					<div class="award-card__link">
						<a href="#" class="award-card__link-item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/link_arrow_1.svg" alt="Ссылка">
						</a>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="award-card">
					<div class="award-card__content">
						<div class="award-card__icon">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/30_index.svg" alt="30 Index">
						</div>
					
						<p>Входим в Топ-30 частных стоматологии Москвы на ноябрь 2022</p>
					</div>
					<div class="award-card__link">
						<a href="#" class="award-card__link-item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/link_arrow_2.svg" alt="Ссылка">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section section--gallery gallery">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<h2>Мы всегда <span class="text-accent">рады вас видеть</span></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="gallery__grid">
					<?php 
					$gallery_order = [1, 2, 3, 5, 4, 6, 7, 8, 9, 10, 11, 12];
					foreach($gallery_order as $i): 
					?>
					<a href="<?php echo get_template_directory_uri(); ?>/assets/images/gallery/gallery<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>.jpg" class="gallery__item" data-lightbox="gallery">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/gallery/gallery<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>.jpg" alt="Галерея <?php echo $i; ?>" class="gallery__image">
					</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section section--contacts contacts">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-6">
				<div class="row">
					<div class="col-sm-12 col-lg-12">
						<h2>Никаких сложностей с приёмом, записью, парковкой и оплатой</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-lg-6">
						<div class="contacts__feature">
							<div class="contacts__feature-icon">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/contact_icon_1.svg" alt="Иконка парковки">
							</div>
							<h3>Собственная бесплатная парковка</h3>
							<p>Специально для наших пациентов у нас есть собственная бесплатная парковка</p>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6">
						<div class="contacts__feature">
							<div class="contacts__feature-icon">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/contact_icon_2.svg" alt="Иконка метро рядом">
							</div>
							<h3>Находимся в 5 минутах от метро</h3>
							<p>В центре, на проспекте Мира. Между станциями метро «Рижская» и «Проспект Мира»</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-lg-12">
						<button class="contacts__call-btn">
							Заказать звонок
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка" class="contacts__call-arrow">
						</button>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-6">
				<div class="contacts__map" role="region" aria-label="Карта проезда">
					<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A323a54469180fade51313f036c1802f512630e5b6ff890ed079c3eccf0923412&amp;width=100%25&amp;height=600&amp;lang=ru_RU&amp;scroll=true"></script>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
