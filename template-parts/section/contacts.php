<?php
/**
 * Template part: Contacts Section
 * Блок контактов с формой записи
 */
?>
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
						<button class="btn contacts__cta-btn" data-popup="open">
							Записаться на приём
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="" class="contacts__cta-arrow">
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>












