<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	wc_print_notices(); ?>

<div class="row">

	<?php do_action( 'woocommerce_before_checkout_form', $checkout );

		// If checkout registration is disabled and not logged in, the user cannot checkout
		if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
			echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', esc_html__( 'You must be logged in to checkout.', 'eyewear' ) );

			return;
		}

		// filter hook for include new pages inside the payment method
		$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

	<div class="clearfix"></div>

	<form name="checkout" method="post" class="checkout woocommerce-checkout"
	      action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">

		<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>
			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
			<div class="col-md-6" id="customer_details">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>

				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
		<?php endif; ?>

		<div class="col-md-6">
			<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'eyewear' ); ?></h3>

			<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

			<div id="order_review" class="woocommerce-checkout-review-order">
				<?php do_action( 'woocommerce_checkout_order_review' ); ?>
			</div>

			<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
		</div>
	</form>
	<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
</div>