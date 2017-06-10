<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );


	/**
	 * Adding Less
	 */
	// add_action( 'wp_enqueue_scripts', function () {
	// 	wp_enqueue_style( 'style-less', get_stylesheet_directory_uri() . '/less/style.less' );
	// } );

	//----------------------------------------------------------------------
	// Less CSS Variables
	//----------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_set_less_variables' ) ) :

		function eyewear_set_less_variables( $arr ) {

			$preset = eyewear_get_preset( '-' );

			$theme_color = eyewear_option( $preset . 'theme-color', FALSE, '#f1ac59' );
			$links_color = eyewear_option( $preset . 'links-color', FALSE, '#f1ac59' );
			$hover_color = eyewear_option( $preset . 'hover-color', FALSE, '#fff2a8' );


			$bg_color       = eyewear_option( $preset . 'body-background-color', FALSE, '#ffffff' );
			$contents_color = eyewear_option( $preset . 'contents-color', FALSE, '#363636' );
			$menu_color     = eyewear_option( $preset . 'menu-color', FALSE, '#000000' );
			$headings_color = eyewear_option( $preset . 'headings-color', FALSE, '#000000' );


			// Heading typography
			$heading_font_family = eyewear_option( 'heading-typography', 'font-family', 'Roboto' );
			$heading_font_weight = eyewear_option( 'heading-typography', 'font-weight', '400' );
			$heading_font_style  = eyewear_option( 'heading-typography', 'font-style' );

			// Body typography
			$font_family = eyewear_option( 'body-typography', 'font-family', 'Roboto' );
			$font_weight = eyewear_option( 'body-typography', 'font-weight', '400' );
			$font_style  = eyewear_option( 'body-typography', 'font-style' );

			$arr[ 'theme-color' ]   = $theme_color;
			$arr[ 'bg-color' ]      = $bg_color;
			$arr[ 'content-color' ] = $contents_color;
			$arr[ 'menu-color' ]    = $menu_color;
			$arr[ 'heading-color' ] = $headings_color;
			$arr[ 'link-color' ]    = $links_color;
			$arr[ 'hover-color' ]   = $hover_color;


			// body typography
			$arr[ 'font-family' ] = $font_family;
			$arr[ 'font-weight' ] = $font_weight;
			$arr[ 'font-style' ]  = $font_style;

			// heading typography
			$arr[ 'heading-font-family' ] = $heading_font_family;
			$arr[ 'heading-font-weight' ] = $heading_font_weight;
			$arr[ 'heading-font-style' ]  = $heading_font_style;

			return apply_filters( 'eyewear_less_variables', $arr );
		}

		add_filter( 'hippo_plugin_set_less_variables', 'eyewear_set_less_variables', 999 );

	endif;