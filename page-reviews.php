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
					<h1>Отзывы наших пациентов</h1>
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

<?php get_template_part('template-parts/section/social-proof'); ?>

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
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/review-avatar-01.jpg" alt="Аватар" class="proof-card__avatar">
										<div class="proof-card__meta">
											<h3 class="proof-card__name">Елена К.</h3>
											<p class="proof-card__level">Знаток города 8 уровня</p>
										</div>
									</header>
									<div class="proof-card__rating">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/rating_stars.svg" alt="Оценка 5 из 5" class="proof-card__stars">
										<span class="proof-card__date">15 марта</span>
									</div>
									<p class="proof-card__text">Прекрасное отношение к пациентам, врачи-профи, уже несколько лет только сюда, ставила пломбы, импланты - все в прекрасном состоянии, идеальные зубки:) Дети очень любят своего доктора - Надежду Семеновну Дугинец, дочь даже спрашивает - когда уже зубы пойдем лечить, так ей врач нравится. Успехов клинике и благодарность всем специалистам!</p>
								</article>
							</div>
							<div class="slider__slide">
								<article class="proof-card">
									<header class="proof-card__header">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/review-avatar-02.jpg" alt="Аватар" class="proof-card__avatar">
										<div class="proof-card__meta">
											<h3 class="proof-card__name">Василий К.</h3>
											<p class="proof-card__level">Знаток города 9 уровня</p>
										</div>
									</header>
									<div class="proof-card__rating">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/rating_stars.svg" alt="Оценка 5 из 5" class="proof-card__stars">
										<span class="proof-card__date">22 февраля</span>
									</div>
									<p class="proof-card__text">Хочу выразить благодарность клинике и в частности хирургу Аросяну Андранику Владимировичу за отличную работу. Ставил импланты — все прошло спокойно и безболезненно. От первой консультации до установки прошло меньше недели, всё организовано очень чётко. Отдельное спасибо менеджеру Элеоноре за внимательное отношение и помощь.</p>
								</article>
							</div>
							<div class="slider__slide">
								<article class="proof-card">
									<header class="proof-card__header">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/review-avatar-03.jpg" alt="Аватар" class="proof-card__avatar">
										<div class="proof-card__meta">
											<h3 class="proof-card__name">Дина Хизбуллина</h3>
											<p class="proof-card__level">Знаток города 7 уровня</p>
										</div>
									</header>
									<div class="proof-card__rating">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/rating_stars.svg" alt="Оценка 5 из 5" class="proof-card__stars">
										<span class="proof-card__date">5 апреля</span>
									</div>
									<p class="proof-card__text">Хочу выразить огромную благодарность всему коллективу стоматологической клиники Елены Мокренко! Врачи здесь настоящие профессионалы, всегда внимательные и заботливые. Подробно объясняли каждую процедуру и отвечали на все мои вопросы. Это создало атмосферу доверия и спокойствия.</p>
								</article>
							</div>
							<div class="slider__slide">
								<article class="proof-card">
									<header class="proof-card__header">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/review-avatar-04.jpg" alt="Аватар" class="proof-card__avatar">
										<div class="proof-card__meta">
											<h3 class="proof-card__name">Наталья Разинкова</h3>
											<p class="proof-card__level">Знаток города 10 уровня</p>
										</div>
									</header>
									<div class="proof-card__rating">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/rating_stars.svg" alt="Оценка 5 из 5" class="proof-card__stars">
										<span class="proof-card__date">18 марта</span>
									</div>
									<p class="proof-card__text">Выражаю огромную благодарность врачам стоматологической клиники Елены Мокренко, а именно хирургу Васильеву Богдану Владимировичу и ортопеду Сейфуллину Альберту Шамильевичу, за их золотые руки, выскокий профессионализм и заботу о пациентах! Также хочу отметить мед.персонал данной клиники, все очень вежливые и внимательные!</p>
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

<?php get_template_part('template-parts/section/consult'); ?>

<?php get_template_part('template-parts/section/location'); ?>

<?php get_template_part('template-parts/section/gallery'); ?>

<?php get_footer(); ?>

