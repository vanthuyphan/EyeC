<div id="hippo-newsletter-popup" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			<div class="modal-body">
				<?php echo do_shortcode( wp_kses( eyewear_option( 'newsletter-popup-content', FALSE, '<p></p>' ), array(
					'span'   => array( 'class' => array() ),
					'strong' => array( 'class' => array() ),
					'ul'     => array( 'class' => array() ),
					'ol'     => array( 'class' => array() ),
					'a'      => array( 'class' => array(), 'href' => array(), 'target' => array() ),
					'li'     => array( 'class' => array() ),
					'p'      => array( 'class' => array() ),
					'div'    => array( 'class' => array() ),
					'img'    => array( 'class' => array(), 'src' => array(), 'alt' => array() ),
				) ) ) ?>
			</div>
		</div>
		<!-- .modal-content -->
	</div>
	<!-- .modal-dialog -->
</div><!-- .modal -->