<?php
/**
 * Template part: Gallery Section
 * Блок галереи фотографий клиники
 */
?>
<section class="section section--gallery gallery">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<h2>Мы всегда <span class="text-accent">рады вас видеть</span></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="gallery__grid">
					<?php 
					$gallery_order = [1, 2, 3, 5, 4, 6, 7, 8, 9, 10, 11, 12];
					$gallery_alt = [
						1 => 'Кабинет стоматологической клиники Елены Мокренко',
						2 => 'Процесс стоматологического лечения в клинике',
						3 => 'Стоматологический кабинет клиники Елены Мокренко',
						4 => 'Дугинец Надежда Семеновна — стоматолог-терапевт за работой с микроскопом',
						5 => 'Процесс лечения пациента в стоматологическом кабинете',
						6 => 'Современный стоматологический аппарат в клинике',
						7 => 'Стоматологическое лечение пациента в клинике',
						8 => 'Дугинец Надежда Семеновна — стоматолог-терапевт в процессе лечения',
						9 => 'Процедура установки зубного импланта',
						10 => 'Стоматолог-терапевт Дугинец Надежда Семеновна во время лечения пациента',
						11 => 'Приемная стоматологической клиники Елены Мокренко',
						12 => 'Администратор стоматологической клиники на ресепшене'
					];
					foreach($gallery_order as $i): 
					?>
					<a href="<?php echo get_template_directory_uri(); ?>/assets/images/gallery/gallery<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>.jpg" class="gallery__item" data-lightbox="gallery">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/gallery/gallery<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>.jpg" alt="<?php echo esc_attr($gallery_alt[$i]); ?>" class="gallery__image">
					</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>












