<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	$attributes = vc_map_get_attributes( $this->getShortcode(), $atts );

	ob_start(); ?>

	<div class="newsletter <?php echo esc_attr( $attributes[ 'el_class' ] ); ?>">
		<?php echo do_shortcode( '[mc4wp_form]' ); ?>
	</div> <!-- .newsletter -->
<?php

	echo $this->endBlockComment( $this->getShortcode() );
	echo ob_get_clean();