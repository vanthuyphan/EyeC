<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	if ( function_exists( 'vc_map' ) ) :

		//---------------------------------------------------------------------
		// Hippo Join US Wrapper
		//---------------------------------------------------------------------

		// $titles = vc_param_group_parse_atts( $atts['titles'] );
		$hippo_video_popup_array = apply_filters( 'hippo-plugin-vc-hippo_video_popup-map', array(
			"name"                    => __( "Video Popup", 'hippo-plugin' ),
			"base"                    => "hippo_video_popup",
			"icon"                    => "fa fa-youtube-play",
			"show_settings_on_create" => TRUE,
			"description"             => __( 'Video Popup', 'hippo-plugin' ),
			'category'                => sprintf( esc_html__( '%s Theme Elements', 'hippo-plugin' ), HIPPO_PLUGIN_THEME_NAME ),
			"params"                  => apply_filters( 'hippo-plugin-vc-hippo_video_popup-params', array(

				// add params same as with any other content element
				array(
					"type"        => "textfield",
					"heading"     => __( "Video Embed Url", 'hippo-plugin' ),
					"param_name"  => "link",
					"std"         => '//www.youtube.com/embed/Mrb0i6Rb7Hc?rel=0&amp;controls=0&amp;autoplay=1&amp;showinfo=0&amp;html5=1',
					"description" => __( "Video link like: //www.youtube.com/embed/Mrb0i6Rb7Hc?rel=0&amp;controls=0&amp;showinfo=0&amp;html5=1", 'hippo-plugin' ),
					"admin_label" => TRUE,
				),
				array(
					'type'        => 'attach_image',
					'heading'     => __( 'Video images', 'hippo-plugin' ),
					'param_name'  => 'image',
					'description' => __( 'Choose images from media library', 'hippo-plugin' )
				),
				array(
					"type"        => "textfield",
					"heading"     => __( "Extra class name", 'hippo-plugin' ),
					"param_name"  => "el_class",
					"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'hippo-plugin' )
				)

			) )
		) );

		vc_map( $hippo_video_popup_array );


		if ( class_exists( 'WPBakeryShortCode' ) and ! class_exists( 'WPBakeryShortCode_hippo_video_popup' ) ) :
			class WPBakeryShortCode_hippo_video_popup extends WPBakeryShortCode {

			}
		endif; // class_exists( 'WPBakeryShortCode' )

	endif;