<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	$attributes = vc_map_get_attributes( $this->getShortcode(), $atts );


	ob_start();

	$link     = vc_build_link( $attributes[ 'link' ] );
	$a_href   = esc_url( $link[ 'url' ] );
	$a_title  = esc_html( $link[ 'title' ] );
	$a_target = esc_attr( trim( $link[ 'target' ] ) );
	global $_eyewear_shortcode_home_carousels;

?>
	<div class="item <?php echo esc_attr( $attributes[ 'active_item' ] ); ?>">
		<?php if ( $attributes[ 'images' ] ) : ?>
			<?php $image_attributes = wp_get_attachment_image_src( $attributes[ 'images' ], 'full' ); ?>
			<img src="<?php echo esc_url( $image_attributes[ 0 ] ); ?>"
			     alt="<?php echo esc_attr( $attributes[ 'title' ] ); ?>"/>
		<?php endif; ?>

		<div class="carousel-text">

			<?php if ( $attributes[ 'title' ] ) : ?>
				<h2 class="animated <?php echo esc_attr( $attributes[ 'title_animation' ] . ' ' . $attributes[ 'title_animation_delay' ] ); ?> carousel-subtitle"><?php echo esc_html( $attributes[ 'title' ] ); ?></h2>
			<?php endif; ?>

			<?php if ( $attributes[ 'details' ] ) : ?>
				<span
					class="animated <?php echo esc_attr( $attributes[ 'details_animation' ] . ' ' . $attributes[ 'details_animation_delay' ] ); ?> carousel-details"><?php echo esc_html( $attributes[ 'details' ] ); ?></span>
			<?php endif; ?>


			<?php if ( $attributes[ 'link_visibility' ] == 'visible' ) : ?>

				<a class="animated <?php echo esc_attr( $attributes[ 'link_animation' ] . ' ' . $attributes[ 'link_animation_delay' ] ); ?>"
				   href="<?php echo esc_url( $a_href ); ?>"
				   target="<?php echo esc_attr( $a_target ) ?>"><?php echo esc_html( $attributes[ 'link_text' ] ); ?> </a>
			<?php endif; ?>
		</div>
		<!-- /.carousel-text -->
	</div><!-- .item -->
<?php
	$_eyewear_shortcode_home_carousels ++;
	echo $this->endBlockComment( $this->getShortcode() );
	echo ob_get_clean();