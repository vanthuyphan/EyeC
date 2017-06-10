<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	$attributes = vc_map_get_attributes( $this->getShortcode(), $atts );

	$items = (array) vc_param_group_parse_atts( $attributes[ 'items' ] );

	ob_start();
?>
	<div class="hippo-join-us-wrapper <?php echo esc_attr( $attributes[ 'el_class' ] ); ?>">

		<ul class="list-inline">
			<li class="hippo-join-us-title"><?php echo esc_html( $attributes[ 'title' ] ) ?></li>
			<?php foreach ( $items as $item ): ?>
				<li class="hippo-join-us-links"><a target="_blank" href="<?php echo esc_url( $item[ 'link' ] ) ?>"><i
							class="<?php echo esc_attr( $item[ 'icon' ] ) ?>"></i></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php
	echo $this->endBlockComment( $this->getShortcode() );
	echo ob_get_clean();