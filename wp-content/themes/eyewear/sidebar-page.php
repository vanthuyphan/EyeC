<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );


	if ( ! is_active_sidebar( 'hippo-page-sidebar' ) ) {
		return;
	}

	$layout = eyewear_option( 'page-layout', FALSE, 'sidebar-right' );
	if ( $layout == 'sidebar-right' ) :
		?>
		<div class="col-md-3 col-sm-4 right-sidebar">
			<div class="primary-sidebar widget-area" role="complementary">
				<?php dynamic_sidebar( 'hippo-page-sidebar' ); ?>
			</div>
		</div>
		<?php
	elseif ( $layout == 'sidebar-left' ) :
		?>
		<div class="col-md-3 col-md-pull-9 col-sm-4 col-sm-pull-8 left-sidebar">
			<div class="primary-sidebar widget-area" role="complementary">
				<?php dynamic_sidebar( 'hippo-page-sidebar' ); ?>
			</div>
		</div>
	<?php endif;