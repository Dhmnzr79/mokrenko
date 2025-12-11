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
						<li><a href="#" class="footer__link">Портфолио</a></li>
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
<?php wp_footer(); ?>
</body>
</html>
