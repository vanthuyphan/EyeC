<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	global $post, $woocommerce, $product;

?>
<div class="images">

	<?php $galleries = $product->get_gallery_attachment_ids();

		if ( $galleries ) : ?>

			<div class="hippo-gallery-wrapper">
				<div class="hippo-gallery">
					<ul class="slides">
						<?php foreach ( $galleries as $gallery ) :
							$img_src = wp_get_attachment_image_src( $gallery, 'eyewear-single-product-thumbnail' );
							$full_img_src = wp_get_attachment_image_src( $gallery, 'full' );
							?>
							<li>
								<a data-rel="prettyPhoto[gallery]"
								   href="<?php echo esc_url( $full_img_src[ 0 ] ); ?>"><img
										src="<?php echo esc_url( $img_src[ 0 ] ); ?>"
										alt="<?php echo wp_kses( get_the_title(), array() ); ?>"></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="hippo-gallery-nav">
					<a class="gallery-control prev"><i class="zmdi zmdi-long-arrow-left"></i></a>
					<a class="gallery-control next"><i class="zmdi zmdi-long-arrow-right"></i></a>
				</div>
			</div>

			<div class="hippo-product-gallery-thumb-wrapper">
				<div class="hippo-thumb">
					<ul class="slides list-inline text-center">
						<?php foreach ( $galleries as $gallery ) :
							$img_src = wp_get_attachment_image_src( $gallery, 'eyewear-single-product-thumbnail-mini' ); ?>
							<li>
								<img src="<?php echo esc_url( $img_src[ 0 ] ); ?>"
								     alt="<?php echo wp_kses( get_the_title(), array() ); ?>">
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		<?php else : ?>

			<div class="entry-thumbnail">
				<?php if ( has_post_thumbnail() ) :
					$image_title   = esc_attr( get_the_title() );
					$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
					$image_link    = wp_get_attachment_url( get_post_thumbnail_id() );
					$image         = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'eyewear-single-product-thumbnail' ), array(
						'title' => $image_title,
						'alt'   => $image_title
					) );
					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="element-lightbox" title="%s" data-rel="prettyPhoto">%s</a>', $image_link, $image_caption, $image ), $post->ID );
				else :
					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'eyewear' ) ), $post->ID );
				endif; ?>

			</div>

		<?php endif; ?>

	<?php //do_action( 'woocommerce_product_thumbnails' ); ?>
</div>