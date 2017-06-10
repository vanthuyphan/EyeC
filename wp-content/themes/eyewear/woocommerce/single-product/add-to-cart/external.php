<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );
?>

<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

<p class="external-cart">
	<a href="<?php echo esc_url( $product_url ); ?>" rel="nofollow" class="external-btn single_add_to_cart_button button alt"><i class="zmdi zmdi-shopping-cart-plus"></i> <?php echo esc_html( $button_text ); ?></a>
</p>

<?php do_action( 'woocommerce_after_add_to_cart_button' );