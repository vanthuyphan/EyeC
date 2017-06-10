<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );


	VcShortcodeAutoloader::getInstance()->includeClass( 'WPBakeryShortCode_Hippo_Products' );
	$instance = new WPBakeryShortCode_Hippo_Products( array( 'base' => $this->settings[ 'base' ] ) );

	$attributes    = vc_map_get_attributes( $this->getShortcode(), $atts );
	$css_animation = $instance->getCSSAnimation( $attributes[ 'css_animation' ] );

	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_animation . ' ' . $attributes[ 'el_class' ], $this->settings[ 'base' ], $attributes );

	ob_start(); ?>

	<div class="woocommerce">

		<?php
			// WP_Query arguments
			$args = array(
				'p'           => $attributes[ 'product_post_id' ],
				'post_type'   => 'product',
				'post_status' => 'publish',
			);


			// The Query
			$query = new WP_Query( $args );

			if ( $query->have_posts() ) :

				woocommerce_product_loop_start();

				while ( $query->have_posts() ) :

					$query->the_post();

					global $post, $product, $woocommerce_loop, $woocommerce;

					// Ensure visibility
					if ( ! $product || ! $product->is_visible() ) :
						return;
					endif;


					$product_image = get_the_post_thumbnail( get_the_ID(), "eyewear-product-thumbnail" );

					if ( ! $product_image ):
						$default_sizes = eyewear_get_image_size( "eyewear-product-thumbnail" );
						$product_image = sprintf( '<img src="%s" alt="%s" width="%s" height="%s" />', esc_url( wc_placeholder_img_src() ), esc_html( get_the_title() ), $default_sizes[ 'width' ], $default_sizes[ 'height' ] );
					endif;

					$css_classes   = array();
					$css_classes[] = trim( $css_class );
					$css_classes[] = 'product-block';
					?>
					<div class="product-block-wrapper">
						<div class="product-details">
							<div class="entry-header">
								<h2 class="entry-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>
							</div>
							<!-- .entry-header -->

							<div class="product-price">
								<?php echo $product->get_price_html(); ?>
							</div>
							<!-- .product-price -->
						</div>
						<!-- .product-details -->
						<a href="<?php the_permalink(); ?>" class="<?php echo implode( ' ', $css_classes ) ?>">

							<?php if ( $product->is_type( 'variable' ) ) : ?>
								<ul class="hippo-variation-product-slider">
									<?php foreach ( $product->get_available_variations() as $variation ): ?>
										<li>
											<img
												sizes="<?php echo esc_attr( $variation[ 'image_sizes' ] ) ?>"
												srcset="<?php echo esc_attr( $variation[ 'image_srcset' ] ) ?>"
												src="<?php echo esc_attr( $variation[ 'image_src' ] ) ?>"
												alt="<?php echo esc_attr( $variation[ 'image_title' ] ) ?> ?>">
										</li>
									<?php endforeach; ?>
								</ul>
								<?php
							else :
								echo $product_image;
							endif;

								if ( $product->stock_status == 'outofstock' ) : ?>
									<span class="out-of-stock"><?php esc_html_e( 'Out of stock', 'eyewear' ); ?></span>
								<?php endif; ?>

							<?php if ( $product->is_on_sale() ) : ?>
								<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'eyewear' ) . '</span>', $post, $product ); ?>
							<?php endif; ?>
						</a>

						<?php if ( $product->is_type( 'variable' ) ) : ?>
							<ul class="hippo-variation-product-slider-controller text-center">
								<?php
									$variation_attributes = $product->get_variation_attributes();
									$slider_attribute     = eyewear_option( 'variation-attribute' );

									if ( isset( $variation_attributes[ wc_attribute_taxonomy_name( $slider_attribute ) ] ) ) :

										$slider_variation_attributes = $variation_attributes[ wc_attribute_taxonomy_name( $slider_attribute ) ];
										$attribute        = eyewear_get_wc_attribute_taxonomy( $slider_attribute );
										$taxonomy         = wc_attribute_taxonomy_name( $slider_attribute );
										//$attribute_items             = wc_get_product_terms( $product->id, wc_attribute_taxonomy_name( $slider_attribute ), array( 'fields' => 'all' ) );
										foreach ( $slider_variation_attributes as $slider_variation_attribute ):

											$term = get_term_by( 'slug', $slider_variation_attribute, $taxonomy );

											$style = '';
											if ( $attribute->attribute_type == 'color' ) :
												$get_term_meta = hippo_plugin_get_term_meta( $term->term_id, 'product_attribute_image', TRUE );
												$style         = "background-color:" . esc_attr( $get_term_meta );
											endif;
											?>
											<li class="<?php echo ( $index == 0 ) ? 'current' : '' ?>"
											    data-toggle="tooltip" data-placement="top"
											    style="<?php esc_attr( $style ) ?>"
											    title="<?php echo esc_html( $term->name ) ?>">

												<?php
													if ( $attribute->attribute_type == 'image' ) :
														$get_term_meta = hippo_plugin_get_term_meta( $term->term_id, 'product_attribute_image', TRUE );
														echo wp_get_attachment_image( $get_term_meta, 'full' );
													endif;
												?>
											</li>
											<?php

										endforeach;
									endif; ?>
							</ul>
						<?php endif; ?>
						<!-- .product-block -->
					</div> <!-- .product-block-wrapper -->
					<?php
				endwhile;

				woocommerce_product_loop_end();

			else:
				echo '<div class="col-md-12">' . esc_html__( 'No products found.', 'eyewear' ) . '</div>';
			endif;

			wp_reset_postdata();
		?>
	</div> <!-- .woocommerce -->
<?php
	echo $this->endBlockComment( $this->getShortcode() );
	echo ob_get_clean();