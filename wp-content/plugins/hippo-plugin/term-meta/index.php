<?php

	// Exit if accessed directly
	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	// if term meta table is not installed.
	if ( get_option( 'db_version' ) < 34370 ) {
		require_once "include/term-meta-install-class.php";
		require_once "include/helpers.php";
	} else {
		require_once "include/helpers-4.4.php";
	}

	require_once "include/term-meta-generator-class.php";
	require_once "tax-meta-fields.php";