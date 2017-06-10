<?php


	defined( 'ABSPATH' ) or die( 'Keep Silent' );


	$attributes = vc_map_get_attributes( $this->getShortcode(), $atts );


	$term_ids = explode( ',', $attributes[ 'category_id' ] );

	ob_start();

	foreach ( $term_ids as $term_id ) :

		$term       = get_term( $term_id, 'product_cat' );
		$img_id     = get_woocommerce_term_meta( $term_id, 'thumbnail_id', TRUE );
		$img_src    = wp_get_attachment_image_src( $img_id, 'eyewear-product-category-thumbnail' );
		$css_styles = sprintf( 'background-image:url(%s)', esc_url( $img_src[ 0 ] ) );
		?>
		<?php if ( $img_id ) : ?>
		<article class="flex-box product-category-block <?php echo esc_attr( $attributes[ 'el_class' ] ); ?>"
		         style="<?php echo esc_attr( $css_styles ) ?>">

			<a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="bg-overlay"></a>

			<div class="entry-footer center-block">
				<h2><?php echo esc_html( $term->name ); ?></h2> <br>
				<a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php esc_html_e( 'Find out More', 'eyewear' ); ?>
					<i class="zmdi zmdi-long-arrow-right"></i>
				</a>
			</div>
		</article>
	<?php endif; ?>
	<?php endforeach;

	echo $this->endBlockComment( $this->getShortcode() );

	echo ob_get_clean();