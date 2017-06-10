<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	if ( function_exists( 'vc_map' ) ) :


		$hippo_newsletter_array = apply_filters( 'hippo-plugin-vc-hippo_newsletter-map', array(
			"name"        => __( "Newsletter", 'hippo-plugin' ),
			"base"        => "hippo_newsletter",
			"icon"        => "fa fa-envelope",
			"class"       => "",
			'category'    => sprintf( esc_html__( '%s Theme Elements', 'hippo-plugin' ), HIPPO_PLUGIN_THEME_NAME ),
			"description" => __( 'Display newsletter signup form', 'hippo-plugin' ),
			"params"      => apply_filters( 'hippo-plugin-vc-hippo_newsletter-params', array(

				array(
					"type"        => "textfield",
					"heading"     => __( "Extra class name", 'hippo-plugin' ),
					"param_name"  => "el_class",
					"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'hippo-plugin' )
				)
			) )
		) );

		vc_map( $hippo_newsletter_array );

		if ( class_exists( 'WPBakeryShortCode' ) and ! class_exists( 'WPBakeryShortCode_Hippo_Newsletter' ) ) :
			class WPBakeryShortCode_Hippo_Newsletter extends WPBakeryShortCode {
			}
		endif; // class_exists( 'WPBakeryShortCode' )
	endif; // function_exists( 'vc_map' )

