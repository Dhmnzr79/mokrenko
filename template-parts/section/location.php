<?php
/**
 * Template part: Location Section
 * Блок с картой и информацией о местоположении
 */
?>
<section class="section section--location location">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-6">
				<div class="location__content">
					<div class="location__header">
						<h2>Никаких сложностей с приёмом, записью, парковкой и оплатой</h2>
						<div class="row">
							<div class="col-sm-12 col-lg-6">
								<div class="location__feature">
									<div class="location__feature-icon">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/contact_icon_1.svg" alt="Иконка парковки">
									</div>
									<h3>Собственная бесплатная парковка</h3>
									<p>Специально для наших пациентов у нас есть собственная бесплатная парковка</p>
								</div>
							</div>
							<div class="col-sm-12 col-lg-6">
								<div class="location__feature">
									<div class="location__feature-icon">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/contact_icon_2.svg" alt="Иконка метро рядом">
									</div>
									<h3>Находимся в 5 минутах от метро</h3>
									<p>В центре, на проспекте Мира. Между станциями метро «Рижская» и «Проспект Мира»</p>
								</div>
							</div>
						</div>
					</div>
					<div class="location__cta">
						<button class="btn location__call-btn" data-popup="open">
							Заказать звонок
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка" class="location__call-arrow">
						</button>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-6">
				<div class="location__map" role="region" aria-label="Карта проезда">
					<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A323a54469180fade51313f036c1802f512630e5b6ff890ed079c3eccf0923412&amp;width=100%25&amp;height=600&amp;lang=ru_RU&amp;scroll=true"></script>
				</div>
			</div>
		</div>
	</div>
</section>












