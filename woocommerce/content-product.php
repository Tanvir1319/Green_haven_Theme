<?php
/**
 * The template for displaying product content within loops.
 *
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}?>



<li <?php wc_product_class( 'gh-product-card', $product ); ?>>


	<a href="<?php the_permalink(); ?>" class="gh-product-image-link">
		<?php
		echo $product->get_image(
			'woocommerce_thumbnail',
			array(
				'class' => 'gh-product-image',
			)
		);
		?>
	</a>

	<div class="gh-product-body">

		<h2 class="gh-product-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>

		<p class="gh-product-category">
			<?php echo wp_kses_post( wc_get_product_category_list( $product->get_id(), ', ' ) ); ?>
		</p>

		<div class="gh-rating">
			<?php echo wp_kses_post( wc_get_rating_html( $product->get_average_rating() ) ); ?>
		</div>

		<p class="gh-product-price">
			<?php echo wp_kses_post( $product->get_price_html() ); ?>
		</p>

		<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>"
		   class="gh-cart-btn add_to_cart_button ajax_add_to_cart"
		   data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
		   data-quantity="1">
			<i class="fa-solid fa-cart-shopping"></i>
			<?php echo esc_html( $product->add_to_cart_text() ); ?>
		</a>

	</div>

</li>
	

