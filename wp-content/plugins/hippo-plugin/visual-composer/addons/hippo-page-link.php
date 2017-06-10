<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	if ( function_exists( 'vc_map' ) ) :

		$pages = array();

		$query = new WP_Query( array(
			                       'post_type'      => 'page',
			                       'posts_per_page' => - 1,
			                       'post_status'    => 'publish'
		                       ) );

		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) :
				$query->the_post();
				$pages[] = array(
					'value' => get_the_id(),
					'label' => get_the_title(),
				);
			endwhile;
		endif;

		wp_reset_postdata();


		$hippo_page_link_array = apply_filters( 'hippo-plugin-vc-hippo_page_link-map', array(
			"name"        => __( "Page Link", 'hippo-plugin' ),
			"base"        => "hippo_page_link",
			"icon"        => "fa fa-external-link",
			"class"       => "",
			'category'    => sprintf( esc_html__( '%s Theme Elements', 'hippo-plugin' ), HIPPO_PLUGIN_THEME_NAME ),
			"description" => esc_html__( 'Display page link', 'hippo-plugin' ),
			"params"      => apply_filters( 'hippo-plugin-vc-hippo_page_link-params', array(
				array(
					"type"        => "autocomplete",
					"admin_label" => TRUE,
					'settings'    => array( 'values' => $pages, 'multiple' => FALSE ),
					"heading"     => esc_html__( "Choose a page", 'hippo-plugin' ),
					"param_name"  => "page_id",
					"description" => esc_html__( "Select page that would you like to link", 'hippo-plugin' )
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Link text", 'hippo-plugin' ),
					"admin_label" => TRUE,
					"param_name"  => "link_text",
					"description" => esc_html__( "Link text.", 'hippo-plugin' ),
				),
				array(
					"type"        => "dropdown",
					"heading"     => esc_html__( "Link target", 'hippo-plugin' ),
					"param_name"  => "target",
					"description" => esc_html__( "Link target to open page.", 'hippo-plugin' ),
					'value'       => array(
						esc_html__( 'Select option', 'hippo-plugin' ) => '',
						esc_html__( 'New Window', 'hippo-plugin' )    => '_blank',
					)
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Extra class name", 'hippo-plugin' ),
					"param_name"  => "el_class",
					"description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'hippo-plugin' )
				)
			) )
		) );

		vc_map( $hippo_page_link_array );

		if ( class_exists( 'WPBakeryShortCode' ) and ! class_exists( 'WPBakeryShortCode_Hippo_Page_Link' ) ) :
			class WPBakeryShortCode_Hippo_Page_Link extends WPBakeryShortCode {
			}
		endif; // class_exists( 'WPBakeryShortCode' ) and ! class_exists( 'WPBakeryShortCode_Hippo_Page_Link' )
	endif; // function_exists( 'vc_map' )

