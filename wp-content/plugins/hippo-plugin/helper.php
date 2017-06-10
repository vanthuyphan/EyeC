<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	//----------------------------------------------------------------------
	// Theme Option Name
	//----------------------------------------------------------------------

	if ( ! function_exists( 'hippo_plugin_theme_option_name' ) ):
		function hippo_plugin_theme_option_name() {
			return apply_filters( 'hippo_theme_option_name', 'hippo_theme_option' );
		}
	endif;

	//----------------------------------------------------------------------
	// Getting Theme Option data
	//----------------------------------------------------------------------

	if ( ! function_exists( 'hippo_plugin_theme_option' ) ):
		function hippo_plugin_theme_option( $index = FALSE, $index2 = FALSE, $default = NULL ) {

			$hippo_theme_option_name = hippo_plugin_theme_option_name();

			if ( ! isset( $GLOBALS[ $hippo_theme_option_name ] ) ) {
				return $default;
			}

			$hippo_theme_option = $GLOBALS[ $hippo_theme_option_name ];


			if ( empty( $index ) ) {
				return $hippo_theme_option;
			}

			if ( $index2 ) {
				$result = ( isset( $hippo_theme_option[ $index ] ) and isset( $hippo_theme_option[ $index ][ $index2 ] ) ) ? $hippo_theme_option[ $index ][ $index2 ] : $default;
			} else {
				$result = isset( $hippo_theme_option[ $index ] ) ? $hippo_theme_option[ $index ] : $default;
			}

			if ( $result == '1' or $result == '0' ) {
				return $result;
			}

			if ( is_string( $result ) and empty( $result ) ) {
				return $default;
			}

			return $result;
		}
	endif;

	//----------------------------------------------------------------------
	// Associative array to html attribute conversion
	//----------------------------------------------------------------------

	if ( ! function_exists( 'hippo_plugin_array2attributes' ) ):

		function hippo_plugin_array2attributes( $attributes, $filter_name = '' ) {

			$attributes = wp_parse_args( $attributes, array() );
			if ( $filter_name ) {
				$attributes = apply_filters( $filter_name, $attributes );
			}

			$attributes_array = array();

			foreach ( $attributes as $key => $value ) {

				if ( is_bool( $attributes[ $key ] ) and $attributes[ $key ] === TRUE ) {
					return $attributes[ $key ] ? $key : '';
				} elseif ( is_bool( $attributes[ $key ] ) and $attributes[ $key ] === FALSE ) {
					$attributes_array[] = '';
				} else {
					$attributes_array[] = $key . '="' . $value . '"';
				}

			}

			return implode( ' ', $attributes_array );
		}
	endif;

	//----------------------------------------------------------------------
	// Convert hexdec color string to rgb(a) string
	//----------------------------------------------------------------------

	if ( ! function_exists( 'hippo_plugin_hex2rgba' ) ):
		function hippo_plugin_hex2rgba( $color, $opacity = FALSE ) {

			$default = 'rgb(0,0,0)';

			//Return default if no color provided
			if ( empty( $color ) ) {
				return $default;
			}

			//Sanitize $color if "#" is provided
			if ( $color[ 0 ] == '#' ) {
				$color = substr( $color, 1 );
			}

			//Check if color has 6 or 3 characters and get values
			if ( strlen( $color ) == 6 ) {
				$hex = array( $color[ 0 ] . $color[ 1 ], $color[ 2 ] . $color[ 3 ], $color[ 4 ] . $color[ 5 ] );
			} elseif ( strlen( $color ) == 3 ) {
				$hex = array( $color[ 0 ] . $color[ 0 ], $color[ 1 ] . $color[ 1 ], $color[ 2 ] . $color[ 2 ] );
			} else {
				return $default;
			}

			//Convert hexadec to rgb
			$rgb = array_map( 'hexdec', $hex );

			//Check if opacity is set(rgba or rgb)
			if ( $opacity ) {
				if ( abs( $opacity ) > 1 ) {
					$opacity = 1.0;
				}
				$output = 'rgba(' . implode( ",", $rgb ) . ',' . $opacity . ')';
			} else {
				$output = 'rgb(' . implode( ",", $rgb ) . ')';
			}

			return $output;
		}
	endif;

	//----------------------------------------------------------------------
	// Check And return File URI
	//----------------------------------------------------------------------

	if ( ! function_exists( 'hippo_plugin_locate_template_uri' ) ):
		function hippo_plugin_locate_template_uri( $template_names ) {
			$located = '';
			foreach ( (array) $template_names as $template_name ) {
				if ( ! $template_name ) {
					continue;
				}
				if ( file_exists( trailingslashit( get_stylesheet_directory() ) . $template_name ) ) {
					$located = trailingslashit( get_stylesheet_directory_uri() ) . $template_name;
					break;
				} elseif ( file_exists( trailingslashit( get_template_directory() ) . $template_name ) ) {
					$located = trailingslashit( get_template_directory_uri() ) . $template_name;
					break;
				}
			}

			return $located;
		}
	endif;

	//----------------------------------------------------------------------
	// Get Theme Preset
	//----------------------------------------------------------------------

	if ( ! function_exists( 'hippo_plugin_theme_option_get_preset' ) ):
		function hippo_plugin_theme_option_get_preset( $suffix = '' ) {

			$valid_list = apply_filters( 'hippo_available_preset', array(
				'preset1',
				'preset2',
				'preset3',
				'preset4',
				'preset5'
			) );

			$preset = hippo_plugin_theme_option( 'preset', FALSE, 'preset1' );

			if ( ! class_exists( 'Hippo_Session' ) ) {
				return apply_filters( 'hippo_preset', $preset ) . $suffix;
			}

			$Hippo_Session = Hippo_Session::get_instance();

			if ( ! apply_filters( 'hippo_can_change_preset_on_fly', '__return_true' ) ) {

				return apply_filters( 'hippo_preset', $preset ) . $suffix;
			}

			$session_name   = '_hippo_preset';
			$require_preset = isset( $_GET[ 'hippo-preset' ] ) ? wp_kses( trim( $_GET[ 'hippo-preset' ] ), array() ) : '';

			// Reset Current Preset
			if ( isset( $_GET[ 'reset-hippo-preset' ] ) ) {
				unset( $Hippo_Session[ $session_name ] );

				return apply_filters( 'hippo_preset', $preset ) . $suffix;
			}

			// Reset for Invalid
			if ( ! empty( $require_preset ) and ! in_array( $require_preset, $valid_list ) ) {
				unset( $Hippo_Session[ $session_name ] );

				return apply_filters( 'hippo_preset', $preset ) . $suffix;
			}

			// Check current on-fly preset and return it
			if ( ! empty( $require_preset ) ) {
				$current = $Hippo_Session[ $session_name ] = $require_preset;
			} elseif ( empty( $require_preset ) and isset( $Hippo_Session[ $session_name ] ) ) {
				// Check current on-fly preset on session and return session value.
				$current = $Hippo_Session[ $session_name ];
			} else {
				// just return default preset.
				$current = $preset;
			}

			return apply_filters( 'hippo_preset', $current ) . $suffix;
		}
	endif;

	//----------------------------------------------------------------------
	// Get Header Style
	//----------------------------------------------------------------------

	if ( ! function_exists( 'hippo_plugin_theme_option_get_header_style' ) ):
		function hippo_plugin_theme_option_get_header_style() {

			$valid_list = apply_filters( 'hippo_available_header_style', array(
				'header-style-default',
				'header-style-box'
			) );

			$default_option = hippo_plugin_theme_option( 'header-style', FALSE, 'header-style-default' );

			if ( ! class_exists( 'Hippo_Session' ) ) {

				return apply_filters( 'hippo_header_style', $default_option );
			}

			$Hippo_Session = Hippo_Session::get_instance();

			if ( ! apply_filters( 'hippo_can_change_header_style_on_fly', '__return_true' ) ) {
				return apply_filters( 'hippo_header_style', $default_option );
			}

			$session_name      = '_hippo_header_style';
			$method_name       = 'hippo-header-style';
			$reset_method_name = 'reset-hippo-header-style';
			$require_option    = isset( $_GET[ $method_name ] ) ? wp_kses( trim( $_GET[ $method_name ] ), array() ) : '';

			// Reset Current
			if ( isset( $_GET[ $reset_method_name ] ) ) {
				unset( $Hippo_Session[ $session_name ] );

				return apply_filters( 'hippo_header_style', $default_option );
			}

			// Reset for Invalid
			if ( ! empty( $require_option ) and ! in_array( $require_option, $valid_list ) ) {
				unset( $Hippo_Session[ $session_name ] );

				return apply_filters( 'hippo_header_style', $default_option );
			}

			// Check current on-fly and return it
			if ( ! empty( $require_option ) ) {
				$current = $Hippo_Session[ $session_name ] = $require_option;
			} elseif ( empty( $require_option ) and isset( $Hippo_Session[ $session_name ] ) ) {
				// Check current on-fly from session and return session value.
				$current = $Hippo_Session[ $session_name ];
			} else {
				// just return default one.
				$current = $default_option;
			}

			return apply_filters( 'hippo_header_style', $current );
		}
	endif;

	//----------------------------------------------------------------------
	// Get Named Image Size Array
	//----------------------------------------------------------------------

	if ( ! function_exists( 'hippo_plugin_get_image_size' ) ):
		function hippo_plugin_get_image_size( $name ) {
			global $_wp_additional_image_sizes;

			return $_wp_additional_image_sizes[ $name ];
		}
	endif;

	//----------------------------------------------------------------------
	// Get Hook Info, attached functions called etc.
	//----------------------------------------------------------------------

	if ( ! function_exists( 'hippo_plugin_hook_info' ) ):

		function hippo_plugin_hook_info( $hook_name ) {
			global $wp_filter;

			$docs = array();

			echo '<pre>';
			echo "\t# Hook Name \"" . $hook_name . "\"";
			echo "\n\n";
			if ( isset( $wp_filter[ $hook_name ] ) ) {
				foreach ( $wp_filter[ $hook_name ] as $pri => $fn ) {

					foreach ( $fn as $fnname => $fnargs ) {
						$reflFunc = new ReflectionFunction( $fnargs[ 'function' ] );
						echo "\t - " . 'Function "' . $fnargs[ 'function' ] . "\" priority " . $pri . ". \n\tin file " . str_ireplace( ABSPATH, '', $reflFunc->getFileName() ) . '#' . $reflFunc->getStartLine();
						echo "\n\n";
						$docs[] = array( $fnargs[ 'function' ], $pri );
					}
				}

				echo "\tAction Hook Commenting\n\t----------------------\n\n";
				echo "\t/**\n\t* " . $hook_name . " hook\n\t*\n";
				foreach ( $docs as $doc ) {
					echo "\t* @hooked " . $doc[ 0 ] . " - " . $doc[ 1 ] . "\n";
				}
				echo "\t*/";
				echo "\n\n";
				echo "\tdo_action( '" . $hook_name . "' );";

			}
			echo '</pre>';
		}
	endif;

	//----------------------------------------------------------------------
	// Estimate time to Read
	//----------------------------------------------------------------------

	if ( ! function_exists( 'hippo_plugin_get_min_to_read' ) ):
		function hippo_plugin_get_min_to_read( $args = array() ) {

			$args = wp_parse_args( $args, apply_filters( 'hippo_get_min_to_read_args', array(
				'minute' => _n_noop( '%s minute read', '%s minutes read', 'hippo-plugin' ),
				'second' => _n_noop( '%s second read', '%s seconds read', 'hippo-plugin' )
			) ) );

			// Why ob_start? if someone want to use short codes on post
			ob_start();
			the_content();
			$contents = ob_get_clean();
			$words    = str_word_count( strip_tags( $contents ) );

			$human_word_read_per_min = (int) apply_filters( 'hippo_min_to_read_word_limit', 150 );

			$minutes = floor( $words / $human_word_read_per_min );
			$seconds = floor( $words % $human_word_read_per_min / ( $human_word_read_per_min / 60 ) );

			if ( 1 <= $minutes ) {
				$estimated_time = sprintf( translate_nooped_plural( $args[ 'minute' ], $minutes, 'hippo-plugin' ), $minutes );
				//$estimated_time .= ', ' . sprintf( translate_nooped_plural( $message[ 'minute' ], $minutes, 'hippo-plugin' ), $minutes );
			} else {
				$estimated_time = sprintf( translate_nooped_plural( $args[ 'second' ], $seconds, 'hippo-plugin' ), $seconds );
			}

			return apply_filters( 'hippo_get_min_to_read', $estimated_time, $minutes, $seconds );
		}
	endif;

