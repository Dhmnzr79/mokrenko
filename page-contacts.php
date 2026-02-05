<?php
/**
 * Template Name: Контакты
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
			<span class="breadcrumbs__current">Контакты</span>
		</div>
	</div>
</section>

<section class="section section--contacts contacts">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-6">
				<div class="contacts__content">
					<h1>Контакты</h1>
					<ul class="contacts__list">
						<li data-emoji="📍">Находимся в центре в 5 минутах от метро на проспекте Мира. Между станциями метро «Рижская» и «Проспект Мира»</li>
						<li data-emoji="📍">Наш адрес: г. Москва, ул. Проспект Мира 75, стр. 1 (м.Рижская)</li>
						<li data-emoji="📞"><a href="tel:+74950035476">+7 (495) 003-54-76</a></li>
						<li data-emoji="🕒">Работаем ежедневно с 10:00 до 21:00</li>
						<li data-emoji="✉️">email: mokrenko-msk@yandex.ru</li>
					</ul>
					<button class="btn contacts__cta-btn">
						Записаться на приём
						<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="" class="contacts__cta-arrow">
					</button>
				</div>
			</div>
			<div class="col-sm-12 col-lg-6">
				<div class="contacts__image">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/contacts.jpg" alt="Вход в стоматологическую клинику Елены Мокренко" class="contacts__img">
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section section--map">
	<div class="container">
		<div class="contacts__map" id="yandex-map"></div>
	</div>
</section>

<section class="section section--directions">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<h2>Как до нас добраться?</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-lg-4">
				<div class="directions__item">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="" class="directions__icon">
					<h3>От ст. м. Рижская (5-7 мин)</h3>
					<p>Один выход из метро. Выходите, идете прямо до подземного перехода. По переходу проходите прямо до конца и на лево. На выходе из перехода, поворачиваете направо, далее идете прямо, эстакада остается позади, поворачиваете налево и идете прямо по проспекту миру до ближайшего светофора. На светофоре поверчиваете направо, переходите дорогу по пешеходному переходу. Слева увидите голубую вывеску Стоматология Елены Мокренко. Вход через Барбер шоп.</p>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="directions__item">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="" class="directions__icon">
					<h3>От ст. м. Проспект мира (10-15 мин)</h3>
					<p>Выход из метро – первый вагон из центра. Выходите из метро, поворачиваете налево и идете прямо параллельно проспекту мира. Слева увидите голубую вывеску Стоматология Елены Мокренко. Вход через барбер шоп.</p>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="directions__item">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="" class="directions__icon">
					<h3>Как добраться на машине. Из центра:</h3>
					<p>Съезд с садового кольца на ул Щепкина. Далее съехать на ул Гиляровского до пересечения с Трифоновской улицей, далее поворачиваете направо (заезд с Трифоновской)</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section section--divider">
	<div class="container">
		<div class="divider"></div>
	</div>
</section>

<section class="section section--licenses-requisites">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-6">
				<h2>Официальная лицензия на все виды лечения</h2>
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
			<div class="col-sm-12 col-lg-6">
				<h2>Наши реквизиты</h2>
				<div class="requisites__content">
					<p>ООО «Стоматологическая клиника Елены Мокренко»</p>
					<p>Юридический адрес 129110, г. Москва, Проспект Мира, дом 75 строение 1, этаж 1, помещение 1, ком.1-9</p>
					<p>Почтовый адрес 129110, г. Москва, Проспект Мира, дом 75 строение 1, этаж 1, помещение 1, ком.1-9</p>
					<p>Фактический адрес 129110, г. Москва, Проспект Мира, дом 75 строение 1, этаж 1, помещение 1, ком.1-9</p>
					<p>Телефон</p>
					<p>Инн/Кпп 7702421620 /770201001</p>
					<p>Расчетный счет 407 028 103 013 000 142 67 в АО «АЛЬФА-БАНК» г. Москва</p>
					<p>Корр. счет 30101810200000000593</p>
					<p>БИК 044525593</p>
					<p>ОКПО 19160781</p>
					<p>ОКАТО 45286570000</p>
					<p>ОКТМО 45379000</p>
					<p>ОГРН 1177746857320</p>
					<p>ФИО должность руководителя Генеральный директор Мокренко Елена Николаевна</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section section--contacts contacts">
	<div class="container">
		<div class="contacts__box">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/mokrenko_first.png" alt="Главный врач клиники - Елена Мокренко" class="contacts__bg">
			<div class="row">
				<div class="col-sm-12 col-lg-6">
					<!-- Пустая колонка для фото -->
				</div>
				<div class="col-sm-12 col-lg-6">
					<div class="contacts__content-block">
						<h2>Контакты</h2>
						<ul class="contacts__list">
							<li data-emoji="📍">г. Москва, ул. Проспект Мира 75, стр. 1 (м.Рижская)</li>
							<li data-emoji="📞"><a href="tel:+74950035476">+7 (495) 003-54-76</a></li>
							<li data-emoji="✉️">mokrenko-msk@yandex.ru</li>
							<li data-emoji="🕒">Пн-Пт: 9:00 - 21:00<br>Сб-Вс: 10:00 - 18:00</li>
						</ul>
						<div class="contacts__question">
							<h3>Остались вопросы?</h3>
							<p>Задайте свой вопрос, и мы бесплатно проконсультируем Вас в течении 5 минут</p>
						</div>
						<button class="btn contacts__cta-btn">
							Записаться на приём
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="" class="contacts__cta-arrow">
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>

