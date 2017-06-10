<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	global $post, $product, $woocommerce_loop;

	// Store loop count we're currently on
	if ( empty( $woocommerce_loop[ 'loop' ] ) ) :
		$woocommerce_loop[ 'loop' ] = 0;
	endif;

	// Store column count for displaying the grid
	if ( empty( $woocommerce_loop[ 'columns' ] ) ) :
		$woocommerce_loop[ 'columns' ] = apply_filters( 'loop_shop_columns', 4 );
	endif;

	// Ensure visibility
	if ( ! $product || ! $product->is_visible() ) :
		return;
	endif;

	$product_image = get_the_post_thumbnail( get_the_ID(), "eyewear-product-thumbnail" );

	if ( ! $product_image ):
		$default_sizes = eyewear_get_image_size( "eyewear-product-thumbnail" );
		$product_image = sprintf( '<img src="%s" alt="%s" width="%s" height="%s" />', esc_url( wc_placeholder_img_src() ), esc_html( get_the_title() ), $default_sizes[ 'width' ], $default_sizes[ 'height' ] );
	endif;

	$css_classes   = array();
	$css_classes[] = 'product-block';
?>

<div class="<?php echo esc_attr( eyewear_wc_product_column_class() ) ?>">

	<div class="product-block-wrapper">
		<div class="product-details">
			<div class="entry-header">
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
			</div>
			<!-- .entry-header -->

			<div class="product-price">
				<?php echo $product->get_price_html(); ?>
			</div>
			<!-- .product-price -->
		</div>
		<!-- .product-details -->
		<a href="<?php the_permalink(); ?>" class="<?php echo implode( ' ', $css_classes ) ?>">

			<?php
				if ( $product->is_type( 'variable' ) ) {

					?>

					<ul class="hippo-variation-product-slider">
						<?php foreach ( $product->get_available_variations() as $variation ): ?>
							<li>
								<img
									sizes="<?php echo esc_attr( $variation[ 'image_sizes' ] ) ?>"
									srcset="<?php echo esc_attr( $variation[ 'image_srcset' ] ) ?>"
									src="<?php echo esc_attr( $variation[ 'image_src' ] ) ?>"
									alt="<?php echo esc_attr( $variation[ 'image_title' ] ) ?> ?>">
							</li>
						<?php endforeach; ?>

					</ul>

					<?php
				} else {
					echo $product_image;
				}
			?>

			<?php
				$stock_status = $product->stock_status;
				if ( $stock_status == 'outofstock' ) : ?>
					<span class="out-of-stock"><?php esc_html_e( 'Out of stock', 'eyewear' ); ?></span>
				<?php endif; ?>

			<?php if ( $product->is_on_sale() ) : ?>
				<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'eyewear' ) . '</span>', $post, $product ); ?>
			<?php endif; ?>
		</a>

		<?php if ( $product->is_type( 'variable' ) ) : ?>
			<ul class="hippo-variation-product-slider-controller text-center">
				<?php
					$variation_attributes = $product->get_variation_attributes();
					$slider_attribute     = eyewear_option( 'variation-attribute' );

					if ( isset( $variation_attributes[ wc_attribute_taxonomy_name( $slider_attribute ) ] ) ) :

						$slider_variation_attributes = $variation_attributes[ wc_attribute_taxonomy_name( $slider_attribute ) ];
						$attribute                   = eyewear_get_wc_attribute_taxonomy( $slider_attribute );
						$taxonomy                    = wc_attribute_taxonomy_name( $slider_attribute );
						//$attribute_items             = wc_get_product_terms( $product->id, wc_attribute_taxonomy_name( $slider_attribute ), array( 'fields' => 'all' ) );
						foreach ( $slider_variation_attributes as $slider_variation_attribute ):

							$term  = get_term_by( 'slug', $slider_variation_attribute, $taxonomy );

							$style = '';
							if ( $attribute->attribute_type == 'color' ) :
								$get_term_meta = hippo_plugin_get_term_meta( $term->term_id, 'product_attribute_image', TRUE );
								$style         = "background-color:" . esc_attr( $get_term_meta );
							endif;
							?>
							<li class="<?php echo ( $index == 0 ) ? 'current' : '' ?>"
							    data-toggle="tooltip" data-placement="top"
							    style="<?php esc_attr( $style ) ?>"
							    title="<?php echo esc_html( $term->name ) ?>">

								<?php
									if ( $attribute->attribute_type == 'image' ) :
										$get_term_meta = hippo_plugin_get_term_meta( $term->term_id, 'product_attribute_image', TRUE );
										echo wp_get_attachment_image( $get_term_meta, 'full' );
									endif;
								?>
							</li>
							<?php

						endforeach;
					endif; ?>
			</ul>
		<?php endif; ?>
		<!-- .product-block -->
	</div>
	<!-- .product-block-wrapper -->
</div>