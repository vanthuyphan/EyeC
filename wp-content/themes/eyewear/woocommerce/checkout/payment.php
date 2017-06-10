<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );
?>

<?php if ( ! is_ajax() ) : ?>
	<?php do_action( 'woocommerce_review_order_before_payment' ); ?>
<?php endif; ?>

	<div id="payment" class="woocommerce-checkout-payment">
		<?php if ( WC()->cart->needs_payment() ) : ?>
			<ul class="payment_methods methods">
				<?php
					if ( ! empty( $available_gateways ) ) :
						foreach ( $available_gateways as $gateway ) :
							wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
						endforeach;
					else :
						if ( ! WC()->customer->get_country() ) :
							$no_gateways_message = esc_html__( 'Please fill in your details above to see available payment methods.', 'eyewear' );
						else :
							$no_gateways_message = esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you need assistance or wish to make alternate arrangements.', 'eyewear' );
						endif;

						echo '<li>' . apply_filters( 'woocommerce_no_available_payment_methods_message', $no_gateways_message ) . '</li>';
					endif;
				?>
			</ul>
		<?php endif; ?>

		<div class="form-row place-order">

			<noscript><?php esc_html_e( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the "Update Totals" button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'eyewear' ); ?>
				<br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals"
				            value="<?php esc_attr_e( 'Update totals', 'eyewear' ); ?>"/></noscript>

			<?php wp_nonce_field( 'woocommerce-process_checkout' ); ?>

			<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

			<?php echo apply_filters( 'woocommerce_order_button_html', '<input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '" />' ); ?>

			<?php if ( wc_get_page_id( 'terms' ) > 0 && apply_filters( 'woocommerce_checkout_show_terms', TRUE ) ) : ?>
				<p class="form-row terms hippo-term-condition">
					<label for="terms"
					       class="checkbox"><?php printf( wp_kses( __( 'I&rsquo;ve read and accept the <a href="%s" target="_blank">terms &amp; conditions</a>', 'eyewear' ), array(
							'a' => array(
								'href'   => array(),
								'target' => array()
							)
						) ), esc_url( wc_get_page_permalink( 'terms' ) ) ); ?></label>
					<input type="checkbox" class="input-checkbox"
					       name="terms" <?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST[ 'terms' ] ) ), TRUE ); ?>
					       id="terms"/>
				</p>
			<?php endif; ?>

			<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

		</div>

	</div>

<?php if ( ! is_ajax() ) : ?>
	<?php do_action( 'woocommerce_review_order_after_payment' ); ?>
<?php endif;