<?php

	//add_filter( 'vc_load_default_templates', 'hippo_vc_template_TEMPLATE_NAME' );
	function hippo_vc_template_TEMPLATE_NAME( $data ) {

		$template                   = array();
		$template[ 'name' ]         = esc_html__( 'TEMPLATE_NAME', 'eyewear' );
		$template[ 'image_path' ]   = get_template_directory_uri() . '/visual-composer/assets/images/thumbs/TEMPLATE_NAME.png'; // always use preg replace to be sure that "space" will not break logic
		$template[ 'custom_class' ] = 'hippo_vc_template_TEMPLATE_NAME';

		ob_start();
		?>


		<?php
		$template[ 'content' ] = ob_get_clean();
		array_unshift( $data, $template );

		return $data;
	}