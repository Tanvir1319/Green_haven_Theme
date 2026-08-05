<?php
/**
 * Green Haven custom WooCommerce Cart hooks.
 *
 * This file is intended for the classic [woocommerce_cart]
 * shortcode, not the React-based WooCommerce Cart Block.
 *
 * @package Green_Haven_Theme
 */

defined( 'ABSPATH' ) || exit;


/* =========================================================
 * CART LAYOUT OPENING
 * ========================================================= */

/**
 * Open the Green Haven Cart layout.
 *
 * WooCommerce has already printed its notices at priority 10.
 * This callback runs at priority 20, immediately before the
 * standard cart form.
 *
 * The resulting structure is approximately:
 *
 * <section class="gh-cart-section">
 *     <div class="gh-container">
 *         <div class="gh-cart-layout">
 *             <form class="woocommerce-cart-form">...</form>
 *             <div class="cart-collaterals">...</div>
 *         </div>
 *     </div>
 * </section>
 *
 * @return void
 */
function green_haven_cart_layout_open() {
	?>
	<section class="gh-cart-section">
		<div class="gh-container">
			<div class="gh-cart-layout">
	<?php
}

add_action(
	'woocommerce_before_cart',
	'green_haven_cart_layout_open',
	20
);


/* =========================================================
 * CART LAYOUT CLOSING
 * ========================================================= */

/**
 * Close the Green Haven Cart layout.
 *
 * @return void
 */
function green_haven_cart_layout_close() {
	?>
			</div>
		</div>
	</section>
	<?php
}

add_action(
	'woocommerce_after_cart',
	'green_haven_cart_layout_close',
	20
);


/* =========================================================
 * OPTIONAL CART TITLE
 * ========================================================= */

/**
 * Render a Cart title section.
 *
 * Do not attach this function when page.php already prints
 * the Cart page title. Attaching both creates two headings.
 *
 * @return void
 */
function green_haven_cart_title_section() {
	?>
	<section class="gh-cart-title-section">
		<div class="gh-container">
			<h1 class="gh-cart-title">
				<?php esc_html_e( 'Your Cart', 'green-haven' ); ?>
			</h1>
		</div>
	</section>
	<?php
}

/*
 * Uncomment only when page.php does not output the page title.
 */
/*
add_action(
	'woocommerce_before_cart',
	'green_haven_cart_title_section',
	15
);
*/


/* =========================================================
 * CART PRODUCT CATEGORY
 * ========================================================= */

/**
 * Add the first product category under the Cart product name.
 *
 * @param string $product_name  Existing product-name HTML.
 * @param array  $cart_item     Cart-item data.
 * @param string $cart_item_key Cart-item key.
 *
 * @return string
 */
function green_haven_cart_product_category(
	$product_name,
	$cart_item,
	$cart_item_key
) {
	unset( $cart_item_key );

	if (
		empty( $cart_item['data'] ) ||
		! $cart_item['data'] instanceof WC_Product
	) {
		return $product_name;
	}

	$product = $cart_item['data'];

	/*
	 * Variable products normally inherit categories from
	 * their parent product.
	 */
	$product_id = $product->get_parent_id()
		? $product->get_parent_id()
		: $product->get_id();

	$terms = get_the_terms( $product_id, 'product_cat' );

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return $product_name;
	}

	$category = reset( $terms );

	if ( ! $category instanceof WP_Term ) {
		return $product_name;
	}

	$category_url = get_term_link( $category );

	if ( is_wp_error( $category_url ) ) {
		return $product_name;
	}

	$product_name .= sprintf(
		'<span class="gh-cart-category">
			<a href="%1$s">%2$s</a>
		</span>',
		esc_url( $category_url ),
		esc_html( $category->name )
	);

	return $product_name;
}

add_filter(
	'woocommerce_cart_item_name',
	'green_haven_cart_product_category',
	20,
	3
);


/* =========================================================
 * CUSTOM REMOVE BUTTON
 * ========================================================= */

/**
 * Replace the standard × character with a Font Awesome icon.
 *
 * The standard WooCommerce remove URL and data attributes
 * are retained, so product removal continues to work.
 *
 * @param string $remove_link   Existing remove-link HTML.
 * @param string $cart_item_key Cart-item key.
 *
 * @return string
 */
