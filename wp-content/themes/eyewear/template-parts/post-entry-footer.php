<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	global $hide_list;

	do_action( 'eyewear_before_post_entry_footer' );
?>
<?php if ( get_the_tag_list() and is_single() ) : ?>
	<ul class="list-inline post-tags entry-footer-tag-list">
		<?php
			the_tags( '<li class="post-tag">', ' ', '</li>' );
		?>
	</ul>
<?php endif; ?>
	<ul class="entry-footer-list">

		<?php if ( is_single() and get_the_category_list() ) : ?>
			<li class="post-categories">
				<?php
					printf( '<span>%s</span> %s', esc_html__( 'in ', 'eyewear' ), get_the_category_list( esc_html__( ', ', 'eyewear' ) ) );
				?>
			</li>
		<?php endif; ?>

		<?php if ( function_exists( 'zilla_likes' ) ) : ?>
			<li class="post-likes">
				<?php zilla_likes() ?>
			</li>
		<?php endif; ?>

		<?php if ( ! is_single() and ! post_password_required() and ( comments_open() or get_comments_number() ) ) : ?>
			<li class="comments-link">
				<i class="zmdi zmdi-comments"></i>
				<?php
					comments_popup_link(
						esc_html__( 'Leave a response', 'eyewear' ),
						esc_html__( '1 response', 'eyewear' ),
						esc_html__( '% responses', 'eyewear' ) );
				?>
			</li>
		<?php endif; ?>

		<?php if ( is_single() and ! post_password_required() and ( comments_open() or get_comments_number() ) ) : ?>
			<li class="comments-link single-comments-link">
				<?php
					comments_popup_link(
						esc_html__( 'Leave a response', 'eyewear' ),
						esc_html__( '1 response', 'eyewear' ),
						esc_html__( '% responses', 'eyewear' ) );
				?>
			</li>
		<?php endif; ?>

		<?php if ( eyewear_option( 'show-share-button', FALSE, TRUE ) ) : ?>
			<li class="share-link">

				<div class="hippo-share-button">
					<div class="social">
						<ul class="list-inline">
							<li class="post-share-dropdown-wrapper">
								<div class="dropdown">
									<button class="dropdown-toggle more-share"
									        aria-haspopup="true" data-toggle="dropdown"
									        aria-expanded="false">
										<i class="zmdi zmdi-share"></i>
										<?php esc_html_e( 'SHARE', 'eyewear' ) ?>
									</button>
									<ul class="dropdown-menu">
										<?php if ( eyewear_option( 'share-button', 'twitter', TRUE ) ) : ?>
											<!--Twitter-->
											<li>
												<a class="btn-social twitter"
												   href="http://twitter.com/home?status=Reading:<?php the_permalink(); ?>"
												   title="<?php esc_html_e( 'Share this post on Twitter!', 'eyewear' ); ?>"
												   target="_blank"><i
														class="zmdi zmdi-twitter"></i></a>
											</li>
										<?php endif; ?>

										<?php if ( eyewear_option( 'share-button', 'facebook', TRUE ) ) : ?>
											<!--Facebook-->
											<li>
												<a class="btn-social facebook"
												   href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>"
												   title="<?php esc_html_e( 'Share this post on Facebook!', 'eyewear' ); ?>"
												   target="_blank"><i class="zmdi zmdi-facebook"></i>
												</a>
											</li>
										<?php endif; ?>


										<?php if ( eyewear_option( 'share-button', 'google', TRUE ) ) : ?>
											<!--Google Plus-->
											<li>
												<a class="btn-social google-plus"
												   href="https://plus.google.com/share?url=<?php the_permalink(); ?>"
												   title="<?php esc_html_e( 'Share this post on Google+!', 'eyewear' ); ?>"
												   target="_blank"><i
														class="zmdi zmdi-google-plus"></i>
												</a>
											</li>
										<?php endif; ?>
										<?php if ( eyewear_option( 'share-button', 'linkedin', TRUE ) ) : ?>

											<li>
												<a class="btn-social linkedin"
												   href="http://www.linkedin.com/shareArticle?mini=true&amp;title=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>"
												   title="<?php esc_html_e( 'Share this post on Linkedin!', 'eyewear' ); ?>"
												   target="_blank"><i
														class="zmdi zmdi-linkedin-box"></i>
												</a>
											</li>
										<?php endif; ?>

									</ul>

								</div>
							</li>
						</ul>
					</div>
			</li>
		<?php endif; ?>


		<?php echo edit_post_link( '<i class="fa fa-pencil"></i>' . esc_html__( 'Edit Post', 'eyewear' ), '<li class="edit-link">', '</li>' ) ?>

		<?php do_action( 'eyewear_post_entry_footer' ); ?>
	</ul>
<?php do_action( 'eyewear_after_post_entry_footer' );