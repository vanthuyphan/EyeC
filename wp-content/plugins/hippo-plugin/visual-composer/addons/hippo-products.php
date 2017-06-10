<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	if ( function_exists( 'vc_map' ) ) :

		$products = array();

		$query = new WP_Query( array(
			                       'post_type'      => 'product',
			                       'posts_per_page' => - 1,
			                       'post_status'    => 'publish'
		                       ) );

		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) :
				$query->the_post();
				$products[] = array(
					'value' => get_the_id(),
					'label' => get_the_title(),
				);
			endwhile;
		endif;

		wp_reset_postdata();

		$hippo_products_array = apply_filters( 'hippo-plugin-vc-hippo_products-map', array(
			"name"        => __( "Products", 'hippo-plugin' ),
			"base"        => "hippo_products",
			"icon"        => "fa fa-cart-plus",
			"class"       => "",
			'category'    => sprintf( esc_html__( '%s Theme Elements', 'hippo-plugin' ), HIPPO_PLUGIN_THEME_NAME ),
			"description" => __( 'Display single product', 'hippo-plugin' ),
			"params"      => apply_filters( 'hippo-plugin-vc-hippo_products-params', array(
				array(
					"type"        => "autocomplete",
					"admin_label" => TRUE,
					'settings'    => array( 'values' => $products, 'multiple' => FALSE ),
					"heading"     => __( "Select Product", 'hippo-plugin' ),
					"param_name"  => "product_post_id",
					"description" => __( "Select produtct that would you like to display", 'hippo-plugin' )
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

		vc_map( $hippo_products_array );

		if ( class_exists( 'WPBakeryShortCode' ) and ! class_exists( 'WPBakeryShortCode_Hippo_Products' ) ) :
			class WPBakeryShortCode_Hippo_Products extends WPBakeryShortCode {
			}
		endif; // class_exists( 'WPBakeryShortCode' ) and ! class_exists( 'WPBakeryShortCode_Hippo_Products' )
	endif; // function_exists( 'vc_map' )

