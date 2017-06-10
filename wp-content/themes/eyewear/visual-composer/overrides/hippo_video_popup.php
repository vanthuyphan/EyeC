<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	$attributes = vc_map_get_attributes( $this->getShortcode(), $atts );


	// echo wp_oembed_get( esc_url( $attributes['hippo_video_link'] ) );

	$video_popup_id = 'hippo_video_popup-' . rand( 10, 9999 );
	ob_start();
?>
	<div class="hippo-video-popup-wrapper <?php echo esc_attr( $attributes[ 'el_class' ] ); ?>"
	     style="background: url('<?php if ( $attributes[ 'image' ] ) : ?><?php $image_attributes = wp_get_attachment_image_src( $attributes[ 'image' ], 'full' ); ?><?php echo esc_url( $image_attributes[ 0 ] ); ?><?php endif; ?>')">
		<a class="video-popup-open-link" data-toggle="modal"
		   href="#<?php echo esc_attr( $video_popup_id ); ?>">
			<i class="zmdi zmdi-play"></i>
		</a>
	</div>


	<div id="<?php echo esc_attr( $video_popup_id ); ?>" class="video-popup modal fade">
		<a class="close" data-dismiss="modal" aria-label="<?php esc_attr_e( 'Close', 'eyewear' ) ?>"></a>

		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body text-center">
					<div class="embed-responsive embed-responsive-16by9"></div>
				</div>
			</div>
		</div>
		<!-- .modal-dialog -->
	</div> <!-- .modal -->

	<script type="text/html">
		<?php $code = 'iframe'; ?>
		<<?php echo esc_html( $code ) ?> class="embed-responsive-item" src="<?php echo esc_attr( $attributes[ 'link' ] ) ?>" frameborder="0"
		        allowfullscreen></<?php echo esc_html( $code ) ?>>
	</script>
<?php
	echo $this->endBlockComment( $this->getShortcode() );
	echo ob_get_clean();