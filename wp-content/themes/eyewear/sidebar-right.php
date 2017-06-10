<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	if ( ! is_active_sidebar( 'hippo-blog-sidebar' ) ) {
		return;
	}
?>
<div class="col-md-3 col-sm-4 right-sidebar">
	<div class="primary-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'hippo-blog-sidebar' ); ?>
	</div>
</div>