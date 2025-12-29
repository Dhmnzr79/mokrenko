<?php
/**
 * Template Name: Блог
 */
get_header();
?>

<section class="section section--page-intro-mobile page-intro-mobile">
	<div class="container">
		<div class="page-intro-mobile__box">
			<h1>Рассказываем просто о сложном в стоматологии</h1>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/mokrenko_first_mobile.png" alt="Доктор Мокренко" class="page-intro-mobile__image">
		</div>
		<div class="page-intro-mobile__benefits">
			<div class="page-intro-mobile__benefit-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="Галочка" class="page-intro-mobile__benefit-icon">
				<p>Ответы на частые вопросы пациентов – без сложных терминов</p>
			</div>
			<div class="page-intro-mobile__benefit-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="Галочка" class="page-intro-mobile__benefit-icon">
				<p>Истории из практики, советы по уходу, современные подходы – всё по-настоящему.</p>
			</div>
			<div class="page-intro-mobile__benefit-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="Галочка" class="page-intro-mobile__benefit-icon">
				<p>Как сохранить зубы здоровыми, а визиты к стоматологу — редкими и спокойными.</p>
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
					<h1>Рассказываем просто о сложном в стоматологии</h1>
					<div class="page-intro__benefits">
						<div class="page-intro__benefit-item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="page-intro__benefit-icon">
							<p>Ответы на частые вопросы пациентов – без сложных терминов</p>
						</div>
						<div class="page-intro__benefit-item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="page-intro__benefit-icon">
							<p>Истории из практики, советы по уходу, современные подходы – всё по-настоящему.</p>
						</div>
						<div class="page-intro__benefit-item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="page-intro__benefit-icon">
							<p>Как сохранить зубы здоровыми, а визиты к стоматологу — редкими и спокойными.</p>
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
			<span class="breadcrumbs__current">Блог</span>
		</div>
	</div>
</section>

<section class="section section--blog blog">
	<div class="container">
		<?php
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$blog_posts = new WP_Query([
			'post_type' => 'post',
			'posts_per_page' => 9,
			'post_status' => 'publish',
			'paged' => $paged,
			'orderby' => 'date',
			'order' => 'DESC'
		]);
		
		if ($blog_posts->have_posts()) :
		?>
		<div class="row blog__grid">
			<?php while ($blog_posts->have_posts()) : $blog_posts->the_post(); ?>
				<div class="col-sm-12 col-lg-4">
					<article class="blog-card">
						<?php if (has_post_thumbnail()) : ?>
							<a href="<?php the_permalink(); ?>" class="blog-card__image">
								<?php the_post_thumbnail('large', ['class' => 'blog-card__img']); ?>
							</a>
						<?php endif; ?>
						<div class="blog-card__content">
							<div class="blog-card__meta">
								<span class="blog-card__date"><?php echo get_the_date('d.m.Y'); ?></span>
							</div>
							<h3 class="blog-card__title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<?php if (has_excerpt()) : ?>
								<div class="blog-card__excerpt">
									<?php the_excerpt(); ?>
								</div>
							<?php endif; ?>
							<a href="<?php the_permalink(); ?>" class="blog-card__link">Читать далее →</a>
						</div>
					</article>
				</div>
			<?php endwhile; ?>
		</div>
		
		<?php if ($blog_posts->max_num_pages > 1) : ?>
			<div class="row">
				<div class="col-sm-12 col-lg-12">
					<div class="blog__pagination">
						<?php
						echo paginate_links([
							'total' => $blog_posts->max_num_pages,
							'current' => $paged,
							'prev_text' => '← Назад',
							'next_text' => 'Вперед →'
						]);
						?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		
		<?php
		wp_reset_postdata();
		else :
		?>
		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<p>Пока нет постов в блоге.</p>
			</div>
		</div>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>

