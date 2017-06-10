<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( "blog-post-wrapper blog-post-default" ); ?>>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<div class="entry-meta">
			<?php eyewear_entry_meta() ?>
		</div>
		<!-- .entry-meta -->

		<?php if ( has_post_thumbnail() || eyewear_post_thumbnail( TRUE ) ) : ?>
			<a href="<?php the_permalink(); ?>"><?php eyewear_post_thumbnail(); ?></a>
		<?php endif; ?>

	</header>
	<!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( '<span class="read-more">' . esc_html__( 'Read More', 'eyewear' ) . '</span>' );
			eyewear_link_pages();
		?>
	</div>
	<!-- .entry-content -->

	<footer class="entry-footer">
		<?php eyewear_entry_footer(); ?>
	</footer>
	<!-- .entry-footer -->

</article><!-- #post-## -->