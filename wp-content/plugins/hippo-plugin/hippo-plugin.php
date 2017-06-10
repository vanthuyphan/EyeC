<?php
	/**
	 * Plugin Name: Hippo Theme Plugin
	 * Description: Theme Hippo theme plugin
	 * Version: 1.0
	 * Domain Path: /languages
	 * Text Domain: hippo-plugin
	 * Author: Theme Hippo
	 * Author URI: http://www.themehippo.com
	 * License: A "GPL2"
	 */

	//---------------------------------------------------------------------
	// Defining Constance
	//---------------------------------------------------------------------

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	if ( ! defined( 'HIPPO_PLUGIN_THEME_NAME' ) ) {
		define( 'HIPPO_PLUGIN_THEME_NAME', wp_get_theme()->get( 'Name' ) );
	} // defined( 'HIPPO_PLUGIN_THEME_NAME' )

	if ( ! defined( 'HIPPO_PLUGIN_THEME_VERSION' ) ) {
		define( 'HIPPO_PLUGIN_THEME_VERSION', wp_get_theme()->get( 'Version' ) );
	} // defined( 'HIPPO_PLUGIN_THEME_VERSION' )

	define( 'HIPPO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
	define( 'HIPPO_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
	define( 'HIPPO_PLUGIN_DIR', dirname( __FILE__ ) );
	define( 'HIPPO_PLUGIN_RELATIVE_PATH', dirname( plugin_basename( __FILE__ ) ) );
	define( 'HIPPO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
	define( 'HIPPO_PLUGIN_FILE', __FILE__ );

	//---------------------------------------------------------------------
	// Loading TextDomain
	//---------------------------------------------------------------------

	if ( ! function_exists( 'hippo_plugin_init' ) ):
		function hippo_plugin_init() {
			load_plugin_textdomain( 'hippo-plugin', FALSE, HIPPO_PLUGIN_RELATIVE_PATH . '/languages' );
		}

		add_action( 'plugins_loaded', 'hippo_plugin_init' );
	endif; // function_exists( 'hippo_plugin_init' )

	//---------------------------------------------------------------------
	// Add settings link to plugins page
	//---------------------------------------------------------------------

	if ( ! function_exists( 'hippo_plugin_settings_link' ) ):

		function hippo_plugin_settings_link( $links ) {

			if ( is_plugin_active( HIPPO_PLUGIN_BASENAME ) ) {
				$action_links = apply_filters( 'hippo_plugin_action_links', array(
					'settings' => sprintf( '<a href="' . esc_url( apply_filters( 'hippo_plugin_settings_url', admin_url( 'admin.php?page=%1$s' ) ) ) . '" title="' . esc_attr__( '%1$s Theme Settings', 'hippo-plugin' ) . '">' . esc_html__( '%1$s Settings', 'hippo-plugin' ) . '</a>', HIPPO_PLUGIN_THEME_NAME ),
				) );

				return array_merge( $action_links, $links );
			}

			return (array) $links;
		}

		add_filter( 'plugin_action_links_' . HIPPO_PLUGIN_BASENAME, 'hippo_plugin_settings_link', 999 );

	endif;

	//---------------------------------------------------------------------
	// Add row meta link to plugins page
	//---------------------------------------------------------------------

	if ( ! function_exists( 'hippo_plugin_row_meta' ) ):

		function hippo_plugin_row_meta( $links, $file ) {

			if ( $file == HIPPO_PLUGIN_BASENAME and is_plugin_active( $file ) ) {
				$row_meta = apply_filters( 'hippo_plugin_row_meta', array(
					'docs'    => sprintf( '<a target="_blank" href="' . esc_url( apply_filters( 'hippo_plugin_docs_url', 'http://goo.gl/GrorVE' ) ) . '" title="' . esc_attr__( 'View %1$s Theme Documentation', 'hippo-plugin' ) . '">' . esc_html__( '%1$s Theme Documentation', 'hippo-plugin' ) . '</a>', HIPPO_PLUGIN_THEME_NAME ),
					//'video'   => sprintf( '<a target="_blank" href="' . esc_url( apply_filters( 'hippo_plugin_video_url', 'https://goo.gl/ZH4Thq' ) ) . '" title="' . esc_attr__( 'View %1$s Theme How to Videos', 'hippo-plugin' ) . '">' . esc_html__( '%1$s Theme Videos', 'hippo-plugin' ) . '</a>', HIPPO_PLUGIN_THEME_NAME ),
					'support' => sprintf( '<a target="_blank" href="' . esc_url( apply_filters( 'hippo_plugin_support_url', 'http://goo.gl/jkpJTT' ) ) . '" title="' . esc_attr__( 'Goto %1$s Theme Support', 'hippo-plugin' ) . '">' . esc_html__( '%1$s Theme Support', 'hippo-plugin' ) . '</a>', HIPPO_PLUGIN_THEME_NAME ),
				) );

				return array_merge( $links, $row_meta );
			}

			return (array) $links;
		}

		add_filter( 'plugin_row_meta', 'hippo_plugin_row_meta', 999, 2 );

	endif;


	//---------------------------------------------------------------------
	// Loading Admin Scripts, StyleSheets
	//---------------------------------------------------------------------

	if ( ! function_exists( 'hippo_plugin_admin_scripts' ) ):

		function hippo_plugin_admin_scripts() {

			// hippo-plugin-before_admin_enqueue_scripts
			do_action( 'hippo-plugin-before_admin_enqueue_scripts', __FILE__ );

			// Load Font Awesome CSS
			wp_enqueue_style( 'hippo-plugin-fontawesome', HIPPO_PLUGIN_URL . 'css/font-awesome.min.css' );

			// Material Design Icon CSS
			wp_enqueue_style( 'hippo-material-design-icons', HIPPO_PLUGIN_URL . 'css/material-design-iconic-font.min.css' );

			// Flat Icon CSS
			wp_enqueue_style( 'hippo-flat-icons', HIPPO_PLUGIN_URL . 'css/flaticon.css' );

			// Select 2 CSS
			wp_enqueue_style( 'hippo-plugin-select2', HIPPO_PLUGIN_URL . 'css/select2.min.css' );

			// Plugin CSS
			wp_enqueue_style( 'hippo-admin-style', HIPPO_PLUGIN_URL . 'css/hippo.css' );

			// select 2 JS
			wp_enqueue_script( 'hippo-plugin-select2', HIPPO_PLUGIN_URL . 'js/select2.min.js' );

			// form field dependency JS
			wp_enqueue_script( 'hippo-form-dependency', HIPPO_PLUGIN_URL . 'js/form-field-dependency.js' );

			// Plugin JS script
			wp_enqueue_script( 'hippo-admin-script', HIPPO_PLUGIN_URL . 'js/hippo.js' );

			// hippo-plugin-after_admin_enqueue_scripts action
			do_action( 'hippo-plugin-after_admin_enqueue_scripts', __FILE__ );
		}

		add_action( 'admin_enqueue_scripts', 'hippo_plugin_admin_scripts' );
	endif; // function_exists( 'hippo_plugin_admin_scripts' )

	//---------------------------------------------------------------------
	// Loading Visual Composer 
	//---------------------------------------------------------------------

	if ( ! function_exists( 'hippo_plugin_load_vc_short_codes' ) ) :

		function hippo_plugin_load_vc_short_codes() {
			include_once HIPPO_PLUGIN_DIR . "/visual-composer/index.php";
		}

		add_action( 'after_setup_theme', 'hippo_plugin_load_vc_short_codes' );
	endif; // function_exists( 'hippo_plugin_load_vc_short_codes' )

	//---------------------------------------------------------------------
	// Session Manager
	//---------------------------------------------------------------------

	require_once HIPPO_PLUGIN_DIR . "/session/hippo-session-manager.php";

	//---------------------------------------------------------------------
	// Loading Icons functions
	//---------------------------------------------------------------------

	require_once HIPPO_PLUGIN_DIR . "/hippo-icons/index.php";

	//---------------------------------------------------------------------
	// Loading Short code generator
	//---------------------------------------------------------------------

	require_once HIPPO_PLUGIN_DIR . "/shortcode/index.php";

	//---------------------------------------------------------------------
	// Loading metabox generator
	//---------------------------------------------------------------------

	require_once HIPPO_PLUGIN_DIR . "/metaboxes/index.php";

	//---------------------------------------------------------------------
	// Loading custom post type generator
	//---------------------------------------------------------------------

	require_once HIPPO_PLUGIN_DIR . "/post-types/index.php";

	//---------------------------------------------------------------------
	// Loading Demo data installer
	//---------------------------------------------------------------------

	require_once HIPPO_PLUGIN_DIR . "/data-import/index.php";

	//---------------------------------------------------------------------
	// Admin Menu Meta
	//---------------------------------------------------------------------

	require_once HIPPO_PLUGIN_DIR . "/menu-meta/index.php";

	//---------------------------------------------------------------------
	// Widget Class Field
	//---------------------------------------------------------------------

	require_once HIPPO_PLUGIN_DIR . "/widgets-attr/index.php";

	//---------------------------------------------------------------------
	// Widgets
	//---------------------------------------------------------------------

	require_once HIPPO_PLUGIN_DIR . "/widgets/index.php";

	//---------------------------------------------------------------------
	// Post Likes
	//---------------------------------------------------------------------

	require_once HIPPO_PLUGIN_DIR . "/post-likes/index.php";

	//---------------------------------------------------------------------
	// Post Views
	//---------------------------------------------------------------------

	require_once HIPPO_PLUGIN_DIR . "/post-views/index.php";

	//---------------------------------------------------------------------
	// Less CSS Compiler
	//---------------------------------------------------------------------

	require_once HIPPO_PLUGIN_DIR . "/lesscss/index.php";

	//---------------------------------------------------------------------
	// Taxonomy Meta
	//---------------------------------------------------------------------

	require_once HIPPO_PLUGIN_DIR . "/term-meta/index.php";

	//---------------------------------------------------------------------
	// Woocommerce Currancy Switcher
	//---------------------------------------------------------------------

	require_once HIPPO_PLUGIN_DIR . "/currency-switcher/index.php";


	//----------------------------------------------------------------------
	// Load Redux Extensions - MUST be loaded before your options are set
	//----------------------------------------------------------------------


	require_once HIPPO_PLUGIN_DIR . "/redux-extensions/index.php";

	require_once HIPPO_PLUGIN_DIR . "/helper.php";

	do_action( 'hippo_plugin_loaded', __FILE__ );





