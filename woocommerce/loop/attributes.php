<?php
/**
 * Custom attributes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;
$attributes = $product->get_attributes();
?>
<div class="product_archive_grid_wrapper">
	<?php foreach ( $attributes as $attribute ) :
			if ( empty( $attribute['is_visible'] ) || ( $attribute['is_taxonomy'] && ! taxonomy_exists( $attribute['name'] ) ) ) {
				continue;
			} else {
				$has_row = true;
			}
			?>
			<div class="product_archive_grid">
				<tr class=" <?php if ( ( $alt = $alt * -1 ) == 1 ) echo 'alt'; ?>">
					<td><?php
						if ( $attribute['is_taxonomy'] ) {

							$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
							echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );

						} else {

							// Convert pipes to commas and display values
							$values = array_map( 'trim', explode( WC_DELIMITER, $attribute['value'] ) );
							echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );

						}
					?></td>
				</tr>
			</div>
		<?php endforeach; ?>
	</div>