<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	if ( ! class_exists( 'Hippo_Plugin_Simple_Currency_Switcher' ) ) :

		final class Hippo_Plugin_Simple_Currency_Switcher {

			public  $base_currency;
			public  $current_currency;
			private $hippo_current_currency_session = '_hippo_current_currency';

			public function __construct() {

				/*if ( ! session_id() ) {
					session_start();
				}*/

				$Hippo_Session = Hippo_Session::get_instance();

				$this->base_currency = get_option( 'woocommerce_currency' );
				//$this->current_currency = isset( $_SESSION[ $this->hippo_current_currency_session ] ) ? $_SESSION[ $this->hippo_current_currency_session ] : $this->base_currency;
				$this->current_currency = isset( $Hippo_Session[ $this->hippo_current_currency_session ] ) ? $Hippo_Session[ $this->hippo_current_currency_session ] : $this->base_currency;


				add_filter( 'wc_price_args', array( $this, 'wc_price_args' ), 9999 );
				add_filter( 'raw_woocommerce_price', array( $this, 'raw_woocommerce_price' ), 9999 );

				add_filter( 'init', array( $this, 'change_currency' ), 9999 );
				add_filter( 'init', array( $this, 'condition_reset_currency' ), 9999 );


			}

			public function condition_reset_currency() {

				if ( isset( $_REQUEST[ 'action' ] ) ) {
					if ( $_REQUEST[ 'action' ] == 'woocommerce_update_order_review' ) {
						$this->reset_currency();
					}
				}

				if ( isset( $_GET[ 'wc-ajax' ] ) AND $_GET[ 'wc-ajax' ] == 'update_order_review' ) {
					$this->reset_currency();
				}


				if ( isset( $_GET[ 'wc-api' ] ) AND isset( $_GET[ 'pp_action' ] ) AND isset( $_GET[ 'use_paypal_credit' ] ) ) {
					if ( $_GET[ 'pp_action' ] == 'expresscheckout' ) {
						$this->reset_currency();
					}
				}

				if ( class_exists( 'WooCommerce' ) and ( is_cart() OR is_checkout() OR is_checkout_pay_page() or is_admin() or is_account_page() ) ) {
					$this->reset_currency();
				}

				if ( function_exists( 'hippo_option' ) and ( ! hippo_option( 'currency-switcher', FALSE, FALSE ) ) ) {
					$this->reset_currency()->reset_session();
				}

				do_action( 'hippo_currency_condition_check', $this );
			}

			public function reset_session() {
				$Hippo_Session = Hippo_Session::get_instance();
				if ( $this->current_currency == $this->base_currency ) {
					unset( $Hippo_Session[ $this->hippo_current_currency_session ] );
				}
			}

			public function reset_currency() {
				$this->current_currency = $this->base_currency;

				return $this;
			}

			private function valid_currency() {
				return hippo_option( 'woo_currency_switcher', 'currency', array() );
			}

			public function change_currency() {

				$Hippo_Session = Hippo_Session::get_instance();

				if ( isset( $_REQUEST[ 'hippo-switch-currency' ] ) and ! empty( $_REQUEST[ 'hippo-switch-currency' ] ) ) {

					$current_currency = strtoupper( wp_kses( trim( $_REQUEST[ 'hippo-switch-currency' ] ), array() ) );

					if ( in_array( $current_currency, $this->valid_currency() ) ) {
						$this->current_currency = $Hippo_Session[ $this->hippo_current_currency_session ] = $current_currency;
					} else {
						$this->reset_currency()->reset_session();
					}
				}
			}

			public function display_list() {

				if ( function_exists( 'get_woocommerce_currency_symbol' ) ) {

					$currencies = $this->valid_currency();
					?>
					<select id="currency-switcher" class="hippo-currency-switcher">
						<?php foreach ( $currencies as $code ): ?>
							<option <?php selected( $code, $this->current_currency ) ?>
								value="<?php echo $code ?>"><?php echo get_woocommerce_currency_symbol( $code ) ?></option>
						<?php endforeach; ?>
					</select>
					<?php
				}
			}

			private function get_selected_index() {
				$currencies = hippo_option( 'woo_currency_switcher', 'currency', array() );
				$currencies = array_flip( $currencies );

				if ( ! isset( $currencies[ $this->current_currency ] ) ) {
					return NULL;
				}

				return $currencies[ $this->current_currency ];
			}

			public function get_price_format() {


				$options = hippo_option( 'woo_currency_switcher', 'currency_position' );

				$selected_currency_index = $this->get_selected_index();

				if ( is_null( $selected_currency_index ) ) {
					$options[ $selected_currency_index ] = get_option( 'woocommerce_currency_pos' );
				}


				$format = '%1$s%2$s';

				switch ( $options[ $selected_currency_index ] ) {
					case 'left' :
						$format = '%1$s%2$s';
						break;
					case 'right' :
						$format = '%2$s%1$s';
						break;
					case 'left_space' :
						$format = '%1$s&nbsp;%2$s';
						break;
					case 'right_space' :
						$format = '%2$s&nbsp;%1$s';
						break;
				}

				return $format;
			}

			public function get_decimal_separator() {

				$options = hippo_option( 'woo_currency_switcher', 'decimal_separator' );

				$selected_currency_index = $this->get_selected_index();

				if ( is_null( $selected_currency_index ) ) {
					$options[ $selected_currency_index ] = get_option( 'woocommerce_price_decimal_sep' );
				}

				return $options[ $selected_currency_index ];

			}

			public function get_thousand_separator() {

				$options = hippo_option( 'woo_currency_switcher', 'thousand_separator' );

				$selected_currency_index = $this->get_selected_index();

				if ( is_null( $selected_currency_index ) ) {
					$options[ $selected_currency_index ] = get_option( 'woocommerce_price_thousand_sep' );
				}

				return $options[ $selected_currency_index ];

			}

			public function get_decimal_number() {

				$options = hippo_option( 'woo_currency_switcher', 'decimal_number' );

				$selected_currency_index = $this->get_selected_index();

				if ( is_null( $selected_currency_index ) ) {
					$options[ $selected_currency_index ] = get_option( 'woocommerce_price_num_decimals' );
				}

				return $options[ $selected_currency_index ];

			}

			private function _get_exchange_rate( $from_currency, $to_currency, $amount = 1 ) {

				$transient_name = 'hippo_exchange_from_' . strtolower( $from_currency ) . '_to_' . strtolower( $to_currency );

				$amount = urlencode( $amount );

				$from_currency = strtoupper( urlencode( $from_currency ) );
				$to_currency   = strtoupper( urlencode( $to_currency ) );

				//if ( WP_DEBUG or FALSE === ( $exchange_rate = get_transient( $transient_name ) ) ) {
				if ( FALSE === ( $exchange_rate = get_transient( $transient_name ) ) ) {

					$url = sprintf( "http://www.google.com/finance/converter?a=%s&from=%s&to=%s", $amount, $from_currency, $to_currency );

					$contents = file_get_contents( $url );
					$doc      = new DOMDocument();
					@$doc->loadHTML( $contents );
					$XPath    = new DOMXPath( $doc );
					$get_rate = $XPath->query( '//*[@id="currency_converter_result"]/span[@class="bld"]' );

					if ( $get_rate->length > 0 ) {
						$rate = floatval( $get_rate->item( 0 )->nodeValue );
					} else {
						$rate = floatval( $amount );
					}

					set_transient( $transient_name, $rate, 6 * HOUR_IN_SECONDS );

					return $rate;
				} else {
					return get_transient( $transient_name );
				}
			}

			public function raw_woocommerce_price( $price ) {

				if ( $this->current_currency == $this->base_currency ) {
					return $price;
				} else {
					$exchange_rate = $this->_get_exchange_rate( $this->base_currency, $this->current_currency );

					return $price * $exchange_rate;
				}

			}

			public function wc_price_args( $args ) {


				if ( $this->current_currency == $this->base_currency ) {
					return $args;
				} else {

					$args[ 'currency' ]           = $this->current_currency;
					$args[ 'decimal_separator' ]  = $this->get_decimal_separator();
					$args[ 'thousand_separator' ] = $this->get_thousand_separator();
					$args[ 'decimals' ]           = $this->get_decimal_number();
					$args[ 'price_format' ]       = $this->get_price_format();

					return $args;

				}
			}
		}

	endif; // class_exists( 'Hippo_Simple_Currency_Switcher' )


	if ( ! function_exists( 'Hippo_Plugin_Simple_Currency_Switcher_Init' ) ):

		function Hippo_Plugin_Simple_Currency_Switcher_Init() {
			$GLOBALS[ 'hippo_plugin_simple_currency_switcher' ] = new Hippo_Plugin_Simple_Currency_Switcher();
		}

		add_action( 'plugins_loaded', 'Hippo_Plugin_Simple_Currency_Switcher_Init' );

	endif; // function_exists( 'Hippo_Plugin_Simple_Currency_Switcher_Init' )

	if ( ! function_exists( 'Hippo_Plugin_Simple_Currency_Switcher' ) ):

		function Hippo_Plugin_Simple_Currency_Switcher() {
			return $GLOBALS[ 'hippo_plugin_simple_currency_switcher' ];
		}
	endif; // function_exists( 'Hippo_Simple_Currency_Switcher' )
