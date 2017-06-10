<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	global $pagenow;

	if ( $pagenow == 'nav-menus.php' ) {

		require_once ABSPATH . 'wp-admin/includes/nav-menu.php';

		class Hippo_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {
			function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
				$item_output = '';
				parent::start_el( $item_output, $item, $depth, $args, $id );
				$output .= preg_replace(
				// NOTE: Check this regex from time to time!
					'/(?=<p[^>]+class="[^"]*field-move)/',
					Hippo_Menu_Item_Meta_Engine::getInstance()->generate_field( $item, $depth, $args ),
					$item_output
				);
			}
		}
	}