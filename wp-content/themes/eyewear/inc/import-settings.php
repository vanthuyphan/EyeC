<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	define( 'HIPPO_CURRENT_IMPORT_URL', untrailingslashit( esc_url( site_url() ) ) );
	define( 'HIPPO_DEVELOPMENT_URL', 'http://eyewear.demo' );
	define( 'HIPPO_IMPORTABLE_ATTACHMENT_URL', 'http://www.cloudsoftwaresolution.com/imgstore/repository/products-attachments/wordpress/eyewear' );

	$upload_dir = wp_upload_dir();
	define( 'HIPPO_CURRENT_ATTACHMENT_URL', $upload_dir[ 'baseurl' ] );

	//----------------------------------------------------------------------
	// Show instructions after dummy data imported
	//----------------------------------------------------------------------


	function hippo_import_rev_slider_slides() {
		return array(
			'http://www.cloudsoftwaresolution.com/imgstore/repository/products-attachments/wordpress/eyewear/main-slider-1.zip',
			'http://www.cloudsoftwaresolution.com/imgstore/repository/products-attachments/wordpress/eyewear/main-slider-2.zip',
			'http://www.cloudsoftwaresolution.com/imgstore/repository/products-attachments/wordpress/eyewear/single-product-slide.zip',
		);
	}

	add_filter( 'hippo_import_rev_slider_slides', 'hippo_import_rev_slider_slides' );

	function hippo_envato_setup_customize() {
		?>
		<p>Create Form <strong>MailChimp for WP &rightarrow; Forms</strong> and Use this form code: </p>
		<textarea class="code" readonly="readonly" cols="100" rows="5"><input type="email" name="EMAIL" placeholder="Your email address" required />
<input type="submit" value="SUBSCRIBE"></textarea>
		<?php
	}

	add_action( 'hippo_envato_setup_customize', 'hippo_envato_setup_customize' );

	function hippo_envato_setup_customize_features() {
		?>
		<ul>
			<li>Header Option: Enable/Disable Login popup.</li>
			<li>Typography: Style, Font Family for your site.</li>
			<li>Logo: Upload a new logo with retina supported and adjust its size.</li>
			<li>Color Schemes: Choose or customize website colors.</li>
			<li>Mobile Menu: Left/Right display position, showing effect.</li>
			<li>Blog Layout: Left/Right/None Blog sidebar display options, post navigation display style.</li>
			<li>Page Layout: Left/Right/None Page sidebar display options.</li>
			<li>Shop Layout: Shopping layout display control.</li>
		</ul>
		<?php
	}

	add_action( 'hippo_envato_setup_customize_features', 'hippo_envato_setup_customize_features' );


	//----------------------------------------------------------------------
	// Filter Applied on Theme Options data importing
	//----------------------------------------------------------------------

	if ( ! function_exists( 'hippo_import_process_theme_option_data' ) ) {

		function hippo_import_process_theme_option_data( $data ) {
			$find    = addcslashes( HIPPO_DEVELOPMENT_URL, '/' );
			$replace = addcslashes( HIPPO_CURRENT_IMPORT_URL, '/' );

			return str_ireplace( $find, $replace, $data );
		}

		add_filter( 'hippo_import_process_theme_option_data', 'hippo_import_process_theme_option_data' );
	}


	//----------------------------------------------------------------------
	// Filter Applied on Widget data importing
	//----------------------------------------------------------------------

	if ( ! function_exists( 'hippo_import_process_widget_data' ) ) {
		function hippo_import_process_widget_data( $data ) {
			$find    = addcslashes( HIPPO_DEVELOPMENT_URL, '/' );
			$replace = addcslashes( HIPPO_CURRENT_IMPORT_URL, '/' );

			return str_ireplace( $find, $replace, $data );
		}

		add_filter( 'hippo_import_process_widget_data', 'hippo_import_process_widget_data' );
	}


	//----------------------------------------------------------------------
	// Filter Applied on Sample XML data attachment importing
	//----------------------------------------------------------------------

	if ( ! function_exists( 'hippo_import_process_attachment_remote_url' ) ) {

		function hippo_import_process_attachment_remote_url( $data ) {
			$find    = HIPPO_DEVELOPMENT_URL;
			$replace = HIPPO_IMPORTABLE_ATTACHMENT_URL;

			return str_ireplace( $find, $replace, $data );
		}

		add_filter( 'hippo_import_process_attachment_remote_url', 'hippo_import_process_attachment_remote_url' );
	}


	//----------------------------------------------------------------------
	// Filter Applied on Sample XML data content importing
	//----------------------------------------------------------------------

	if ( ! function_exists( 'hippo_import_process_post_content' ) ) {

		function hippo_import_process_post_content( $data ) {
			$find    = HIPPO_DEVELOPMENT_URL;
			$replace = HIPPO_CURRENT_IMPORT_URL;

			return str_ireplace( $find, $replace, $data );
		}

		add_filter( 'hippo_import_process_post_content', 'hippo_import_process_post_content' );
	}
