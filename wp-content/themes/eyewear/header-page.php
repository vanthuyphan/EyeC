<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	$current_page_template = basename( get_page_template_slug() );

	if ( is_page() and ! in_array( $current_page_template, eyewear_home_page_templates() ) ) : ?>
		<div class="page-title-section">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="custom-page-header">
							<div class="page-header">
								<h1><?php echo esc_html( eyewear_title_text() ); ?></h1>
							</div>
							<!-- .page-header -->
						</div>
						<!-- .custom-page-header -->
					</div>
					<!-- .col-## -->
				</div>
				<!-- .row -->
			</div>
			<!-- .container -->
		</div> <!-- .page-header-wrapper -->
	<?php endif; ?>

<?php if ( ! is_page() && ! is_404() && ! is_singular( 'product' ) ) : ?>
	<div class="page-title-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="custom-page-header">
						<div class="page-header">
							<?php
								if ( is_singular() ) : ?>
									<h1><?php echo wp_kses( get_the_title(), array() ); ?></h1>
									<div class="entry-meta">
										<?php eyewear_entry_meta() ?>
									</div>
									<!-- .entry-meta -->
								<?php else: ?>
									<h1><?php echo wp_kses( eyewear_title_text(), array() ); ?></h1>
								<?php endif; ?>

						</div><!-- .page-header -->
					</div><!-- .custom-page-header -->
				</div><!-- .col-## -->
			</div><!-- .row -->
		</div><!-- .container -->
	</div> <!-- .page-header-wrapper -->
<?php endif;