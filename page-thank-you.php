<?php
/**
 * Template Name: Благодарность
 */
get_header();
?>

<section class="section section--thank-you thank-you">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-8 col-lg-offset-2">
				<div class="thank-you__content">
					<div class="thank-you__icon">
						<svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="12" cy="12" r="10" stroke="#3AD5BC" stroke-width="2" fill="none"/>
							<path d="M8 12l2 2 6-6" stroke="#3AD5BC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</div>
					<h1 class="thank-you__title">Спасибо за вашу заявку!</h1>
					<p class="thank-you__text">
						Мы получили вашу заявку и свяжемся с вами в ближайшее время.
					</p>
					<p class="thank-you__text">
						Наш специалист перезвонит вам в течение 15 минут в рабочее время.
					</p>
					<div class="thank-you__actions">
						<a href="<?php echo esc_url(home_url('/')); ?>" class="btn thank-you__btn">Вернуться на главную</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
?>

