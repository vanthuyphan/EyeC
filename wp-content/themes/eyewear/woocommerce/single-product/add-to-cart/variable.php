<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	global $product;

	$attribute_keys = array_keys( $attributes );

	do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="variations_form cart" method="post" enctype='multipart/form-data'
	      data-product_id="<?php echo absint( $product->id ); ?>"
	      data-product_variations="<?php echo esc_attr( wp_json_encode( $available_variations ) ) ?>">
		<?php do_action( 'woocommerce_before_variations_form' ); ?>

		<?php if ( empty( $available_variations ) && FALSE !== $available_variations ) : ?>
			<p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'eyewear' ); ?></p>
		<?php else : ?>
			<table class="variations">
				<tbody>
				<?php
					foreach ( $attributes as $attribute_name => $options ) : ?>
						<tr>
							<td class="label"><label
									for="<?php echo sanitize_title( $attribute_name ) . $product->id; ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label>
							</td>
							<td class="value">
								<?php

									$attribute = eyewear_get_wc_attribute_taxonomy( $attribute_name );

									if ( isset( $attribute->attribute_type ) and $attribute->attribute_type == 'color' ) :

										$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) : $product->get_variation_default_attribute( $attribute_name );

										eyewear_wc_color_variation_attribute_options( array(
											                                              'options'   => $options,
											                                              'attribute' => $attribute_name,
											                                              'product'   => $product,
											                                              'selected'  => $selected
										                                              ) );
									//echo end( $attribute_keys ) === $attribute_name ? '<a class="reset_variations" href="#">' . esc_html__( 'Clear selection', 'eyewear' ) . '</a>' : '';

									elseif ( isset( $attribute->attribute_type ) and $attribute->attribute_type == 'image' ) :

										$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) : $product->get_variation_default_attribute( $attribute_name );

										eyewear_wc_image_variation_attribute_options( array(
											                                              'options'   => $options,
											                                              'attribute' => $attribute_name,
											                                              'product'   => $product,
											                                              'selected'  => $selected
										                                              ) );
									//echo end( $attribute_keys ) === $attribute_name ? '<a class="reset_variations" href="#">' . esc_html__( 'Clear selection', 'eyewear' ) . '</a>' : '';

									else :


										$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) : $product->get_variation_default_attribute( $attribute_name );
										wc_dropdown_variation_attribute_options( array(
											                                         'options'   => $options,
											                                         'attribute' => $attribute_name,
											                                         'product'   => $product,
											                                         'selected'  => $selected,
											                                         'class'     => 'hippo-variation-select-box'
										                                         ) );
										//echo end( $attribute_keys ) === $attribute_name ? '<a class="reset_variations" href="#">' . esc_html__( 'Clear selection', 'eyewear' ) . '</a>' : '';

									endif;
								?>
							</td>
						</tr>


						<?php if ( end( $attribute_keys ) === $attribute_name ): ?>
							<tr>
								<td class="label">&nbsp;</td>
								<td class="value"><a class="reset_variations"
								                     href="#"><?php echo esc_html__( 'Clear selection', 'eyewear' ) ?></a>
								</td>
							</tr>
						<?php endif; ?>

					<?php endforeach; ?>
				</tbody>
			</table>

			<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

			<div class="single_variation_wrap" style="display:none;">
				<?php
					/**
					 * woocommerce_before_single_variation Hook
					 */
					do_action( 'woocommerce_before_single_variation' );

					/**
					 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
					 * @since  2.4.0
					 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
					 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
					 */
					do_action( 'woocommerce_single_variation' );

					/**
					 * woocommerce_after_single_variation Hook
					 */
					do_action( 'woocommerce_after_single_variation' );
				?>
				<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_variations_form' ); ?>
	</form>
<?php do_action( 'woocommerce_after_add_to_cart_form' );