<?php
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
						<div class="benefits__card-icon">
							<span class="benefits__icon">📅</span>
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
						<h3>Выбор пользователей Яндекса</h3>
						<p>Входим в Топ-30 частных стоматологии Москвы на ноябрь 2022</p>
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
						<h3>Выбор пользователей Яндекса</h3>
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
			</div>
			<div class="col-sm-12 col-lg-6">
				<div class="contacts__map" role="region" aria-label="Карта проезда"></div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
