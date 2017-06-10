<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	if ( function_exists( 'woocommerce_mini_cart' ) ) :

		global $woocommerce;
		?>
		<div id="mini-cart" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-header">
					<?php if ( eyewear_option( 'minicart-title-show', FALSE, TRUE ) ) : ?>
						<h4 class="modal-title"><?php echo esc_html( eyewear_option( 'mini-cart-title', FALSE, esc_html__( 'Cart', 'eyewear' ) ) ); ?></h4>
					<?php endif; ?>
					<a class="close" data-dismiss="modal" aria-label="<?php esc_html_e( 'Close', 'eyewear' ) ?>"></a>
				</div>

				<div class="modal-content woocommerce mini-cart-details cart-details">
					<?php woocommerce_mini_cart() ?>
				</div>
			</div>
			<!-- .modal-dialog -->
		</div> <!-- .modal -->
	<?php endif;