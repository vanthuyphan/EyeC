<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	VcShortcodeAutoloader::getInstance()->includeClass( 'WPBakeryShortCode_Hippo_Product_Feature' );

	$instance = new WPBakeryShortCode_Hippo_Product_Feature( array( 'base' => $this->settings[ 'base' ] ) );

	$attributes    = vc_map_get_attributes( $this->getShortcode(), $atts );
	$css_animation = $instance->getCSSAnimation( $attributes[ 'css_animation' ] );

	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_animation . ' ' . $attributes[ 'el_class' ], $this->settings[ 'base' ], $attributes );

	$icon = hippo_plugin_get_vc_library_icon( $attributes );

	ob_start();
?>
	<div class="hippo-product-feature-wrapper wpb_content_element <?php echo esc_attr( $css_class ) ?>">

		<?php if ( ! empty( $icon ) ): ?>
			<i class="<?php echo esc_attr( $icon ) ?>"></i>
		<?php endif; ?>

		<?php if ( ! empty( $attributes[ 'title' ] ) ): ?>
			<h3><?php echo esc_html( $attributes[ 'title' ] ) ?></h3>
		<?php endif; ?>

		<?php if ( ! empty( $attributes[ 'description' ] ) ): ?>
			<?php echo wpb_js_remove_wpautop( $attributes[ 'description' ], TRUE ) ?>
		<?php endif; ?>
	</div>
<?php
	echo $this->endBlockComment( $this->getShortcode() );
	echo ob_get_clean();