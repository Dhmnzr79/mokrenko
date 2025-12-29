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
		<button class="btn page-intro-mobile__cta-btn" data-popup="open">
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

<?php get_template_part('template-parts/section/gallery'); ?>

<?php get_template_part('template-parts/section/social-proof'); ?>

<?php get_template_part('template-parts/section/awards'); ?>

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
<?php get_template_part('template-parts/section/contacts'); ?>

<?php get_footer(); ?>

