<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	// =================================================================
	// Disable Visual Composer Frontend Editing
	// =================================================================

	if ( function_exists( 'vc_disable_frontend' ) ):
		vc_disable_frontend();
	endif;

	$_eyewear_shortcode_tabs           = array();
	$_eyewear_shortcode_home_carousels = 0;
	$_eyewear_testimonials_attr        = array();

	// =================================================================
	// Visual Composer Row Wrapper Classes
	// =================================================================

	$_eyewear_vc_row_wrapper_css_classes = array(
		'type'        => 'dropdown',
		'heading'     => esc_html__( 'Theme Specific CSS Class', 'eyewear' ),
		'param_name'  => 'hippo_theme_css_class',
		'admin_label' => FALSE,
		'value'       => apply_filters( 'eyewear_vc_row_wrapper_css_classes',
		                                array(
			                                esc_html__( 'Theme Specific CSS Class', 'eyewear' )   => '',
			                                esc_html__( 'Subscribe Bar', 'eyewear' )              => 'th-btm-newsletter',
			                                esc_html__( 'Section top padding', 'eyewear' )        => 'section-top-padding',
			                                esc_html__( 'Section bottom padding', 'eyewear' )     => 'section-bottom-padding',
			                                esc_html__( 'Section top bottom padding', 'eyewear' ) => 'section-top-bottom-padding',
			                                esc_html__( 'Section  title', 'eyewear' )             => 'section-title',
			                                esc_html__( 'Section Specification', 'eyewear' )      => 'section-specification',
			                                esc_html__( 'Section Specification list', 'eyewear' ) => 'specification-list',
			                                esc_html__( 'Section Features', 'eyewear' )           => 'section-feature',
			                                esc_html__( 'Video Full Width Wrapper', 'eyewear' )   => 'video-full-width-wrapper',
			                                esc_html__( 'Video Thumb Wrapper', 'eyewear' )        => 'video-thumb-wrapper',
			                                esc_html__( 'Team Section', 'eyewear' )               => 'hippo-team-section',
			                                esc_html__( 'Product Grid View', 'eyewear' )          => 'hippo-product-grid-view',
			                                esc_html__( 'Eyewear call to action', 'eyewear' )     => 'hippo-call-to-action',
		                                ) ),
		'description' => esc_html__( 'Theme Specific css class', 'eyewear' ),
		'group'       => sprintf( esc_html__( '%s Theme Specific Class', 'eyewear' ), EYEWEAR_THEME_NAME )
	);

	// =================================================================
	// Visual Composer Column Wrapper Classes
	// =================================================================

	$_eyewear_vc_column_wrapper_css_classes = array(
		'type'        => 'dropdown',
		'heading'     => esc_html__( 'Theme Specific CSS Class', 'eyewear' ),
		'param_name'  => 'hippo_theme_css_class',
		'admin_label' => FALSE,
		'value'       => apply_filters( 'eyewear_vc_column_wrapper_css_classes',
		                                array(
			                                esc_html__( 'Theme Specific CSS Class', 'eyewear' ) => '',
			                                esc_html__( 'Specification icon right', 'eyewear' ) => 'specification-left',
			                                esc_html__( 'Specification icon left', 'eyewear' )  => 'specification-right',
			                                esc_html__( 'Specification list', 'eyewear' )       => 'specification-list',
			                                esc_html__( 'Video Full Width Wrapper', 'eyewear' ) => 'video-full-width-wrapper',
			                                esc_html__( 'Video Thumb Wrapper', 'eyewear' )      => 'video-thumb-wrapper',
			                                esc_html__( 'Vertical text align', 'eyewear' )      => 'content-vertical-align',
		                                ) ),
		'description' => esc_html__( 'Theme Specific css class', 'eyewear' ),
		'group'       => sprintf( esc_html__( '%s Theme Specific Class', 'eyewear' ), EYEWEAR_THEME_NAME )
	);

	// =================================================================
	// Add Template Overwrite Path
	// =================================================================

	vc_set_shortcodes_templates_dir( locate_template( 'visual-composer/overrides' ) );

	// =================================================================
	// Visual Composer Admin element stylesheet
	// =================================================================

	if ( ! function_exists( 'eyewear_vc_admin_styles' ) ) :
		function eyewear_vc_admin_styles() {
			wp_enqueue_style( 'hippo_vc_admin_style', eyewear_locate_template_uri( 'visual-composer/assets/css/vc-admin-element-style.css' ), array(), time(), 'all' );
		}

		add_action( 'admin_enqueue_scripts', 'eyewear_vc_admin_styles' );
	endif;

	// =================================================================
	// Visual Composer Load Default Templates
	// =================================================================

	if ( ! function_exists( 'eyewear_load_vc_default_templates' ) ):

		function eyewear_load_vc_default_templates() {

			add_filter( 'vc_load_default_templates', '__return_empty_array' );

			$template_dir = locate_template( 'visual-composer/templates' );

			foreach ( glob( $template_dir . "/*.php" ) as $filename ) :

				$template_name = sprintf( "visual-composer/templates/%s", basename( $filename ) );
				locate_template( $template_name, TRUE );
			endforeach;
		}

		add_action( 'wp_loaded', 'eyewear_load_vc_default_templates', 9 );
	endif;

	// =================================================================
	// Change Visual Composer Shortcode Class
	// =================================================================

	if ( ! function_exists( 'eyewear_change_vc_class' ) ) :

		function eyewear_change_vc_class( $class_string, $tag, $attr ) {
			if ( $tag == 'vc_row' || $tag == 'vc_row_inner' ) {

				//$class_string = str_ireplace( 'vc_row-fluid', '', $class_string );
				//$class_string = str_ireplace( 'vc_row', ' row vc_row', $class_string );
				//$class_string = str_ireplace( 'wpb_row', '', $class_string );
			}

			if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
				//	$class_string = str_ireplace( 'vc_col-', 'col-', $class_string );
			}

			return $class_string;
		}

		add_filter( 'vc_shortcodes_css_class', 'eyewear_change_vc_class', 10, 3 );
	endif;

	// =================================================================
	// Fix for twitter bootstrap support remove some param
	// =================================================================

	vc_remove_param( "vc_row", "full_width" );
	vc_remove_param( "vc_row", "full_height" );
	vc_remove_param( "vc_row", "content_placement" );

	// =================================================================
	// Add bootstrap array
	// =================================================================

	$row_attribute = array(
		$_eyewear_vc_row_wrapper_css_classes,
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Row Style', 'eyewear' ),
			'param_name'  => 'row_width',
			'value'       => array(
				esc_html__( 'Fixed Width', 'eyewear' ) => 'container',
				esc_html__( 'Fluid Width', 'eyewear' ) => 'container-fluid',
				//esc_html__( 'Full Width', 'eyewear' )  => 'container-full'
			),
			'description' => esc_html__( 'Container width', 'eyewear' ),
			'std'         => 'container-fluid'
		)
	);

	$row_inner_attribute = array(
		$_eyewear_vc_row_wrapper_css_classes
	);

	vc_add_params( 'vc_row', apply_filters( 'eyewear-vc_row-attr', $row_attribute ) );
	vc_add_params( 'vc_row_inner', apply_filters( 'eyewear-vc_row_inner-attr', $row_inner_attribute ) );


	$column_attributes = array(
		$_eyewear_vc_column_wrapper_css_classes,
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Custom column class?', 'eyewear' ),
			'param_name'  => 'custom_columns',
			'description' => esc_html__( 'Add class on column like: col-ms-6, hidden-ms', 'eyewear' ),
			'group'       => esc_html__( 'Custom column', 'eyewear' )
		),
		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Add Clear fix after this column?', 'eyewear' ),
			'param_name'  => 'active_clearfix',
			'description' => esc_html__( 'If checked, a div appended after this column with clearfix class', 'eyewear' ),
			'value'       => array( esc_html__( 'Yes', 'eyewear' ) => 'yes' ),
			'group'       => esc_html__( 'Clear Columns', 'eyewear' )
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Clear fix visibility class(es):', 'eyewear' ),
			'param_name'  => 'clear_fix_classes',
			'description' => wp_kses( __( 'Clearfix div activated on this class like: <code>visible-sm-block</code> or <code>visible-xs-inline</code>. <br>Available <code>visible-*-block</code> <code>visible-*-inline-block</code> <code>visible-*-inline</code>). Use multiple with space.', 'eyewear' ), array(
				'code' => array(),
				'br'   => array()
			) ),
			'dependency'  => array(
				'element' => 'active_clearfix',
				'value'   => 'yes',
			),
			'group'       => esc_html__( 'Clear Columns', 'eyewear' )
		)
	);

	vc_add_params( 'vc_column', apply_filters( 'eyewear-vc_column-attr', $column_attributes ) );
	vc_add_params( 'vc_column_inner', apply_filters( 'eyewear-vc_column-attr', apply_filters( 'eyewear-vc_column_inner-attr', $column_attributes ) ) );

	// =================================================================
	//  Visual Composer Frontend CSS Override
	// =================================================================

	if ( ! function_exists( 'visual_composer_css_override' ) ):

		function visual_composer_css_override() {
			wp_enqueue_style( 'js_composer_front-override', eyewear_locate_template_uri( 'css/js_composer-override.css' ), FALSE, '', 'all' );
		}
	endif;

	if ( ! function_exists( 'visual_composer_register_front_css' ) ):

		function visual_composer_register_front_css() {
			add_action( 'wp_enqueue_scripts', 'visual_composer_css_override' );
		}

		add_action( 'vc_base_register_front_css', 'visual_composer_register_front_css' );
	endif;