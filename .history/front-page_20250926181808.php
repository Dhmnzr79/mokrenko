<?php
/**
 * Front Page template with hero and test blocks
 */
get_header();
?>
<section class="section section--hero hero">
	<div class="container">
		<div class="hero__box bg-gradient-brand">
			<div class="row">
				<div class="col-sm-8 col-lg-8">
					<h2>Тестовый блок 1</h2>
					<p>Это пример текста в первом тестовом блоке. Здесь проверяем типографику и сетку.</p>
				</div>
				<div class="col-sm-4 col-lg-4">
					<h3>Сайд-блок</h3>
					<p>Дополнительный текст для проверки колонок и отступов.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section section--reviews reviews">
	<div class="container">
		<div class="row reviews__header">
			<div class="col-sm-8 col-lg-8">
				<h2>Отзывы наших пациентов</h2>
				<p>Узнайте, что говорят о нашей работе</p>
			</div>
			<div class="col-sm-4 col-lg-4">
				<div class="reviews__stats">
					<div class="stat-number">4.9</div>
					<p>Средняя оценка</p>
				</div>
			</div>
		</div>
		
		<div class="row reviews__grid">
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
			
			foreach($reviews as $review):
				$fio = get_post_meta($review->ID, '_reviews_fio', true);
				$video_url = get_post_meta($review->ID, '_reviews_video_url', true);
				$thumbnail = get_the_post_thumbnail($review->ID, 'medium');
			?>
			<div class="col-sm-12 col-lg-4">
				<div class="review-card">
					<?php if($thumbnail): ?>
						<div class="review-card__photo">
							<?php echo $thumbnail; ?>
						</div>
					<?php endif; ?>
					
					<div class="review-card__content">
						<h3><?php echo $fio ? esc_html($fio) : get_the_title($review->ID); ?></h3>
						<div class="review-card__text">
							<?php echo wp_kses_post($review->post_content); ?>
						</div>
						
						<?php if($video_url): ?>
							<div class="review-card__video">
								<a href="<?php echo esc_url($video_url); ?>" target="_blank" class="btn btn--video">
									Смотреть видео отзыв
								</a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section section--chief-doctor chief-doctor">
	<div class="container">
		<div class="row chief-doctor__header">
			<div class="col-sm-12 col-lg-12">
				<h2>Клиника основана стоматологом-ортопедом Еленой Мокренко</h2>
			</div>
		</div>
		
		<div class="row chief-doctor__content">
			<div class="col-sm-12 col-lg-6">
				<div class="row">
					<div class="col-sm-12 col-lg-12">
						<div class="chief-doctor__block-210">
							<p>Владеет в совершенстве современными методами профилактики, диагностики и лечения в области ортопедии. Обучает выпускников медицинских университетов.</p>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-12 col-lg-6">
						<div class="chief-doctor__block-209-1">
							<div class="achievement-item">
								<div class="achievement-icon">✓</div>
								<p>Эксперт в корректировке формы, цвета и украшении зубов</p>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6">
						<div class="chief-doctor__block-209-2">
							<div class="achievement-item">
								<div class="achievement-icon">✓</div>
								<p>Сертифицированный специалист по установке люминиров с 12-летним опытом</p>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-12 col-lg-6">
						<div class="chief-doctor__block-209-3">
							<div class="achievement-item">
								<div class="achievement-icon">✓</div>
								<p>Участник Стоматологической Ассоциации России</p>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6">
						<div class="chief-doctor__block-209-4">
							<div class="achievement-item">
								<div class="achievement-icon">✓</div>
								<p>Участник American Dental Academy: повышение квалификации и обмен опытом с лучшими американскими и европейскими стоматологами</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-6">
				<div class="chief-doctor__photo">
					<img src="https://via.placeholder.com/400x500/4CAF50/FFFFFF?text=Фото+врача" alt="Дугинец Надежда Семеновна" class="chief-doctor__img">
					<div class="chief-doctor__badge">
						<span class="chief-doctor__badge-text">Главный врач</span>
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
				<div class="service-card service-card--header" style="background-color: #f0f0f0;">
					<h2>Наши услуги</h2>
					<p>Полный спектр стоматологических услуг для всей семьи</p>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="service-card" style="background-color: #f0f0f0;">
					<h3>Восстановить зуб</h3>
					<div class="service-links" style="display: flex; flex-direction: column; gap: 8px;">
						<a href="#" class="service-link">Коронка на зуб</a>
						<a href="#" class="service-link">Импланты зубов</a>
						<a href="#" class="service-link">Протезирование зубов</a>
						<a href="#" class="service-link">Реставрация зубов</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="service-card" style="background-color: #f0f0f0;">
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
				<div class="services__cta">
					<h3>Записаться на прием</h3>
					<button class="btn btn--primary">Записаться</button>
				</div>
			</div>
			<div class="col-sm-12 col-lg-8">
				<h2>Наши услуги</h2>
				<p>Полный спектр стоматологических услуг для всей семьи</p>
			</div>
		</div>
	</div>
</section>

<section class="section section--benefits benefits">
	<div class="container">
		<div class="row benefits__row-201">
			<div class="col-sm-12 col-lg-8">
				<div class="bg-demo-1">
					<div class="row">
						<div class="col-sm-12 col-lg-12">
							<div class="bg-demo-6">
								<h2>Наши плюсы</h2>
								<p>Демонстрация схем 210 и 209 внутри левой области.</p>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top:16px">
						<div class="col-sm-12 col-lg-6">
							<div class="bg-demo-7">
								<p>Колонка A (6/12)</p>
							</div>
						</div>
						<div class="col-sm-12 col-lg-6">
							<div class="bg-demo-8">
								<p>Колонка B (6/12)</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="bg-demo-2">
					<div class="bg-demo-card">
						<h3>Гарантии и качество</h3>
						<p>Стерильность, контроль качества, персональный подход.</p>
					</div>
				</div>
			</div>
		</div>

		
		<div class="row benefits__row-205">
			<div class="col-sm-12 col-lg-4">
				<div class="bg-demo-3">
					<div class="bg-demo-card">
						<h3>Без боли</h3>
						<p>Современная анестезия, щадящие методики.</p>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="bg-demo-4">
					<div class="bg-demo-card">
						<h3>Честные цены</h3>
						<p>Прозрачные сметы, акции и рассрочка.</p>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="bg-demo-5">
					<div class="bg-demo-card">
						<h3>Сроки и гарантии</h3>
						<p>Соблюдаем сроки лечения, предоставляем гарантию.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