function green_haven_cart_remove_link(
	$remove_link,
	$cart_item_key
) {
	unset( $remove_link );

	if (
		! WC()->cart ||
		! isset( WC()->cart->cart_contents[ $cart_item_key ] )
	) {
		return '';
	}

	$cart_item = WC()->cart->cart_contents[ $cart_item_key ];
	$product   = isset( $cart_item['data'] )
		? $cart_item['data']
		: false;

	if ( ! $product instanceof WC_Product ) {
		return '';
	}

	$product_name = wp_strip_all_tags( $product->get_name() );

	return sprintf(
		'<a href="%1$s"
			class="remove gh-remove"
			aria-label="%2$s"
			data-product_id="%3$s"
			data-product_sku="%4$s">
			<i class="fa-solid fa-xmark" aria-hidden="true"></i>
		</a>',
		esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
		esc_attr(
			sprintf(
				/* translators: %s: product name. */
				__( 'Remove %s from cart', 'woocommerce' ),
				$product_name
			)
		),
		esc_attr( $product->get_id() ),
		esc_attr( $product->get_sku() )
	);
}

add_filter(
	'woocommerce_cart_item_remove_link',
	'green_haven_cart_remove_link',
	20,
	2
);


/* =========================================================
 * CUSTOM QUANTITY BUTTONS
 * ========================================================= */

/**
 * Add minus and plus buttons around the standard WooCommerce
 * quantity input.
 *
 * The actual WooCommerce input remains unchanged, including:
 *
 * cart[cart_item_key][qty]
 *
 * Therefore WooCommerce can still process quantity updates.
 *
 * @param string $quantity_html Existing quantity-input HTML.
 * @param string $cart_item_key Cart-item key.
 * @param array  $cart_item     Cart-item data.
 *
 * @return string
 */
function green_haven_cart_quantity_buttons(
	$quantity_html,
	$cart_item_key,
	$cart_item
) {
	unset( $cart_item_key );

	if (
		empty( $cart_item['data'] ) ||
		! $cart_item['data'] instanceof WC_Product
	) {
		return $quantity_html;
	}

	$product = $cart_item['data'];

	/*
	 * Products sold individually must remain quantity 1.
	 */
	if ( $product->is_sold_individually() ) {
		return $quantity_html;
	}

	return sprintf(
		'<div class="gh-qty-box">
			<button
				type="button"
				class="gh-qty-minus"
				aria-label="%1$s">−</button>

			%2$s

			<button
				type="button"
				class="gh-qty-plus"
				aria-label="%3$s">+</button>
		</div>',
		esc_attr__( 'Decrease quantity', 'green-haven' ),
		$quantity_html, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		esc_attr__( 'Increase quantity', 'green-haven' )
	);
}

add_filter(
	'woocommerce_cart_item_quantity',
	'green_haven_cart_quantity_buttons',
	20,
	3
);


/* =========================================================
 * CUSTOM CART TOTALS PANEL
 * ========================================================= */

/**
 * Render the Green Haven Cart totals panel.
 *
 * This replaces woocommerce_cart_totals(), while retaining:
 *
 * - Cart subtotal
 * - Applied coupons
 * - Shipping methods and calculator
 * - Extra fees
 * - Taxes
 * - Order total
 * - Extension hooks
 * - Coupon form
 * - Express-payment hooks
 * - Continue Shopping
 * - Proceed to Checkout
 *
 * @return void
 */
