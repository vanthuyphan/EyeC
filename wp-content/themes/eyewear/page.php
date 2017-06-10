<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	get_header(); ?>
	<section id="content" class="site-content page-section default-page">
		<div class="container">
			<div class="row">
				<?php
					$layout     = eyewear_option( 'page-layout', FALSE, 'sidebar-right' );
					$grid_class = 'col-md-12';

					if ( $layout == 'sidebar-right' ) :
						$grid_class = ( is_active_sidebar( 'hippo-page-sidebar' ) )
							? 'col-md-9 col-sm-8'
							: $grid_class;

					elseif ( $layout == 'sidebar-left' ) :
						$grid_class = ( is_active_sidebar( 'hippo-page-sidebar' ) )
							? 'col-md-9 col-md-push-3 col-sm-8 col-sm-push-4'
							: $grid_class;
					endif;
				?>

				<div id="primary" class="content-area <?php echo esc_attr( $grid_class ); ?>">
					<main id="main" class="site-main" role="main">
						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'post-contents/content', 'page' ); ?>

							<?php if ( eyewear_option( 'page-comment', FALSE, comments_open() ) ) : ?>
								<?php
								// If comments are open or we have at least one comment, load up the comment template
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
								?>

							<?php endif; // hippo_option( 'page-comment', FALSE, TRUE ) ?>

						<?php endwhile; // end of the loop. ?>
					</main>
				</div>
				<!-- .col-* -->
				<?php get_sidebar( 'page' ); ?>
			</div>
			<!-- .row -->
		</div>
		<!-- .container -->
	</section> <!-- section -->
<?php get_footer(); ?>