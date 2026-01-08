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
					foreach($gallery_order as $i): 
					?>
					<a href="<?php echo get_template_directory_uri(); ?>/assets/images/gallery/gallery<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>.jpg" class="gallery__item" data-lightbox="gallery">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/gallery/gallery<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>.jpg" alt="Галерея <?php echo $i; ?>" class="gallery__image">
					</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>










