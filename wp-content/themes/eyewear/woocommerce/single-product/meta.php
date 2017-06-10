<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	global $post, $product;

	$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
	$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
?>
<div class="hippo-single-product-meta-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hippo-single-product-meta">
					<div class="product_meta">

						<?php do_action( 'woocommerce_product_meta_start' ); ?>

						<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

							<span class="sku_wrapper"><?php _e( 'SKU:', 'eyewear' ); ?> <span class="sku"
							                                                                itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'eyewear' ); ?></span></span>

						<?php endif; ?>

						<?php echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'eyewear' ) . ' ', '</span>' ); ?>

						<?php echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'eyewear' ) . ' ', '</span>' ); ?>

						<?php do_action( 'woocommerce_product_meta_end' ); ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>


