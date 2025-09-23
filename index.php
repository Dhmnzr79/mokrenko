<?php
/**
 * Minimal index template for Mokrenko theme
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<main class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; else : ?>
					<p><?php esc_html_e('No content yet.', 'mokrenko'); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</main>
<?php wp_footer(); ?>
</body>
</html>
