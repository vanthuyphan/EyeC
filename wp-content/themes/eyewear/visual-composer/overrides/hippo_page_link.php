<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	$attributes = vc_map_get_attributes( $this->getShortcode(), $atts );

	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $attributes[ 'el_class' ], $this->settings[ 'base' ], $attributes );

	ob_start();
?>
	<div class="hippo-page-link-wrapper text-center <?php echo esc_attr( $css_class ) ?>">
		<a class="hippo-page-link" target="<?php echo esc_attr( $attributes[ 'target' ] ) ?>"
		   href="<?php echo esc_url( trailingslashit( untrailingslashit( get_the_permalink( $attributes[ 'page_id' ] ) ) ) ) ?>"><?php echo esc_html( $attributes[ 'link_text' ] ) ?></a>
	</div>
<?php
	echo $this->endBlockComment( $this->getShortcode() );
	echo ob_get_clean();



