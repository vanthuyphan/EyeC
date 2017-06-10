<?php
	/*
	Template Name: Visual Composer Page
	*/

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'post-contents/content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>
		</main> <!-- #main -->
	</div> <!-- #primary -->
<?php get_footer();