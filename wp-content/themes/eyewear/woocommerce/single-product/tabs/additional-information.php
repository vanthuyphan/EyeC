<?php
	/**
	 * Additional Information tab
	 *
	 * @author        WooThemes
	 * @package       WooCommerce/Templates
	 * @version       2.0.0
	 */

	defined( 'ABSPATH' ) or die( 'Keep Silent' );


	global $product;

	$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional Information', 'eyewear' ) );

?>

<?php if ( $heading ): ?>
	<h2><?php echo $heading; ?></h2>
<?php endif; ?>

<?php $product->list_attributes(); ?>
