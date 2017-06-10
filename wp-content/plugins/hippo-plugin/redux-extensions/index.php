<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );


	if ( ! function_exists( 'redux_register_hippo_extension_loader' ) ) :

		function redux_register_hippo_extension_loader( $ReduxFramework ) {

			$extension_path = trailingslashit( HIPPO_PLUGIN_PATH . 'redux-extensions' );


			foreach ( glob( $extension_path . "*", GLOB_ONLYDIR ) as $folder ) :

				$extension_class_dir_name = basename( $folder );
				$extension_class_name     = 'ReduxFramework_Extension_' . $extension_class_dir_name;


				if ( ! class_exists( $extension_class_name ) ) :

					$class_file = sprintf( 'redux-extensions/%1$s/extension_%1$s.php', $extension_class_dir_name );
					$class_file = apply_filters( 'redux/extension/' . $ReduxFramework->args[ 'opt_name' ] . '/' . $extension_class_dir_name, $class_file );

					require_once HIPPO_PLUGIN_PATH . $class_file;

					new $extension_class_name( $ReduxFramework );

				endif;

			endforeach;


		}

		// Modify {$redux_opt_name} to match your opt_name
		//add_action( "redux/extensions/{$redux_opt_name}/before", 'redux_register_hippo_extension_loader', 0 );
		add_action( "redux/extensions/before", 'redux_register_hippo_extension_loader', 0 );
	endif;


	if ( ! function_exists( 'hippo_plugin_preset_mapper' ) ):

		function hippo_plugin_preset_mapper( $section ) {


			foreach ( $section[ 'fields' ] as $key => $fields ) {

				if ( isset( $fields[ 'presets' ] ) and is_array( $fields[ 'presets' ] ) ) {

					$preset_names   = $fields[ 'options' ];
					$preset_defined = $fields[ 'presets' ];
					$preset_id      = $fields[ 'id' ];
					$section_id     = $fields[ 'section_id' ];

					foreach ( $preset_names as $name => $value ) {

						foreach ( $preset_defined as $preset_define ) {

							$preset_define[ 'required' ]   = array( $preset_id, '=', $name );
							$preset_define[ 'id' ]         = $name . '-' . $preset_define[ 'id' ];
							$preset_define[ 'section_id' ] = $section_id;

							if ( isset( $preset_define[ 'default' ] ) and isset( $preset_define[ 'default' ][ $name ] ) ) {
								$preset_define[ 'default' ] = $preset_define[ 'default' ][ $name ];
							}

							$section[ 'fields' ][] = $preset_define;

						}
					}
				}
			}

			return $section;
		}

	endif;


	if ( ! function_exists( 'hippo_plugin_preset_manager_construct' ) ):

		function hippo_plugin_preset_manager_construct( $ReduxFramework ) {

			$redux_opt_name = $ReduxFramework->args[ 'opt_name' ];

			add_filter( 'redux/options/' . $redux_opt_name . '/section/hippo_preset_manager', 'hippo_plugin_preset_mapper' );
		}

		add_action( 'redux/construct', 'hippo_plugin_preset_manager_construct' );

	endif;
