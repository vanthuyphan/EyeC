<?php


	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	if ( function_exists( 'vc_map' ) ) :

		$hippo_team_array = apply_filters( 'hippo-plugin-vc-hippo_team-map', array(
			"name"                    => __( "Our Team", 'hippo-plugin' ),
			"description"             => __( "Our Team", 'hippo-plugin' ),
			"base"                    => "hippo_team",
			"icon"                    => "fa fa-users",
			'category'                => sprintf( esc_html__( '%s Theme Elements', 'hippo-plugin' ), HIPPO_PLUGIN_THEME_NAME ),
			"show_settings_on_create" => TRUE,
			"params"                  => apply_filters( 'hippo-plugin-vc-hippo_team-params', array(

				array(
					'type'        => 'attach_image',
					'heading'     => __( 'Team Member Photo', 'hippo-plugin' ),
					'param_name'  => 'image',
					'description' => __( 'Choose Photo from media library', 'hippo-plugin' )
				),
				array(
					"type"        => "textfield",
					"heading"     => __( "Name", 'hippo-plugin' ),
					"param_name"  => "name",
					"description" => __( "Team Member Name", 'hippo-plugin' ),
					"admin_label" => TRUE,
				),
				array(
					"type"        => "textfield",
					"heading"     => __( "Team Member Designation", 'hippo-plugin' ),
					"param_name"  => "designation",
					"description" => __( "Team Member Designation", 'hippo-plugin' )
				),
				array(
					"type"        => "textfield",
					"heading"     => __( "Extra class name", 'hippo-plugin' ),
					"param_name"  => "el_class",
					"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'hippo-plugin' )
				)
			) )
		) );

		vc_map( $hippo_team_array );

		if ( class_exists( 'WPBakeryShortCode' ) and ! class_exists( 'WPBakeryShortCode_Hippo_Team' ) ) :
			class WPBakeryShortCode_Hippo_Team extends WPBakeryShortCode {

			}
		endif; // class_exists( 'WPBakeryShortCode' ) and ! class_exists( 'WPBakeryShortCode_Hippo_Team' )

	endif;