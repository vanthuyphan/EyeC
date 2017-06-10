<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	/**
	 * Return the current cache expire setting.
	 *
	 * @return int
	 */
	function hippo_session_cache_expire() {
		$hippo_session = Hippo_Session::get_instance();

		return $hippo_session->cache_expiration();
	}

	/**
	 * Alias of hippo_session_write_close()
	 */
	function hippo_session_commit() {
		hippo_session_write_close();
	}

	/**
	 * Load a JSON-encoded string into the current session.
	 *
	 * @param string $data
	 */
	function hippo_session_decode( $data ) {
		$hippo_session = Hippo_Session::get_instance();

		return $hippo_session->json_in( $data );
	}

	/**
	 * Encode the current session's data as a JSON string.
	 *
	 * @return string
	 */
	function hippo_session_encode() {
		$hippo_session = Hippo_Session::get_instance();

		return $hippo_session->json_out();
	}

	/**
	 * Regenerate the session ID.
	 *
	 * @param bool $delete_old_session
	 *
	 * @return bool
	 */
	function hippo_session_regenerate_id( $delete_old_session = FALSE ) {
		$hippo_session = Hippo_Session::get_instance();

		$hippo_session->regenerate_id( $delete_old_session );

		return TRUE;
	}

	/**
	 * Start new or resume existing session.
	 *
	 * Resumes an existing session based on a value sent by the _hippo_session cookie.
	 *
	 * @return bool
	 */
	function hippo_session_start() {
		$hippo_session = Hippo_Session::get_instance();
		do_action( 'hippo_session_start' );

		return $hippo_session->session_started();
	}


	add_action( 'plugins_loaded', 'hippo_session_start' );


	/**
	 * Return the current session status.
	 *
	 * @return int
	 */
	function hippo_session_status() {
		$hippo_session = Hippo_Session::get_instance();

		if ( $hippo_session->session_started() ) {
			return PHP_SESSION_ACTIVE;
		}

		return PHP_SESSION_NONE;
	}

	/**
	 * Unset all session variables.
	 */
	function hippo_session_unset() {
		$hippo_session = Hippo_Session::get_instance();

		$hippo_session->reset();
	}

	/**
	 * Write session data and end session
	 */
	function hippo_session_write_close() {
		$hippo_session = Hippo_Session::get_instance();

		$hippo_session->write_data();
		do_action( 'hippo_session_commit' );
	}

	add_action( 'shutdown', 'hippo_session_write_close' );

	/**
	 * Clean up expired sessions by removing data and their expiration entries from
	 * the WordPress options table.
	 *
	 * This method should never be called directly and should instead be triggered as part
	 * of a scheduled task or cron job.
	 */
	function hippo_session_cleanup() {
		if ( defined( 'WP_SETUP_CONFIG' ) ) {
			return;
		}

		if ( ! defined( 'WP_INSTALLING' ) ) {
			/**
			 * Determine the size of each batch for deletion.
			 *
			 * @param int
			 */
			$batch_size = apply_filters( 'hippo_session_delete_batch_size', 1000 );

			// Delete a batch of old sessions
			Hippo_Session_Utils::delete_old_sessions( $batch_size );
		}

		// Allow other plugins to hook in to the garbage collection process.
		do_action( 'hippo_session_cleanup' );
	}

	add_action( 'hippo_session_garbage_collection', 'hippo_session_cleanup' );

	/**
	 * Register the garbage collector as a twice daily event.
	 */
	function hippo_session_register_garbage_collection() {
		if ( ! wp_next_scheduled( 'hippo_session_garbage_collection' ) ) {
			wp_schedule_event( time(), 'hourly', 'hippo_session_garbage_collection' );
		}
	}

	add_action( 'wp', 'hippo_session_register_garbage_collection' );
