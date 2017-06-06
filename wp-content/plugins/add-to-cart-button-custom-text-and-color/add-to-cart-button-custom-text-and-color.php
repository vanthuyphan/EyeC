<?php
/*
Plugin Name: Add to Cart Button Custom Text and Color
Plugin URI: http://wordpress.org/plugins/add-to-cart-button-custom-text-and-color
Description: This plugin allows to customize the 'ADD TO CART' button text in WooCommerce by product type in both archive and single product pages and also allow to change woocommmerce button and font color.
Author: Chahat Sharma
Author URI: 
Version: 1.0
*/
?>
<?php


add_action( 'admin_print_scripts-appearance_page_theme_options', 'woo_admin_scripts' );
add_action( 'admin_enqueue_scripts', 'woo_admin_styles' );
	add_action( 'admin_enqueue_scripts', 'woo_admin_scripts' );
/**
 * Enqueuing some scripts.
 *
 * @uses wp_enqueue_script to register javascripts.
 * @uses wp_enqueue_script to add javascripts to WordPress generated pages.
 */
function woo_admin_scripts() {
		wp_enqueue_script( 'wp-color-picker' );
}

/****************************************************************************************/

add_action( 'admin_print_styles-appearance_page_theme_options', 'woo_admin_styles' );
/**
 * Enqueuing some styles.
 *
 * @uses wp_enqueue_style to register stylesheets.
 * @uses wp_enqueue_style to add styles.
 */
function woo_admin_styles() {
	wp_enqueue_style( 'style.css' , plugins_url('assets/style.css', __FILE__) );
	wp_enqueue_style( 'wp-color-picker' );
}

		/*****************************************************************************/

//register settings
function woo_setting(){
    register_setting( 'woo_setting', 'woo_setting' );
}

//function for create a theme setting option
 function woo_option_menu() {
	 add_submenu_page ('woocommerce', 'WooCommerce Buttons', 'WooCommerce Buttons', 'edit_theme_options', 'woocommerce_buttons', 'woo_button_page');	
	}

add_action('admin_menu', 'woo_option_menu');
add_action( 'admin_init', 'woo_setting' );

function woo_button_page() {
?>

<div class="woo_button_setting">

<h1>WooCommerce Button Setting</h1>
<?php _e(''); ?>
<form name="woo_setting" action="options.php" method="post">
        <?php settings_fields( 'woo_setting' ); ?>
<?php $options = get_option( 'woo_setting' ); ?>

<?php if( isset( $_GET [ 'settings-updated' ] ) && 'true' == $_GET[ 'settings-updated' ] ): ?>
					<div class="updated" id="message">
					   <p><strong><?php _e( 'Settings saved.', 'attitude' );?></strong></p>
					</div>
			<?php endif; ?>
<h3>For Single Page</h3>
<table>
	<tr>
    	<td>Single Page Text</td>
        <td><input type="text" name="woo_setting[single_button_text]" id="woo_setting[single_button_text]" value="<?php esc_attr_e( $options['single_button_text'] ); ?>" /></td>
    </tr>
</table>
<h3>For Archive/Category Page</h3>
<table>
			<!--- text for simple product button -->
    <tr>
    	<td>Simple Product</td>
         <td><input type="text" name="woo_setting[simple_button_text]" id="woo_setting[simple_button_text]" value="<?php esc_attr_e( $options['simple_button_text'] ); ?>" palceholder="Add to Cart" /></td>
    </tr>
			<!--- button text for variable product -->
    <tr>
    	<td>Variable Product</td>
         <td><input type="text" name="woo_setting[variable_button_text]" id="woo_setting[variable_button_text]" value="<?php esc_attr_e( $options['variable_button_text'] ); ?>" palceholder="Add to Cart" /></td>
    </tr>
			<!--- button text for grouped product -->
    <tr>
    	<td>Grouped Product</td>
         <td><input type="text" name="woo_setting[grouped_button_text]" id="woo_setting[grouped_button_text]" value="<?php esc_attr_e( $options['grouped_button_text'] ); ?>" palceholder="Add to Cart" /></td>
    </tr>
			<!--- button text for external product -->
    <tr>
    	<td>External Product</td>
         <td><input type="text" name="woo_setting[external_button_text]" id="woo_setting[external_button_text]" value="<?php esc_attr_e( $options['external_button_text'] ); ?>" palceholder="Add to Cart" /></td>
    </tr>

</table>

<h3>WooCommece Button Style</h3>

<script>
            jQuery(document).ready(function($){

jQuery('.of-color').wpColorPicker();
											});
            </script>
<table>
	<tr>
    	<td>Button Style</td>
        <td>
        	<select id="woo_button_type" name="woo_setting[woo_button_type]">
											<?php 
												$button_types = array();
												$button_types = array( 	'Select Button Type' => '',
																	  	'Round' =>'round',
																		'Rounded' => 'rounded',
																		'Rectangle' => 'rectangle'
																		);
										foreach( $button_types as $button_type => $button_type_value) {
											?>
											<option value="<?php echo $button_type_value; ?>" <?php selected( $button_type_value, $options['woo_button_type']); ?>><?php printf( __( '%s', 'woocommerce button' ), $button_type ); ?></option>
											<?php 
										}
											?>
										</select>
        </td>
    </tr>
    
 	<tr>
    	<td>Button Font Color</td>
        <td><input type="text" value="<?php esc_attr_e( $options['woo_button_font_color'] ); ?>" data-default-color="#354d7a" class="of-color" name="woo_setting[woo_button_font_color]" id="woo_setting[woo_button_font_color]" /></td>
    </tr> 
    
 	<tr>
    	<td>Button Backgroud Color</td>
       <td><input type="text" value="<?php esc_attr_e( $options['woo_button_color'] ); ?>" data-default-color="#354d7a" class="of-color" name="woo_setting[woo_button_color]" id="woo_setting[woo_button_color]" /></td>
    </tr>     
    
</table>


                <input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save All Changes', 'attitude' ); ?>" />

</form>
</div>
<?php
}
include_once 'settings.php';
?>