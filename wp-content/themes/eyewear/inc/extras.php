<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	//----------------------------------------------------------------------
	// Get list of available home page templates
	//----------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_home_page_templates' ) ):

		function eyewear_home_page_templates() {

			// Index for body class and value for real page template file name;
			return apply_filters( 'eyewear_home_page_templates', array(
				'template-visualcomposer'                        => 'template-vc.php',
				'template-full'                                  => 'template-full-width.php',
				'template-fixed'                                 => 'template-fixed-width.php',
				'template-page-no-sidebar page-sidebar-no'       => 'page-no-sidebar.php',
				'template-page-sidebar-right page-sidebar-right' => 'page-sidebar-right.php',
				'template-page-sidebar-left page-sidebar-left'   => 'page-sidebar-left.php',
				'template-blog-no-sidebar blog-sidebar-no'       => 'blog-default-no-sidebar.php',
				'template-blog-sidebar-left blog-sidebar-left'   => 'blog-default-sidebar-left.php',
				'template-blog-sidebar-right blog-sidebar-right' => 'blog-default-sidebar-right.php',
			) );
		}

	endif;

	//----------------------------------------------------------------------
	// Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
	//----------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_page_menu_args' ) ) :

		function eyewear_page_menu_args( $args ) {

			$args[ 'show_home' ] = TRUE;

			return apply_filters( 'eyewear_page_menu_args', $args );
		}

		add_filter( 'wp_page_menu_args', 'eyewear_page_menu_args', 9999 );
	endif;

	//----------------------------------------------------------------------
	// Adds custom classes to the array of body classes.
	//----------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_body_classes' ) ) :

		function eyewear_body_classes( $classes ) {
			// Adds a class of group-blog to blogs with more than 1 published author.
			if ( is_multi_author() ) {
				$classes[] = 'group-blog';
			}

			$classes[] = eyewear_get_preset();

			$current_page_template = basename( get_page_template_slug() );

			foreach ( eyewear_home_page_templates() as $class_name => $filename ) :
				if ( trim( $filename ) == $current_page_template ) :
					$classes[] = $class_name;
				endif;
			endforeach;

			// Adds a class of hfeed to non-singular pages.
			if ( ! is_singular() ) :
				$classes[] = 'hfeed';
			endif;

			if ( is_home() or is_archive() or is_search() ) :
				if ( is_active_sidebar( 'hippo-blog-sidebar' ) ):
					$classes[] = 'blog-' . eyewear_option( 'blog-layout', FALSE, 'sidebar-right' );
				else:
					$classes[] = 'blog-sidebar-no';
				endif;
			endif;

			if ( is_singular( 'post' ) ) :

				if ( eyewear_option( 'hippo-single-post-sidebar', FALSE, TRUE ) ):
					$classes[] = 'blog-' . eyewear_option( 'blog-layout', FALSE, 'sidebar-right' );
				else:
					$classes[] = 'blog-sidebar-no';
				endif;

			endif;

			if ( is_page() ) :
				if ( is_active_sidebar( 'hippo-page-sidebar' ) ):
					$classes[] = 'page-' . eyewear_option( 'page-layout', FALSE, 'sidebar-right' );
				else:
					$classes[] = 'page-sidebar-no';
				endif;
			endif;


			//$classes[] = eyewear_option( 'layout-type', FALSE, 'full-width' );

			return apply_filters( 'eyewear_body_classes', $classes );
		}

		add_filter( 'body_class', 'eyewear_body_classes', 9999 );
	endif;

	//----------------------------------------------------------------------
	// Adds custom classes to the array of post classes.
	//----------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_post_classes' ) ) :

		function eyewear_post_classes( $classes ) {

			if ( ! is_home() && ! is_paged() && is_sticky() ) {
				$classes[] = 'sticky';
			}

			if ( eyewear_post_thumbnail( TRUE ) or has_post_thumbnail() ) {
				$classes[] = 'has-post-thumbnail';
			}

			return apply_filters( 'eyewear_post_classes', $classes );
		}

		add_filter( 'post_class', 'eyewear_post_classes', 9999 );
	endif;

	//----------------------------------------------------------------------
	// Sets the authordata global when viewing an author archive.
	// This provides backwards compatibility with
	// http://core.trac.wordpress.org/changeset/25574
	// It removes the need to call the_post() and rewind_posts() in an author
	// template to print information about the author.
	//----------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_setup_author' ) ) :
		function eyewear_setup_author() {
			global $wp_query;

			if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
				$GLOBALS[ 'authordata' ] = get_userdata( $wp_query->post->post_author );
			}
		}

		add_action( 'wp', 'eyewear_setup_author', 9999 );
	endif;

	//-------------------------------------------------------------------------------
	// Add Author Contact
	//-------------------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_add_author_contact' ) ) :
		function eyewear_add_author_contact( $contactmethods ) {

			$contactmethods[ 'google_profile' ]   = esc_html__( 'Google Plus Profile URL', 'eyewear' );
			$contactmethods[ 'twitter_profile' ]  = esc_html__( 'Twitter Profile URL', 'eyewear' );
			$contactmethods[ 'facebook_profile' ] = esc_html__( 'Facebook Profile URL', 'eyewear' );
			$contactmethods[ 'linkedin_profile' ] = esc_html__( 'Linkedin Profile URL', 'eyewear' );
			$contactmethods[ 'github_profile' ]   = esc_html__( 'Github Profile URL', 'eyewear' );

			return apply_filters( 'eyewear_add_author_contact', $contactmethods );
		}

		add_filter( 'user_contactmethods', 'eyewear_add_author_contact', 9999 );
	endif;

	//----------------------------------------------------------------------
	// Display page break button in editor
	//----------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_wp_page_paging' ) ) :

		function eyewear_wp_page_paging( $mce_buttons ) {
			if ( get_post_type() == 'post' or get_post_type() == 'page' ) {
				$pos = array_search( 'wp_more', $mce_buttons, TRUE );
				if ( $pos !== FALSE ) {
					$buttons     = array_slice( $mce_buttons, 0, $pos + 1 );
					$buttons[]   = 'wp_page';
					$mce_buttons = array_merge( $buttons, array_slice( $mce_buttons, $pos + 1 ) );
				}
			}

			return apply_filters( 'eyewear_mce_buttons', $mce_buttons );
		}

		add_filter( 'mce_buttons', 'eyewear_wp_page_paging', 9999 );
	endif;

	//----------------------------------------------------------------------
	// Set post view on single page display
	//----------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_call_post_views_set_fn' ) ) :

		function eyewear_call_post_views_set_fn( $contents ) {
			if ( function_exists( 'hippo_plugin_set_post_views' ) and is_single() ) {
				hippo_plugin_set_post_views();
			}

			return $contents;
		}

		add_filter( 'the_content', 'eyewear_call_post_views_set_fn', 9999 );

	endif;

	//----------------------------------------------------------------------
	// Post excerpt length, Post excerpt more
	//----------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_custom_excerpt_length' ) ) :

		function eyewear_custom_excerpt_length( $wp_default ) {
			return apply_filters( 'eyewear_custom_excerpt_length', 10, $wp_default );
		}

		add_filter( 'excerpt_length', 'eyewear_custom_excerpt_length', 9999 );
	endif;

	//----------------------------------------------------------------------
	// Post excerpt more
	//----------------------------------------------------------------------

	if ( ! function_exists( 'eyewear_custom_excerpt_more' ) ) :
		function eyewear_custom_excerpt_more( $more ) {
			return ' ';
		}

		add_filter( 'excerpt_more', 'eyewear_custom_excerpt_more', 9999 );
	endif;
