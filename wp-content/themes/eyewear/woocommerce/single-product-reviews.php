<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	if ( ! comments_open() ) {
		return;
	}

	global $post, $product, $woocommerce_loop;

?>
<div id="reviews">
	<div class="row">
		<div class="col-md-12">
			<div id="comments">
				<h2><?php
						if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) ) {
							printf( _n( '%s review for %s', '%s reviews for %s', $count, 'eyewear' ), $count, wp_kses( get_the_title(), array() ) );
						} else {
							esc_html_e( 'Reviews', 'eyewear' );
						}
					?></h2>

				<?php if ( have_comments() ) : ?>

					<ol class="commentlist">
						<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
					</ol>

					<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
						echo '<nav class="woocommerce-pagination">';
						paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
							'prev_text' => '&larr;',
							'next_text' => '&rarr;',
							'type'      => 'list',
						) ) );
						echo '</nav>';
					endif; ?>

				<?php else : ?>

					<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'eyewear' ); ?></p>

				<?php endif; ?>
			</div>
			<!-- #comments -->
		</div>

		<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

			<div class="col-md-12">
				<div id="review_form_wrapper">
					<div id="review_form">
						<?php
							$commenter = wp_get_current_commenter();

							$comment_form = array(
								'title_reply'          => have_comments() ? esc_html__( 'Leave a Reply', 'eyewear' ) : esc_html__( 'Be the first to review', 'eyewear' ) . ' &ldquo;' . wp_kses( get_the_title(), array() ) . '&rdquo;',
								'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'eyewear' ),
								'comment_notes_before' => '',
								'comment_notes_after'  => '',
								'fields'               => array(
									'author' => '<div class="input-field comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'eyewear' ) . ' <span class="required">*</span></label> ' .
									            '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter[ 'comment_author' ] ) . '" size="30" aria-required="true" /></div>',
									'email'  => '<div class="input-field comment-form-email"><label for="email">' . esc_html__( 'Email', 'eyewear' ) . ' <span class="required">*</span></label> ' .
									            '<input class="form-control" id="email" name="email" type="text" value="' . esc_attr( $commenter[ 'comment_author_email' ] ) . '" size="30" aria-required="true" /></div>',
								),
								'label_submit'         => esc_html__( 'Submit', 'eyewear' ),
								'logged_in_as'         => '',
								'comment_field'        => ''
							);

							if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
								$comment_form[ 'must_log_in' ] = '<p class="must-log-in">' . sprintf( wp_kses( __( 'You must be <a href="%s">logged in</a> to post a review.', 'eyewear' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( $account_page_url ) ) . '</p>';
							}


							$comment_form[ 'comment_field' ] = '<div class="input-field comment-form-comment"><label for="comment">' . esc_html__( 'Your Review', 'eyewear' ) . '</label><textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>';

							if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
								$comment_form[ 'comment_field' ] .= '<p class="comment-form-rating"><label for="rating">' . esc_html__( 'Your Rating', 'eyewear' ) . '</label><select name="rating" id="rating">
								<option value="">' . esc_html__( 'Rate&hellip;', 'eyewear' ) . '</option>
								<option value="5">' . esc_html__( 'Perfect', 'eyewear' ) . '</option>
								<option value="4">' . esc_html__( 'Good', 'eyewear' ) . '</option>
								<option value="3">' . esc_html__( 'Average', 'eyewear' ) . '</option>
								<option value="2">' . esc_html__( 'Not that bad', 'eyewear' ) . '</option>
								<option value="1">' . esc_html__( 'Very Poor', 'eyewear' ) . '</option>
							</select></p>';
							}

							comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
						?>
					</div>
				</div>
				<!-- #review_form_wrapper -->
			</div>

		<?php else : ?>

			<div class="col-md-12"><p
					class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'eyewear' ); ?></p>
			</div>

		<?php endif; ?>

		<div class="clear"></div>
	</div>
</div> <!-- #reviews -->
