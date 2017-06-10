<?php

	/**
	 * Theme Settings Config File
	 *
	 */

	defined( 'ABSPATH' ) or die( 'Keep Silent' );


	// This is your option name where all the Redux data is stored.
	$redux_opt_name = eyewear_option_name();


	//===============================================================================
	//  SET ARGUMENTS
	// For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
	//===============================================================================

	$theme = wp_get_theme(); // For use with some settings. Not necessary.

	$args = array(
		// TYPICAL -> Change these values as you need/desire
		'opt_name'                  => $redux_opt_name,
		// This is where your data is stored in the database and also becomes your global variable name.
		'display_name'              => $theme->get( 'Name' ),
		// Name that appears at the top of your panel
		'display_version'           => $theme->get( 'Version' ),
		// Version that appears at the top of your panel
		'menu_type'                 => 'menu',
		//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
		'allow_sub_menu'            => TRUE,
		// Show the sections below the admin menu item or not
		'menu_title'                => sprintf( esc_html__( '%s Options', 'eyewear' ), $theme->get( 'Name' ) ),
		'page_title'                => sprintf( esc_html__( '%s Theme Options', 'eyewear' ), $theme->get( 'Name' ) ),
		// You will need to generate a Google API key to use this feature.
		// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
		'google_api_key'            => '',
		// Set it you want google fonts to update weekly. A google_api_key value is required.
		'google_update_weekly'      => FALSE,
		// Must be defined to add google fonts to the typography module
		'async_typography'          => FALSE,
		// Use a asynchronous font on the front end or font string
		'disable_google_fonts_link' => FALSE,
		// Disable this in case you want to create your own google fonts loader
		'admin_bar'                 => TRUE,
		// Show the panel pages on the admin bar
		'admin_bar_icon'            => 'dashicons-admin-generic',
		// Choose an icon for the admin bar menu
		'admin_bar_priority'        => 50,
		// Choose an priority for the admin bar menu
		'global_variable'           => '',
		// Set a different name for your global variable other than the opt_name
		'dev_mode'                  => FALSE,
		'forced_dev_mode_off'       => FALSE,
		// Show the time the page took to load, etc
		'update_notice'             => TRUE,
		// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
		'customizer'                => TRUE,
		// Enable basic customizer support
		//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
		//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

		// OPTIONAL -> Give you extra features
		'page_priority'             => '40',
		// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
		'page_parent'               => 'themes.php',
		// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
		'page_permissions'          => 'manage_options',
		// Permissions needed to access the options panel.
		'menu_icon'                 => '',
		// Specify a custom URL to an icon
		'last_tab'                  => '',
		// Force your panel to always open to a specific tab (by id)
		'page_icon'                 => 'icon-themes',
		// Icon displayed in the admin panel next to your menu_title
		'page_slug'                 => '',
		// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
		'save_defaults'             => TRUE,
		// On load save the defaults to DB before user clicks save or not
		'default_show'              => FALSE,
		// If true, shows the default value next to each field that is not the default value.
		'default_mark'              => '',
		// What to print by the field's title if the value shown is default. Suggested: *
		'show_import_export'        => TRUE,
		// Shows the Import/Export panel when not used as a field.

		// CAREFUL -> These options are for advanced use only
		'transient_time'            => 60 * MINUTE_IN_SECONDS,
		'output'                    => TRUE,
		// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
		'output_tag'                => TRUE,
		// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
		'footer_credit'             => sprintf( esc_html__( '%s Theme Options', 'eyewear' ), $theme->get( 'Name' ) ),
		// Disable the footer credit of Redux. Please leave if you can help it.

		// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
		'database'                  => '',
		// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
		'use_cdn'                   => TRUE,
		// If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

		// HINTS
		'hints'                     => array(
			'icon'          => 'el el-question-sign',
			'icon_position' => 'right',
			'icon_color'    => 'lightgray',
			'icon_size'     => 'normal',
			'tip_style'     => array(
				'color'   => 'red',
				'shadow'  => TRUE,
				'rounded' => FALSE,
				'style'   => '',
			),
			'tip_position'  => array(
				'my' => 'top left',
				'at' => 'bottom right',
			),
			'tip_effect'    => array(
				'show' => array(
					'effect'   => 'slide',
					'duration' => '500',
					'event'    => 'mouseover',
				),
				'hide' => array(
					'effect'   => 'slide',
					'duration' => '500',
					'event'    => 'click mouseleave',
				),
			),
		)
	);

	// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
	$args[ 'admin_bar_links' ][] = array(
		'href'  => 'http://goo.gl/GrorVE',
		'title' => sprintf( esc_html__( '%s Theme Documentation', 'eyewear' ), $theme->get( 'Name' ) ),
	);

	$args[ 'admin_bar_links' ][] = array(
		'href'  => 'http://goo.gl/jkpJTT',
		'title' => sprintf( esc_html__( '%s Theme Support', 'eyewear' ), $theme->get( 'Name' ) ),
	);

	Redux::setArgs( $redux_opt_name, apply_filters( 'hippo_theme_option_args', $args ) );

	//===============================================================================
	//  END ARGUMENTS
	//===============================================================================

	Redux::setSection( $redux_opt_name, array(
		'icon'   => 'el-icon-cogs',
		'title'  => esc_html__( 'General Settings', 'eyewear' ),
		'fields' => array(
			array(
				'id'       => 'demo-data-installer',
				'type'     => 'switch',
				'title'    => esc_html__( 'Theme Setup Wizard', 'eyewear' ),
				'subtitle' => esc_html__( 'Show or Hide Theme Setup Wizard link on admin bar.', 'eyewear' ),
				'on'       => esc_html__( 'Show', 'eyewear' ),
				'off'      => esc_html__( 'Hide', 'eyewear' ),
				'default'  => TRUE,
			),
			array(
				'id'       => 'show-preloader',
				'type'     => 'switch',
				'title'    => esc_html__( 'Page Preloader', 'eyewear' ),
				'subtitle' => esc_html__( 'Show or Hide page preloader.', 'eyewear' ),
				'on'       => esc_html__( 'Show', 'eyewear' ),
				'off'      => esc_html__( 'Hide', 'eyewear' ),
				'default'  => TRUE,
			),
			array(
				'id'       => 'sticky-sidebar',
				'type'     => 'switch',
				'title'    => esc_html__( 'Sticky Sidebar', 'eyewear' ),
				'subtitle' => esc_html__( 'Enable or Disable Sticky Sidebar.', 'eyewear' ),
				'on'       => esc_html__( 'Enable', 'eyewear' ),
				'off'      => esc_html__( 'Disable', 'eyewear' ),
				'default'  => TRUE,
			),
			array(
				'id'       => 'back-to-top',
				'type'     => 'switch',
				'title'    => esc_html__( 'Back To Top', 'eyewear' ),
				'subtitle' => esc_html__( 'Show or Hide Back To Top.', 'eyewear' ),
				'on'       => esc_html__( 'Show', 'eyewear' ),
				'off'      => esc_html__( 'Hide', 'eyewear' ),
				'default'  => TRUE,
			),
		)
	) );

	Redux::setSection( $redux_opt_name, array(
		'icon'   => 'el el-website',
		'title'  => esc_html__( 'Header Settings', 'eyewear' ),
		'fields' => array(

			array(
				'id'       => 'header-style',
				'type'     => 'image_select',
				'title'    => esc_html__( 'Header style', 'eyewear' ),
				'subtitle' => esc_html__( 'Select Header style.', 'eyewear' ),
				'desc'     => esc_html__( 'Size: 580px &times; 100px', 'eyewear' ),
				'options'  => array(
					'header-style-box'     => array(
						'alt' => esc_html__( 'Header Box', 'eyewear' ),
						'img' => get_template_directory_uri() . '/img/header-style/header-box.png'
					),
					'header-style-default' => array(
						'alt' => esc_html__( 'Header Default', 'eyewear' ),
						'img' => get_template_directory_uri() . '/img/header-style/header-default.png'
					),
				),
				'default'  => 'header-style-default'
			),
			array(
				'id'       => 'sticky-menu',
				'type'     => 'switch',
				'title'    => esc_html__( 'Active Sticky Menu?', 'eyewear' ),
				'subtitle' => esc_html__( 'You can active or deactive sticky menu from here.', 'eyewear' ),
				'on'       => esc_html__( 'Yes', 'eyewear' ),
				'off'      => esc_html__( 'No', 'eyewear' ),
				'default'  => TRUE,
			),
			array(
				'id'       => 'login-form',
				'type'     => 'switch',
				'title'    => esc_html__( 'Login Option', 'eyewear' ),
				'subtitle' => esc_html__( 'You can enable or disable login menu from here.', 'eyewear' ),
				'on'       => esc_html__( 'Enable', 'eyewear' ),
				'off'      => esc_html__( 'Disable', 'eyewear' ),
				'default'  => TRUE,
			),
		)
	) );

	Redux::setSection( $redux_opt_name, array(
		'icon'   => 'el-icon-brush',
		'title'  => esc_html__( 'Preset Settings', 'eyewear' ),
		'id'     => 'hippo_preset_manager',
		'fields' => array(

			array(
				'id'       => 'less-compiler',
				'type'     => 'switch',
				'title'    => esc_html__( 'Less Compiler', 'eyewear' ),
				'subtitle' => esc_html__( 'Turn on builtin less compiler.', 'eyewear' ),
				'on'       => 'Enable',
				'off'      => 'Disable',
				'default'  => FALSE,
			),
			array(
				'id'       => 'compress-less-output',
				'type'     => 'switch',
				'title'    => esc_html__( 'Compress Less Output', 'eyewear' ),
				'subtitle' => esc_html__( 'Compress Less Output for better page load if less compiler is enabled.', 'eyewear' ),
				'on'       => 'Yes',
				'off'      => 'No',
				'default'  => FALSE,
				'required' => array( 'less-compiler', '=', '1' ),
			),
			array(
				'id'    => 'preset_change_warning',
				'type'  => 'info',
				'icon'  => 'el-icon-info-sign',
				'title' => esc_html__( 'Remember Please!', 'eyewear' ),
				'style' => 'warning',
				'desc'  => esc_html__( 'If you wish to change preset or color settings, please make sure "Less Compiler" is enabled. Other wise no css effect will shown.', 'eyewear' )
			),
			'hippo_preset_manager' => array(
				'id'       => 'preset',
				'type'     => 'hippo_preset',
				'title'    => esc_html__( 'Color Presets', 'eyewear' ),
				'subtitle' => esc_html__( 'Theme Color Presets', 'eyewear' ),
				'default'  => 'preset1',
				'options'  => array(
					'preset1' => esc_html__( 'Preset 1', 'eyewear' ),
					'preset2' => esc_html__( 'Preset 2', 'eyewear' ),
					'preset3' => esc_html__( 'Preset 3', 'eyewear' ),
					'preset4' => esc_html__( 'Preset 4', 'eyewear' ),
					'preset5' => esc_html__( 'Preset 5', 'eyewear' ),
				),
				'presets'  => array(
					array(
						'id'       => 'theme-color',
						'type'     => 'color', // hippo_preset_color
						'title'    => esc_html__( 'Theme Base Color', 'eyewear' ),
						'subtitle' => esc_html__( 'Change theme base color', 'eyewear' ),
						'default'  => array(
							'preset1' => '#f1ac59',
							'preset2' => '#41b3ff',
							'preset3' => '#ff847c',
							'preset4' => '#00d8b1',
							'preset5' => '#be9639'
						)
					),
					array(
						'id'       => 'links-color',
						'type'     => 'color', // hippo_preset_color
						'title'    => esc_html__( 'Link Color', 'eyewear' ),
						'subtitle' => esc_html__( 'Change Link Color', 'eyewear' ),
						'default'  => array(
							'preset1' => '#f1ac59',
							'preset2' => '#41b3ff',
							'preset3' => '#ff847c',
							'preset4' => '#00d8b1',
							'preset5' => '#be9639'
						),
					),
					array(
						'id'       => 'hover-color',
						'type'     => 'color', // hippo_preset_color
						'title'    => esc_html__( 'Hover Color', 'eyewear' ),
						'subtitle' => esc_html__( 'Change Hover Color', 'eyewear' ),
						'default'  => array(
							'preset1' => '#fff2a8',
							'preset2' => '#63f5ef',
							'preset3' => '#FFC8C8',
							'preset4' => '#d4ffa3',
							'preset5' => '#fcff90'
						),
					),
					array(
						'id'       => 'body-background-color',
						'type'     => 'color', // hippo_preset_color
						'title'    => esc_html__( 'Body Background Color', 'eyewear' ),
						'subtitle' => esc_html__( 'Change body color', 'eyewear' ),
						'default'  => array(
							'preset1' => '#ffffff',
							'preset2' => '#ffffff',
							'preset3' => '#ffffff',
							'preset4' => '#ffffff',
							'preset5' => '#ffffff'
						)
					),
					array(
						'id'       => 'contents-color',
						'type'     => 'color', // hippo_preset_color
						'title'    => esc_html__( 'Content Color', 'eyewear' ),
						'subtitle' => esc_html__( 'Change content color', 'eyewear' ),
						'default'  => array(
							'preset1' => '#363636',
							'preset2' => '#4f4f4f',
							'preset3' => '#444f5a',
							'preset4' => '#152a38',
							'preset5' => '#363636'
						)
					),
					array(
						'id'       => 'menu-color',
						'type'     => 'color', // hippo_preset_color
						'title'    => esc_html__( 'Menu Color', 'eyewear' ),
						'subtitle' => esc_html__( 'Change menu color', 'eyewear' ),
						'default'  => array(
							'preset1' => '#000000',
							'preset2' => '#353535',
							'preset3' => '#3e4149',
							'preset4' => '#152a38',
							'preset5' => '#101010'
						)
					),
					array(
						'id'       => 'headings-color',
						'type'     => 'color', // hippo_preset_color
						'title'    => esc_html__( 'Heading Color', 'eyewear' ),
						'subtitle' => esc_html__( 'Change all heading color', 'eyewear' ),
						'default'  => array(
							'preset1' => '#000000',
							'preset2' => '#353535',
							'preset3' => '#3e4149',
							'preset4' => '#00d8b1',
							'preset5' => '#be9639'
						)
					),
				),
			),
		)
	) );

	Redux::setSection( $redux_opt_name, array(
		'icon'   => 'el-icon-font',
		'title'  => esc_html__( 'Typography Settings', 'eyewear' ),
		'fields' => array(
			array(
				'id'          => 'body-typography',
				'type'        => 'typography',
				'title'       => esc_html__( 'Body Typography', 'eyewear' ),
				'google'      => TRUE,
				'font-backup' => FALSE,
				'line-height' => FALSE,
				'color'       => FALSE,
				'text-align'  => FALSE,
				//'all_styles'  => TRUE,
				'font-style'  => TRUE,
				'font-size'   => FALSE,
				'subtitle'    => esc_html__( 'Body typography for body font.', 'eyewear' ),
				'default'     => array(
					'font-style'  => '400',
					'font-family' => 'Roboto',
					'google'      => TRUE,
				),
			),
			array(
				'id'          => 'heading-typography',
				'type'        => 'typography',
				'title'       => esc_html__( 'Heading Typography', 'eyewear' ),
				'google'      => TRUE,
				'font-backup' => FALSE,
				'line-height' => FALSE,
				'color'       => FALSE,
				'text-align'  => FALSE,
				//'all_styles'  => TRUE, // if true all font style called from google on frontend
				'font-style'  => TRUE,
				'font-size'   => FALSE,
				'subtitle'    => esc_html__( 'Heading typography font.', 'eyewear' ),
				'default'     => array(
					'font-style'  => '400',
					'font-family' => 'Roboto',
					'google'      => TRUE,
				)
			),
		)
	) );

	Redux::setSection( $redux_opt_name, array(
		'icon'   => 'el-icon-slideshare',
		'title'  => esc_html__( 'Logo Settings', 'eyewear' ),
		'fields' => array(
			array(
				'id'       => 'logo',
				'type'     => 'media',
				'preview'  => 'true',
				'title'    => esc_html__( 'Site logo.', 'eyewear' ),
				'subtitle' => esc_html__( 'Change site logo.', 'eyewear' )
			),
			array(
				'id'       => 'retina-logo',
				'type'     => 'media',
				'preview'  => 'true',
				'title'    => esc_html__( 'Site retina logo (high density)', 'eyewear' ),
				'subtitle' => esc_html__( 'Change retina logo. Dimension should double of site logo.', 'eyewear' ),
			),
		)
	) );

	Redux::setSection( $redux_opt_name, array(
		'icon'   => 'el-icon-lines',
		'title'  => esc_html__( 'Mobile Menu Settings', 'eyewear' ),
		'fields' => array(

			/*array(
				'id'       => 'offcanvas-menu-title',
				'type'     => 'text',
				'title'    => esc_html__( 'Offcanvas Menu Title', 'eyewear' ),
				'subtitle' => esc_html__( 'Change Offcanvas Menu Title', 'eyewear' ),
				'default'  => esc_html__( 'Sidebar Menu', 'eyewear' ),
			),*/
			array(
				'id'      => 'offcanvas-menu-position',
				'type'    => 'image_select',
				'title'   => esc_html__( 'Mobile menu position', 'eyewear' ),
				'options' => array(
					'left'  => array(
						'alt' => 'Left Side',
						'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
					),
					'right' => array(
						'alt' => 'Right Side',
						'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
					),
				),
				'default' => 'left'
			),
			array(
				'id'      => 'offcanvas-menu-effect',
				'type'    => 'select',
				'title'   => esc_html__( 'Mobile menu effect', 'eyewear' ),
				'options' => array(
					'slide-in-on-top'        => esc_html__( 'Slide in on top', 'eyewear' ),
					'reveal'                 => esc_html__( 'Reveal', 'eyewear' ),
					'slide-along'            => esc_html__( 'Slide along', 'eyewear' ),
					'reverse-slide-out'      => esc_html__( 'Reverse slide out', 'eyewear' ),
					'scale-down-pusher'      => esc_html__( 'Scale down pusher', 'eyewear' ),
					'scale-up'               => esc_html__( 'Scale Up', 'eyewear' ),
					'scale-rotate-pusher'    => esc_html__( 'Scale Rotate Pusher', 'eyewear' ),
					'open-door'              => esc_html__( 'Open Door', 'eyewear' ),
					'fall-down'              => esc_html__( 'Fall Down', 'eyewear' ),
					'push-down'              => esc_html__( 'Push Down', 'eyewear' ),
					'rotate-pusher'          => esc_html__( 'Rotate Pusher', 'eyewear' ),
					'three-d-rotate-in'      => esc_html__( '3D Rotate In', 'eyewear' ),
					'three-d-rotate-out'     => esc_html__( '3D Rotate Out', 'eyewear' ),
					'delayed-three-d-rotate' => esc_html__( 'Delayed 3D rotate', 'eyewear' ),
				),
				'default' => 'reveal',
			),
		)
	) );

	Redux::setSection( $redux_opt_name, array(
		'icon'   => 'el-icon-livejournal',
		'title'  => esc_html__( 'Blog Settings', 'eyewear' ),
		'fields' => array(

			array(
				'id'       => 'blog-title',
				'type'     => 'text',
				'title'    => esc_html__( 'Blog Subtitle', 'eyewear' ),
				'subtitle' => esc_html__( 'Write blog sub title here.', 'eyewear' ),
				'default'  => esc_html__( 'Blog', 'eyewear' ),
			),
			array(
				'id'       => 'blog-layout',
				'type'     => 'image_select',
				'title'    => esc_html__( 'Blog Layout', 'eyewear' ),
				'subtitle' => esc_html__( 'Blog layout content and sidebar alignment. Choose from Fullwidth, Left sidebar or Right sidebar layout.', 'eyewear' ),
				'options'  => array(
					'sidebar-no'    => array(
						'alt' => esc_html__( '1 Column', 'eyewear' ),
						'img' => ReduxFramework::$_url . 'assets/img/1col.png'
					),
					'sidebar-left'  => array(
						'alt' => esc_html__( '2 Columns Left', 'eyewear' ),
						'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
					),
					'sidebar-right' => array(
						'alt' => esc_html__( '2 Columns Right', 'eyewear' ),
						'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
					)
				),
				'default'  => 'sidebar-right'
			),
			array(
				'id'       => 'hippo-single-post-sidebar',
				'type'     => 'switch',
				'title'    => esc_html__( 'Single post sidebar', 'eyewear' ),
				'subtitle' => esc_html__( 'Show or hide single post sidebar', 'eyewear' ),
				'on'       => esc_html__( 'Show', 'eyewear' ),
				'off'      => esc_html__( 'Hide', 'eyewear' ),
				'default'  => TRUE,
			),
			array(
				'id'       => 'show-share-button',
				'type'     => 'switch',
				'title'    => esc_html__( 'Show share button', 'eyewear' ),
				'subtitle' => esc_html__( 'You can show or hide social share button from single post.', 'eyewear' ),
				'on'       => esc_html__( 'Show', 'eyewear' ),
				'off'      => esc_html__( 'Hide', 'eyewear' ),
				'default'  => TRUE,
			),
			array(
				'id'       => 'share-button',
				'type'     => 'checkbox',
				'required' => array( 'show-share-button', '=', '1' ),
				'title'    => esc_html__( 'Share button', 'eyewear' ),
				'subtitle' => esc_html__( 'Check mark for showing share button', 'eyewear' ),
				'options'  => array(
					'facebook' => esc_html__( 'Facebook', 'eyewear' ),
					'twitter'  => esc_html__( 'Twitter', 'eyewear' ),
					'google'   => esc_html__( 'Google+', 'eyewear' ),
					'linkedin' => esc_html__( 'Linkedin', 'eyewear' )
				),
				'default'  => array(
					'facebook' => '1',
					'twitter'  => '1',
					'google'   => '1',
					'linkedin' => '1',
				)
			),
			array(
				'id'       => 'post-navigation',
				'type'     => 'switch',
				'title'    => esc_html__( 'Post navigation', 'eyewear' ),
				'subtitle' => esc_html__( 'Blog single post navigation', 'eyewear' ),
				'desc'     => esc_html__( '< Previous Article | Next Article >', 'eyewear' ),
				'on'       => esc_html__( 'Show', 'eyewear' ),
				'off'      => esc_html__( 'Hide', 'eyewear' ),
				'default'  => TRUE,
			),
			array(
				'id'       => 'blog-page-nav',
				'type'     => 'switch',
				'title'    => esc_html__( 'Blog Pagination or Navigation', 'eyewear' ),
				'subtitle' => esc_html__( 'Blog pagination style, posts pagination or newer / older posts', 'eyewear' ),
				'desc'     => esc_html__( 'Older Entries | Newer Entries, posts pagination [1 | 2 | 3 ... 8 | 9]', 'eyewear' ),
				'on'       => esc_html__( 'Pagination', 'eyewear' ),
				'off'      => esc_html__( 'Navigation', 'eyewear' ),
				'default'  => TRUE,
			),
		)
	) );

	Redux::setSection( $redux_opt_name, array(
		'icon'   => 'el-icon-file-edit',
		'title'  => esc_html__( 'Page Settings', 'eyewear' ),
		'fields' => array(

			array(
				'id'       => 'page-layout',
				'type'     => 'image_select',
				'title'    => esc_html__( 'Page Layout', 'eyewear' ),
				'subtitle' => esc_html__( 'Page layout content and sidebar alignment. Choose from Fullwidth, Left sidebar or Right sidebar layout.', 'eyewear' ),
				'options'  => array(
					'sidebar-no'    => array(
						'alt' => esc_html__( '1 Column', 'eyewear' ),
						'img' => ReduxFramework::$_url . 'assets/img/1col.png'
					),
					'sidebar-left'  => array(
						'alt' => esc_html__( '2 Columns Left', 'eyewear' ),
						'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
					),
					'sidebar-right' => array(
						'alt' => esc_html__( '2 Columns Right', 'eyewear' ),
						'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
					)
				),
				'default'  => 'sidebar-right'
			),
			array(
				'id'       => 'page-comment',
				'type'     => 'switch',
				'title'    => esc_html__( 'Globally enable or disable page comments', 'eyewear' ),
				'subtitle' => esc_html__( 'Enable or Disabled Page Comments.', 'eyewear' ),
				'on'       => esc_html__( 'Enable', 'eyewear' ),
				'off'      => esc_html__( 'Disabled', 'eyewear' ),
				'default'  => FALSE,
			),
		)
	) );


	// Show Option Of Woocommerce is enabled :)
	if ( class_exists( 'WooCommerce' ) ):

		Redux::setSection( $redux_opt_name, array(
			'icon'   => 'el-icon-shopping-cart',
			'title'  => esc_html__( 'Shop Settings', 'eyewear' ),
			'fields' => array(

				array(
					'id'      => 'shop-perpage',
					'type'    => 'text',
					'title'   => esc_html__( 'Shop page product display limit', 'eyewear' ),
					'desc'    => esc_html__( 'Enter post number that you want to show product on shop page.', 'eyewear' ),
					'default' => 12,
				),
				array(
					'id'      => 'shop-cat-perpage',
					'type'    => 'text',
					'title'   => esc_html__( 'Shop category page product display limit', 'eyewear' ),
					'desc'    => esc_html__( 'Enter post number that you want to show product on shop category page.', 'eyewear' ),
					'default' => 12,
				),
				array(
					'id'      => 'shop-related-limit',
					'type'    => 'text',
					'title'   => esc_html__( 'Related product display limit', 'eyewear' ),
					'desc'    => esc_html__( 'Enter post number that you want to show product on related product.', 'eyewear' ),
					'default' => 4,
				),
				array(
					'id'      => 'variation-attribute',
					'type'    => 'select',
					'title'   => esc_html__( 'Variation Product Attribute', 'eyewear' ),
					'desc'    => esc_html__( 'Choose a default attribute for variation product slider.', 'eyewear' ),
					'options' => wp_list_pluck( wc_get_attribute_taxonomies(), 'attribute_label', 'attribute_name' ),
				),
				array(
					'id'       => 'cart-icon',
					'type'     => 'switch',
					'title'    => esc_html__( 'Cart Icon', 'eyewear' ),
					'subtitle' => esc_html__( 'Show or Hide cart icon on header', 'eyewear' ),
					'on'       => esc_html__( 'Show', 'eyewear' ),
					'off'      => esc_html__( 'Hide', 'eyewear' ),
					'default'  => TRUE,
				),
				array(
					'id'      => 'minicart-title-show',
					'type'    => 'switch',
					'title'   => esc_html__( 'Show Mini cart Title', 'eyewear' ),
					'on'      => esc_html__( 'Show', 'eyewear' ),
					'off'     => esc_html__( 'Hide', 'eyewear' ),
					'default' => TRUE,
				),
				array(
					'id'       => 'mini-cart-title',
					'type'     => 'text',
					'required' => array( 'minicart-title-show', '=', '1' ),
					'title'    => esc_html__( 'Mini Cart Title', 'eyewear' ),
					'default'  => esc_html__( 'Your Cart', 'eyewear' ),
				),
				array(
					'id'       => 'show-shop-share-button',
					'type'     => 'switch',
					'title'    => esc_html__( 'Show share button', 'eyewear' ),
					'subtitle' => esc_html__( 'You can show or hide social share button from single post.', 'eyewear' ),
					'on'       => esc_html__( 'Show', 'eyewear' ),
					'off'      => esc_html__( 'Hide', 'eyewear' ),
					'default'  => TRUE,
				),
				array(
					'id'       => 'shop-share-button',
					'type'     => 'checkbox',
					'required' => array( 'show-shop-share-button', '=', '1' ),
					'title'    => esc_html__( 'Share button', 'eyewear' ),
					'subtitle' => esc_html__( 'Check mark for showing share button', 'eyewear' ),
					'options'  => array(
						'facebook' => esc_html__( 'Facebook', 'eyewear' ),
						'twitter'  => esc_html__( 'Twitter', 'eyewear' ),
						'google'   => esc_html__( 'Google+', 'eyewear' ),
						'linkedin' => esc_html__( 'Linkedin', 'eyewear' )
					),
					'default'  => array(
						'facebook' => '1',
						'twitter'  => '1',
						'google'   => '1',
						'linkedin' => '1',
					)
				),
			)
		) );

	endif;


	Redux::setSection( $redux_opt_name, array(
		'icon'   => 'el-icon-photo',
		'title'  => esc_html__( 'Footer Settings', 'eyewear' ),
		'fields' => array(
			array(
				'id'       => 'social-section-show',
				'type'     => 'switch',
				'title'    => esc_html__( 'Show Social Section', 'eyewear' ),
				'subtitle' => esc_html__( 'Show or Hide Social Section in Header.', 'eyewear' ),
				'on'       => esc_html__( 'Show', 'eyewear' ),
				'off'      => esc_html__( 'Hide', 'eyewear' ),
				'default'  => TRUE,
			),
			array(
				'id'       => 'rss-link',
				'type'     => 'switch',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Show RSS Link', 'eyewear' ),
				'subtitle' => esc_html__( 'Show or Hide RSS Link.', 'eyewear' ),
				'default'  => TRUE
			),
			array(
				'id'       => 'facebook-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Facebook Link', 'eyewear' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Facebook icon. Leave blank to hide icon.', 'eyewear' ),
				'default'  => "#"
			),
			array(
				'id'       => 'twitter-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Twitter Link', 'eyewear' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Twitter icon. Leave blank to hide icon.', 'eyewear' ),
				'default'  => "#"
			),
			array(
				'id'       => 'google-plus-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Google Plus Link', 'eyewear' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Google Plus icon. Leave blank to hide icon.', 'eyewear' ),
				'default'  => "#"
			),
			array(
				'id'       => 'youtube-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Youtube Link', 'eyewear' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Youtube icon. Leave blank to hide icon.', 'eyewear' ),
			),
			array(
				'id'       => 'skype-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Skype Link', 'eyewear' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Skype icon. Leave blank to hide icon.', 'eyewear' ),
			),
			array(
				'id'       => 'pinterest-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Pinterest Link', 'eyewear' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Pinterest icon. Leave blank to hide icon.', 'eyewear' ),
				'default'  => "#"
			),
			array(
				'id'       => 'flickr-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Flickr Link', 'eyewear' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Flickr icon. Leave blank to hide icon.', 'eyewear' ),
			),
			array(
				'id'       => 'linkedin-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Linkedin Link', 'eyewear' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Linkedin icon. Leave blank to hide icon.', 'eyewear' ),
			),
			array(
				'id'       => 'vimeo-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Vimeo Link', 'eyewear' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Vimeo icon. Leave blank to hide icon.', 'eyewear' ),
			),
			array(
				'id'       => 'instagram-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Instagram Link', 'eyewear' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Instagram icon. Leave blank to hide icon.', 'eyewear' ),
			),
			array(
				'id'       => 'dribbble-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Dribbble Link', 'eyewear' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Dribbble icon. Leave blank to hide icon.', 'eyewear' ),
			),
			array(
				'id'       => 'tumblr-link',
				'type'     => 'text',
				'required' => array( 'social-section-show', '=', '1' ),
				'title'    => esc_html__( 'Tumblr Link', 'eyewear' ),
				'subtitle' => esc_html__( 'Insert your custom link to show the Tumblr icon. Leave blank to hide icon.', 'eyewear' ),
			),
			array(
				'id'       => 'footer-contact',
				'type'     => 'editor',
				'title'    => esc_html__( 'Footer Contact', 'eyewear' ),
				'subtitle' => esc_html__( 'Change footer contact and address', 'eyewear' ),
				'default'  => wp_kses( '<span>eyewear Inc., 8901 Marmora Road, Glasgow, D04 89GR.  Phone - (800) 2345-6789</span>', array( 'span' => array( 'class' => array() ) ) ),
			)
		)
	) );

	//   Redux::setSection( $redux_opt_name, array());

	//===============================================================================
	//  END SETTINGS
	//===============================================================================