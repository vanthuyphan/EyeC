<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	global $wp_query;

	if ( $wp_query->max_num_pages <= 1 ) :
		return;
	endif;
?>
<div class="woocommerce-pagination">
	<?php

		$product_page_items = paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base'      => esc_url( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, FALSE ) ) ) ),
			'format'    => '',
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $wp_query->max_num_pages,
			'prev_text' => '<i class="fa fa-long-arrow-left"></i> ' . esc_html__( 'Prev', 'eyewear' ),
			'next_text' => esc_html__( 'Next', 'eyewear' ) . '<i class="fa fa-long-arrow-right"></i>',
			'type'      => 'array',
			'end_size'  => 3,
			'mid_size'  => 3
		) ) );


		$pagination = "<ul class=\"pagination page-numbers\">\n\t<li>";
		$pagination .= join( "</li>\n\t<li>", (array) $product_page_items );
		$pagination .= "</li>\n</ul>\n";

		echo $pagination;
	?>
</div> <!-- .woocommerce-pagination -->