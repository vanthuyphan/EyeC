<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	global $product;

	if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
		return;
	}

	$rating_count = $product->get_rating_count();
	$review_count = $product->get_review_count();
	$average      = $product->get_average_rating();

	if ( $rating_count > 0 ) : ?>

		<div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope
		     itemtype="http://schema.org/AggregateRating">
			<?php if ( comments_open() ) : ?>


				<div class="star-rating"
				     title="<?php printf( esc_html__( 'Rated %s out of 5', 'eyewear' ), $average ); ?>">
			<span style="width:<?php echo( ( $average / 5 ) * 100 ); ?>%">
				<strong itemprop="ratingValue"
				        class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( esc_html__( 'out of %s5%s', 'eyewear' ), '<span itemprop="bestRating">', '</span>' ); ?>
				<?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'eyewear' ), '<span itemprop="ratingCount" class="rating">' . $rating_count . '</span>' ); ?>
			</span>
				</div>

				<?php if ( is_eyewear_quick_view() ):

					$reviews_link = $product->get_permalink() . '#reviews';
				else:
					$reviews_link = '#reviews';
				endif; ?>
				<a href="<?php echo esc_url( $reviews_link ) ?>" class="woocommerce-review-link"
				   rel="nofollow"><?php printf( _n( '%s review', '%s reviews', $review_count, 'eyewear' ), '<span itemprop="reviewCount" class="count">' . $review_count . '</span>' ); ?></a><?php endif ?>


		</div>
	<?php endif;