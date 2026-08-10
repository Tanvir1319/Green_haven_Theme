<?php

/**
 * Disable Compare button on archive pages
 * only if WPC Smart Compare is active.
 */
if ( function_exists( 'woosc_init' ) ) {
	add_filter( 'woosc_button_position_archive', '__return_false' );
}


/**
 * Disable Compare button on single product pages
 * only if WPC Smart Compare is active.
 */
if ( function_exists( 'woosc_init' ) ) {
	add_filter( 'woosc_button_position_single', '__return_false' );
}







/**
 * Register Product Sidebar.
 */
/**
 * Register Shop Sidebar.
 */
function green_haven_register_product_sidebar() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Product Sidebar', 'green-haven' ),
			'id'            => 'product-sidebar',
			'description'   => esc_html__( 'Widgets displayed in the shop sidebar.', 'green-haven' ),

			'before_widget' => '<div id="%1$s" class="gh-sidebar-block gh-product-sidebar-widget %2$s">',
			'after_widget'  => '</div>',

			'before_title'  => '<h3 class="gh-sidebar-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'green_haven_register_product_sidebar' );