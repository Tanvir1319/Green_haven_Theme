<?php
/**
 * Cart page template.
 *
 * This renders the classic WooCommerce cart directly.
 * It uses WooCommerce's own shortcode flow, so WooCommerce will load:
 * Green_haven_Theme/woocommerce/cart/cart.php
 * Green_haven_Theme/woocommerce/cart/cart-empty.php
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main gh-cart-page">
	<section class="gh-cart-title-section">
		<div class="gh-container">
			<h1 class="gh-cart-title">
				<?php
				if ( have_posts() ) {
					the_post();
					the_title();
					rewind_posts();
				} else {
					esc_html_e( 'Cart', 'green-haven-theme' );
				}
				?>
			</h1>
		</div>
	</section>

	<?php
	if ( class_exists( 'WooCommerce' ) && class_exists( 'WC_Shortcodes' ) ) {
		echo WC_Shortcodes::cart(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		?>
		<div class="woocommerce">
			<p class="woocommerce-info">
				<?php esc_html_e( 'WooCommerce cart is not available.', 'green-haven-theme' ); ?>
			</p>
		</div>
		<?php
	}
	?>
</main>

<?php
get_footer();