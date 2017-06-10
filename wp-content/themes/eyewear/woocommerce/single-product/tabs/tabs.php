<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );


	/**
	 * Filter tabs and allow third parties to add their own
	 *
	 * Each tab is an array containing title, callback and priority.
	 * @see woocommerce_default_product_tabs()
	 */
	$tabs = apply_filters( 'woocommerce_product_tabs', array() );

	if ( ! empty( $tabs ) ) : ?>


		<div class="hippo-single-product-tabs-wrapper">

			<?php foreach ( $tabs as $key => $tab ) : ?>
				<div
					class="hippo-single-product-tab-wrapper hippo-single-product-tab-<?php echo esc_attr( $key ); ?>-wrapper">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div
									class="entry-content hippo-single-product-tab hippo-single-product-tab-<?php echo esc_attr( $key ); ?>"
									id="tab-<?php echo esc_attr( $key ); ?>">
									<?php call_user_func( $tab[ 'callback' ], $key, $tab ); ?>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- .hippo-single-product-tab-<?php echo esc_attr( $key ); ?>-wrapper -->
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
