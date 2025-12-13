<?php
/**
 * Template for single blog post
 */

// Добавляем класс body для скрытия обычного header
add_filter('body_class', function($classes) {
	$classes[] = 'page-has-top';
	return $classes;
});

get_header();
?>

<?php get_template_part('template-parts/page-top'); ?>

<section class="section section--breadcrumbs">
	<div class="container">
		<div class="breadcrumbs">
			<a href="/" class="breadcrumbs__link">Главная</a>
			<span class="breadcrumbs__separator">→</span>
			<a href="<?php echo esc_url(get_page_url_by_template('page-blog.php')); ?>" class="breadcrumbs__link">Блог</a>
			<span class="breadcrumbs__separator">→</span>
			<span class="breadcrumbs__current"><?php the_title(); ?></span>
		</div>
	</div>
</section>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<section class="section section--blog-single blog-single">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-8">
				<article class="blog-single__article">
					<?php if (has_post_thumbnail()) : ?>
						<div class="blog-single__image">
							<?php the_post_thumbnail('large', ['class' => 'blog-single__img']); ?>
						</div>
					<?php endif; ?>
					
					<header class="blog-single__header">
						<div class="blog-single__meta">
							<span class="blog-single__date"><?php echo get_the_date('d.m.Y'); ?></span>
						</div>
						<h1 class="blog-single__title"><?php the_title(); ?></h1>
					</header>
					
					<div class="blog-single__content">
						<?php the_content(); ?>
					</div>
					
					<div class="blog-single__back-to-blog">
						<a href="<?php echo esc_url(get_page_url_by_template('page-blog.php')); ?>" class="blog-single__back-to-blog-link">Вернуться в блог →</a>
					</div>
					
					<?php
					$related_1_id = get_post_meta(get_the_ID(), 'post_related_1', true);
					$related_2_id = get_post_meta(get_the_ID(), 'post_related_2', true);
					$related_posts = [];
					
					if ($related_1_id) {
						$related_posts[] = get_post($related_1_id);
					}
					if ($related_2_id) {
						$related_posts[] = get_post($related_2_id);
					}
					
					if (!empty($related_posts)) :
					?>
					<div class="blog-single__related">
						<h2 class="blog-single__related-title">Похожие статьи</h2>
						<div class="row blog-single__related-grid">
							<?php foreach ($related_posts as $related_post) : 
								if (!$related_post || $related_post->post_status !== 'publish') continue;
								setup_postdata($related_post);
							?>
								<div class="col-sm-12 col-lg-6">
									<article class="blog-card">
										<?php if (has_post_thumbnail($related_post->ID)) : ?>
											<a href="<?php echo get_permalink($related_post->ID); ?>" class="blog-card__image">
												<?php echo get_the_post_thumbnail($related_post->ID, 'large', ['class' => 'blog-card__img']); ?>
											</a>
										<?php endif; ?>
										<div class="blog-card__content">
											<div class="blog-card__meta">
												<span class="blog-card__date"><?php echo get_the_date('d.m.Y', $related_post->ID); ?></span>
											</div>
											<h3 class="blog-card__title">
												<a href="<?php echo get_permalink($related_post->ID); ?>"><?php echo get_the_title($related_post->ID); ?></a>
											</h3>
											<?php if (has_excerpt($related_post->ID)) : ?>
												<div class="blog-card__excerpt">
													<?php echo get_the_excerpt($related_post->ID); ?>
												</div>
											<?php endif; ?>
											<a href="<?php echo get_permalink($related_post->ID); ?>" class="blog-card__link">Читать далее →</a>
										</div>
									</article>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<?php 
					wp_reset_postdata();
					endif; 
					?>
				</article>
			</div>
			<div class="col-sm-12 col-lg-4">
				<aside class="blog-single__sidebar">
					<div class="doctor-question__box bg-gradient-brand">
						<h2 class="doctor-question__title">Остались вопросы?</h2>
						<p class="doctor-question__text">Задайте свой вопрос, и мы бесплатно проконсультируем Вас в течении 5 минут по любому вопросы и при необходимости запишем на бесплатную консультацию</p>
						<?php echo do_shortcode('[contact-form-7 id="8b72ea4" title="Форма с вопросом"]'); ?>
						<div class="form-consent">
							<label class="form-consent__label">
								<input type="checkbox" class="form-consent__checkbox" checked required>
								<span class="form-consent__text">Я даю согласие на обработку <a href="https://mokrenko-msk.ru/privacy.pdf" target="_blank" rel="noopener" class="form-consent__link">персональных данных</a></span>
							</label>
						</div>
					</div>
				</aside>
			</div>
		</div>
	</div>
</section>
<?php endwhile; endif; ?>

<?php get_footer(); ?>

