<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );
?>
<article class="no-results not-found blog-post-wrapper blog-post-default">

	<div class="content-wrapper">
		<header class="entry-header">
			<h2 class="entry-title"><?php esc_html_e( 'Nothing Found', 'eyewear' ); ?></h2>
		</header>
		<!-- .page-header -->

		<div class="entry-content">
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'eyewear' ), array(
						'a' => array(
							'href'  => array(),
							'title' => array(),
							'class' => array()
						)
					) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

			<?php elseif ( is_search() ) : ?>
				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'eyewear' ); ?></p>
				<?php get_search_form(); ?>
			<?php else : ?>
				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'eyewear' ); ?></p>
				<?php get_search_form(); ?>
			<?php endif; ?>
		</div>
		<!-- .page-content -->
	</div>
</article><!-- .no-results -->