<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	if ( ! WC()->cart->coupons_enabled() ) :
		return;
	endif; ?>

<?php if ( is_user_logged_in() ) : ?>
<div class="col-md-12 coupon-form-wrapper">
	<?php else : ?>
	<div class="col-md-6 coupon-form-wrapper">
		<?php endif; ?>

		<?php $info_message = apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon?', 'eyewear' ) . ' <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', 'eyewear' ) . '</a>' );
			wc_print_notice( $info_message, 'notice' );
		?>

		<form class="checkout_coupon" method="post" style="display:none">

			<div class="input-group">
				<input type="text" name="coupon_code" class="form-control"
				       placeholder="<?php esc_attr_e( 'Coupon code', 'eyewear' ); ?>" id="coupon_code" value=""/>

			<span class="input-group-btn">
	            <input type="submit" class="button" name="apply_coupon"
	                   value="<?php esc_attr_e( 'Apply Coupon', 'eyewear' ); ?>"/>
	         </span>
			</div>
			<div class="clear"></div>
		</form>
	</div>