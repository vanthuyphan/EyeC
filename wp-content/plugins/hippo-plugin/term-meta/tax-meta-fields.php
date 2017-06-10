<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	if ( ! function_exists( 'hippo_variation_styling' ) ):

		function hippo_variation_styling() {

			$fields = array();

			$fields[ 'color' ] = array(
				array(
					'label' => __( 'Color', 'hippo-plugin' ), // <label>
					'desc'  => __( 'Choose a color', 'hippo-plugin' ), // description
					'id'    => 'product_attribute_color', // name of field
					'type'  => 'color'
				)
			);

			$fields[ 'image' ] = array(
				array(
					'label' => __( 'Image', 'hippo-plugin' ), // <label>
					'desc'  => __( 'Choose a Image', 'hippo-plugin' ), // description
					'id'    => 'product_attribute_image', // name of field
					'type'  => 'image'
				)
			);

			if ( function_exists( 'wc_get_attribute_taxonomies' ) ):

				$attribute_taxonomies = wc_get_attribute_taxonomies();
				if ( $attribute_taxonomies ) :
					foreach ( $attribute_taxonomies as $tax ) :
						$product_attr      = wc_attribute_taxonomy_name( $tax->attribute_name );
						$product_attr_type = $tax->attribute_type;
						if ( in_array( $product_attr_type, array( 'color', 'image' ) ) ) :
							new Hippo_Term_Meta( $product_attr, 'product', $fields[ $product_attr_type ] );
						endif; //  in_array( $product_attr_type, array( 'color', 'image' ) )
					endforeach; // $attribute_taxonomies
				endif; // $attribute_taxonomies
			endif; // function_exists( 'wc_get_attribute_taxonomies' )

		}

		add_action( 'admin_init', 'hippo_variation_styling' );

	endif;
