<?php
/**
 * Template part: Consult Section
 * Блок записи на бесплатный осмотр
 */
?>
<section class="section section--consult consult">
	<div class="container">
        <div class="consult__box bg-gradient-brand consult__box--with-doctor">
            <img class="consult__bg" src="<?php echo esc_url( wp_get_upload_dir()['baseurl'] . '/2025/10/gurdzan.png' ); ?>" alt="Врач" loading="lazy">
			<div class="consult__layout">
				<div class="consult__row consult__row--title">
					<h2 class="consult__title">Запишитесь на <span class="text-contrast">бесплатный осмотр</span> <br>к нашим врачам</h2>
					
				</div>
				<div class="consult__row consult__row--cards">
					<div class="consult__card consult__card--left">
						<h3 class="consult__card-title">Что будет на осмотре?</h3>
						<ul class="consult__list">
							<li class="consult__item">
								<span class="consult__item-icon">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка">
								</span>
								<span class="consult__item-text">Цифровой 3D слепок вашей челюсти и улыбки</span>
							</li>
							<li class="consult__item">
								<span class="consult__item-icon">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка">
								</span>
								<span class="consult__item-text">Полное обследование и диагностика полости рта</span>
							</li>
							<li class="consult__item">
								<span class="consult__item-icon">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка">
								</span>
								<span class="consult__item-text">Составление детального плана лечения в 3‑х вариантах со стоимостью и сроками каждого этапа работ.</span>
							</li>
						</ul>
					</div>
					<div class="consult__card consult__card--right">
						<div class="consult__badge">А также:</div>
						<h3 class="consult__card-title">Квалифицированная консультация по оздоровлению полости рта:</h3>
						<ul class="consult__bullets">
							<li>Обследование зубов на наличие кариеса</li>
							<li>Обследование дёсен на наличие воспаления</li>
							<li>Специальное обследование на наличие запаха изо рта и установление его причин.</li>
						</ul>
					</div>
				</div>
				<div class="consult__row consult__row--cta">
					<button class="btn consult__cta-btn" data-popup="open">
						Записаться на консультацию
						<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка" class="consult__cta-arrow">
					</button>
				</div>
			</div>
		</div>
	</div>
</section>













