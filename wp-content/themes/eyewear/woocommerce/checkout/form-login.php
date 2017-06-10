<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );
?>

<?php if ( ! is_user_logged_in() ) : ?>
	<div class="col-md-6 login-form-wrapper">
<?php endif; ?>


<?php if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) :
	return;
endif;

	$info_message = apply_filters( 'woocommerce_checkout_login_message', esc_html__( 'Returning customer?', 'eyewear' ) );
	$info_message .= ' <a href="#" class="showlogin">' . esc_html__( 'Click here to login', 'eyewear' ) . '</a>';
	wc_print_notice( $info_message, 'notice' );
?>

<?php
	woocommerce_login_form(
		array(
			'message'  => esc_html__( 'If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.', 'eyewear' ),
			'redirect' => wc_get_page_permalink( 'checkout' ),
			'hidden'   => TRUE
		)
	);
?>

<?php if ( ! is_user_logged_in() ) : ?>
	</div>
<?php endif;