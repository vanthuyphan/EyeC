<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	global $hide_list;

	do_action( 'eyewear_before_post_entry_meta' );
?>
	<ul class="list-inline post-entry-meta">

		<li class="posted-by author vcard">
			<a class="url fn n"
			   href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php echo esc_html( get_the_author() ) ?></a>
		</li>
		<li class="posted-on">
			<?php
				$time_string = '%5$s <a href="%7$s"><time class="entry-date published updated" datetime="%1$s">%2$s</time></a>';

				if ( ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) ) {
					$time_string = '%5$s <a href="%7$s"><time class="entry-date published" datetime="%1$s">%2$s</time></a>';
					//$time_string .= '<strong>%6$s</strong><a href="%7$s"><time class="updated" datetime="%3$s">%4$s</time></a>';
				}

				printf(
					$time_string,
					esc_attr( get_the_date( 'c' ) ),
					( ( get_the_time( 'U' ) + ( 60 * 60 * 24 * 90 ) ) > current_time( 'timestamp' ) ) ? sprintf( '%s ago', esc_html( human_time_diff( get_the_date( 'U' ), current_time( 'timestamp' ) ) ) ) : get_the_date(),
					esc_attr( get_the_modified_date( 'c' ) ),
					sprintf( '%s ago', esc_html( human_time_diff( get_the_modified_date( 'U' ), current_time( 'timestamp' ) ) ) ),
					esc_html__( 'Published on', 'eyewear' ),
					esc_html__( 'Updated on', 'eyewear' ),
					esc_url( get_permalink() )
				);
			?>
		</li>
		<li class="reading-time">
			<?php echo eyewear_get_min_to_read() ?>
		</li>
		<?php do_action( 'eyewear_post_entry_meta' ); ?>
	</ul>

<?php do_action( 'eyewear_after_post_entry_meta' );
