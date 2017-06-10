<div class="hippo-share-button">
	<div class="social">
		<ul class="list-inline">
			<?php do_action( 'eyewear_shop_share_button_start' ); ?>

			<?php if ( eyewear_option( 'shop-share-button', 'facebook', TRUE ) ) : ?>
				<!--Facebook-->
				<li><a class="btn-social facebook"
				       href="//www.facebook.com/sharer.php?u=<?php echo rawurlencode( get_the_permalink() ) ?>&amp;t=<?php echo rawurlencode( get_the_title() ) ?>"
				       title="<?php esc_html_e( 'Share this on Facebook', 'eyewear' ); ?>"
				       target="_blank"><i class="fa fa-facebook"></i></a></li>
			<?php endif; ?>

			<?php if ( eyewear_option( 'shop-share-button', 'twitter', TRUE ) ) : ?>
				<!--Twitter-->
				<li><a class="btn-social twitter"
				       href="//twitter.com/home?status=<?php echo rawurlencode( sprintf( esc_html__( 'Reading: %s', 'eyewear' ), get_the_permalink() ) ) ?>"
				       title="<?php esc_html_e( 'Share this on Twitter', 'eyewear' ); ?>"
				       target="_blank"><i class="fa fa-twitter"></i></a></li>
			<?php endif; ?>

			<?php if ( eyewear_option( 'shop-share-button', 'google', TRUE ) ) : ?>
				<!--Google Plus-->
				<li><a class="btn-social google-plus"
				       href="//plus.google.com/share?url=<?php echo rawurlencode( get_the_permalink() ) ?>"
				       title="<?php esc_html_e( 'Share this on Google+', 'eyewear' ); ?>"
				       target="_blank"><i class="fa fa-google-plus"></i></a></li>
			<?php endif; ?>

			<?php if ( eyewear_option( 'shop-share-button', 'linkedin', TRUE ) ) : ?>
				<!--Linkedin-->
				<li><a class="btn-social linkedin"
				       href="//www.linkedin.com/shareArticle?url=<?php echo rawurlencode( get_the_permalink() ) ?>&amp;mini=true&amp;title=<?php echo rawurlencode( get_the_title() ) ?>"
				       title="<?php esc_html_e( 'Share this on Linkedin', 'eyewear' ); ?>"
				       target="_blank"><i class="fa fa-linkedin"></i></a></li>
			<?php endif; ?>

			<?php do_action( 'eyewear_shop_share_button_end' ); ?>
		</ul>
	</div>
</div>