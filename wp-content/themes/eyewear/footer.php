<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );
?>
</div>
<!-- .contents -->

<!-- copyright-section start -->
<footer class="footer">
	<div class="footer-top-wrapper">
		<div class="container">
			<div class="row">
				<?php if ( is_active_sidebar( 'hippo-footer-widget' ) ): ?>
					<div class="col-sm-12">
						<div class="footer-widgets-wrapper">
							<div class="row">
								<?php dynamic_sidebar( 'hippo-footer-widget' ) ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<!-- /.col-# -->
			</div>
			<!-- .row -->
		</div>
		<!-- .container -->
	</div>
	<!-- .footer-top-wrapper -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="copyright-info">
						<span>
	                            <?php printf(

		                            wp_kses( __( 'Copyright &copy; %1$s %2$s. All Rights Reserved. Designed by %3$s.', 'eyewear' ),
		                                     array(
			                                     'a' => array(
				                                     'href'  => array(),
				                                     'title' => array(),
				                                     'class' => array()
			                                     )
		                                     ) ), date( 'Y' ), esc_html__( 'eyewear', 'eyewear' ), "<a href='http://www.themehippo.com' title='Visit themehippo.com!'>ThemeHippo.com</a>" ); ?>
	                    </span>
					</div>
				</div>
				<?php if ( eyewear_option( 'social-section-show', FALSE, TRUE ) ) : ?>
					<div class="col-sm-12">
						<div class="social-section">
							<ul class="social-shares rounded small icon-white">
								<?php if ( eyewear_option( 'rss-link', FALSE, TRUE ) ) : ?>
									<li>
										<a href="<?php echo esc_url( get_bloginfo( 'rss2_url' ) ); ?>"
										   target="_blank"><i class="fa fa-rss"></i></a>
									</li>
								<?php endif; ?>

								<?php if ( eyewear_option( 'facebook-link' ) ) : ?>
									<li><a href="<?php echo esc_url( eyewear_option( 'facebook-link' ) ); ?>"
									       target="_blank"><i class="fa fa-facebook"></i></a></li>
								<?php endif; ?>

								<?php if ( eyewear_option( 'twitter-link' ) ) : ?>
									<li><a href="<?php echo esc_url( eyewear_option( 'twitter-link' ) ); ?>"
									       target="_blank"><i class="fa fa-twitter"></i></a></li>
								<?php endif; ?>

								<?php if ( eyewear_option( 'google-plus-link' ) ) : ?>
									<li><a href="<?php echo esc_url( eyewear_option( 'google-plus-link' ) ); ?>"
									       target="_blank"><i class="fa fa-google-plus"></i></a></li>
								<?php endif; ?>

								<?php if ( eyewear_option( 'youtube-link' ) ) : ?>
									<li><a href="<?php echo esc_url( eyewear_option( 'youtube-link' ) ); ?>"
									       target="_blank"><i class="fa fa-youtube"></i></a></li>
								<?php endif; ?>

								<?php if ( eyewear_option( 'skype-link' ) ) : ?>
									<li><a href="<?php echo esc_url( eyewear_option( 'skype-link' ) ); ?>"
									       target="_blank"><i class="fa fa-skype"></i></a></li>
								<?php endif; ?>

								<?php if ( eyewear_option( 'pinterest-link' ) ) : ?>
									<li><a href="<?php echo esc_url( eyewear_option( 'pinterest-link' ) ); ?>"
									       target="_blank"><i class="fa fa-pinterest"></i></a></li>
								<?php endif; ?>

								<?php if ( eyewear_option( 'flickr-link' ) ) : ?>
									<li><a href="<?php echo esc_url( eyewear_option( 'flickr-link' ) ); ?>"
									       target="_blank"><i class="fa fa-flickr"></i></a></li>
								<?php endif; ?>

								<?php if ( eyewear_option( 'linkedin-link' ) ) : ?>
									<li><a href="<?php echo esc_url( eyewear_option( 'linkedin-link' ) ); ?>"
									       target="_blank"><i class="fa fa-linkedin"></i></a></li>
								<?php endif; ?>

								<?php if ( eyewear_option( 'vimeo-link' ) ) : ?>
									<li><a href="<?php echo esc_url( eyewear_option( 'vimeo-link' ) ); ?>"
									       target="_blank"><i class="fa fa-vimeo-square"></i></a></li>
								<?php endif; ?>

								<?php if ( eyewear_option( 'instagram-link' ) ) : ?>
									<li><a href="<?php echo esc_url( eyewear_option( 'instagram-link' ) ); ?>"
									       target="_blank"><i class="fa fa-instagram"></i></a></li>
								<?php endif; ?>

								<?php if ( eyewear_option( 'dribbble-link' ) ) : ?>
									<li><a href="<?php echo esc_url( eyewear_option( 'dribbble-link' ) ); ?>"
									       target="_blank"><i class="fa fa-dribbble"></i></a></li>
								<?php endif; ?>

								<?php if ( eyewear_option( 'tumblr-link' ) ) : ?>
									<li><a href="<?php echo esc_url( eyewear_option( 'tumblr-link' ) ); ?>"
									       target="_blank"><i class="fa fa-tumblr"></i></a></li>
								<?php endif; ?>
							</ul>
						</div>
						<!-- .social-section -->
					</div>
				<?php endif; ?>

				<?php if ( eyewear_option( 'newsletter-popup', FALSE, TRUE ) ) :
					get_template_part( 'template-parts/newsletter', 'popup' );
				endif; ?>

			</div>
			<!-- .row -->
		</div>
		<!-- .conteiner -->
	</div>
	<!-- .copyright -->
	<!-- .row -->
</footer> <!-- footer end -->
<?php if ( offCanvas_On_InnerPusher( eyewear_option( 'offcanvas-menu-effect', FALSE, 'reveal' ) ) ) : ?>
	<nav class="menu-wrapper" id="offcanvasmenu">
		<button type="button" class="close close-sidebar">&times;</button>
		<div>
			<div>
				<?php dynamic_sidebar( 'offcanvas-menu' ) ?>
			</div>
		</div>
	</nav>
<?php endif; ?>

<?php do_action( 'hippo_theme_end_inner_wrapper' ); ?>
</div><!-- .row -->
</div><!-- .container-wrapper -->
</div> <!-- .pusher -->
<?php do_action( 'hippo_theme_after_inner_wrapper' ); ?>

<?php if ( ! offCanvas_On_InnerPusher( eyewear_option( 'offcanvas-menu-effect', FALSE, 'reveal' ) ) ) : ?>
	<nav class="menu-wrapper" id="offcanvasmenu">
		<button type="button" class="close close-sidebar">&times;</button>
		<div>
			<div>
				<?php dynamic_sidebar( 'offcanvas-menu' ) ?>
			</div>
		</div>
	</nav>
<?php endif; ?>
</div> <!-- #wrapper -->
<?php wp_footer(); ?>
</body>
</html>