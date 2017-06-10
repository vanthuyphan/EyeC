<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	global $product;
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	do_action( 'woocommerce_before_single_product' );

	if ( post_password_required() ) {
		echo get_the_password_form();

		return;
	}
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>"
     id="product-<?php the_ID(); ?>" <?php post_class( 'row' ); ?>>

	<div class="hippo-single-product-title-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="hippo-single-product-title">
						<?php

							/**
							 * eyewear_single_product_title hook
							 *
							 * @hooked woocommerce_template_single_title - 5
							 */
							do_action( 'eyewear_single_product_title' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- .hippo-single-product-title-wrapper -->

	<div class="hippo-before-single-product-summary-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="before-summary">
						<?php
							/**
							 * woocommerce_before_single_product_summary hook
							 *
							 * @hooked woocommerce_show_product_sale_flash - 10
							 * @hooked woocommerce_show_product_images - 20
							 */
							do_action( 'woocommerce_before_single_product_summary' );
						?></div>
				</div>
			</div>
		</div>
	</div>
	<!-- .hippo-before-single-product-summary-wrapper -->

	<div class="hippo-single-product-summary-wrapper">
		<div class="container">

			<div class="row">

				<div class="col-sm-12">
					<div class="hippo-product-summary">
						<div class="pre-summary">
							<?php
								/**
								 * eyewear_pre_woocommerce_single_product_summary hook
								 *
								 * @hooked woocommerce_template_single_rating - 10
								 * @hooked woocommerce_template_single_price - 15
								 * @hooked woocommerce_template_single_excerpt - 20
								 */
								do_action( 'eyewear_pre_woocommerce_single_product_summary' );
							?>
						</div>
						<div class="summary entry-summary">

							<?php
								/**
								 * woocommerce_single_product_summary hook
								 *
								 * @hooked woocommerce_template_single_add_to_cart - 30
								 */
								do_action( 'woocommerce_single_product_summary' );
							?>
						</div>
						<!-- .summary -->
					</div>
				</div>
				<!-- .hippo-product-summary -->


			</div>
		</div>
	</div>
	<!-- .hippo-single-product-summary-wrapper -->
	<?php

		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_template_single_sharing - 10
		 * @hooked woocommerce_template_single_meta - 20
		 * @hooked woocommerce_output_product_data_tabs - 30
		 * @hooked woocommerce_upsell_display - 40
		 * @hooked woocommerce_output_related_products - 50
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>


	<meta itemprop="url" content="<?php the_permalink(); ?>"/>

</div> <!-- #product-## -->

<div class="hippo-after-single-product-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php do_action( 'woocommerce_after_single_product' ); ?>
			</div>
		</div>
	</div>
	<!-- .hippo-after-single-product-wrapper -->
</div>