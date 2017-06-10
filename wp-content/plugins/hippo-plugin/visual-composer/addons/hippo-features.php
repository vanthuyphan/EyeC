<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	if ( function_exists( 'vc_map' ) ) :

		global $_hippo_vc_icon_library,
		       $_hippo_vc_icon_fontawesome,
		       $_hippo_vc_icon_openiconic,
		       $_hippo_vc_icon_typeicon,
		       $_hippo_vc_icon_entypoicon,
		       $_hippo_vc_icon_lineicon,
		       $_hippo_vc_icon_materialicon,
		       $_hippo_vc_icon_flaticon;

		$hippo_product_feature_array = apply_filters( 'hippo-plugin-vc-hippo_product_feature-map', array(
			"name"        => __( "Product Features", 'hippo-plugin' ),
			"base"        => "hippo_product_feature",
			"icon"        => "fa fa-bolt",
			"class"       => "",
			'category'    => sprintf( esc_html__( '%s Theme Elements', 'hippo-plugin' ), HIPPO_PLUGIN_THEME_NAME ),
			"description" => __( 'Single Product Features', 'hippo-plugin' ),
			"params"      => apply_filters( 'hippo-plugin-vc-hippo_product_feature-params', array(

				$_hippo_vc_icon_library,
				$_hippo_vc_icon_fontawesome,
				$_hippo_vc_icon_openiconic,
				$_hippo_vc_icon_typeicon,
				$_hippo_vc_icon_entypoicon,
				$_hippo_vc_icon_lineicon,
				$_hippo_vc_icon_materialicon,
				$_hippo_vc_icon_flaticon,
				array(
					"type"        => "textfield",
					"admin_label" => TRUE,
					"heading"     => __( "Product Feature title", 'hippo-plugin' ),
					"param_name"  => "title",
					"description" => __( "Product feature title", 'hippo-plugin' )
				),
				array(
					"type"        => "textarea_html",
					'holder'      => 'div',
					'class'       => '',
					"heading"     => __( "Feature description", 'hippo-plugin' ),
					"param_name"  => "description",
					"description" => __( "Product Feature description", 'hippo-plugin' ),
					'value'       => __( '<p>Click edit button to change this text. </p>', 'hippo-plugin' ),
				),
				vc_map_add_css_animation(),
				array(
					"type"        => "textfield",
					"heading"     => __( "Extra class name", 'hippo-plugin' ),
					"param_name"  => "el_class",
					"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'hippo-plugin' )
				)
			) )
		) );

		vc_map( $hippo_product_feature_array );

		if ( class_exists( 'WPBakeryShortCode' ) and ! class_exists( 'WPBakeryShortCode_Hippo_Product_Feature' ) ) :
			class WPBakeryShortCode_Hippo_Product_Feature extends WPBakeryShortCode {
				/*protected function outputTitle( $title ) {
					return '';
				}*/
			}
		endif; // class_exists( 'WPBakeryShortCode' )
	endif; // function_exists( 'vc_map' )

