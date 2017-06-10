<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	VcShortcodeAutoloader::getInstance()->includeClass( 'WPBakeryShortCode_Hippo_Faq' );
	$instance = new WPBakeryShortCode_Hippo_Faq( array( 'base' => $this->settings[ 'base' ] ) );

	$attributes    = vc_map_get_attributes( $this->getShortcode(), $atts );
	$css_animation = $instance->getCSSAnimation( $attributes[ 'css_animation' ] );

	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_animation . ' ' . $attributes[ 'el_class' ], $this->settings[ 'base' ], $attributes );

	ob_start();
?>
	<div
		class="faq-list <?php echo esc_attr( $css_class ); ?>">

		<div class="media">
			<?php if ( $attributes[ 'icon_show' ] == 'yes' ) : ?>
				<div class="media-left">
					<i class="fa <?php echo esc_attr( $attributes[ 'icon' ] ); ?>"
					   style="color: <?php echo esc_attr( $attributes[ 'icon_color' ] ); ?>"></i>
				</div>
			<?php endif; ?>

			<div class="media-body">
				<?php if ( $attributes[ 'question_title' ] ) : ?>
					<h3 class="media-heading"><?php echo esc_html( $attributes[ 'question_title' ] ); ?></h3>
				<?php endif; ?>

				<?php echo wpb_js_remove_wpautop( $content, TRUE ); ?>
			</div>
		</div>
	</div>
<?php
	echo $this->endBlockComment( $this->getShortcode() );
	echo ob_get_clean();