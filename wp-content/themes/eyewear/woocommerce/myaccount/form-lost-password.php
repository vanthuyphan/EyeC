<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );
?>

<?php wc_print_notices(); ?>

<form method="post" class="lost_reset_password">

	<?php if ( 'lost_password' == $args[ 'form' ] ) : ?>

		<p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'eyewear' ) ); ?></p>

		<div class="input-field">
			<label for="user_login"><?php esc_html_e( 'Username or email', 'eyewear' ); ?></label>
			<input class="form-control" type="text" name="user_login" id="user_login"/>
		</div>

	<?php else : ?>

		<p><?php echo apply_filters( 'woocommerce_reset_password_message', esc_html__( 'Enter a new password below.', 'eyewear' ) ); ?></p>

		<div class="input-field">
			<label for="password_1"><?php esc_html_e( 'New password', 'eyewear' ); ?> <span
					class="required">*</span></label>
			<input type="password" class="form-control" name="password_1" id="password_1"/>
		</div>
		<div class="input-field">
			<label for="password_2"><?php esc_html_e( 'Re-enter new password', 'eyewear' ); ?> <span
					class="required">*</span></label>
			<input type="password" class="form-control" name="password_2" id="password_2"/>
		</div>

		<input type="hidden" name="reset_key" value="<?php echo isset( $args[ 'key' ] ) ? $args[ 'key' ] : ''; ?>"/>
		<input type="hidden" name="reset_login"
		       value="<?php echo isset( $args[ 'login' ] ) ? $args[ 'login' ] : ''; ?>"/>

	<?php endif; ?>

	<div class="clear"></div>

	<?php do_action( 'woocommerce_lostpassword_form' ); ?>

	<p class="form-row">
		<input type="hidden" name="wc_reset_password" value="true"/>
		<input type="submit" class="btn btn-primary"
		       value="<?php echo 'lost_password' == $args[ 'form' ] ? esc_html__( 'Reset Password', 'eyewear' ) : esc_html__( 'Save', 'eyewear' ); ?>"/>
	</p>

	<?php wp_nonce_field( $args[ 'form' ] ); ?>

</form>