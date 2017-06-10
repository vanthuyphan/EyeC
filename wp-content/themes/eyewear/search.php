<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	get_header(); ?>

	<section id="content" class="site-content blog-section search-section">
		<div class="container">
			<div class="row">
				<div class="row">
					<?php
						$layout = eyewear_option( 'blog-layout', FALSE, 'sidebar-right' );

						$grid_class = 'col-md-12';

						if ( $layout == 'sidebar-right' ) :

							$grid_class = ( is_active_sidebar( 'hippo-blog-sidebar' ) )
								? 'col-md-9 col-sm-8'
								: $grid_class;

						elseif ( $layout == 'sidebar-left' ) :
							$grid_class = ( is_active_sidebar( 'hippo-blog-sidebar' ) )
								? 'col-md-9 col-md-push-3 col-sm-8 col-sm-push-4'
								: $grid_class;
						endif;
					?>


					<div id="primary" class="content-area <?php echo esc_attr( $grid_class ); ?>">

						<main id="main" class="site-main" role="main">

							<?php if ( have_posts() ) : ?>

								<?php /* Start the Loop */ ?>
								<?php while ( have_posts() ) : the_post(); ?>

									<?php
									/* Include the Post-Format-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
									 */
									get_template_part( 'post-contents/content', get_post_format() );
									?>

								<?php endwhile; ?>

								<div class="pagination-wrap clearfix">
									<?php
										// Posts Pagination
										if ( eyewear_option( 'blog-page-nav', FALSE, TRUE ) ) :
											eyewear_posts_pagination();
										else :
											eyewear_posts_navigation();
										endif; ?>
								</div>

							<?php else : ?>

								<?php get_template_part( 'post-contents/content', 'none' ); ?>

							<?php endif; ?>

						</main>
						<!-- #main -->
					</div>
					<!-- .col -->
					<?php get_sidebar(); ?>
				</div>
				<!-- .row -->
			</div>
			<!-- .container -->
	</section> <!-- .blog-section -->

<?php get_footer();