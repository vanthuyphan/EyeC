<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	global $product, $woocommerce_loop;

	if ( empty( $product ) || ! $product->exists() ) {
		return;
	}

	$related = $product->get_related( eyewear_option( 'shop-related-limit', FALSE, 4 ) );

	if ( sizeof( $related ) == 0 ) {
		return;
	}
	$args = apply_filters( 'woocommerce_related_products_args', array(
		'post_type'           => 'product',
		'ignore_sticky_posts' => 1,
		'no_found_rows'       => 1,
		'posts_per_page'      => $posts_per_page,
		'orderby'             => $orderby,
		'post__in'            => $related,
		'post__not_in'        => array( $product->id )
	) );

	$products = new WP_Query( $args );

	$woocommerce_loop[ 'columns' ] = $columns;

	if ( $products->have_posts() ) : ?>

		<div class="related products hippo-single-related-product-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2 class="related-title"><?php esc_html_e( 'Related Products', 'eyewear' ); ?></h2>
					</div>
				</div>
				<?php
					woocommerce_product_loop_start();
					eyewear_unset_woocommerce_single_product();
					$GLOBALS[ 'is_eyewear_related_products' ] = TRUE;
				?>
				<div class="row">
					<?php while ( $products->have_posts() ) : $products->the_post(); ?>
						<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; // end of the loop. ?>
				</div>
				<?php
					$GLOBALS[ 'is_eyewear_related_products' ] = FALSE;
					woocommerce_product_loop_end(); ?>
			</div>
		</div>
	<?php endif;
	wp_reset_postdata();