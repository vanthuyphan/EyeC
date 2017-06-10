<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	$attributes = vc_map_get_attributes( $this->getShortcode(), $atts );

	$items = (array) vc_param_group_parse_atts( $attributes[ 'items' ] );

	$section_id = trim( $attributes[ 'section_id' ] );
	
	ob_start();
?>
	<div
		class="text-center wpb_content_element hippo-product-technical-details-wrapper <?php echo esc_attr( $attributes[ 'el_class' ] ); ?>">

		<h4 class="hippo-product-technical-details-title">
			<a class="hippo-product-technical-details-link" data-toggle="collapse"
			   href="#<?php echo esc_attr( $section_id ) ?>" aria-expanded="false">
				<span
					class="hippo-product-technical-details-text"><?php echo esc_attr( $attributes[ 'title' ] ); ?></span>
				<i class="hippo-product-technical-details-icon zmdi zmdi-chevron-right"></i>
			</a>
		</h4>

		<div class="specification-list collapse" id="<?php echo esc_attr( $section_id ) ?>">

			<div class="table-responsive">
				<table class="table hippo-product-technical-details-table">
					<tbody>
					<?php foreach ( $items as $item ): ?>
						<tr>
							<th><?php echo esc_html( $item[ 'title' ] ) ?></th>
							<td><?php echo esc_html( $item[ 'value' ] ) ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php
	echo $this->endBlockComment( $this->getShortcode() );
	echo ob_get_clean();