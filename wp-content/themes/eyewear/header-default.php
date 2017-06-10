<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );
?>
<header class="header header-style-default clearfix">
	<div class="navbar navbar-horizontal">
		<div class="container">
			<div class="navbar-header">
				<div class="site-logo">
					<?php
						$preset             = eyewear_get_preset( '-' );
						$preset_logo        = eyewear_option( $preset . 'preset-logo', 'url', FALSE );
						$preset_retina_logo = eyewear_option( $preset . 'preset-retina-logo', 'url', get_template_directory_uri() . '/img/logo@2x.png' );
						if ( $preset_logo ) : ?>
							<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ) ?>"
							   title="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>">
								<img src="<?php echo esc_url( $preset_logo ); ?>"
								     data-at2x="<?php echo esc_url( $preset_retina_logo ); ?>"
								     alt="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>"/></a>
						<?php else : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ) ?>"
							   title="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>"><img
									src="<?php echo esc_url( eyewear_option( 'logo', 'url', get_template_directory_uri() . '/img/logo.png' ) ) ?>"
									data-at2x="<?php echo esc_url( eyewear_option( 'retina-logo', 'url', get_template_directory_uri() . '/img/logo@2x.png' ) ) ?>"
									alt="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>"/></a>
						<?php endif; ?>
				</div>
			</div>
			<!-- .navbar-header -->
			<div class="header-right-content">
				<div class="user-login">
					<?php if ( ! is_user_logged_in() ) : ?>
						<a data-toggle="modal" href="#login"><?php esc_html_e( 'Login', 'eyewear' ) ?></a>
					<?php else : ?>
						<a class="sing-out"
						   href="<?php echo esc_url( wp_logout_url( home_url( '/' ) ) ); ?>"
						><?php esc_html_e( 'Sign Out', 'eyewear' ) ?></a>
					<?php endif; ?>
				</div>

				<?php if ( eyewear_option( 'cart-icon', FALSE, TRUE ) and class_exists( 'WooCommerce' ) ) : ?>
					<div class="cart-notify">
						<a class="mini-cart-link" data-toggle="modal" href="#mini-cart">
							<i class="zmdi zmdi-shopping-basket"></i> <?php esc_html_e( 'My Bag', 'eyewear' ) ?>
						</a>
						<span id="mini-cart-total"
						      class="cart-contents">
							( <?php echo number_format_i18n( WC()->cart->cart_contents_count ); ?> )</span>
					</div> <!-- .cart-notify -->
				<?php endif; ?>

				<div class="mobile-menu-trigger visible-xs-inline-block visible-sm-inline-block pull-right">
					<a class="navbar-toggle" href="#mobile_menu"><i class="zmdi zmdi-menu"></i></a>
				</div>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse">

				<?php wp_nav_menu( apply_filters( 'eyewear_nav_menu_header_default_args', array(
					                   'container'      => FALSE,
					                   'theme_location' => 'primary',
					                   'items_wrap'     => '<ul id="%1$s" class="%2$s nav navbar-nav navbar-right">%3$s</ul>',
					                   'walker'         => new Hippo_Menu_Walker(),
					                   'fallback_cb'    => 'Hippo_Menu_Walker::fallback'
				                   ) )
				);
				?>


			</div>
			<!-- .navbar-collapse -->
		</div>
		<!-- .container -->
	</div>
</header>
