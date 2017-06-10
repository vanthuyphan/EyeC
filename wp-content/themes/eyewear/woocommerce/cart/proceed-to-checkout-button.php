<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	printf(
		'<a href="%s" class="%s">%s</a>',
		esc_url( WC()->cart->get_checkout_url() ),
		'checkout-button button alt wc-forward',
		esc_html__( 'Checkout Now', 'eyewear' )
	);
