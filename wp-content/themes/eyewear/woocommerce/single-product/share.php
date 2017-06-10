<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );
?>

<div class="hippo-single-product-sharing-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hippo-single-product-sharing">
					<?php do_action( 'woocommerce_share' ); // Sharing plugins can hook into here ?>
				</div>
			</div>
		</div>
	</div>
</div>
