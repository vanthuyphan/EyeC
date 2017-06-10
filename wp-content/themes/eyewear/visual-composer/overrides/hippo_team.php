<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	$attributes = vc_map_get_attributes( $this->getShortcode(), $atts );
	$css_class  = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $attributes[ 'el_class' ], $this->settings[ 'base' ], $attributes );

	ob_start(); ?>

	<div class="hippo-team-wrapper <?php echo esc_attr( $css_class ); ?>">
		<?php
			echo wp_get_attachment_image( $attributes[ 'image' ], "hippo-team-photo", FALSE, array(
				'class' => "attachment-hippo-team-photo size-hippo-team-photo hippo-team-image img-responsive",
				'alt'   => esc_attr( $attributes[ 'name' ] )
			) );
		?>

		<div class="hippo-team-details">
			<p class="hippo-team-member-name"><?php echo esc_html( $attributes[ 'name' ] ) ?></p>

			<p class="hippo-team-designation"><?php echo esc_html( $attributes[ 'designation' ] ) ?></p>
		</div>
	</div>
<?php

	echo $this->endBlockComment( $this->getShortcode() );
	echo ob_get_clean();