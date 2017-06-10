<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	if ( class_exists( 'Vc_Manager' ) ) :

		//---------------------------------------------------------------------
		// Register Icon Assets
		//---------------------------------------------------------------------

		if ( ! function_exists( 'hippo_vc_iconpicker_base_register_customicon_css' ) ):

			function hippo_vc_iconpicker_base_register_customicon_css() {
				wp_register_style( 'hippo-material-design-icons', HIPPO_PLUGIN_URL . 'css/material-design-iconic-font.min.css', FALSE, WPB_VC_VERSION, 'screen' );
				wp_register_style( 'hippo-flaticon-icons', HIPPO_PLUGIN_URL . 'css/flaticon.css', FALSE, WPB_VC_VERSION, 'screen' );
			}

			add_action( 'vc_base_register_front_css', 'hippo_vc_iconpicker_base_register_customicon_css' );
			add_action( 'vc_base_register_admin_css', 'hippo_vc_iconpicker_base_register_customicon_css' );
		endif; // function_exists( 'hippo_vc_iconpicker_base_register_customicon_css' )


		//---------------------------------------------------------------------
		// Load Icon Assets
		//---------------------------------------------------------------------

		if ( ! function_exists( 'hippo_vc_iconpicker_editor_customicon_jscss' ) ):

			function hippo_vc_iconpicker_editor_customicon_jscss() {
				wp_enqueue_style( 'hippo-material-design-icons' );
				wp_enqueue_style( 'hippo-flaticon-icons' );
			}

			add_action( 'vc_backend_editor_enqueue_js_css', 'hippo_vc_iconpicker_editor_customicon_jscss' );
			add_action( 'vc_frontend_editor_enqueue_js_css', 'hippo_vc_iconpicker_editor_customicon_jscss' );

		endif; // function_exists( 'hippo_vc_iconpicker_editor_customicon_jscss' )


		//---------------------------------------------------------------------
		// Make Icon Available
		//---------------------------------------------------------------------

		if ( ! function_exists( 'hippo_vc_iconpicker_type_custom_icon' ) ):
			function hippo_vc_iconpicker_type_custom_icon( $icons ) {

				$icon     = hippo_plugin_material_icons();
				$icon_arr = array();

				foreach ( $icon as $key => $name ) {
					$icon_arr[] = array( $key => $name );
				}

				return array_merge( $icons, $icon_arr );
			}

			add_filter( 'vc_iconpicker-type-material-icon', 'hippo_vc_iconpicker_type_custom_icon' );


			function hippo_vc_iconpicker_type_custom_icon2( $icons ) {

				$icon     = hippo_plugin_flat_icon_icons();
				$icon_arr = array();

				foreach ( $icon as $key => $name ) {
					$icon_arr[] = array( $key => $name );
				}

				return array_merge( $icons, $icon_arr );
			}

			add_filter( 'vc_iconpicker-type-flaticon-icon', 'hippo_vc_iconpicker_type_custom_icon2' );


		endif; // function_exists( 'hippo_vc_iconpicker_type_custom_icon' )


		//---------------------------------------------------------------------
		// Load MAP Files
		//---------------------------------------------------------------------

		if ( ! function_exists( 'hippo_visual_composer_maps' ) ):

			function hippo_visual_composer_maps() {
				// Load AddOns files
				if ( function_exists( 'vc_map' ) ) :
					foreach ( glob( HIPPO_PLUGIN_DIR . "/visual-composer/addons/*.php" ) as $filename ) :
						include_once $filename;
					endforeach;
				endif;
			}

			//add_action( 'wp_loaded', 'hippo_visual_composer_maps', 10 ); //Show our custom shortcodes first in the list
			add_action( 'vc_after_init', 'hippo_visual_composer_maps', 999 ); //Show our custom shortcodes first in the list
		endif; // function_exists( 'hippo_visual_composer_maps' )


		//---------------------------------------------------------------------
		// Load Includes Files
		//---------------------------------------------------------------------

		if ( ! function_exists( 'hippo_visual_composer_includes' ) ):

			function hippo_visual_composer_includes() {

				// Load AddOns helper files
				foreach ( glob( HIPPO_PLUGIN_DIR . "/visual-composer/includes/*.php" ) as $filename ) :
					include_once $filename;
				endforeach;
			}

			add_action( 'vc_after_mapping', 'hippo_visual_composer_includes', 999 ); //Show our custom shortcodes first in the list
		endif; // function_exists( 'hippo_visual_composer_includes' )


	endif;  // class_exists( 'Vc_Manager' )