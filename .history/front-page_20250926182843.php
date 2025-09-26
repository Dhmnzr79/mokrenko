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
					<div class="service-links" style="display: flex; flex-direction: column; gap: 8px;">
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
				<div class="service-card" style="background-color: #f0f0f0;">
					<h3>Вставить все зубы</h3>
					<div class="service-links" style="display: flex; flex-direction: column; gap: 8px;">
						<a href="#" class="service-link">Все зубы за 1 день All-on-4</a>
						<a href="#" class="service-link">Имплантация All-on-6</a>
						<a href="#" class="service-link">Несъёмные протезы</a>
						<a href="#" class="service-link">Съёмные протезы</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-8">
				<div class="service-card" style="background-color: #f0f0f0;">
					<h3>Красивая улыбка</h3>
					<div class="service-links" style="display: flex; flex-direction: column; gap: 8px;">
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

<section class="section section--benefits benefits">
	<div class="container">
		<div class="row benefits__row-201">
			<div class="col-sm-12 col-lg-8">
				<div class="benefits__main" style="background-color: #f0f0f0;">
					<div class="row">
						<div class="col-sm-12 col-lg-12">
							<div class="benefits__header" style="background-color: #f0f0f0;">
								<h2>Выбор клиники - ключевой этап в лечении зубов</h2>
								<p>Наша цель — укрепить здоровье ваших зубов</p>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top:16px">
						<div class="col-sm-12 col-lg-6">
							<div class="benefits__feature" style="background-color: #f0f0f0;">
								<div class="benefits__feature-icon">
									<span class="benefits__icon">🏷️</span>
								</div>
								<h3>Честные цены без накруток и скрытых платежей</h3>
								<p>Цены на сайте соответствуют ценам в клинике. Не навязываем лишних услуг и не вносим скрытые платежи в договор. У нас честный подход.</p>
							</div>
						</div>
						<div class="col-sm-12 col-lg-6">
							<div class="benefits__feature" style="background-color: #f0f0f0;">
								<div class="benefits__feature-icon">
									<span class="benefits__icon">🦷</span>
								</div>
								<h3>Качественное лечение с гарантией по договору</h3>
								<p>Делаем только качественно и на века. Если по нашей вине у вас выпала пломба, коронка или имплант - мы исправим все абсолютно бесплатно в тот же день.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="benefits__card" style="background-color: #f0f0f0;">
					<div class="benefits__card-content">
						<div class="benefits__card-icon">
							<span class="benefits__icon">🏥</span>
						</div>
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

		
		<div class="row benefits__row-205">
			<div class="col-sm-12 col-lg-4">
				<div class="benefits__card" style="background-color: #f0f0f0;">
					<div class="benefits__card-content">
						<div class="benefits__card-icon">
							<span class="benefits__icon">😊</span>
						</div>
						<h3>Лечение без боли</h3>
						<p>Вы ничего не почувствуете. Швейцарские медикаменты и 30-летний опыт главного врача позволяют гарантировать полное отсутствие боли</p>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="benefits__card" style="background-color: #f0f0f0;">
					<div class="benefits__card-content">
						<div class="benefits__card-image">
							<img src="https://via.placeholder.com/300x200/f0f0f0/666666?text=Фото" alt="Честные цены" class="benefits__img">
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="benefits__card" style="background-color: #f0f0f0;">
					<div class="benefits__card-content">
						<h3>Сроки и гарантии</h3>
						<p>Соблюдаем сроки лечения, предоставляем гарантию.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
