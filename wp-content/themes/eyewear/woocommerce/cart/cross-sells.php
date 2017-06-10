<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	global $product, $woocommerce_loop;

	$crosssells = WC()->cart->get_cross_sells();

	if ( sizeof( $crosssells ) == 0 ) {
		return;
	}

	$meta_query = WC()->query->get_meta_query();

	$args = array(
		'post_type'           => 'product',
		'ignore_sticky_posts' => 1,
		'no_found_rows'       => 1,
		'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', $posts_per_page ),
		'orderby'             => $orderby,
		'post__in'            => $crosssells,
		'meta_query'          => $meta_query
	);

	$products = new WP_Query( $args );

	$woocommerce_loop[ 'columns' ] = apply_filters( 'woocommerce_cross_sells_columns', $columns );

	if ( $products->have_posts() ) :


		$column_class = 'col-xs-12';

		if ( count( $crosssells ) <= 1 ) {
			$column_class = 'col-lg-4 col-md-4 col-xs-12';
		} elseif ( count( $crosssells ) <= 2 ) {
			$column_class = 'col-lg-6 col-xs-12';
		} elseif ( count( $crosssells ) <= 3 ) {
			$column_class = 'col-xs-12';
		}

		?>
		<div class="row">
			<div class="col-xs-12<?php //echo esc_attr( $column_class )
			?>">
				<div class="cross-sells products">

					<h2><?php esc_html_e( 'You may be interested in&hellip;', 'eyewear' ) ?></h2>

					<div class="row">
						<?php
							woocommerce_product_loop_start();
							eyewear_unset_woocommerce_single_product();
						?>

						<?php while ( $products->have_posts() ) : $products->the_post(); ?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php endwhile; // end of the loop.
						?>

						<?php woocommerce_product_loop_end(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif;

	wp_reset_query();