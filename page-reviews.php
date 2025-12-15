<?php
/**
 * Template Name: Отзывы
 */
get_header();
?>
<section class="section section--hero-mobile hero-mobile">
	<div class="container">
		<div class="hero-mobile__box">
			<h1>Отзывы наших пациентов</h1>
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
						<button class="btn hero__cta-btn">
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
					<h1>Отзывы наших пациентов</h1>
					<div class="hero__rating">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/rating_main.svg" alt="Рейтинг" class="hero__rating-icon">
						<p class="hero__rating-text">Наш рейтинг на независимых порталах</p>
					</div>
					<div class="hero__cta">
						<h3>Запишитесь на осмотр и получите</h3>
						<p>Полное обследование рта, а также полной анализ вашего организма по нашей методике</p>
						<button class="btn hero__cta-btn">
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

<section class="section section--breadcrumbs">
	<div class="container">
		<div class="breadcrumbs">
			<a href="/" class="breadcrumbs__link">Главная</a>
			<span class="breadcrumbs__separator">→</span>
			<span class="breadcrumbs__current">Отзывы</span>
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
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'orderby' => 'date',
		'order' => 'DESC'
	]);
	?>
	
	<div class="reviews__desktop">
		<div class="row">
			<?php
			if (empty($reviews)) {
				echo '<div class="col-sm-12 col-lg-12">';
				echo '<p>Нет отзывов для отображения.</p>';
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
				echo '<p>Нет отзывов для отображения.</p>';
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

<section class="section section--social-proof social-proof">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="social-proof__header visually-hidden">Отзывы из внешних источников</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12 col-lg-6">
				<div class="social-proof__intro">
					<h2>Более <span class="text-accent">25 000</span> улыбок мы подарили нашим клиентам за <span class="text-contrast">20 лет работы</span></h2>
					<div class="reviews__stats">
					<div class="reviews__faces">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/circle_face_01.jpg" alt="Фото пациента 1" class="reviews__face">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/circle_face_06.jpg" alt="Фото пациента 2" class="reviews__face">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/circle_face_07.jpg" alt="Фото пациента 3" class="reviews__face">
					</div>
					<div class="reviews__rating">
						<p class="reviews__rating-text">96% процентов пациентов приходят по рекомендации от своих друзей и близких.</p>
					</div>
				</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-6">
				<div class="slider slider--social">
					<div class="slider__container">
						<div class="slider__track">
							<div class="slider__slide slider__slide--active">
								<article class="proof-card">
									<header class="proof-card__header">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/circle_face_02.jpg" alt="Аватар" class="proof-card__avatar">
										<div class="proof-card__meta">
											<h3 class="proof-card__name">Татьяна Палий</h3>
											<p class="proof-card__level">Знаток города 10 уровня</p>
										</div>
									</header>
									<div class="proof-card__rating">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/rating_stars.svg" alt="Оценка 5 из 5" class="proof-card__stars">
										<span class="proof-card__date">12 марта</span>
									</div>
									<p class="proof-card__text">Хочу выразить огромную благодарность хирургу стоматологу Богдану Владимировичу за профессионализм и доброжелательное отношение. Внимательное отношение к своим пациентам.</p>
								</article>
							</div>
							<div class="slider__slide">
								<article class="proof-card">
									<header class="proof-card__header">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/circle_face_03.jpg" alt="Аватар" class="proof-card__avatar">
										<div class="proof-card__meta">
											<h3 class="proof-card__name">Мария Петрова</h3>
											<p class="proof-card__level">Знаток города 10 уровня</p>
										</div>
									</header>
									<div class="proof-card__rating">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/rating_stars.svg" alt="Оценка 5 из 5" class="proof-card__stars">
										<span class="proof-card__date">12 марта</span>
									</div>
									<p class="proof-card__text">Выражаю благодарность врачу Богдану Владимировичу за профессионализм и внимательное отношение. Рекомендую клинику.</p>
								</article>
							</div>
							<div class="slider__slide">
								<article class="proof-card">
									<header class="proof-card__header">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/circle_face_02.jpg" alt="Аватар" class="proof-card__avatar">
										<div class="proof-card__meta">
											<h3 class="proof-card__name">Иван Палий</h3>
											<p class="proof-card__level">Знаток города 10 уровня</p>
										</div>
									</header>
									<div class="proof-card__rating">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/rating_stars.svg" alt="Оценка 5 из 5" class="proof-card__stars">
										<span class="proof-card__date">12 марта</span>
									</div>
									<p class="proof-card__text">Хочу выразить огромную благодарность хирургу стоматологу Богдану Владимировичу за профессионализм и доброжелательное отношение. Внимательное отношение к своим пациентам.</p>
								</article>
							</div>
							<div class="slider__slide">
								<article class="proof-card">
									<header class="proof-card__header">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/circle_face_03.jpg" alt="Аватар" class="proof-card__avatar">
										<div class="proof-card__meta">
											<h3 class="proof-card__name">Петр Сидоров</h3>
											<p class="proof-card__level">Знаток города 10 уровня</p>
										</div>
									</header>
									<div class="proof-card__rating">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/rating_stars.svg" alt="Оценка 5 из 5" class="proof-card__stars">
										<span class="proof-card__date">12 марта</span>
									</div>
									<p class="proof-card__text">Выражаю благодарность врачу Богдану Владимировичу за профессионализм и внимательное отношение. Рекомендую клинику.</p>
								</article>
							</div>
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
						<div class="consult__badge">А также:</div>
						<h3 class="consult__card-title">Квалифицированная консультация по оздоровлению полости рта:</h3>
						<ul class="consult__bullets">
							<li>Обследование зубов на наличие кариеса</li>
							<li>Обследование дёсен на наличие воспаления</li>
							<li>Специальное обследование на наличие запаха изо рта и установление его причин.</li>
						</ul>
					</div>
				</div>
				<div class="consult__row consult__row--cta">
					<button class="btn consult__cta-btn">
						Записаться на консультацию
						<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка" class="consult__cta-arrow">
					</button>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section section--location location">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-6">
				<div class="location__content">
					<div class="location__header">
						<h2>Никаких сложностей с приёмом, записью, парковкой и оплатой</h2>
						<div class="row">
							<div class="col-sm-12 col-lg-6">
								<div class="location__feature">
									<div class="location__feature-icon">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/contact_icon_1.svg" alt="Иконка парковки">
									</div>
									<h3>Собственная бесплатная парковка</h3>
									<p>Специально для наших пациентов у нас есть собственная бесплатная парковка</p>
								</div>
							</div>
							<div class="col-sm-12 col-lg-6">
								<div class="location__feature">
									<div class="location__feature-icon">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/contact_icon_2.svg" alt="Иконка метро рядом">
									</div>
									<h3>Находимся в 5 минутах от метро</h3>
									<p>В центре, на проспекте Мира. Между станциями метро «Рижская» и «Проспект Мира»</p>
								</div>
							</div>
						</div>
					</div>
					<div class="location__cta">
						<button class="btn location__call-btn">
							Заказать звонок
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка" class="location__call-arrow">
						</button>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-6">
				<div class="location__map" role="region" aria-label="Карта проезда">
					<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A323a54469180fade51313f036c1802f512630e5b6ff890ed079c3eccf0923412&amp;width=100%25&amp;height=600&amp;lang=ru_RU&amp;scroll=true"></script>
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

<?php get_footer(); ?>

