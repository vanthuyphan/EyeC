<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	global $product, $woocommerce_loop;

	$upsells = $product->get_upsells();

	if ( sizeof( $upsells ) == 0 ) {
		return;
	}

	$meta_query = WC()->query->get_meta_query();

	$args = array(
		'post_type'           => 'product',
		'ignore_sticky_posts' => 1,
		'no_found_rows'       => 1,
		'posts_per_page'      => $posts_per_page,
		'orderby'             => $orderby,
		'post__in'            => $upsells,
		'post__not_in'        => array( $product->id ),
		'meta_query'          => $meta_query
	);

	$products = new WP_Query( $args );

	$woocommerce_loop[ 'columns' ] = $columns;

	if ( $products->have_posts() ) : ?>

		<div class="upsells products hippo-single-upsells-product-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2><?php esc_html_e( 'You may also like&hellip;', 'eyewear' ) ?></h2>
					</div>
				</div>

				<?php
					woocommerce_product_loop_start();
					eyewear_unset_woocommerce_single_product();
					$GLOBALS[ 'is_eyewear_upsell_products' ] = TRUE;
				?>
				<div class="row">
					<?php while ( $products->have_posts() ) : $products->the_post(); ?>
						<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; // end of the loop. ?>
				</div>
				<?php
					$GLOBALS[ 'is_eyewear_upsell_products' ] = FALSE;
					woocommerce_product_loop_end();
				?>
			</div>
		</div>

	<?php endif;

	wp_reset_postdata();
