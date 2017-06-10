<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	//----------------------------------------------------------------------
	// WooCommerce set post per page
	//----------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_set_products_per_page' ) ) :
		function eyewear_set_products_per_page() {
			if ( is_shop() ) {
				return intval( eyewear_option( 'shop-perpage', FALSE, '12' ) );
			} elseif ( is_product_category() ) {
				return intval( eyewear_option( 'shop-cat-perpage', FALSE, '12' ) );
			}
		}

		add_filter( 'loop_shop_per_page', 'eyewear_set_products_per_page', 20 );
	endif;

	//----------------------------------------------------------------------
	// WooCommerce AddToCart Count ajax response
	//----------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_woo_cart_count' ) ) :
		function eyewear_woo_cart_count() {
			global $woocommerce;
			$cart_total = ( $woocommerce->cart->cart_contents_count ) ? $woocommerce->cart->cart_contents_count : '0';
			echo "( " . number_format_i18n( intval( $cart_total ) ) . " )";
			die;
		}

		add_action( 'wp_ajax_eyewear_cart_count', 'eyewear_woo_cart_count' );
		add_action( 'wp_ajax_nopriv_eyewear_cart_count', 'eyewear_woo_cart_count' );
	endif;

	//----------------------------------------------------------------------
	// WooCommerce remove from minicart ajax response
	//----------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_woo_mini_cart_remove' ) ) :
		function eyewear_woo_mini_cart_remove() {
			global $woocommerce;
			$cart_item_key = $cart_item_key = sanitize_text_field( $_GET[ 'remove_item' ] );
			$woocommerce->cart->remove_cart_item( $cart_item_key );
			die;
		}

		add_action( 'wp_ajax_eyewear_remove_from_mini_cart', 'eyewear_woo_mini_cart_remove' );
		add_action( 'wp_ajax_nopriv_eyewear_remove_from_mini_cart', 'eyewear_woo_mini_cart_remove' );
	endif;

	//----------------------------------------------------------------------
	// WooCommerce WishList
	//----------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_woo_wishlist_count' ) ) :
		function eyewear_woo_wishlist_count() {

			if ( function_exists( 'yith_wcwl_count_products' ) ) {
				echo number_format_i18n( yith_wcwl_count_products() );
			}
			die;
		}

		add_action( 'wp_ajax_eyewear_wishlist_total_count', 'eyewear_woo_wishlist_count' );
		add_action( 'wp_ajax_nopriv_eyewear_wishlist_total_count', 'eyewear_woo_wishlist_count' );
	endif;

	//----------------------------------------------------------------------
	// Add new tab on product single page
	//----------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_new_product_policy_tab' ) ) :

		function eyewear_new_product_policy_tab( $tabs ) {
			// Adds the new tab

			$data = trim( get_post_meta( get_the_ID(), 'product_policy', TRUE ) );

			if ( ! empty( $data ) ) {
				$tabs[ 'single_policy_tab' ] = array(
					'title'    => esc_html__( 'Policy', 'eyewear' ),
					'priority' => 11,
					'callback' => 'eyewear_new_product_tab_content'
				);
			}

			return $tabs;
		}

		function eyewear_new_product_tab_content() {
			// The new tab content
			echo wp_kses_post( get_post_meta( get_the_ID(), 'product_policy', TRUE ) );
		}

		//add_filter( 'woocommerce_product_tabs', 'eyewear_new_product_policy_tab' );
	endif;

	//-------------------------------------------------------------------------------
	// Single product organize and remove WooCommerce default breadcrumb
	//-------------------------------------------------------------------------------

	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	add_action( 'eyewear_single_product_title', 'woocommerce_template_single_title', 5 );

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	add_action( 'eyewear_pre_woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	add_action( 'eyewear_pre_woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	add_action( 'eyewear_pre_woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );


	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
	add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_sharing', 10 );

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_meta', 20 );

	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
	add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 30 );

	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	add_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 40 );

	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 50 );


	//-------------------------------------------------------------------------------
	// Cart Page Organize
	//-------------------------------------------------------------------------------

	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
	add_action( 'eyewear_cart_totals', 'woocommerce_cart_totals', 999 );

	//-------------------------------------------------------------------------------
	// Add to cart Script Param
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_woo_add_to_cart_script_handler' ) ):
		function eyewear_woo_add_to_cart_script_handler() {
			return array(
				'ajax_url'                => WC()->ajax_url(),
				'wc_ajax_url'             => WC_AJAX::get_endpoint( "%%endpoint%%" ),
				'i18n_view_cart'          => '<i class="waves-effect waves-light zmdi zmdi-shopping-basket zmdi-hc-fw icon-circle black"></i>',
				'i18n_view_cart_title'    => esc_html__( 'View Cart', 'eyewear' ),
				'cart_url'                => apply_filters( 'woocommerce_add_to_cart_redirect', WC()->cart->get_cart_url() ),
				'is_cart'                 => is_cart(),
				'cart_redirect_after_add' => get_option( 'woocommerce_cart_redirect_after_add' )
			);
		}

		add_filter( 'wc_add_to_cart_params', 'eyewear_woo_add_to_cart_script_handler' );

	endif;

	//-------------------------------------------------------------------------------
	// Override WooCommerce Frontend Javascript
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_woo_scripts' ) ) {

		function eyewear_woo_scripts() {

			// Add to cart
			wp_deregister_script( 'wc-add-to-cart' );
			wp_register_script( 'wc-add-to-cart', get_template_directory_uri() . '/js/add-to-cart.js', array( 'jquery' ), FALSE, TRUE );
			wp_enqueue_script( 'wc-add-to-cart' );

			// Add to cart variation
			wp_deregister_script( 'wc-add-to-cart-variation' );
			wp_register_script( 'wc-add-to-cart-variation', get_template_directory_uri() . '/js/add-to-cart-variation.js', array( 'jquery' ), FALSE, TRUE );
			wp_enqueue_script( 'wc-add-to-cart-variation' );


			// latest select2
			wp_deregister_script( 'select2' );
			wp_dequeue_script( 'select2' );

			wp_deregister_style( 'select2' );
			wp_dequeue_style( 'select2' );

			wp_enqueue_script( 'eyewear-select2', get_template_directory_uri() . '/js/select2.full.min.js', array( 'jquery' ), FALSE, TRUE );
			wp_enqueue_style( 'eyewear-select2', get_template_directory_uri() . '/css/select2.min.css', array(), '4.0.0' );

		}

		add_action( 'wp_enqueue_scripts', 'eyewear_woo_scripts' );
	}

	//-------------------------------------------------------------------------------
	// WooCommerce gallery thumb column
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_woo_gallery_thumb_column' ) ) {
		function eyewear_woo_gallery_thumb_column() {
			return 4; // .last class applied to every 4th thumbnail
		}

		add_filter( 'woocommerce_product_thumbnails_columns', 'eyewear_woo_gallery_thumb_column' );
	}


	//-------------------------------------------------------------------------------
	// Hide Product Attribute From Single Product
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_product_attributs' ) ) :
		function eyewear_product_attributs() {
			//global $product;
			//$product->list_attributes();
		}

		add_action( 'woocommerce_single_product_summary', 'eyewear_product_attributs', 35 );
	endif;

	//-------------------------------------------------------------------------------
	// Show Share Buttons Product
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_share_button' ) ) :
		function eyewear_share_button() {
			if ( eyewear_option( 'show-shop-share-button', FALSE, TRUE ) ) :
				get_template_part( 'template-parts/shop-social-share' );
			endif;
		}

		add_action( 'woocommerce_share', 'eyewear_share_button', 20 );
	endif;


	//-------------------------------------------------------------------------------
	// remove woocommerce default pretty photo
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_remove_woo_lightbox' ) ):
		function eyewear_remove_woo_lightbox() {
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
		}

		//add_action( 'wp_enqueue_scripts', 'eyewear_remove_woo_lightbox', 99 );
	endif;

	//-------------------------------------------------------------------------------
	// load woocommerce pretty photo
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_load_woo_lightbox' ) ):
		function eyewear_load_woo_lightbox() {
			$suffix                  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			$woocommerce_assets_path = str_replace( array(
				                                        'http:',
				                                        'https:'
			                                        ), '', WC()->plugin_url() ) . '/assets/';


			wp_enqueue_script( 'prettyPhoto', $woocommerce_assets_path . 'js/prettyPhoto/jquery.prettyPhoto' . $suffix . '.js', array( 'jquery' ), '3.1.6', TRUE );
			wp_enqueue_script( 'prettyPhoto-init', $woocommerce_assets_path . 'js/prettyPhoto/jquery.prettyPhoto.init' . $suffix . '.js', array(
				'jquery',
				'prettyPhoto'
			) );
			wp_enqueue_style( 'woocommerce_prettyPhoto_css', $woocommerce_assets_path . 'css/prettyPhoto.css' );
		}

		add_action( 'wp_enqueue_scripts', 'eyewear_load_woo_lightbox', 999 );

	endif;

	//-------------------------------------------------------------------------------
	// Add style attribute types on woocommerce taxonomy
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_admin_style_attributes_types' ) ) :

		function eyewear_admin_style_attributes_types( $current ) {

			$current[ 'color' ] = esc_html__( 'Color', 'eyewear' );
			$current[ 'image' ] = esc_html__( 'Image', 'eyewear' );

			return $current;
		}

		add_filter( 'product_attributes_type_selector', 'eyewear_admin_style_attributes_types' );
	endif;

	//-------------------------------------------------------------------------------
	// Get a Attribute taxonomy values
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_get_wc_attribute_taxonomy' ) ):

		function eyewear_get_wc_attribute_taxonomy( $attribute_name ) {

			if ( FALSE === ( $attribute_taxonomy = get_transient( "eyewear_get_wc_attribute_taxonomy_{$attribute_name}" ) ) ) {

				global $wpdb;

				$attr_prefix        = wc_attribute_taxonomy_name( '' );
				$attribute_name     = esc_sql( str_ireplace( $attr_prefix, '', $attribute_name ) );
				$attribute_taxonomy = $wpdb->get_row( "SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies WHERE attribute_name='{$attribute_name}'" );
				set_transient( "eyewear_get_wc_attribute_taxonomy_{$attribute_name}", $attribute_taxonomy );
			}

			return apply_filters( 'eyewear_get_wc_attribute_taxonomy', $attribute_taxonomy );
		}
	endif;

	//-------------------------------------------------------------------------------
	// Set style attribute on product admin page
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_admin_style_attributes_values' ) ) :

		function eyewear_admin_style_attributes_values( $tax, $i ) {

			global $woocommerce, $thepostid;
			if ( in_array( $tax->attribute_type, array( 'color', 'image' ) ) ) {
				$taxonomy = wc_attribute_taxonomy_name( $tax->attribute_name );
				?>
				<select multiple="multiple" data-placeholder="<?php esc_attr_e( 'Select terms', 'eyewear' ); ?>"
				        class="multiselect attribute_values wc-enhanced-select"
				        name="attribute_values[<?php echo $i; ?>][]">
					<?php
						$all_terms = get_terms( $taxonomy, 'orderby=name&hide_empty=0' );
						if ( $all_terms ) {
							foreach ( $all_terms as $term ) {
								echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( has_term( absint( $term->term_id ), $taxonomy, $thepostid ), TRUE, FALSE ) . '>' . $term->name . '</option>';
							}
						}
					?>
				</select>
				<button
					class="button plus select_all_attributes"><?php esc_html_e( 'Select all', 'eyewear' ); ?></button>
				<button
					class="button minus select_no_attributes"><?php esc_html_e( 'Select none', 'eyewear' ); ?></button>
				<button class="button fr plus add_new_attribute"><?php esc_html_e( 'Add new', 'eyewear' ); ?></button>
				<?php
			}
		}

		add_action( 'woocommerce_product_option_terms', 'eyewear_admin_style_attributes_values', 10, 2 );

	endif;

	//-------------------------------------------------------------------------------
	// Color Variation Attribute Options
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_wc_color_variation_attribute_options' ) ) :

		function eyewear_wc_color_variation_attribute_options( $args = array() ) {

			$args = wp_parse_args( $args, array(
				'options'          => FALSE,
				'attribute'        => FALSE,
				'product'          => FALSE,
				'selected'         => FALSE,
				'name'             => '',
				'id'               => '',
				'class'            => '',
				'show_option_none' => esc_html__( 'Choose an option', 'eyewear' )
			) );

			$options   = $args[ 'options' ];
			$product   = $args[ 'product' ];
			$attribute = $args[ 'attribute' ];
			$name      = $args[ 'name' ] ? $args[ 'name' ] : 'attribute_' . sanitize_title( $attribute );
			$id        = $args[ 'id' ] ? $args[ 'id' ] : sanitize_title( $attribute ) . $product->id;
			$class     = $args[ 'class' ];

			if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
				$attributes = $product->get_variation_attributes();
				$options    = $attributes[ $attribute ];
			}

			echo '<select ' . $id . ' class="' . esc_attr( $class ) . ' hide" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '">';

			if ( $args[ 'show_option_none' ] ) {
				echo '<option value="">' . esc_html( $args[ 'show_option_none' ] ) . '</option>';
			}

			if ( ! empty( $options ) ) {
				if ( $product && taxonomy_exists( $attribute ) ) {
					// Get terms if this is a taxonomy - ordered. We need the names too.
					$terms = wc_get_product_terms( $product->id, $attribute, array( 'fields' => 'all' ) );

					foreach ( $terms as $term ) {
						if ( in_array( $term->slug, $options ) ) {
							echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $args[ 'selected' ] ), $term->slug, FALSE ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
						}
					}
				}
			}

			echo '</select>';

			echo '<ul class="list-inline variable-items-wrapper color-variable-wrapper">';
			if ( ! empty( $options ) ) {
				if ( $product && taxonomy_exists( $attribute ) ) {
					$terms = wc_get_product_terms( $product->id, $attribute, array( 'fields' => 'all' ) );

					foreach ( $terms as $term ) {
						if ( in_array( $term->slug, $options ) ) {
							$get_term_meta  = hippo_plugin_get_term_meta( $term->term_id, 'product_attribute_color', TRUE );
							$selected_class = ( sanitize_title( $args[ 'selected' ] ) == $term->slug ) ? 'selected' : '';
							?>
							<li data-toggle="tooltip" data-placement="top"
							    class="variable-item color-variable-item color-variable-item-<?php echo $term->slug ?> <?php echo $selected_class ?>"
							    title="<?php echo esc_html( $term->name ) ?>"
							    style="background-color:<?php echo esc_attr( $get_term_meta ) ?>;"
							    data-value="<?php echo esc_attr( $term->slug ) ?>"></li>
							<?php
						}
					}
				}
			}
			echo '</ul>';
		}

	endif;

	//-------------------------------------------------------------------------------
	// Image Variation Attribute Options
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_wc_image_variation_attribute_options' ) ) :

		function eyewear_wc_image_variation_attribute_options( $args = array() ) {

			$args = wp_parse_args( $args, array(
				'options'          => FALSE,
				'attribute'        => FALSE,
				'product'          => FALSE,
				'selected'         => FALSE,
				'name'             => '',
				'id'               => '',
				'class'            => '',
				'show_option_none' => esc_html__( 'Choose an option', 'eyewear' )
			) );

			$options   = $args[ 'options' ];
			$product   = $args[ 'product' ];
			$attribute = $args[ 'attribute' ];
			$name      = $args[ 'name' ] ? $args[ 'name' ] : 'attribute_' . sanitize_title( $attribute );
			$id        = $args[ 'id' ] ? $args[ 'id' ] : sanitize_title( $attribute ) . $product->id;
			$class     = $args[ 'class' ];

			if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
				$attributes = $product->get_variation_attributes();
				$options    = $attributes[ $attribute ];
			}

			echo '<select ' . $id . ' class="' . esc_attr( $class ) . ' hide" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '">';

			if ( $args[ 'show_option_none' ] ) {
				echo '<option value="">' . esc_html( $args[ 'show_option_none' ] ) . '</option>';
			}

			if ( ! empty( $options ) ) {
				if ( $product && taxonomy_exists( $attribute ) ) {
					// Get terms if this is a taxonomy - ordered. We need the names too.
					$terms = wc_get_product_terms( $product->id, $attribute, array( 'fields' => 'all' ) );

					foreach ( $terms as $term ) {
						if ( in_array( $term->slug, $options ) ) {
							echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $args[ 'selected' ] ), $term->slug, FALSE ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
						}
					}
				}
			}

			echo '</select>';

			echo '<ul class="list-inline variable-items-wrapper image-variable-wrapper">';
			if ( ! empty( $options ) ) {
				if ( $product && taxonomy_exists( $attribute ) ) {
					$terms = wc_get_product_terms( $product->id, $attribute, array( 'fields' => 'all' ) );

					foreach ( $terms as $term ) {
						if ( in_array( $term->slug, $options ) ) {
							$get_term_meta  = hippo_plugin_get_term_meta( $term->term_id, 'product_attribute_image', TRUE );
							$image          = wp_get_attachment_image_src( $get_term_meta, 'full' );
							$selected_class = ( sanitize_title( $args[ 'selected' ] ) == $term->slug ) ? 'selected' : '';
							?>
							<li data-toggle="tooltip" data-placement="top"
							    class="variable-item image-variable-item image-variable-item-<?php echo $term->slug ?> <?php echo $selected_class ?>"
							    title="<?php echo esc_html( $term->name ) ?>"
							    data-value="<?php echo esc_attr( $term->slug ) ?>"><img
									alt="<?php echo esc_html( $term->name ) ?>"
									src="<?php echo esc_url( $image[ 0 ] ) ?>"></li>
							<?php
						}
					}
				}
			}
			echo '</ul>';
		}
	endif;

	//-------------------------------------------------------------------------------
	// Remove WooCommerce Responsive Css
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_remove_woocommerce_enqueue_styles' ) ) :
		function eyewear_remove_woocommerce_enqueue_styles( $styles ) {

			unset( $styles[ 'woocommerce-layout' ] );
			unset( $styles[ 'woocommerce-smallscreen' ] );

			return $styles;
		}

		add_filter( 'woocommerce_enqueue_styles', 'eyewear_remove_woocommerce_enqueue_styles' );
	endif;

	//-------------------------------------------------------------------------------
	//  WooCommerce Get Currency list
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_wc_get_currencies' ) and function_exists( 'get_woocommerce_currencies' ) ) :

		function eyewear_wc_get_currencies() {

			$currency_code_options = (array) get_woocommerce_currencies();

			foreach ( $currency_code_options as $code => $name ) {
				$currency_code_options[ $code ] = $name . ' (' . get_woocommerce_currency_symbol( $code ) . ')';
			}

			return $currency_code_options;
		}
	endif;

	//-------------------------------------------------------------------------------
	//  WooCommerce Get Currency icon position
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_wc_get_currency_position' ) and function_exists( 'get_woocommerce_currency_symbol' ) ) :
		function eyewear_wc_get_currency_position() {

			return array(
				'left'        => esc_html__( 'Left', 'eyewear' ) . ' (' . get_woocommerce_currency_symbol() . '99.99)',
				'right'       => esc_html__( 'Right', 'eyewear' ) . ' (99.99' . get_woocommerce_currency_symbol() . ')',
				'left_space'  => esc_html__( 'Left with space', 'eyewear' ) . ' (' . get_woocommerce_currency_symbol() . ' 99.99)',
				'right_space' => esc_html__( 'Right with space', 'eyewear' ) . ' (99.99 ' . get_woocommerce_currency_symbol() . ')'
			);
		}
	endif;


	//-------------------------------------------------------------------------------
	//  WooCommerce Change Shop Thumbnail Image Size
	//-------------------------------------------------------------------------------

	// admin.php?page=wc-settings&tab=products&section=display

	if ( ! function_exists( 'eyewear_woocommerce_shop_thumbnail_image_size' ) ):

		function eyewear_woocommerce_shop_thumbnail_image_size( $size ) {

			return eyewear_get_image_size( 'eyewear-mini-cart-thumb' );
		}

		add_filter( 'woocommerce_get_image_size_shop_thumbnail', 'eyewear_woocommerce_shop_thumbnail_image_size' );

	endif;

	//-------------------------------------------------------------------------------
	//  WooCommerce Change Shop Catalog Image Size
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_woocommerce_shop_catalog_image_size' ) ):

		function eyewear_woocommerce_shop_catalog_image_size( $size ) {
			$size[ 'width' ]  = 300;
			$size[ 'height' ] = 300;
			$size[ 'crop' ]   = 1;

			return $size;
		}

		add_filter( 'woocommerce_get_image_size_shop_catalog', 'eyewear_woocommerce_shop_catalog_image_size' );

	endif;

	//-------------------------------------------------------------------------------
	//  WooCommerce Change Shop Single Image Size
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_woocommerce_shop_single_image_size' ) ):

		function eyewear_woocommerce_shop_single_image_size( $size ) {
			return eyewear_get_image_size( 'eyewear-single-product-thumbnail' );
		}

		add_filter( 'woocommerce_get_image_size_shop_single', 'eyewear_woocommerce_shop_single_image_size' );

	endif;

	//-------------------------------------------------------------------------------
	//  Check Is we are on single product page? really?
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_is_woocommerce_single_product' ) ):

		function eyewear_is_woocommerce_single_product() {

			global $product, $eyewear_is_main_product;

			if ( isset( $eyewear_is_main_product ) and $eyewear_is_main_product ) {
				return TRUE;
			}

			return FALSE;
		}

	endif;

	//-------------------------------------------------------------------------------
	//  Truly Set that we are on single product page
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_set_woocommerce_single_product' ) ):

		function eyewear_set_woocommerce_single_product() {

			global $product, $eyewear_is_main_product;

			if ( is_product() ) {
				$eyewear_is_main_product = TRUE;
			}
		}

		add_action( 'woocommerce_before_main_content', 'eyewear_set_woocommerce_single_product' );

	endif;

	//-------------------------------------------------------------------------------
	//  Unset Single product page because we are now on related product loop
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_unset_woocommerce_single_product' ) ):

		function eyewear_unset_woocommerce_single_product() {

			global $product, $eyewear_is_main_product;

			if ( is_product() ) {
				$eyewear_is_main_product = FALSE;
			}
		}

	endif;

	//-------------------------------------------------------------------------------
	//  Change Popup attribute image
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_change_woocommerce_popup_product_attribute_image' ) ):

		function eyewear_change_woocommerce_popup_product_attribute_image( $options, $variable_object, $variation ) {

			if ( ! eyewear_is_woocommerce_single_product() ) {
				if ( has_post_thumbnail( $variation->get_variation_id() ) ) {
					$attachment_id = get_post_thumbnail_id( $variation->get_variation_id() );
					$attachment    = wp_get_attachment_image_src( $attachment_id, 'eyewear-product-thumbnail' );
					$image         = $attachment ? current( $attachment ) : '';
				} else {
					$image = '';
				}

				$options[ 'image_src' ] = $image;
			}

			return $options;

		}

		add_filter( 'woocommerce_available_variation', 'eyewear_change_woocommerce_popup_product_attribute_image', 9999, 3 );
	endif;

	//-------------------------------------------------------------------------------
	//  Check shipping calc enabled on cart page
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_has_shipping_calc_on_cart_page' ) ):

		function eyewear_has_shipping_calc_on_cart_page() {
			if ( is_cart() and ( get_option( 'woocommerce_enable_shipping_calc' ) === 'yes' ) and ( get_option( 'woocommerce_calc_shipping' ) === 'yes' ) ) {
				return TRUE;
			}

			return FALSE;
		}
	endif;

	//-------------------------------------------------------------------------------
	//  Quick View Item Sorting
	//-------------------------------------------------------------------------------

	add_action( 'eyewear_woocommerce_single_product_quick_view_summary', 'woocommerce_template_single_title', 5 );
	add_action( 'eyewear_woocommerce_single_product_quick_view_summary', 'woocommerce_template_single_rating', 10 );
	add_action( 'eyewear_woocommerce_single_product_quick_view_summary', 'woocommerce_template_single_price', 15 );
	add_action( 'eyewear_woocommerce_single_product_quick_view_summary', 'woocommerce_template_single_excerpt', 20 );
	add_action( 'eyewear_woocommerce_single_product_quick_view', 'woocommerce_template_single_add_to_cart', 25 );


	//-------------------------------------------------------------------------------
	//  Product Column Class
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_wc_product_column_class' ) ):

		function eyewear_wc_product_column_class( $class = array() ) {

			if ( ! empty( $class ) ) {
				if ( ! is_array( $class ) ) {
					$class = preg_split( '#\s+#', $class );
				}
				$class = array_map( 'esc_attr', $class );
			}


			$classes = apply_filters( 'eyewear_wc_product_column_class',
			                          array_merge( array(
				                                       'col-lg-4',
				                                       'col-md-4',
				                                       'col-sm-4',
				                                       'col-ms-12',
				                                       'col-xs-12'
			                                       ), (array) $class ) );

			return implode( ' ', array_unique( $classes ) );
		}
	endif;

	//----------------------------------------------------------------------
	// Cross sell Column Class
	//----------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_wc_cross_sell_product_column_class' ) ):

		function eyewear_wc_cross_sell_product_column_class( $class ) {

			if ( is_cart() ) {
				$crosssells = WC()->cart->get_cross_sells();
				$class      = array();

				if ( count( $crosssells ) <= 1 ) {
					$class[] = 'col-xs-12';
				} elseif ( count( $crosssells ) <= 2 ) {
					$class[] = 'col-lg-6';
					$class[] = 'col-md-6';
					$class[] = 'col-sm-6';
					$class[] = 'col-ms-6';
					$class[] = 'col-xs-12';
				} elseif ( count( $crosssells ) <= 3 ) {
					$class[] = 'col-md-4';
					$class[] = 'col-sm-6';
					$class[] = 'col-xs-12';
				} else {
					$class[] = 'col-md-3';
					$class[] = 'col-sm-12';
					$class[] = 'col-xs-12';
				}


			}

			return $class;
		}

		//add_filter( 'eyewear_wc_product_column_class', 'eyewear_wc_cross_sell_product_column_class', 9999 );
	endif;

	//----------------------------------------------------------------------
	// Check QuickView
	//----------------------------------------------------------------------

	if ( ! function_exists( 'is_eyewear_quick_view' ) ) {

		function is_eyewear_quick_view() {
			global $is_eyewear_quick_view;

			return $is_eyewear_quick_view;
		}
	}

	//----------------------------------------------------------------------
	// Related Product Argument
	//----------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_output_related_products_args' ) ):
		function eyewear_output_related_products_args( $args ) {
			$args[ 'posts_per_page' ] = eyewear_option( 'shop-related-limit', FALSE, 4 );

			return $args;
		}

		add_filter( 'woocommerce_related_products_args', 'eyewear_output_related_products_args', 9999 );
	endif;