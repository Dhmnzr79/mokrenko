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

<section class="section section--services services">
	<div class="container">
		<div class="row services__header">
			<div class="col-sm-12 col-lg-4">
				<div class="services__cta">
					<h3>Записаться на прием</h3>
					<button class="btn btn--primary">Записаться</button>
				</div>
			</div>
			<div class="col-sm-12 col-lg-8">
				<h2>Наши услуги</h2>
				<p>Полный спектр стоматологических услуг для всей семьи</p>
			</div>
		</div>
		
		<div class="row services__grid">
			<div class="col-sm-12 col-lg-4">
				<div class="service-card">
					<h3>Терапия</h3>
					<p>Лечение кариеса, пульпита, периодонтита</p>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="service-card">
					<h3>Хирургия</h3>
					<p>Удаление зубов, имплантация</p>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="service-card">
					<h3>Ортодонтия</h3>
					<p>Исправление прикуса, брекеты</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section section--benefits benefits">
	<div class="container">
		<div class="row benefits__row-201">
			<div class="col-sm-12 col-lg-8">
				<div class="bg-demo-1">
					<div class="row">
						<div class="col-sm-12 col-lg-12">
							<div class="bg-demo-6">
								<h2>Наши плюсы</h2>
								<p>Демонстрация схем 210 и 209 внутри левой области.</p>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top:16px">
						<div class="col-sm-12 col-lg-6">
							<div class="bg-demo-7">
								<p>Колонка A (6/12)</p>
							</div>
						</div>
						<div class="col-sm-12 col-lg-6">
							<div class="bg-demo-8">
								<p>Колонка B (6/12)</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="bg-demo-2">
					<div class="bg-demo-card">
						<h3>Гарантии и качество</h3>
						<p>Стерильность, контроль качества, персональный подход.</p>
					</div>
				</div>
			</div>
		</div>

		
		<div class="row benefits__row-205">
			<div class="col-sm-12 col-lg-4">
				<div class="bg-demo-3">
					<div class="bg-demo-card">
						<h3>Без боли</h3>
						<p>Современная анестезия, щадящие методики.</p>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="bg-demo-4">
					<div class="bg-demo-card">
						<h3>Честные цены</h3>
						<p>Прозрачные сметы, акции и рассрочка.</p>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="bg-demo-5">
					<div class="bg-demo-card">
						<h3>Сроки и гарантии</h3>
						<p>Соблюдаем сроки лечения, предоставляем гарантию.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
