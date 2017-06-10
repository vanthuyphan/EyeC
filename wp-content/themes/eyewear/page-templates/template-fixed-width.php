<?php
	/*
	Template Name: Fixed Width
	*/

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container">
				<?php
					while ( have_posts() ) :
						the_post();
						the_content();
					endwhile; // end of the loop.
				?>
			</div>
			<!-- .container -->
		</main>
		<!-- #main -->
	</div> <!-- #primary -->
<?php get_footer();