<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );
?>
<div id="login" class="modal fade">

	<div class="modal-header">
		<a data-dismiss="modal" href="#" aria-label="<?php esc_html_e( 'Close', 'eyewear' ); ?>"
		   class="modal-close close"></a>
	</div>
	<!-- .modal-header -->

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="form-container">

				<?php if ( get_option( 'users_can_register' ) ): ?>
					<ul class="nav nav-tabs login-modal-tabs" role="tablist">
						<li role="presentation" class="active">
							<a href="#login-form" aria-controls="login" role="tab"
							   data-toggle="tab">
								<?php esc_html_e( 'Sign-In', 'eyewear' ); ?>
							</a>
						</li>
						<li role="presentation">
							<a href="#register-form" aria-controls="register" role="tab"
							   data-toggle="tab"><?php esc_html_e( 'Register', 'eyewear' ) ?>
							</a>
						</li>
					</ul>

					<div class="tab-content login-modal-tab-contents">
						<div role="tabpanel" class="tab-pane fade in active" id="login-form">
							<div class="card">
								<?php if ( function_exists( 'wc_print_notices' ) ) :
									wc_print_notices();
								endif; ?>

								<form method="post" class="user-login">

									<?php do_action( 'woocommerce_login_form_start' ); ?>

									<div class="input-field input-container">
										<label>
											<?php esc_html_e( 'Username', 'eyewear' ); ?>
											<input class="form-control validate" type="text"
											       name="username"
											       value="<?php if ( ! empty( $_POST[ 'username' ] ) ) {
												       echo esc_attr( $_POST[ 'username' ] );
											       } ?>" required>
										</label>
									</div>
									<div class="input-field input-container">
										<label>
											<?php esc_html_e( 'Password', 'eyewear' ); ?>
											<input class="form-control validate" type="password" name="password"
											       required>
										</label>
									</div>
									<?php do_action( 'woocommerce_login_form' ); ?>
									<div class="button-container login-submit">
										<?php wp_nonce_field( 'woocommerce-login' ); ?>
										<input type="submit" class="btn btn-primary btn-lg" name="login"
										       value="<?php esc_attr_e( 'Submit', 'eyewear' ); ?>"/>
									</div>

									<?php do_action( 'woocommerce_login_form_end' ); ?>

								</form>

								<div class="footer">
									<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot your password?', 'eyewear' ); ?></a>
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="register-form">
							<div class="card">
								<form method="post" class="user-register">
									<?php do_action( 'woocommerce_register_form_start' ); ?>

									<div class="input-field input-container">
										<label><?php esc_html_e( "Username", "eyewear" ); ?>
											<input class="form-control" type="text" name="username"
											       value="<?php if ( ! empty( $_POST[ 'username' ] ) ) {
												       echo esc_attr( $_POST[ 'username' ] );
											       } ?>" required>
										</label>
									</div>
									<div class="input-field input-container">
										<label><?php esc_html_e( "Password", "eyewear" ); ?>
											<input class="form-control" type="password" name="password" required>
										</label>
									</div>
									<div class="input-field input-container">
										<label><?php esc_html_e( "Email", "eyewear" ); ?>
											<input class="form-control" type="email" name="email"
											       value="<?php if ( ! empty( $_POST[ 'email' ] ) ) {
												       echo esc_attr( $_POST[ 'email' ] );
											       } ?>"/>
										</label>
									</div>

									<?php do_action( 'woocommerce_register_form' ); ?>
									<?php do_action( 'register_form' ); ?>

									<div class="button-container">
										<?php wp_nonce_field( 'woocommerce-register' ); ?>
										<input type="submit" class="btn btn-primary btn-lg" name="register"
										       value="<?php esc_attr_e( 'Register', 'eyewear' ); ?>"/>
									</div>

									<?php do_action( 'woocommerce_register_form_end' ); ?>
								</form>
							</div>
						</div>
					</div>
				<?php else: ?>
					<div class="card">
						<h2 class="title"><?php esc_html_e( 'Sign-In', 'eyewear' ); ?></h2>

						<?php if ( function_exists( 'wc_print_notices' ) ): wc_print_notices(); endif; ?>

						<form method="post" class="user-login">

							<?php do_action( 'woocommerce_login_form_start' ); ?>

							<div class="input-field input-container">
								<label><?php esc_html_e( 'Username', 'eyewear' ); ?>
									<input class="form-control validate" type="text"
									       name="username"
									       value="<?php if ( ! empty( $_POST[ 'username' ] ) ) {
										       echo esc_attr( $_POST[ 'username' ] );
									       } ?>" required>
								</label>
							</div>
							<div class="input-field input-container">
								<label><?php esc_html_e( 'Password', 'eyewear' ); ?>
									<input class="form-control validate" type="password" name="password" required>
								</label>
							</div>
							<?php do_action( 'woocommerce_login_form' ); ?>
							<div class="button-container login-submit">
								<?php wp_nonce_field( 'woocommerce-login' ); ?>
								<input type="submit" class="btn btn-primary btn-lg" name="login"
								       value="<?php esc_attr_e( 'Submit', 'eyewear' ); ?>"/>
							</div>
							<?php do_action( 'woocommerce_login_form_end' ); ?>
						</form>

						<div class="footer">
							<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot your password?', 'eyewear' ); ?></a>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<!-- .form-container -->
		</div>
		<!-- .modal-content -->
	</div>
	<!-- .modal-dialog -->
</div> <!-- .modal -->