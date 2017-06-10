<?php


	//----------------------------------------------------------------------
	// Autoloading shortcode files
	//----------------------------------------------------------------------

	foreach ( glob( EM_SHORTCODES_DIR . "/shortcodes/*.php" ) as $filename ) :
		hippo_import_shortcode( basename( $filename ) );
	endforeach;
