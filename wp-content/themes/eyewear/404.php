<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	get_header(); ?>
	<div id="content" class="site-content">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="primary" class="content-area">
						<main id="main" class="site-main" role="main">
							<div class="error-404 not-found">

								<header class="page-header">
									<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'eyewear' ); ?></h1>
								</header>
								<!-- .page-header -->

								<div class="page-content">
									<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'eyewear' ); ?></p>

									<?php get_search_form(); ?>

									<p><?php esc_html_e( 'Try using the button below to go to main page of the site', 'eyewear' ); ?></p>

									<div class="home-link clearfix">
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
										   class="btn btn-primary"><?php esc_html_e( 'Go Back to Home', 'eyewear' ); ?></a>
									</div>
								</div>
							</div>
							<!-- .page-notfound -->
						</main>
						<!-- main -->
					</div>
					<!-- #primary -->
				</div>
				<!-- .col-* -->
			</div>
		</div>
		<!-- .row -->
	</div> <!-- .site-content -->
<?php get_footer();