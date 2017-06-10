<?php
	/*
	Template Name: Page Sidebar Left
	*/

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	get_header(); ?>
	<section id="content" class="site-content page-section default-page">
		<div class="container">
			<div class="row">
				<div id="primary" class="content-area col-md-9 col-md-push-3 col-sm-8 col-sm-push-4">
					<main id="main" class="site-main" role="main">
						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'post-contents/content', 'page' ); ?>

							<?php if ( eyewear_option( 'page-comment', FALSE, TRUE ) ) : ?>
								<?php
								// If comments are open or we have at least one comment, load up the comment template
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
								?>
							<?php endif; ?>
						<?php endwhile; // end of the loop. ?>
					</main>
				</div>
				<!-- #primary -->

				<div class="col-md-3 col-md-pull-9 col-sm-4 col-sm-pull-8">
					<div class="primary-sidebar widget-area page-left-sidebar" role="complementary">
						<?php dynamic_sidebar( 'hippo-page-sidebar' ); ?>
					</div>
				</div>
			</div>
			<!-- .row -->
		</div>
	</section>
<?php get_footer();