<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post-wrapper blog-post-default' ); ?>>

		<header class="entry-header">
			<!-- <h2 class="entry-title"><?php //the_title(); ?></h2> -->
			<?php if ( has_post_thumbnail() || eyewear_post_thumbnail( TRUE ) ) : ?>
				<?php eyewear_post_thumbnail(); ?>
			<?php endif; ?>
		</header>
		<!-- .entry-header -->


		<div class="entry-content">
			<?php
				the_content( '<span class="btn btn-default btn-primary readmore">' . esc_html__( 'Read More', 'eyewear' ) . '</span>' );
				eyewear_link_pages();
			?>
		</div>
		<!-- .entry-content -->

		<footer class="entry-footer">
			<?php eyewear_entry_footer(); ?>
		</footer>
		<!-- .entry-footer -->


	</article> <!-- #post-## -->
	<div class="clearfix"></div>


<?php if ( is_single() ) :

	if ( get_the_author_meta( 'description' ) ) :
		get_template_part( 'author-bio' );
	endif;

	if ( eyewear_option( 'post-navigation', FALSE, TRUE ) ) :
		eyewear_post_navigation();
	endif;
endif;