</main>
<footer class="site-footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="footer__logo">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/logo.svg" alt="Mokrenko" class="footer__logo-img">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-lg-3">
				<div class="footer__section">
					<h3 class="footer__title">Услуги:</h3>
					<ul class="footer__list">
						<li><a href="#" class="footer__link">Коронка на зуб</a></li>
						<li><a href="#" class="footer__link">Импланты зубов</a></li>
						<li><a href="#" class="footer__link">Протезирование зубов</a></li>
						<li><a href="#" class="footer__link">Реставрация зубов</a></li>
						<li><a href="#" class="footer__link">Лечение зубов</a></li>
						<li><a href="#" class="footer__link">Удаление зубов</a></li>
						<li><a href="#" class="footer__link">Лечение десен</a></li>
						<li><a href="#" class="footer__link">Чистка зубов</a></li>
					</ul>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="footer__section">
					<h3 class="footer__title footer__title--empty"></h3>
					<ul class="footer__list">
						<li><a href="#" class="footer__link">Все зубы за 1 день All-on-4</a></li>
						<li><a href="#" class="footer__link">Имплантация All-on-6</a></li>
						<li><a href="#" class="footer__link">Несъёмные протезы</a></li>
						<li><a href="#" class="footer__link">Съёмные протезы</a></li>
						<li><a href="#" class="footer__link">Виниры на зубы</a></li>
						<li><a href="#" class="footer__link">Брекеты</a></li>
						<li><a href="#" class="footer__link">Отбеливание зубов</a></li>
						<li><a href="#" class="footer__link">Чистка Air Flow</a></li>
					</ul>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="footer__section">
					<h3 class="footer__title">Навигация</h3>
					<ul class="footer__list">
						<li><a href="<?php echo esc_url(get_page_url_by_template('page-portfolio.php')); ?>" class="footer__link">Портфолио</a></li>
						<li><a href="<?php echo esc_url(get_page_url_by_template('page-doctors.php')); ?>" class="footer__link">Врачи</a></li>
						<li><a href="#" class="footer__link">Акции</a></li>
						<li><a href="<?php echo esc_url(get_page_url_by_template('page-blog.php')); ?>" class="footer__link">Блог</a></li>
						<li><a href="<?php echo esc_url(get_page_url_by_template('page-reviews.php')); ?>" class="footer__link">Отзывы</a></li>
						<li><a href="<?php echo esc_url(get_page_url_by_template('page-contacts.php')); ?>" class="footer__link">Контакты</a></li>
					</ul>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="footer__section">
					<h3 class="footer__title">Поиск по сайту</h3>
					<div class="footer__search">
						<input type="text" placeholder="Поиск..." class="footer__search-input">
					</div>
					<div class="footer__social">
						<a href="#" class="footer__social-link">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/telegram.svg" alt="Telegram">
						</a>
						<a href="#" class="footer__social-link">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/whatsapp.svg" alt="WhatsApp">
						</a>
						<a href="#" class="footer__social-link">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/vk.svg" alt="VK">
						</a>
						<a href="#" class="footer__social-link">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/youtube.svg" alt="YouTube">
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="footer__copyright">
					<div class="footer__copyright-left">
						<p>ООО «Стоматологическая клиника Елены Мокренко»</p>
						<p>ИНН: 7702421620     ОГРН: 1177746857320</p>
					</div>
					<div class="footer__copyright-right">
						<a href="https://mokrenko-msk.ru/privacy.pdf" target="_blank" rel="noopener noreferrer" class="footer__privacy-link">Политика конфиденциальности</a>
					</div>
				</div>
				<div class="footer__disclaimer">
					<p>Имеются противопоказания. Необходима консультация специалиста</p>
				</div>
			</div>
		</div>
	</div>
</footer>

<!-- Popup 1: Оставьте заявку -->
<div id="popup-1" class="popup-overlay" role="dialog" aria-modal="true" aria-hidden="true">
	<div class="popup-sheet" role="document">
		<button class="popup-close" aria-label="Закрыть" onclick="closePopup()">✕</button>

		<h2>Оставьте заявку</h2>
		<p class="popup-subtitle">
			Мы перезвоним вам в ближайшее время, разберём вашу ситуацию,
			подскажем подходящие варианты имплантации и запишем на консультацию, если захотите.
		</p>

		<?php echo do_shortcode('[contact-form-7 id="0f28481" title="Контактная форма 1"]'); ?>
		<div class="form-consent">
			<label class="form-consent__label">
				<input type="checkbox" class="form-consent__checkbox" checked required>
				<span class="form-consent__text">Я даю согласие на обработку <a href="https://mokrenko-msk.ru/privacy.pdf" target="_blank" rel="noopener" class="form-consent__link">персональных данных</a></span>
			</label>
		</div>
	</div>
</div>

<!-- Popup 2: Есть вопрос по услуге? -->
<div id="popup-2" class="popup-overlay" role="dialog" aria-modal="true" aria-hidden="true">
	<div class="popup-sheet" role="document">
		<button class="popup-close" aria-label="Закрыть" onclick="closePopup()">✕</button>

		<h2>Есть вопрос по услуге?</h2>
		<p class="popup-subtitle">
			Мы перезвоним вам в ближайшее время, разберём вашу ситуацию,
			подскажем подходящие варианты имплантации и запишем на консультацию, если захотите.
		</p>

		<?php echo do_shortcode('[contact-form-7 id="0f28481" title="Контактная форма 1"]'); ?>
		<div class="form-consent">
			<label class="form-consent__label">
				<input type="checkbox" class="form-consent__checkbox" checked required>
				<span class="form-consent__text">Я даю согласие на обработку <a href="https://mokrenko-msk.ru/privacy.pdf" target="_blank" rel="noopener" class="form-consent__link">персональных данных</a></span>
			</label>
		</div>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