function green_haven_cart_totals_panel() {

	if ( ! WC()->cart || WC()->cart->is_empty() ) {
		return;
	}

	$calculated_shipping = (
		WC()->customer &&
		WC()->customer->has_calculated_shipping()
	);
	?>

	<aside
		class="gh-cart-summary cart_totals<?php
		echo $calculated_shipping
			? ' calculated_shipping'
			: '';
		?>"
	>

		<?php do_action( 'woocommerce_before_cart_totals' ); ?>

		<h2>
			<?php esc_html_e( 'Cart Totals', 'green-haven' ); ?>
		</h2>

		<table
			class="shop_table shop_table_responsive gh-cart-totals-table"
			cellspacing="0"
		>
			<tbody>

				<tr class="cart-subtotal gh-total-row">
					<th>
						<?php esc_html_e( 'Subtotal', 'woocommerce' ); ?>
					</th>

					<td data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
						<?php wc_cart_totals_subtotal_html(); ?>
					</td>
				</tr>

				<?php
				foreach ( WC()->cart->get_coupons() as $code => $coupon ) :
					?>
					<tr
						class="cart-discount gh-total-row coupon-<?php
						echo esc_attr( sanitize_title( $code ) );
						?>"
					>
						<th>
							<?php wc_cart_totals_coupon_label( $coupon ); ?>
						</th>

						<td data-title="<?php
						echo esc_attr(
							wc_cart_totals_coupon_label(
								$coupon,
								false
							)
						);
						?>">
							<?php wc_cart_totals_coupon_html( $coupon ); ?>
						</td>
					</tr>
				<?php endforeach; ?>

				<?php
				if (
					WC()->cart->needs_shipping() &&
					WC()->cart->show_shipping()
				) :
					?>

					<?php
					do_action(
						'woocommerce_cart_totals_before_shipping'
					);
					?>

					<?php wc_cart_totals_shipping_html(); ?>

					<?php
					do_action(
						'woocommerce_cart_totals_after_shipping'
					);
					?>

				<?php
				elseif (
					WC()->cart->needs_shipping() &&
					'yes' === get_option(
						'woocommerce_enable_shipping_calc'
					)
				) :
					?>

					<tr class="shipping gh-total-row">
						<th>
							<?php esc_html_e( 'Shipping', 'woocommerce' ); ?>
						</th>

						<td data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>">
							<?php woocommerce_shipping_calculator(); ?>
						</td>
					</tr>

				<?php
				elseif ( WC()->cart->needs_shipping() ) :
					?>

					<tr class="shipping gh-total-row">
						<th>
							<?php esc_html_e( 'Shipping', 'woocommerce' ); ?>
						</th>

						<td data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>">
							<?php
							esc_html_e(
								'Calculated at checkout',
								'green-haven'
							);
							?>
						</td>
					</tr>

				<?php endif; ?>

				<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
					<tr class="fee gh-total-row">
						<th>
							<?php echo esc_html( $fee->name ); ?>
						</th>

						<td data-title="<?php echo esc_attr( $fee->name ); ?>">
							<?php wc_cart_totals_fee_html( $fee ); ?>
						</td>
					</tr>
				<?php endforeach; ?>

				<?php
				if (
					wc_tax_enabled() &&
					! WC()->cart->display_prices_including_tax()
				) {
					$taxable_address = WC()->customer
						? WC()->customer->get_taxable_address()
						: array();

					$estimated_text = '';

					if (
						WC()->customer &&
						WC()->customer->is_customer_outside_base() &&
						! WC()->customer->has_calculated_shipping() &&
						! empty( $taxable_address[0] )
					) {
						$estimated_text = sprintf(
							' <small>%s</small>',
							sprintf(
								/* translators: %s: estimated country. */
								esc_html__( '(estimated for %s)', 'woocommerce' ),
								WC()->countries->estimated_for_prefix(
									$taxable_address[0]
								) .
								WC()->countries->countries[
									$taxable_address[0]
								]
							)
						);
					}

					if (
						'itemized' ===
						get_option( 'woocommerce_tax_total_display' )
					) {
						foreach (
							WC()->cart->get_tax_totals()
							as $code => $tax
						) {
							?>
							<tr
								class="tax-rate gh-total-row tax-rate-<?php
								echo esc_attr(
									sanitize_title( $code )
								);
								?>"
							>
								<th>
									<?php
									echo esc_html( $tax->label );
									echo wp_kses_post( $estimated_text );
									?>
								</th>

								<td data-title="<?php
								echo esc_attr( $tax->label );
								?>">
									<?php
									echo wp_kses_post(
										$tax->formatted_amount
									);
									?>
								</td>
							</tr>
							<?php
						}
					} else {
						?>
						<tr class="tax-total gh-total-row">
							<th>
								<?php
								echo esc_html(
									WC()->countries->tax_or_vat()
								);
								echo wp_kses_post( $estimated_text );
								?>
							</th>

							<td data-title="<?php
							echo esc_attr(
								WC()->countries->tax_or_vat()
							);
							?>">
								<?php wc_cart_totals_taxes_total_html(); ?>
							</td>
						</tr>
						<?php
					}
				}
				?>

				<?php
				do_action(
					'woocommerce_cart_totals_before_order_total'
				);
				?>

				<tr class="order-total gh-total-row gh-total-final">
					<th>
						<?php esc_html_e( 'Total', 'woocommerce' ); ?>
					</th>

					<td data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
						<?php wc_cart_totals_order_total_html(); ?>
					</td>
				</tr>

				<?php
				do_action(
					'woocommerce_cart_totals_after_order_total'
				);
				?>

			</tbody>
		</table>

		<?php green_haven_cart_coupon_form(); ?>

		<div class="wc-proceed-to-checkout">
			<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
		</div>

		<?php do_action( 'woocommerce_after_cart_totals' ); ?>

	</aside>

	<?php
}

