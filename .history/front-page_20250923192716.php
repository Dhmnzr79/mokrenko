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
		<!-- Первый ряд: сетка #1 (8/4) -->
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
		
		<!-- Второй ряд: сетка #5 (равные трети 4/4/4) -->
		<div class="row reviews__grid">
			<div class="col-sm-12 col-lg-4">
				<div class="review-card">
					<h3>Анна Петрова</h3>
					<p>Отличный сервис, профессиональные врачи</p>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="review-card">
					<h3>Михаил Иванов</h3>
					<p>Быстро и качественно, рекомендую</p>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="review-card">
					<h3>Елена Сидорова</h3>
					<p>Очень довольна результатом лечения</p>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
