<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	if ( is_eyewear_quick_view() ) :
		?>
		<h1 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h1>
	<?php else : ?>
		<?php if ( is_singular( 'product' ) ) : ?>
			<div class="product-navigation">
				<?php previous_post_link( '<div class="previous">%link</div>', sprintf( esc_html__( '%s Previous Product', 'eyewear' ), '<i class="zmdi zmdi-long-arrow-left"></i>' ) ); ?>
				<?php next_post_link( '<div class="next">%link</div>', sprintf( esc_html__( 'Next Product %s', 'eyewear' ), '<i class="zmdi zmdi-long-arrow-right"></i>' ) ); ?>
			</div>
		<?php endif; ?>
		<h1 itemprop="name" class="product_title entry-title text-center"><?php the_title(); ?></h1>
	<?php endif; ?>

