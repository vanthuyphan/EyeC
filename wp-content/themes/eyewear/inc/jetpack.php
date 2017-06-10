<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	/**
	 * Jetpack setup function.
	 *
	 * See: https://jetpack.me/support/infinite-scroll/
	 */

	if ( ! function_exists( 'eyewear_jetpack_setup' ) ):

		function eyewear_jetpack_setup() {
			// Add theme support for Infinite Scroll.
			add_theme_support( 'infinite-scroll', array(
				'container' => 'main',  // while loop wrapper is #main  ID
				'render'    => 'eyewear_infinite_scroll_render',
				'footer'    => 'wrapper',  // Footer Wrapper is #wrapper ID
			) );
		} // end function eyewear_jetpack_setup
		add_action( 'after_setup_theme', 'eyewear_jetpack_setup' );
	endif;

	/**
	 * Custom render function for Infinite Scroll.
	 */

	if ( ! function_exists( 'eyewear_infinite_scroll_render' ) ):
		function eyewear_infinite_scroll_render() {
			while ( have_posts() ) :
				the_post();
				get_template_part( 'post-contents/content', get_post_format() );
			endwhile;
		} // end function eyewear_infinite_scroll_render
	endif;