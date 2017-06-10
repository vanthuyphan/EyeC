<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	global $wp_query;

	get_header( 'shop' ); ?>

	<section id="content" class="site-content shop-section shop-section-archive">
		<div class="filter-section">
			<div class="container">
				<div class="row">

					<div class="col-xs-12">
						<div class="product-category-wrap">
							<div class="product-category-list">
								<button class="btn-cat-list hippo-button-toggle" type="button"
								        title="<?php esc_html_e( 'More Categories', 'eyewear' ) ?>"
								        data-placement="left">
									<span><?php esc_html_e( 'Product Categories', 'eyewear' ) ?> <i
											class="zmdi zmdi-chevron-down"></i></span>
								</button>
								<ul>
									<?php


										$categories = (array) get_categories( array(
											                                      'taxonomy' => 'product_cat',
											                                      'orderby'  => 'name',
										                                      ) );

										foreach ( $categories as $category ) :

											$id    = $category->term_id;
											$name = $category->name;
											$slug = $category->slug;

											$thumbnail_id = get_woocommerce_term_meta( $id, 'thumbnail_id', TRUE );
											//$image        = wp_get_attachment_url( $thumbnail_id );
											$image = wp_get_attachment_image_src( $thumbnail_id, 'shop_catalog' );
											?>
											<li class="cat-item cat-item-<?php echo absint( $id ) ?>">

												<a href="<?php echo esc_url( get_term_link( $slug, 'product_cat' ) ) ?>">
													<?php if ( isset( $image[ '0' ] ) ): ?>
														<img width="<?php echo esc_attr( $image[ '1' ] ) ?>"
														     height="<?php echo esc_attr( $image[ '2' ] ) ?>"
														     src="<?php echo esc_url( $image[ '0' ] ) ?>"
														     alt="<?php echo esc_html( $name ) ?>">
													<?php endif; ?>
													<span><?php echo esc_html( $name ) ?></span>
												</a>
											</li>
										<?php endforeach; ?>
								</ul>
							</div>
						</div><!--Product category-->

						<div class="shop-filter-trigger">
						<?php if ( is_active_sidebar( 'woosidebar' ) ) : ?>

								<div class="btn-filter-trigger">
									<?php esc_html_e( 'Filter', 'eyewear' ) ?>
									<i class="zmdi zmdi-tune" title="<?php esc_html_e( 'Product Filter', 'eyewear' ) ?>"></i>
								</div>
						<?php endif; ?>
						</div><!--Sidebar Filter Trigger-->

					</div>
				</div>
			</div>
			<!-- .container -->
		</div>
		<!-- .filter-section -->
		<div class="container">
			<?php if ( is_active_sidebar( 'woosidebar' ) ) : ?>
				<div class="shop-sidebar-wrap">
					<div class="shop-sidebar" style="display: none;">
						<div class="row">
							<?php dynamic_sidebar( 'woosidebar' ); ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<?php
				/**
				 * woocommerce_archive_description hook
				 *
				 * @hooked woocommerce_taxonomy_archive_description - 10
				 * @hooked woocommerce_product_archive_description - 10
				 */

				do_action( 'woocommerce_archive_description' );

				if ( have_posts() ) :


					/**
					 * woocommerce_before_shop_loop hook
					 *
					 * @hooked woocommerce_result_count - 20
					 * @hooked woocommerce_catalog_ordering - 30
					 */
					//do_action( 'woocommerce_before_shop_loop' );

					woocommerce_product_loop_start(); ?>

					<?php woocommerce_product_subcategories(); ?>

					<div class="row">

						<?php
							while ( have_posts() ) : the_post();

								wc_get_template_part( 'content', 'product' );

							endwhile; // end of the loop.
						?>
					</div>

					<?php woocommerce_product_loop_end(); ?>

					<?php
					/**
					 * woocommerce_after_shop_loop hook
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action( 'woocommerce_after_shop_loop' );
					?>

				<?php elseif ( ! woocommerce_product_subcategories( array(
					                                                    'before' => woocommerce_product_loop_start( FALSE ),
					                                                    'after'  => woocommerce_product_loop_end( FALSE )
				                                                    ) )
				) : ?>

					<?php wc_get_template( 'loop/no-products-found.php' ); ?>

				<?php endif; ?>

		</div>
		<!-- .container -->
	</section>
<?php get_footer( 'shop' );