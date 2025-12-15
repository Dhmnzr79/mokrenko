<?php
/**
 * Template Name: О клинике
 */
get_header();
?>

<section class="section section--page-intro-mobile page-intro-mobile">
	<div class="container">
		<div class="page-intro-mobile__box">
			<h1>30 лет опыта в каждом решении и улыбке пациента</h1>
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
					<h1>30 лет опыта в каждом решении и улыбке пациента</h1>
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
			<span class="breadcrumbs__current">О клинике</span>
		</div>
	</div>
</section>

<section class="section section--history">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-4">
				<h2>История клиники</h2>
			</div>
			<div class="col-sm-12 col-lg-8">
				<div class="history__content">
					<p>Все началось в далеком 1978 году, когда Елена Николаевна, будучи еще юной девушкой, отправилась с родителями в Венгрию и на своем личном опыте ощутила кардинальное отличие советской и зарубежной стоматологии. Разительный контраст был не в пользу отечественной медицины, но он настолько сильно впечатлил, что именно тогда Елена Николаевна решила посвятить этой сфере всю свою жизнь.</p>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-12 col-lg-4">
				<div class="history__year">1980-1986</div>
			</div>
			<div class="col-sm-12 col-lg-8">
				<div class="history__content">
					<p>С 1980 по 1986 год Елена Николаевна получала образование в Московском медицинском институте. По окончании в 1986 году была сразу приглашена в Центральную поликлинику №1 при МПС, которая в то время считалась лучшей в Москве. Одновременно прошла интернатуру по хирургической стоматологии, сдав экзамены экстерном. В 1986 году отправилась в Италию перенимать опыт у зарубежных коллег. Спустя шесть лет вернулась в Россию и с энтузиазмом продолжила профессиональную деятельность.</p>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-12 col-lg-4">
				<div class="history__year">1990-е</div>
			</div>
			<div class="col-sm-12 col-lg-8">
				<div class="history__content">
					<p>В начале 90-х прошла все курсы в Американской стоматологической академии в Москве.</p>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-12 col-lg-4">
				<div class="history__year">2012-2014</div>
			</div>
			<div class="col-sm-12 col-lg-8">
				<div class="history__content">
					<p>С 2012 по 2014 год Елена Николаевна путешествовала по миру, посетив 17 стран. В каждой стране она пристальное внимание уделяла стоматологическим кабинетам, общалась с врачами, сравнивала технологии и расширяла базу знаний. После мирового турне обучалась у Александра Бабурова в Санкт-Петербурге.</p>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-12 col-lg-4">
				<div class="history__year">2020</div>
			</div>
			<div class="col-sm-12 col-lg-8">
				<div class="history__content">
					<p>Идея создания собственной частной клиники была реализована в 2014 году. Это была небольшая, но хорошо оснащенная стоматологическая практика на Садовом кольце. Клиника успешно работала 3,5 года, после чего потребовалось расширение. Довольные клиенты Елены Мокренко из первой стоматологической практики перешли во вторую клинику, добавилось много новых пациентов, клиентская база стоматологической практики непрерывно расширялась.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section section--video">
	<div class="container">
		<div class="video__container">
			<button class="video__play-btn">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/play.svg" alt="Play" class="video__play-icon">
			</button>
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

<!-- Certificates Section -->
<section class="section section--certificates certificates">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-6">
				<div class="certificates__content">
					<h2>Официальная лицензия на все виды лечения</h2>
				</div>
			</div>
			<div class="col-sm-12 col-lg-6">
				<div class="certificates__gallery">
					<a href="<?php echo get_template_directory_uri(); ?>/assets/images/lic_01.webp" class="certificates__image" data-lightbox="certificates" data-title="Лицензия 1">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/lic_01.webp" alt="Лицензия 1">
					</a>
					<a href="<?php echo get_template_directory_uri(); ?>/assets/images/lic_02.webp" class="certificates__image" data-lightbox="certificates" data-title="Лицензия 2">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/lic_02.webp" alt="Лицензия 2">
					</a>
					<a href="<?php echo get_template_directory_uri(); ?>/assets/images/lic_03.webp" class="certificates__image" data-lightbox="certificates" data-title="Лицензия 3">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/lic_03.webp" alt="Лицензия 3">
					</a>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Contacts Section -->
<section class="section section--contacts contacts">
	<div class="container">
		<div class="contacts__box">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/mokrenko_first.png" alt="Врач" class="contacts__bg">
			<div class="row">
				<div class="col-sm-12 col-lg-6">
					<!-- Пустая колонка для фото -->
				</div>
				<div class="col-sm-12 col-lg-6">
					<div class="contacts__content-block">
						<h2>Контакты</h2>
						<ul class="contacts__list">
							<li data-emoji="📍">г. Москва, проспект Мира, д. 57, корп. 2</li>
							<li data-emoji="📞">+7 (495) 123-45-67</li>
							<li data-emoji="✉️">info@mokrenko.ru</li>
							<li data-emoji="🕒">Пн-Пт: 9:00 - 21:00<br>Сб-Вс: 10:00 - 18:00</li>
						</ul>
						<div class="contacts__question">
							<h3>Остались вопросы?</h3>
							<p>Задайте свой вопрос, и мы бесплатно проконсультируем Вас в течении 5 минут</p>
						</div>
						<button class="btn contacts__cta-btn">
							Записаться на приём
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка" class="contacts__cta-arrow">
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>

