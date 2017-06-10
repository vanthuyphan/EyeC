<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	//----------------------------------------------------------------------
	// Defining Constance
	//----------------------------------------------------------------------

	if ( ! defined( 'EYEWEAR_THEME_NAME' ) ) {
		define( 'EYEWEAR_THEME_NAME', wp_get_theme()->get( 'Name' ) );
	}

	//----------------------------------------------------------------------
	// Helper, Import Setting, NavWalker,  addons
	//----------------------------------------------------------------------

	require get_template_directory() . "/inc/helper.php";

	require get_template_directory() . "/inc/import-settings.php";

	require get_template_directory() . "/inc/class-hippo-menu-walker.php";

	require get_template_directory() . "/inc/less-init.php";

	if ( function_exists( 'Vc_Manager' ) ) :
		require get_template_directory() . "/visual-composer/visual-composer.php";
	endif;

	if ( class_exists( 'Redux' ) ):
		require get_template_directory() . "/inc/theme-options.php";
	endif;


	//----------------------------------------------------------------------
	// Setting Default Content Width
	//----------------------------------------------------------------------

	if ( ! isset( $content_width ) ) :
		$content_width = apply_filters( 'eyewear_content_width', 1170 );
	endif;


	//-------------------------------------------------------------------------------
	// Load Google Font If Redux is not Active.
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_fonts_url' ) ):

		function eyewear_fonts_url() {
			$font_url = '';

			/*
			Translators: If there are characters in your language that are not supported
			by chosen font(s), translate this to 'off'. Do not translate into your own language.
			 */
			if ( 'off' !== esc_html_x( 'on', 'Google font: on or off', 'eyewear' ) ) {
				$font_url = add_query_arg(
					array(
						'family' => 'Roboto:400',
						'subset' => 'latin,latin-ext'
					), "//fonts.googleapis.com/css" );
			}

			return apply_filters( 'eyewear_google_font_url', $font_url );
		}
	endif;


	if ( ! function_exists( 'eyewear_theme_setup' ) ) :

		//------------------------------------------------------------------------------
		// Sets up theme defaults and registers support for various WordPress features.
		// Note that this function is hooked into the after_setup_theme hook, which
		// runs before the init hook. The init hook is too late for some features, such
		// as indicating support for post thumbnails.
		//-------------------------------------------------------------------------------

		function eyewear_theme_setup() {

			//-------------------------------------------------------------------------------
			// Make theme available for translation.
			//-------------------------------------------------------------------------------
			load_theme_textdomain( 'eyewear', get_template_directory() . '/languages' );


			// WooCommerce Support
			add_theme_support( 'woocommerce' );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			// Supporting title tag
			add_theme_support( 'title-tag' );


			//-------------------------------------------------------------------------------
			// Enable support for Post Thumbnails on posts and pages.
			// @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
			//-------------------------------------------------------------------------------
			add_theme_support( 'post-thumbnails' );


			// default post thumbnail size
			set_post_thumbnail_size( 1140 );

			add_image_size( 'eyewear-blog-thumbnail', 1140, 600, TRUE );
			add_image_size( 'eyewear-single-blog-thumbnail', 1140, 600, TRUE );

			// Default Product Thumbnail
			add_image_size( 'eyewear-product-thumbnail', 720, 300, array( 'center', 'center' ) );
			add_image_size( 'eyewear-single-product-thumbnail', 1140, 475, array( 'center', 'center' ) );
			add_image_size( 'eyewear-product-category-thumbnail', 720, 300, array( 'center', 'center' ) );
			add_image_size( 'eyewear-single-product-thumbnail-mini', 120, 50, array( 'center', 'center' ) );
			add_image_size( 'eyewear-mini-cart-thumb', 120, 50, array( 'center', 'center' ) );
			add_image_size( 'eyewear-team-photo', 550, 700, array( 'center', 'center' ) );

			// Register wp_nav_menu()
			register_nav_menus( apply_filters( 'eyewear_register_nav_menus', array(
				'primary' => esc_html__( 'Primary Menu', 'eyewear' )
			) ) );

			//-------------------------------------------------------------------------------
			// Switch default core markup for search form, comment form, and comments
			// to output valid HTML5.
			//-------------------------------------------------------------------------------
			add_theme_support( 'html5',
			                   apply_filters( 'eyewear_html5_theme_support', array(
				                   'comment-list',
				                   'comment-form',
				                   'search-form',
				                   'gallery',
				                   'caption'
			                   ) ) );


			//-------------------------------------------------------------------------------
			// Enable support for Post Formats.
			// See http://codex.wordpress.org/Post_Formats
			//-------------------------------------------------------------------------------
			add_theme_support( 'post-formats', apply_filters( 'eyewear_post_formats_theme_support', array(
				'aside',
				'status',
				'image',
				'audio',
				'video',
				'gallery',
				'quote',
				'link',
				'chat'
			) ) );

			add_editor_style( apply_filters( 'eyewear_add_editor_style', array(
				'css/editor-style.css',
				'css/material-design-iconic-font.min.css'
			) ) );
		}

		add_action( 'after_setup_theme', 'eyewear_theme_setup' );

	endif; // eyewear_theme_setup

	//-------------------------------------------------------------------------------
	// Register widget area.
	// @link http://codex.wordpress.org/Function_Reference/register_sidebar
	//-------------------------------------------------------------------------------
	if ( ! function_exists( 'eyewear_widgets_init' ) ) :

		function eyewear_widgets_init() {

			do_action( 'eyewear_before_register_sidebar' );

			register_sidebar( apply_filters( 'eyewear_blog_sidebar', array(
				'name'          => esc_html__( 'Blog Sidebar', 'eyewear' ),
				'id'            => 'hippo-blog-sidebar',
				'description'   => esc_html__( 'Appears in the blog sidebar.', 'eyewear' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) ) );

			register_sidebar( apply_filters( 'eyewear_page_sidebar', array(
				'name'          => esc_html__( 'Page Sidebar', 'eyewear' ),
				'id'            => 'hippo-page-sidebar',
				'description'   => esc_html__( 'Appears in the Page sidebar.', 'eyewear' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) ) );

			register_sidebar( apply_filters( 'eyewear_woo_sidebar', array(
				'name'          => esc_html__( 'Shop Header Sidebar', 'eyewear' ),
				'id'            => 'woosidebar',
				'description'   => esc_html__( 'Appears in the Shop Archive Page. To display filters, tags, etc.', 'eyewear' ),
				'before_widget' => '<div id="%1$s" class="col-sm-3 widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) ) );

			register_sidebar( apply_filters( 'eyewear_footer_sidebar', array(
				'name'          => esc_html__( 'Footer widget', 'eyewear' ),
				'id'            => 'hippo-footer-widget',
				'description'   => esc_html__( 'Appears in the footer.', 'eyewear' ),
				'before_widget' => '<div class="col-sm-3 footer-widget widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>',
			) ) );

			register_sidebar( apply_filters( 'eyewear_offcanvas_menu_sidebar', array(
				'name'          => esc_html__( 'Off Canvas Menu', 'eyewear' ),
				'id'            => 'offcanvas-menu',
				'description'   => esc_html__( 'Off Canvas Menu', 'eyewear' ),
				'before_widget' => '<div class="offcanvasmenu widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) ) );

			register_sidebar( apply_filters( 'eyewear_mega_menu_one_sidebar', array(
				'name'          => esc_html__( 'Mega Menu Widget One', 'eyewear' ),
				'id'            => 'mega-menu-one',
				'description'   => esc_html__( 'Appears in the mega menu while selected from nav menu item', 'eyewear' ),
				'before_widget' => '<div class="col-sm-3"><div class="megamenu-widget widget %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>',
			) ) );

			register_sidebar( apply_filters( 'eyewear_mega_menu_two_sidebar', array(
				'name'          => esc_html__( 'Mega Menu Widget Two', 'eyewear' ),
				'id'            => 'mega-menu-two',
				'description'   => esc_html__( 'Appears in the mega menu while selected from nav menu item', 'eyewear' ),
				'before_widget' => '<div class="col-sm-3"><div class="megamenu-widget widget %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>',
			) ) );

			register_sidebar( apply_filters( 'eyewear_mega_menu_three_sidebar', array(
				'name'          => esc_html__( 'Mega Menu Widget Three', 'eyewear' ),
				'id'            => 'mega-menu-three',
				'description'   => esc_html__( 'Appears in the mega menu while selected from nav menu item', 'eyewear' ),
				'before_widget' => '<div class="col-sm-3"><div class="megamenu-widget widget %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>',
			) ) );

			register_sidebar( apply_filters( 'eyewear_mega_menu_four_sidebar', array(
				'name'          => esc_html__( 'Mega Menu Widget Four', 'eyewear' ),
				'id'            => 'mega-menu-four',
				'description'   => esc_html__( 'Appears in the mega menu while selected from nav menu item', 'eyewear' ),
				'before_widget' => '<div class="col-sm-3"><div class="megamenu-widget widget %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>',
			) ) );

			register_sidebar( apply_filters( 'eyewear_mega_menu_five_sidebar', array(
				'name'          => esc_html__( 'Mega Menu Widget Five', 'eyewear' ),
				'id'            => 'mega-menu-five',
				'description'   => esc_html__( 'Appears in the mega menu while selected from nav menu item', 'eyewear' ),
				'before_widget' => '<div class="col-sm-3"><div class="megamenu-widget widget %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>',
			) ) );

			do_action( 'eyewear_after_register_sidebar' );

		}

		add_action( 'widgets_init', 'eyewear_widgets_init' );


		if ( ! function_exists( 'eyewear_widget_grid_class_to_remove' ) ) :
			function eyewear_widget_grid_class_to_remove( $classes ) {
				$classes[] = 'col-md-3';
				$classes[] = 'col-sm-3';

				return $classes;
			}

			add_filter( 'hippo_plugin_widget_grid_class_to_remove', 'eyewear_widget_grid_class_to_remove' );
		endif;


		if ( ! function_exists( 'eyewear_nav_menu_item_meta_list' ) ) :

			function eyewear_nav_menu_item_meta_list( $fields ) {

				$fields[ 'widgets' ] = array(
					'type'    => 'select2',
					'label'   => esc_html__( 'Megamenu Sidebar', 'eyewear' ),
					'options' => array(
						''                => esc_html__( '-- Select --', 'eyewear' ),
						'mega-menu-one'   => esc_html__( 'Mega Menu Widget One', 'eyewear' ),
						'mega-menu-two'   => esc_html__( 'Mega Menu Widget Two', 'eyewear' ),
						'mega-menu-three' => esc_html__( 'Mega Menu Widget Three', 'eyewear' ),
						'mega-menu-four'  => esc_html__( 'Mega Menu Widget Four', 'eyewear' ),
						'mega-menu-five'  => esc_html__( 'Mega Menu Widget Five', 'eyewear' )
					),
					'depth'   => 0
				);

				$fields[ 'menucolumnclass' ] = array(
					'type'       => 'text',
					'label'      => esc_html__( 'Mega Menu Column Class', 'eyewear' ),
					'default'    => 'col-md-10',
					'depth'      => 0,
					'dependency' => array(
						array( 'widgets' => array( 'type' => '!empty' ) )
					)
				);

				return apply_filters( 'eyewear_nav_menu_item_meta_list', $fields );
			}

			add_filter( 'hippo_plugin_nav_menu_item_meta', 'eyewear_nav_menu_item_meta_list' );
		endif;
	endif;


	//-------------------------------------------------------------------------------
	// Enqueue scripts and styles.
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_scripts' ) ) :

		function eyewear_scripts() {

			do_action( 'eyewear_before_enqueue_script' );

			/** ====================================================================
			 *  Loading CSS
			 * ====================================================================
			 */

			if ( ! eyewear_option( 'body-typography', 'font-family' ) ) {
				wp_enqueue_style( 'eyewear-google-font', eyewear_fonts_url(), array(), NULL );
			}

			// Flat-icons
			wp_enqueue_style( 'eyewear-flat-icon-icons', get_template_directory_uri() . '/css/flaticon.css', array(), '' );

			// Material-design-icons
			wp_enqueue_style( 'eyewear-material-design-icons', get_template_directory_uri() . '/css/material-design-iconic-font.min.css', array(), '2.1.2' );

			// Font Awesome Icons
			wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.4.0' );

			// Animate css
			wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css', array(), NULL );

			// Twitter BootStrap.
			wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.5' );


			if ( class_exists( 'WooCommerce' ) or is_active_widget( FALSE, FALSE, 'hippo_latest_tweet', TRUE ) ) :
				// owl-carousel
				wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), '1.3.2' );

				// owl-theme
				wp_enqueue_style( 'eyewear-owl-theme', get_template_directory_uri() . '/css/owl.theme.css', array(), '1.3.2' );
			endif;
			// hippo-offcanvas
			wp_enqueue_style( 'eyewear-offcanvas', get_template_directory_uri() . '/css/hippo-off-canvas.css', array(), NULL );

			if ( class_exists( 'WooCommerce' ) and is_product() ) :
				// flexslider for woocommerce product gallery slider
				wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css', array(), NULL );
			endif;
			// PrettyPhoto
			if ( ! class_exists( 'WooCommerce' ) ) :
				wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css', array(), NULL, TRUE );
			endif;

			// master.less
			if ( class_exists( 'Hippo_Plugin_Less_Css_Init' ) ) {
				wp_enqueue_style( 'eyewear-style', eyewear_locate_template_uri( 'less/master.less' ) );
			} else {
				wp_enqueue_style( 'eyewear-style', sprintf( '%s/css-compiled/master-%s.css', get_template_directory_uri(), eyewear_get_preset() ) );
			}
			// main stylesheet
			wp_enqueue_style( 'stylesheet', get_stylesheet_uri() );


			/** ====================================================================
			 *  Loading JavaScripts
			 * ====================================================================
			 */
			// modernizr
			wp_enqueue_script( 'eyewear-modernizr', get_template_directory_uri() . '/js/modernizr-2.8.1.min.js', array(), NULL );

			// bootstrap
			wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.5', TRUE );

			if ( class_exists( 'WooCommerce' ) or is_active_widget( FALSE, FALSE, 'hippo_latest_tweet', TRUE ) ) :

				// owl-carousel
				wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), NULL, TRUE );
			endif;

			// eyewear offcanvas
			wp_enqueue_script( 'eyewear-offcanvas', get_template_directory_uri() . '/js/hippo-off-canvas.js', array( 'jquery' ), NULL, TRUE );

			if ( eyewear_option( 'sticky-sidebar', FALSE, TRUE ) and ( is_home() or is_singular( 'post' ) ) ):
				// sticky-sidebar
				wp_enqueue_script( 'jquery.sticky-kit', get_template_directory_uri() . '/js/jquery.sticky-kit.min.js', array( 'jquery' ), NULL, TRUE );
			endif;

			if ( eyewear_option( 'sticky-menu', FALSE, TRUE ) ) :
				// Sticky menu js
				wp_enqueue_script( 'eyewear-sticky-menu', get_template_directory_uri() . '/js/sticky-menu.js', array( 'jquery' ), NULL, TRUE );
			endif;

			// Retina js
			wp_enqueue_script( 'retina', get_template_directory_uri() . '/js/retina.min.js', array( 'jquery' ), NULL, TRUE );


			if ( is_active_widget( FALSE, FALSE, 'hippo_latest_tweet', TRUE ) ) :
				// Twitter fetcher for twitter widget
				wp_enqueue_script( 'eyewear-twitter-fetcher', get_template_directory_uri() . '/js/twitter-fetcher-min.js', array( 'jquery' ), NULL, TRUE );
			endif;

			if ( is_active_widget( FALSE, FALSE, 'hippo_flickr_photo', TRUE ) ):
				// flicker-photo for flicker widget
				wp_enqueue_script( 'eyewear-flicker-photo', get_template_directory_uri() . '/js/flicker-photo.min.js', array( 'jquery' ), NULL, TRUE );
			endif;

			if ( class_exists( 'WooCommerce' ) ) :
				// flexslider for woocommerce product gallery slider
				wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), NULL, TRUE );
			endif;

			// PrettyPhoto JS If WooCommerce Installed Load Woocommerce JS or Load this
			if ( ! class_exists( 'WooCommerce' ) ) :
				wp_enqueue_script( 'prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array( 'jquery' ), NULL, TRUE );
			endif;

			// JS Plugin
			wp_enqueue_script( 'eyewear-script', get_template_directory_uri() . '/js/scripts.js', array(
				'jquery',
			), NULL, TRUE );

			// localize script
			wp_localize_script( 'eyewear-script', 'eyewearJSObject', apply_filters( 'eyewear_js_object', array(
				'ajax_url'                => esc_url( admin_url( 'admin-ajax.php' ) ),
				'site_url'                => esc_url( site_url( '/' ) ),
				'home_url'                => esc_url( home_url( '/' ) ),
				'theme_url'               => get_template_directory_uri(),
				'is_front_page'           => is_front_page(),
				'is_home'                 => is_home(),
				'is_mobile'               => wp_is_mobile(),
				'is_user_logged_in'       => is_user_logged_in(),
				'is_single_post'          => is_singular( 'post' ),
				'offcanvas_menu_position' => 'hippo-offcanvas-' . eyewear_option( 'offcanvas-menu-position', FALSE, 'left' ),
				'offcanvas_menu_effect'   => eyewear_option( 'offcanvas-menu-effect', FALSE, 'reveal' ),
				'back_to_top'             => eyewear_option( 'back-to-top', FALSE, TRUE ),
				'is_sticky_sidebar'       => eyewear_option( 'sticky-sidebar', FALSE, TRUE ),
				'is_sticky_menu'          => eyewear_option( 'sticky-menu', FALSE, TRUE ),
				'is_woocommerce'          => class_exists( 'WooCommerce' ),
				'is_twitter_widget'       => is_active_widget( FALSE, FALSE, 'hippo_latest_tweet', TRUE ),
				'is_flicker_widget'       => is_active_widget( FALSE, FALSE, 'hippo_flickr_photo', TRUE ),
			) ) );


			if ( is_singular() and comments_open() and get_option( 'thread_comments' ) ) :
				wp_enqueue_script( 'comment-reply' );
			endif;

			do_action( 'eyewear_after_enqueue_script' );
		}

		add_action( 'wp_enqueue_scripts', 'eyewear_scripts' );
	endif;


	if ( ! function_exists( 'eyewear_audio_video_shortcode_class' ) ) :
		function eyewear_audio_video_shortcode_class( $class ) {
			return $class . ' mejs-mejskin';
		}

		add_filter( 'wp_audio_shortcode_class', 'eyewear_audio_video_shortcode_class' );
		add_filter( 'wp_video_shortcode_class', 'eyewear_audio_video_shortcode_class' );
	endif;

	if ( class_exists( 'WooCommerce' ) ) :
		//-------------------------------------------------------------------------------
		// WooCommerce Functionality
		//-------------------------------------------------------------------------------
		require get_template_directory() . "/inc/woocommerce.php";
	endif;

	//-------------------------------------------------------------------------------
	// Custom template tags for this theme.
	//-------------------------------------------------------------------------------

	require get_template_directory() . "/inc/template-tags.php";

	//-------------------------------------------------------------------------------
	// Custom functions that act independently of the theme templates.
	//-------------------------------------------------------------------------------
	require get_template_directory() . "/inc/extras.php";

	//-------------------------------------------------------------------------------
	// Load JetPack compatibility file.
	//-------------------------------------------------------------------------------
	require get_template_directory() . "/inc/jetpack.php";

	//----------------------------------------------------------------------
	// Admin Functions
	//----------------------------------------------------------------------

	if ( is_admin() ):

		//----------------------------------------------------------------------
		// Load the TGM Plugin Installation
		//----------------------------------------------------------------------

		require get_template_directory() . "/required-plugins/index.php";

		//----------------------------------------------------------------------
		// Load Theme Setup Options
		//----------------------------------------------------------------------

		require get_template_directory() . "/setup-wizard/index.php";

	endif;

