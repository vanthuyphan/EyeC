<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	global $post;

	$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Product Description', 'eyewear' ) ) );

?>

<?php if ( $heading ): ?>
	<h2><?php echo $heading; ?></h2>
<?php endif; ?>

<?php the_content(); ?>
