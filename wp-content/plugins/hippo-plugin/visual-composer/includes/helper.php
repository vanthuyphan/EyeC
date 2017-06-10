<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	$GLOBALS[ '_hippo_vc_icon_library' ] = array(
		'type'        => 'dropdown',
		'heading'     => __( 'Icon library', 'hippo-plugin' ),
		'value'       => array(
			__( 'Font Awesome', 'hippo-plugin' )  => 'fontawesome',
			__( 'Open Iconic', 'hippo-plugin' )   => 'openiconic',
			__( 'Typicons', 'hippo-plugin' )      => 'typicons',
			__( 'Entypo', 'hippo-plugin' )        => 'entypo',
			__( 'Linecons', 'hippo-plugin' )      => 'linecons',
			__( 'Material Icon', 'hippo-plugin' ) => 'material',
			__( 'Flat Icon', 'hippo-plugin' )     => 'flat',
			//__( 'Pixel', 'hippo-plugin' )         => 'pixelicons',
		),
		'std'         => 'fontawesome',
		'admin_label' => TRUE,
		'param_name'  => 'icon_type',
		'description' => __( 'Select icon library.', 'hippo-plugin' ),
	);

	$GLOBALS[ '_hippo_vc_icon_fontawesome' ] = array(
		'type'        => 'iconpicker',
		'heading'     => __( 'Icon', 'hippo-plugin' ),
		'param_name'  => 'icon_fontawesome',
		'value'       => 'fa fa-adjust', // default value to backend editor admin_label
		'settings'    => array(
			'type' => 'fontawesome'
		),
		'dependency'  => array(
			'element' => 'icon_type',
			'value'   => 'fontawesome',
		),
		'description' => __( 'Select icon from library.', 'hippo-plugin' ),
	);

	$GLOBALS[ '_hippo_vc_icon_openiconic' ] = array(
		'type'        => 'iconpicker',
		'heading'     => __( 'Icon', 'hippo-plugin' ),
		'param_name'  => 'icon_openiconic',
		'value'       => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
		'settings'    => array(
			'type' => 'openiconic',
		),
		'dependency'  => array(
			'element' => 'icon_type',
			'value'   => 'openiconic',
		),
		'description' => __( 'Select icon from library.', 'hippo-plugin' ),
	);

	$GLOBALS[ '_hippo_vc_icon_typeicon' ] = array(
		'type'        => 'iconpicker',
		'heading'     => __( 'Icon', 'hippo-plugin' ),
		'param_name'  => 'icon_typicons',
		'value'       => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
		'settings'    => array(
			'type' => 'typicons',
		),
		'dependency'  => array(
			'element' => 'icon_type',
			'value'   => 'typicons',
		),
		'description' => __( 'Select icon from library.', 'hippo-plugin' ),
	);

	$GLOBALS[ '_hippo_vc_icon_entypoicon' ] = array(
		'type'       => 'iconpicker',
		'heading'    => __( 'Icon', 'hippo-plugin' ),
		'param_name' => 'icon_entypo',
		'value'      => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
		'settings'   => array(
			'type' => 'entypo',
		),
		'dependency' => array(
			'element' => 'icon_type',
			'value'   => 'entypo',
		),
	);

	$GLOBALS[ '_hippo_vc_icon_lineicon' ] = array(
		'type'        => 'iconpicker',
		'heading'     => __( 'Icon', 'hippo-plugin' ),
		'param_name'  => 'icon_linecons',
		'value'       => 'vc_li vc_li-heart', // default value to backend editor admin_label
		'settings'    => array(
			'type' => 'linecons',
		),
		'dependency'  => array(
			'element' => 'icon_type',
			'value'   => 'linecons',
		),
		'description' => __( 'Select icon from library.', 'hippo-plugin' ),
	);

	$GLOBALS[ '_hippo_vc_icon_materialicon' ] = array(
		'type'        => 'iconpicker',
		'heading'     => __( 'Icon', 'hippo-plugin' ),
		'param_name'  => 'icon_material',
		'value'       => 'zmdi zmdi-3d-rotation', // default value to backend editor admin_label
		'settings'    => array(
			'type' => 'material-icon',
		),
		'dependency'  => array(
			'element' => 'icon_type',
			'value'   => 'material',
		),
		'description' => __( 'Select icon from library.', 'hippo-plugin' ),
	);

	$GLOBALS[ '_hippo_vc_icon_flaticon' ] = array(
		'type'        => 'iconpicker',
		'heading'     => __( 'Icon', 'hippo-plugin' ),
		'param_name'  => 'icon_flat',
		'value'       => 'flaticon-checkmark11', // default value to backend editor admin_label
		'settings'    => array(
			'type' => 'flaticon-icon',
		),
		'dependency'  => array(
			'element' => 'icon_type',
			'value'   => 'flat',
		),
		'description' => __( 'Select icon from library.', 'hippo-plugin' ),
	);

	$GLOBALS[ '_hippo_vc_icon_size' ] = array(
		'type'        => 'dropdown',
		'heading'     => __( 'Size', 'hippo-plugin' ),
		'param_name'  => 'size',
		'value'       => array_merge( getVcShared( 'sizes' ), array( 'Extra Large' => 'xl' ) ),
		'std'         => 'md',
		'description' => __( 'Icon size.', 'hippo-plugin' ),
	);

	$GLOBALS[ '_hippo_vc_icon_align' ] = array(
		'type'        => 'dropdown',
		'heading'     => __( 'Icon alignment', 'hippo-plugin' ),
		'param_name'  => 'align',
		'value'       => array(
			__( 'Left', 'hippo-plugin' )   => 'left',
			__( 'Right', 'hippo-plugin' )  => 'right',
			__( 'Center', 'hippo-plugin' ) => 'center',
		),
		'description' => __( 'Select icon alignment.', 'hippo-plugin' ),
	);

	if ( ! function_exists( 'hippo_plugin_get_vc_library_icon' ) ) :
		function hippo_plugin_get_vc_library_icon( $shortcode_attributes, $library_name = FALSE ) {

			if ( ! $library_name ) {
				$library_name = $shortcode_attributes[ 'icon_type' ];
			}

			if ( empty( $library_name ) ) {
				return __return_empty_string();
			}

			vc_icon_element_fonts_enqueue( $library_name );

			return $shortcode_attributes[ 'icon_' . $library_name ];
		}
	endif;