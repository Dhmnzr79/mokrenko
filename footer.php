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
						<li><a href="#" class="footer__link">Люминиры</a></li>
						<li><a href="#" class="footer__link">Виниры</a></li>
						<li><a href="#" class="footer__link">Лечение зубов</a></li>
						<li><a href="#" class="footer__link">Хирургическая стоматология</a></li>
						<li><a href="#" class="footer__link">Отбеливание зубов</a></li>
						<li><a href="#" class="footer__link">Профессиональная гигиена</a></li>
						<li><a href="#" class="footer__link">Детская стоматология</a></li>
						<li><a href="#" class="footer__link">Лечение десен</a></li>
					</ul>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="footer__section">
					<h3 class="footer__title footer__title--empty"></h3>
					<ul class="footer__list">
						<li><a href="#" class="footer__link">Протезирование зубов</a></li>
						<li><a href="#" class="footer__link">Съемные протезы</a></li>
						<li><a href="#" class="footer__link">Имплантация под ключ</a></li>
						<li><a href="#" class="footer__link">Одноэтапная имплантация</a></li>
						<li><a href="#" class="footer__link">Классическая имплантация</a></li>
						<li><a href="#" class="footer__link">Одномоментная имплантация</a></li>
						<li><a href="#" class="footer__link">All-on-4</a></li>
						<li><a href="#" class="footer__link">All-on-6</a></li>
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
				<p class="footer__copyright">© <?php echo date('Y'); ?> Mokrenko</p>
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

		<form class="popup-form" method="post">
			<input type="text" name="name" class="popup-field" placeholder="Ваше имя" autocomplete="name" required>
			<input type="tel" name="phone" class="popup-field" placeholder="+7 (___) ___-__-__" inputmode="numeric" autocomplete="tel" required>
			
			<button type="submit" class="popup-cta">Отправить заявку</button>
			
			<a href="https://wa.me/79000000000" class="popup-whatsapp" target="_blank" rel="noopener">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
					<path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
				</svg>
				Написать в WhatsApp
			</a>
			
			<p class="popup-policy">
				Нажимая кнопку, вы соглашаетесь с <a href="#" target="_blank" rel="noopener">политикой конфиденциальности</a>
			</p>
		</form>
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

		<form class="popup-form" method="post">
			<input type="text" name="name" class="popup-field" placeholder="Ваше имя" autocomplete="name" required>
			<input type="tel" name="phone" class="popup-field" placeholder="+7 (___) ___-__-__" inputmode="numeric" autocomplete="tel" required>
			
			<button type="submit" class="popup-cta">Отправить заявку</button>
			
			<a href="https://wa.me/79000000000" class="popup-whatsapp" target="_blank" rel="noopener">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
					<path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
				</svg>
				Написать в WhatsApp
			</a>
			
			<p class="popup-policy">
				Нажимая кнопку, вы соглашаетесь с <a href="#" target="_blank" rel="noopener">политикой конфиденциальности</a>
			</p>
		</form>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