add_action(
	'woocommerce_cart_collaterals',
	'green_haven_cart_totals_panel',
	10
);


/* =========================================================
 * CUSTOM COUPON FORM
 * ========================================================= */

/**
 * Render the Cart-summary coupon form.
 *
 * This is outside the main cart form, so it must have its own
 * form tag and WooCommerce cart nonce.
 *
 * @return void
 */
function green_haven_cart_coupon_form() {

	if ( ! wc_coupons_enabled() ) {
		return;
	}
	?>

	<form
		class="gh-coupon-form"
		method="post"
		action="<?php echo esc_url( wc_get_cart_url() ); ?>"
	>

		<label
			for="gh_coupon_code"
			class="screen-reader-text"
	>
			<?php esc_html_e( 'Coupon code', 'woocommerce' ); ?>
		</label>

		<input
			type="text"
			name="coupon_code"
			id="gh_coupon_code"
			value=""
			placeholder="<?php esc_attr_e( 'Apply Coupon', 'green-haven' ); ?>"
			autocomplete="off"
		>

		<button
			type="submit"
			name="apply_coupon"
			value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"
			aria-label="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"
		>
			<i
				class="fa-solid fa-chevron-right"
				aria-hidden="true"
			></i>

			<span class="screen-reader-text">
				<?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?>
			</span>
		</button>

		<?php
		wp_nonce_field(
			'woocommerce-cart',
			'woocommerce-cart-nonce'
		);
		?>

	</form>

	<?php
}


/* =========================================================
 * CONTINUE SHOPPING BUTTON
 * ========================================================= */

/**
 * Add the Continue Shopping button above the checkout button.
 *
 * @return void
 */
function green_haven_continue_shopping_button() {

	$shop_url = wc_get_page_permalink( 'shop' );

	if ( ! $shop_url ) {
		$shop_url = home_url( '/' );
	}
	?>

	<a
		href="<?php echo esc_url( $shop_url ); ?>"
		class="button wc-backward gh-summary-btn gh-continue-shopping"
	>
		<?php esc_html_e( 'Continue Shopping', 'green-haven' ); ?>
	</a>

	<?php
}

add_action(
	'woocommerce_proceed_to_checkout',
	'green_haven_continue_shopping_button',
	15
);


/* =========================================================
 * CUSTOM PROCEED TO CHECKOUT BUTTON
 * ========================================================= */

/**
 * Add the custom Proceed to Checkout button.
 *
 * The standard WooCommerce button classes are retained for
 * plugin and stylesheet compatibility.
 *
 * @return void
 */
function green_haven_proceed_to_checkout_button() {
	?>

	<a
		href="<?php echo esc_url( wc_get_checkout_url() ); ?>"
		class="checkout-button button alt wc-forward gh-summary-btn gh-checkout-button"
	>
		<?php esc_html_e( 'Proceed to Checkout', 'green-haven' ); ?>
	</a>

	<?php
}

add_action(
	'woocommerce_proceed_to_checkout',
	'green_haven_proceed_to_checkout_button',
	20
);


/* =========================================================
 * CART JAVASCRIPT
 * ========================================================= */

/**
 * Load the quantity-button JavaScript on the classic Cart.
 *
 * @return void
 */
function green_haven_enqueue_cart_quantity_script() {

	if ( ! function_exists( 'is_cart' ) || ! is_cart() ) {
		return;
	}

	$relative_path = '/assets/js/cart-quantity.js';
	$absolute_path = get_template_directory() . $relative_path;

	$version = file_exists( $absolute_path )
		? (string) filemtime( $absolute_path )
		: '1.0.0';

	wp_enqueue_script(
		'green-haven-cart-quantity',
		get_template_directory_uri() . $relative_path,
		array( 'jquery' ),
		$version,
		true
	);
}

add_action(
	'wp_enqueue_scripts',
	'green_haven_enqueue_cart_quantity_script',
	30
);