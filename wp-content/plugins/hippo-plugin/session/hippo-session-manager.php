<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	// let users change the session cookie name
	if ( ! defined( 'HIPPO_SESSION_COOKIE' ) ) {
		define( 'HIPPO_SESSION_COOKIE', '_hippo_session' );
	}
	if ( ! class_exists( 'Hippo_Recursive_ArrayAccess' ) ) {
		include 'includes/class-hippo-recursive-arrayaccess.php';
	}
	// Include utilities class
	if ( ! class_exists( 'Hippo_Session_Utils' ) ) {
		include 'includes/class-hippo-session-utils.php';
	}
	// Only include the functionality if it's not pre-defined.
	if ( ! class_exists( 'Hippo_Session' ) ) {
		include 'includes/class-hippo-session.php';
		include 'includes/hippo-session.php';
	}