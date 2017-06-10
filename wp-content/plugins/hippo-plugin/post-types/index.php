<?php

	/**
	 * Autoloading post types
	 */
	foreach ( glob( HIPPO_PLUGIN_DIR . "/post-types/post-types/*.php" ) as $filename ) {
		include_once $filename;
	}
