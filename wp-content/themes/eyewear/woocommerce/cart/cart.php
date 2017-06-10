<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	wc_print_notices();

	do_action( 'woocommerce_before_cart' ); ?>

	<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

		<div class="hippo-cart-wrapper">
			<div class="row">
				<div class="col-md-8">


					<?php do_action( 'woocommerce_before_cart_table' ); ?>

					<table class="shop_table cart table" cellspacing="0">
						<thead>
						<tr>
							<th class="product-name"><?php esc_html_e( 'Product', 'eyewear' ); ?></th>
							<th class="product-price"><?php esc_html_e( 'Price', 'eyewear' ); ?></th>
							<th class="product-quantity"><?php esc_html_e( 'Quantity', 'eyewear' ); ?></th>
							<th class="product-subtotal"><?php esc_html_e( 'Total', 'eyewear' ); ?></th>
							<th class="product-remove">&nbsp;</th>
						</tr>
						</thead>
						<tbody>
						<?php do_action( 'woocommerce_before_cart_contents' ); ?>

						<?php
							foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
								$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item[ 'data' ], $cart_item, $cart_item_key );
								$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item[ 'product_id' ], $cart_item, $cart_item_key );

								if ( $_product && $_product->exists() && $cart_item[ 'quantity' ] > 0 && apply_filters( 'woocommerce_cart_item_visible', TRUE, $cart_item, $cart_item_key ) ) {
									?>
									<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">


										<td class="product-name clearfix"
										    data-label="<?php esc_html_e( 'Product', 'eyewear' ); ?>">
											<div class="item-thumb">
												<?php
													$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

													if ( ! $_product->is_visible() ) {
														echo $thumbnail;
													} else {
														printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $thumbnail );
													}
												?>
											</div>

											<div class="item-info">
												<?php
													if ( ! $_product->is_visible() ) {
														echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
													} else {
														echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s </a>', esc_url( $_product->get_permalink( $cart_item ) ), $_product->get_title() ), $cart_item, $cart_item_key );
													}

													// Meta data
													echo WC()->cart->get_item_data( $cart_item );

													// Backorder notification
													if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item[ 'quantity' ] ) ) {
														echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'eyewear' ) . '</p>';
													}
												?>
											</div>

										</td>

										<td class="product-price"
										    data-label="<?php esc_html_e( 'Price', 'eyewear' ); ?>">
											<?php
												echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
											?>
										</td>

										<td class="product-quantity"
										    data-label="<?php esc_html_e( 'Quantity', 'eyewear' ); ?>">
											<?php
												if ( $_product->is_sold_individually() ) {
													$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
												} else {
													$product_quantity = woocommerce_quantity_input( array(
														                                                'input_name'  => "cart[{$cart_item_key}][qty]",
														                                                'input_value' => $cart_item[ 'quantity' ],
														                                                'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
														                                                'min_value'   => '0'
													                                                ), $_product, FALSE );
												}

												echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
											?>
										</td>

										<td class="product-subtotal"
										    data-label="<?php esc_html_e( 'Total', 'eyewear' ); ?>">
											<?php
												echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item[ 'quantity' ] ), $cart_item, $cart_item_key );
											?>
										</td>

										<td class="product-remove">
											<?php
												echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
													'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s"><i class="zmdi zmdi-close zmdi-hc-fw"></i></a>',
													esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
													__( 'Remove this item', 'eyewear' ),
													esc_attr( $product_id ),
													esc_attr( $_product->get_sku() )
												), $cart_item_key );
											?>
										</td>
									</tr>
									<?php
								}
							}

							do_action( 'woocommerce_cart_contents' );
						?>
						<tr>
							<td colspan="6" class="actions">


								<?php if ( WC()->cart->coupons_enabled() ) { ?>
									<div class="coupon input-field clearfix">

                            <span>
                                <input type="text"
                                       name="coupon_code"
                                       class="form-control input-text"
                                       id="coupon_code"
                                       value=""
                                       placeholder="<?php esc_attr_e( 'Have a coupon code ?', 'eyewear' ); ?>"
                                       onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = '<?php esc_attr_e( 'Have a coupon code ?', 'eyewear' ); ?>'"/>
                            </span>

									</div>

									<div class="cuppon-button">
										<input type="submit" class="button" name="apply_coupon"
										       value="<?php esc_attr_e( 'Apply Coupon', 'eyewear' ); ?>"/>
									</div>
									<?php do_action( 'woocommerce_cart_coupon' ); ?>
								<?php } ?>

								<div class="update-cart-button">
									<?php do_action( 'woocommerce_cart_actions' ); ?>
									<?php wp_nonce_field( 'woocommerce-cart' ); ?>
								</div>
							</td>
						</tr>

						<?php do_action( 'woocommerce_after_cart_contents' ); ?>
						</tbody>
					</table>

					<?php do_action( 'woocommerce_after_cart_table' ); ?>


				</div>
				<div class="col-md-4">
					<div class="row">
						<?php
							/**
							 * eyewear_cart_totals hook
							 *
							 * @hooked woocommerce_cart_totals - 999
							 */
							do_action( 'eyewear_cart_totals' ); ?>
					</div>
				</div>
			</div>
		</div>

		<div class="cart-collaterals">

			<?php
				/**
				 * woocommerce_cart_collaterals hook
				 * @hooked woocommerce_cross_sell_display - 10
				 */

				do_action( 'woocommerce_cart_collaterals' ); ?>

		</div>
	</form>
<?php do_action( 'woocommerce_after_cart' );