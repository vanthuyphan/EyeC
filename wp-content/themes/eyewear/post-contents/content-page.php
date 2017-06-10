<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	the_content( esc_html__( "Read More", 'eyewear' ) );

	wp_link_pages( array(
		               'before'      => '<div class="pagination"><span class="page-links-title">' . esc_html__( 'Pages:', 'eyewear' ) . '</span>',
		               'after'       => '</div>',
		               'link_before' => '<span>',
		               'link_after'  => '</span>',
	               ) );
