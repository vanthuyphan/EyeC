<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );
?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

	<div class="widget_shopping_cart_content">

		<ul class="cart_list product_list_widget">

			<?php if ( ! WC()->cart->is_empty() ) :

				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item[ 'data' ], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item[ 'product_id' ], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item[ 'quantity' ] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', TRUE, $cart_item, $cart_item_key ) ) :

						$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
						$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'hippo-mini-cart-thumb', array( 'class' => 'attachment-shop_thumbnail hippo-mini-cart-thumb' ) ), $cart_item, $cart_item_key );
						$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
						<li class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">

							<?php if ( ! $_product->is_visible() ) : ?>
								<?php echo str_replace( array(
									                        'http:',
									                        'https:'
								                        ), '', $thumbnail ); ?>

								<?php echo str_replace( array(
									                        'http:',
									                        'https:'
								                        ), '', $product_name ); ?>

								<div class="mini-cart-product-name-wrapper">
									<?php echo WC()->cart->get_item_data( $cart_item ); ?>
									<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item[ 'quantity' ], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>

								</div>

							<?php else : ?>
								<a class="product-thumb"
								   href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>">
									<?php echo str_replace( array(
										                        'http:',
										                        'https:'
									                        ), '', $thumbnail ); ?>
								</a>

								<div class="mini-cart-product-name-wrapper">

									<a class="product-name"
									   href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>">
										<?php echo str_replace( array(
											                        'http:',
											                        'https:'
										                        ), '', $product_name ); ?>
									</a>

									<?php echo WC()->cart->get_item_data( $cart_item ); ?>
									<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item[ 'quantity' ], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>

								</div>

							<?php endif; ?>


							<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="remove hippo-remove-from-mini-cart-ajax" data-item_key="%s" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
									esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
									esc_attr( $cart_item_key ),
									esc_html__( 'Remove this item', 'eyewear' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
							?>
						</li>
						<?php
					endif;
				endforeach;
			else : ?>

				<li class="empty"><?php esc_html_e( 'No products in the cart', 'eyewear' ); ?></li>

			<?php endif; ?>

		</ul>
		<!-- end product list -->

		<?php if ( ! WC()->cart->is_empty() ) : ?>

			<div class="total">
				<strong><?php esc_html_e( 'Subtotal', 'eyewear' ); ?></strong> <?php echo WC()->cart->get_cart_subtotal(); ?>
			</div>

			<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

			<p class="buttons">
				<a href="<?php echo WC()->cart->get_cart_url(); ?>"
				   class="button viewcart wc-forward"><?php esc_html_e( 'View Cart', 'eyewear' ); ?></a>
				<a href="<?php echo WC()->cart->get_checkout_url(); ?>"
				   class="button checkout wc-forward"><?php esc_html_e( 'Checkout', 'eyewear' ); ?></a>
			</p>

		<?php endif; ?>

	</div> <!-- DONOT REMOVE THIS OTHERWISE MINICART REMOVE / ADD WILL NOT WORK -->
<?php do_action( 'woocommerce_after_mini_cart' );
