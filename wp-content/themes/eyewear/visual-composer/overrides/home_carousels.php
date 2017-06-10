<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	$attributes = vc_map_get_attributes( $this->getShortcode(), $atts );


	global $_eyewear_shortcode_home_carousels;
	$_eyewear_shortcode_home_carousels = 0;
	ob_start();

?>
	<div class="carousel-wrapper">
		<div class="carousel hippo-carousel slide" data-ride="carousel" data-interval="5000">
			<div class="carousel-inner">
				<?php echo wpb_js_remove_wpautop( $content ); ?>
			</div>
			<!-- .carousel-inner -->

			<div class="carousel-control-wrapper">

				<a class="left carousel-control" href=".hippo-carousel" data-slide="prev">
					<i class="zmdi zmdi-triangle-up"></i>
				</a>

				<a class="right carousel-control" href=".hippo-carousel" data-slide="next">
					<i class="zmdi zmdi-triangle-down"></i>
				</a>
			</div>
			<!-- .carousel-control-wrapper -->

			<!-- Indicators -->

			<ol class="carousel-indicators">
				<?php for ( $i = 0; $i < $_eyewear_shortcode_home_carousels; $i ++ ): ?>
					<li data-target=".hippo-carousel" data-slide-to="<?php echo $i ?>"
					    class="<?php echo ( $i < 1 ) ? 'active' : '' ?>"></li>
				<?php endfor; ?>
			</ol>
			<!-- .Indicators -->


		</div>
	</div> <!-- .carousel-wrapper -->

<?php
	echo $this->endBlockComment( $this->getShortcode() );
	echo ob_get_clean();
