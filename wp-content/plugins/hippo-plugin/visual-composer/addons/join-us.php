<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	if ( function_exists( 'vc_map' ) ) :

		//---------------------------------------------------------------------
		// Hippo Join US Wrapper
		//---------------------------------------------------------------------

		// $titles = vc_param_group_parse_atts( $atts['titles'] );
		$hippo_join_us_array = apply_filters( 'hippo-plugin-vc-hippo_join_us-map', array(
			"name"                    => __( "Join us", 'hippo-plugin' ),
			"base"                    => "hippo_join_us",
			"icon"                    => "fa fa-pied-piper-alt",
			"show_settings_on_create" => TRUE,
			"description"             => __( 'Join us social links', 'hippo-plugin' ),
			'category'                => sprintf( esc_html__( '%s Theme Elements', 'hippo-plugin' ), HIPPO_PLUGIN_THEME_NAME ),
			"params"                  => apply_filters( 'hippo-plugin-vc-hippo_join_us-params', array(

				// add params same as with any other content element
				array(
					"type"        => "textfield",
					"heading"     => __( "Join Us title", 'hippo-plugin' ),
					"param_name"  => "title",
					"std"         => __( "Join Us On", 'hippo-plugin' ),
					"description" => __( "Join us title.", 'hippo-plugin' ),
					"admin_label" => TRUE,
				),
				array(
					'type'       => 'param_group',
					'value'      => urlencode( json_encode( array(
						                                        array(
							                                        'icon' => 'fa fa-facebook',
							                                        'link' => '#',
						                                        )
					                                        ) ) ),
					'param_name' => 'items',
					// Note params is mapped inside param-group:
					'params'     => array(

						array(
							'type'       => 'iconpicker',
							'value'      => '',
							'heading'    => __( "Choose a social icon", 'hippo-plugin' ),
							'param_name' => 'icon',
						),
						array(
							'type'       => 'textfield',
							'value'      => '',
							'heading'    => __( 'Icon wise social link', 'hippo-plugin' ),
							'param_name' => 'link',
						),
					)
				),
				array(
					"type"        => "textfield",
					"heading"     => __( "Extra class name", 'hippo-plugin' ),
					"param_name"  => "el_class",
					"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'hippo-plugin' )
				)
			) )
		) );

		vc_map( $hippo_join_us_array );


		if ( class_exists( 'WPBakeryShortCode' ) and ! class_exists( 'WPBakeryShortCode_Hippo_Join_Us' ) ) :
			class WPBakeryShortCode_Hippo_Join_Us extends WPBakeryShortCode {

			}
		endif; // class_exists( 'WPBakeryShortCode' )

	endif;