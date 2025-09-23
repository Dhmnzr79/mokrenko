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

<section class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-lg-6">
				<h2>Тестовый блок 2</h2>
				<p>Ещё один пример текста. Без js, чистая разметка, mobile-first.</p>
			</div>
			<div class="col-sm-6 col-lg-6">
				<h3>Заголовок h3</h3>
				<p>Контент для второй колонки, чтобы увидеть поведение сетки при разных ширинах.</p>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
