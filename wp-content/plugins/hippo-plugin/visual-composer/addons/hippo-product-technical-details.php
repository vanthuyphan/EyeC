<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	if ( function_exists( 'vc_map' ) ) :


		//---------------------------------------------------------------------
		// Hippo Join US Wrapper
		//---------------------------------------------------------------------

		// $titles = vc_param_group_parse_atts( $atts['titles'] );
		$hippo_product_technical_details_array = apply_filters( 'hippo-plugin-vc-hippo_product_technical_details-map', array(
			"name"                    => __( "Technical Details", 'hippo-plugin' ),
			"base"                    => "hippo_product_technical_details",
			"icon"                    => "fa fa-black-tie",
			"show_settings_on_create" => TRUE,
			"description"             => __( 'Product Technical Details', 'hippo-plugin' ),
			'category'                => sprintf( esc_html__( '%s Theme Elements', 'hippo-plugin' ), HIPPO_PLUGIN_THEME_NAME ),
			"params"                  => apply_filters( 'hippo-plugin-vc-hippo_product_technical_details-params', array(

				// add params same as with any other content element
				array(
					"type"        => "textfield",
					"heading"     => __( "Title", 'hippo-plugin' ),
					"param_name"  => "title",
					"std"         => __( "Read more technical details", 'hippo-plugin' ),
					"description" => __( "Technical Details Title.", 'hippo-plugin' ),
					"admin_label" => TRUE,
				),
				array(
					'type'        => 'el_id',
					'param_name'  => 'section_id',
					'value'       => 'read-more-specification-' . rand( 10, 9999 ),
					'heading'     => __( 'Section ID', 'hippo-plugin' ),
					'description' => __( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'hippo-plugin' ),
				),
				array(
					'type'       => 'param_group',
					'value'      => urlencode( json_encode( array(
						                                        array(
							                                        'title' => '',
							                                        'value' => '',
						                                        )
					                                        ) ) ),
					'param_name' => 'items',
					// Note params is mapped inside param-group:
					'params'     => array(

						array(
							'type'       => 'textfield',
							'value'      => '',
							'heading'    => __( "Title", 'hippo-plugin' ),
							'param_name' => 'title',
						),
						array(
							'type'       => 'textfield',
							'value'      => '',
							'heading'    => __( "Value", 'hippo-plugin' ),
							'param_name' => 'value',
						)
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

		vc_map( $hippo_product_technical_details_array );


		if ( class_exists( 'WPBakeryShortCode' ) and ! class_exists( 'WPBakeryShortCode_hippo_product_technical_details' ) ) :
			class WPBakeryShortCode_hippo_product_technical_details extends WPBakeryShortCode {

			}
		endif; // class_exists( 'WPBakeryShortCode' )

	endif;