<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', TRUE ) );

?>
<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?>
    id="li-comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment_container">

		<!-- <?php //echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '60' ), '' ); ?> -->

		<div class="comment-text">

			<?php if ( $comment->comment_approved == '0' ) : ?>

				<p class="meta"><em><?php esc_html_e( 'Your comment is awaiting approval', 'eyewear' ); ?></em></p>

			<?php else : ?>

				<div class="meta">
					<div class="comment-author">
						<strong itemprop="author"><?php comment_author(); ?></strong>
						<?php if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' ) :
							if ( wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) ) :
								echo '<em class="verified">(' . esc_html__( 'verified owner', 'eyewear' ) . ')</em> ';
							endif;
						endif;

						?>
					</div>

					<time itemprop="datePublished"
					      datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( wc_date_format() ); ?></time>
					<?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>

						<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating"
						     title="<?php echo sprintf( esc_html__( 'Rated %d out of 5', 'eyewear' ), $rating ) ?>">
							<span style="width:<?php echo ( $rating / 5 ) * 100; ?>%"><strong
									itemprop="ratingValue"><?php echo $rating; ?></strong> <?php esc_html_e( 'out of 5', 'eyewear' ); ?></span>
						</div>

					<?php endif; ?>
				</div>

			<?php endif; ?>

			<div itemprop="description" class="description"><?php comment_text(); ?></div>
		</div>
	</div>