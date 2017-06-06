<?php

$options = get_option('woo_setting');

add_filter( 'woocommerce_product_single_add_to_cart_text', 'single_text' );
function single_text() {
			$options = get_option('woo_setting');
		return $options['single_button_text'];
	}


add_filter('woocommerce_product_add_to_cart_text', 'woo_add_to_cart_text');
	
function woo_add_to_cart_text() {
	
	$options = get_option('woo_setting');
	
	global $product;
	
	$product_type = $product->product_type;

switch ( $product_type ) {
		case 'external':
			return $options['external_button_text'];
		break;
		case 'grouped':
			return $options['grouped_button_text'];
		break;
		case 'simple':
			return $options['simple_button_text'];
		break;
		case 'variable':
			return $options['variable_button_text'];
		break;	
	}
	
}

			// function for styling woocommerce button

add_action('wp_head', 'woo_setting_style');

function woo_setting_style() {
	$options = get_option('woo_setting');

			// for button style
		# if button type round 
	
	if('round' == $options['woo_button_type']) {
		?>
        <style>
        .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button
		{
			border-radius:5px !important;
			}
        </style>
	<?php	
	}
			# if button type rounded
			
	if('rounded' == $options['woo_button_type']) {
		?>
        <style>
        .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button
		{
			border-radius:15px !important;
			}
        </style>
	<?php	
	}	
			# if button type rectangle
			
	if('rectangle' == $options['woo_button_type']) {
		?>
        <style>
        .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button
		{
			border-radius:0px !important;
			}
        </style>
	<?php	
	}	
	?>	
		  <style>
          .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button
		  {
			color:<?php echo $options['woo_button_font_color']; ?>;
			background-color:<?php echo $options['woo_button_color']; ?> !important;
			background:<?php echo $options['woo_button_color']; ?> !important;
			}
			.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt
			{
				color:<?php echo $options['woo_button_font_color']; ?>;
			background-color:<?php echo $options['woo_button_color']; ?> !important;
			background:<?php echo $options['woo_button_color']; ?> !important;
				}
          </style>		
          
				
	<?php
return woo_setting_style;
} //end of woo setting function
?>