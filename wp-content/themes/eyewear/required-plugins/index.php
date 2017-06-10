<?php
	/**
	 * This file represents an example of the code that themes would use to register
	 * the required plugins.
	 *
	 * It is expected that theme authors would copy and paste this code into their
	 * functions.php file, and amend to suit.
	 *
	 * @see        http://tgmpluginactivation.com/configuration/ for detailed documentation.
	 *
	 * @package    TGM-Plugin-Activation
	 * @subpackage Example
	 * @version    2.5.0
	 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
	 * @copyright  Copyright (c) 2011, Thomas Griffin
	 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
	 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
	 */
	/**
	 * Include the TGM_Plugin_Activation class.
	 */
	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	require get_template_directory() . "/required-plugins/class-tgm-plugin-activation.php";

	add_action( 'tgmpa_register', 'eyewear_theme_register_required_plugins' );
	/**
	 * Register the required plugins for this theme.
	 *
	 * In this example, we register five plugins:
	 * - one included with the TGMPA library
	 * - two from an external source, one from an arbitrary source, one from a GitHub repository
	 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
	 *
	 * The variable passed to tgmpa_register_plugins() should be an array of plugin
	 * arrays.
	 *
	 * This function is hooked into tgmpa_init, which is fired within the
	 * TGM_Plugin_Activation class constructor.
	 */
	function eyewear_theme_register_required_plugins() {
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */

		$plugins = array(

			// Hippo Plugin
			array(
				'name'               => 'EyeWear Theme Plugin',
				// The plugin name
				'slug'               => 'hippo-plugin',
				// The plugin slug (typically the folder name)
				'source'             => get_template_directory() . '/required-plugins/plugins/hippo-plugin.zip',
				// The plugin source
				'required'           => TRUE,
				// If false, the plugin is only 'recommended' instead of required
				'version'            => '',
				// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => FALSE,
				// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => FALSE,
				// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '',
				// If set, overrides default API URL and points to an external URL
			),
			// Visual Composer
			array(
				'name'     => 'WPBakery Visual Composer',
				// The plugin name
				'slug'     => 'js_composer',
				// The plugin slug (typically the folder name)
				'source'   => 'http://s3-us-west-2.amazonaws.com/theme-required-plugins/js_composer.zip',
				// The plugin source
				'required' => TRUE,
				// If false, the plugin is only 'recommended' instead of required
			),
			// Revolution Slider
			array(
				'name'     => 'Revolution Slider',
				// The plugin name
				'slug'     => 'revslider',
				// The plugin slug (typically the folder name)
				'source'   => 'http://s3-us-west-2.amazonaws.com/theme-required-plugins/revslider.zip',
				// The plugin source
				'required' => TRUE,
				// If false, the plugin is only 'recommended' instead of required
			),
			// Envato WordPress Toolkit
			array(
				'name'     => 'Envato WordPress Toolkit',
				// The plugin name
				'slug'     => 'envato-wordpress-toolkit',
				// The plugin slug (typically the folder name)
				'source'   => 'https://github.com/envato/envato-wordpress-toolkit/archive/master.zip',
				// The plugin source
				'required' => FALSE,
				// If false, the plugin is only 'recommended' instead of required
			),
			// Contact Form 7
			array(
				'name'     => 'Contact Form 7',
				'slug'     => 'contact-form-7',
				'required' => TRUE,
			),
			// Black Studio TinyMCE Widget
			array(
				'name'     => 'Black Studio TinyMCE Widget',
				'slug'     => 'black-studio-tinymce-widget',
				'required' => TRUE,
			),
			// Redux Framework
			array(
				'name'     => 'Redux Framework',
				'slug'     => 'redux-framework',
				'required' => TRUE,
			),
			// Regenerate Thumbnails
			array(
				'name'     => 'Regenerate Thumbnails',
				'slug'     => 'regenerate-thumbnails',
				'required' => FALSE,
			),
			// WooCommerce
			array(
				'name'     => 'WooCommerce',
				'slug'     => 'woocommerce',
				'required' => FALSE,
			),
			// MailChimp for WordPress
			array(
				'name'     => 'MailChimp for WordPress',
				'slug'     => 'mailchimp-for-wp',
				'required' => FALSE,
			),
		);

		// Change this to your theme text domain, used for internationalising strings
		$theme_text_domain = 'eyewear';

		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'tgmpa',
			// Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',
			// Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins',
			// Menu slug.
			'parent_slug'  => 'themes.php',
			// Parent menu slug.
			'capability'   => 'edit_theme_options',
			// Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => TRUE,
			// Show admin notices or not.
			'dismissable'  => TRUE,
			// If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',
			// If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => FALSE,
			// Automatically activate plugins after installation or not.
			'message'      => '',
			// Message to output right before the plugins table.

		);
		tgmpa( $plugins, $config );
	}

