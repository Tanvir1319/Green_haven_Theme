<?php
/**
 * Remove selected default WooCommerce Cart callbacks.
 *
 * @package Green_Haven_Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Remove the default Cart callbacks that will be replaced
 * by Green Haven callbacks.
 *
 * Run on `wp` so WooCommerce has already registered its
 * callbacks and WordPress conditional functions are available.
 *
 * @return void
 */
function green_haven_remove_default_cart_hooks() {

	if ( ! function_exists( 'is_cart' ) || ! is_cart() ) {
		return;
	}

	/*
	 * Default Cart collaterals.
	 *
	 * WooCommerce registers both callbacks at priority 10.
	 */
	remove_action(
		'woocommerce_cart_collaterals',
		'woocommerce_cross_sell_display',
		10
	);

	remove_action(
		'woocommerce_cart_collaterals',
		'woocommerce_cart_totals',
		10
	);

	/*
	 * Default Proceed to Checkout button.
	 *
	 * We will add a Green Haven version using the same hook.
	 */
	remove_action(
		'woocommerce_proceed_to_checkout',
		'woocommerce_button_proceed_to_checkout',
		20
	);

	/*
	 * Optional: remove express-payment buttons such as
	 * WooPayments/Apple Pay/Google Pay from the Cart totals.
	 *
	 * Leave this commented when you want to retain them.
	 */
	/*
	remove_action(
		'woocommerce_proceed_to_checkout',
		'wc_get_pay_buttons',
		10
	);
	*/

	/*
	 * Do not remove the notices callback.
	 *
	 * WooCommerce uses this for coupon, quantity, stock and
	 * validation messages.
	 */
	/*
	remove_action(
		'woocommerce_before_cart',
		'woocommerce_output_all_notices',
		10
	);
	*/

	/*
	 * Do not remove the standard empty-cart message unless
	 * you also add a custom replacement.
	 */
	/*
	remove_action(
		'woocommerce_cart_is_empty',
		'wc_empty_cart_message',
		10
	);
	*/
}

add_action(
	'wp',
	'green_haven_remove_default_cart_hooks',
	20
);