<?php
/**
 * Enqueue all front-end and admin assets for Green Haven Theme.
 *
 * @package Green_Haven_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function green_haven_theme_enqueue_assets() {
    $theme   = wp_get_theme();
    $version = $theme->get( 'Version' );

    // Bootstrap CSS
    wp_enqueue_style(
        'green-haven-bootstrap-css',
        get_template_directory_uri() . '/assets/css/bootstrap.min.css',
        array(),
        '5.3.0',
        'all'
    );

    // Font Awesome (bundled, no CDN)
    wp_enqueue_style(
        'green-haven-font-awesome',
        get_template_directory_uri() . '/assets/css/all.min.css',
        array(),
        '6.4.0',
        'all'
    );

    // Owl Carousel CSS (must load before dependants)
    wp_enqueue_style(
        'green-haven-owl-carousel',
        get_template_directory_uri() . '/assets/css/owl.carousel.min.css',
        array(),
        '2.3.4',
        'all'
    );




    wp_enqueue_style(
        'green-haven-owl-theme',
        get_template_directory_uri() . '/assets/css/owl.theme.default.min.css',
        array( 'green-haven-owl-carousel' ),
        '2.3.4',
        'all'
    );

    // Glightbox CSS
    wp_enqueue_style(
        'green-haven-glightbox',
        get_template_directory_uri() . '/assets/css/glightbox.min.css',
        array(),
        '2.3.4',
        'all'
    );

    // Component stylesheets
    wp_enqueue_style( 'green-haven-home-style',        get_template_directory_uri() . '/assets/css/home-style.css',               array( 'green-haven-owl-carousel' ), $version, 'all' );
    wp_enqueue_style( 'green-haven-nav-footer',        get_template_directory_uri() . '/assets/css/navbar-footer.css',             array(), $version, 'all' );
    wp_enqueue_style( 'green-haven-contact',           get_template_directory_uri() . '/assets/css/contact.css',                   array(), $version, 'all' );


  /* Shop page */
if (
	function_exists( 'is_shop' ) &&
	( is_shop() || is_product_category() || is_product_tag() )
) {
	wp_enqueue_style(
		'green-haven-shop',
		get_template_directory_uri() . '/assets/css/shop.css',
		array( 'woocommerce-general' ),
		filemtime( get_template_directory() . '/assets/css/shop.css' ),
		'all'
	);
}

/* Cart page */
if ( function_exists( 'is_cart' ) && is_cart() ) {
	wp_enqueue_style(
		'green-haven-cart',
		get_template_directory_uri() . '/assets/css/cart.css',
		array( 'woocommerce-general' ),
		filemtime( get_template_directory() . '/assets/css/cart.css' ),
		'all'
	);
}

/* Checkout page */
if (
	function_exists( 'is_checkout' ) &&
	is_checkout() &&
	! is_order_received_page()
) {
	wp_enqueue_style(
		'green-haven-checkout',
		get_template_directory_uri() . '/assets/css/checkout.css',
		array( 'woocommerce-general' ),
		filemtime( get_template_directory() . '/assets/css/checkout.css' ),
		'all'
	);
}


if (
	function_exists( 'is_checkout' ) &&
	! is_checkout() &&
	 is_order_received_page()
) {
	wp_enqueue_style(
		'green-haven-order-details',
		get_template_directory_uri() . '/assets/css/order-details.css',
		array( 'woocommerce-general' ),
		filemtime( get_template_directory() . '/assets/css/' ),
		'all'
	);
}
/* Single product page */
if ( function_exists( 'is_product' ) && is_product() ) {
	wp_enqueue_style(
		'green-haven-single-product',
		get_template_directory_uri() . '/assets/css/single-product.css',
		array( 'woocommerce-general' ),
		filemtime( get_template_directory() . '/assets/css/single-product.css' ),
		'all'
	);
}
 wp_enqueue_style( 'green-haven-order',           get_template_directory_uri() . '/assets/css/order-details.css',                   array(), $version, 'all' );

  wp_enqueue_style( 'green-haven-my-account',           get_template_directory_uri() . '/assets/css/my-account.css',                   array(), $version, 'all' );


/* Wishlist page */
if ( is_page( 'wishlist' ) ) {
	wp_enqueue_style(
		'green-haven-wishlist',
		get_template_directory_uri() . '/assets/css/wishlist.css',
		array(),
		filemtime( get_template_directory() . '/assets/css/wishlist.css' ),
		'all'
	);
}


  
    wp_enqueue_style( 'green-haven-service',           get_template_directory_uri() . '/assets/css/service.css',                   array(), $version, 'all' );
    wp_enqueue_style( 'green-haven-service-load-more', get_template_directory_uri() . '/assets/css/service-page-load-more.css',    array(), $version, 'all' );
    wp_enqueue_style( 'green-haven-blog-style',        get_template_directory_uri() . '/assets/css/green-haven-blog.css',          array(), $version, 'all' );
    wp_enqueue_style( 'green-haven-single-blog',       get_template_directory_uri() . '/assets/css/single-blog.css',               array(), $version, 'all' );
    wp_enqueue_style( 'green-haven-style',             get_template_directory_uri() . '/assets/css/style.css',                     array(), $version, 'all' );

	
    wp_enqueue_style(
        'green-haven-theme-style',
        get_stylesheet_uri(),
        array(
            'green-haven-bootstrap-css',
            'green-haven-font-awesome',
            'green-haven-owl-carousel',
            'green-haven-owl-theme',
        ),
        $version,
        'all'
    );

    if ( ! wp_script_is( 'jquery', 'enqueued' ) ) {
        wp_enqueue_script( 'jquery' );
    }

    // JavaScript
    wp_enqueue_script( 'green-haven-bootstrap-js',       get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js',   array( 'jquery' ), '5.3.0', true );
    wp_enqueue_script( 'green-haven-glightbox-js',        get_template_directory_uri() . '/assets/js/glightbox.min.js',          array( 'jquery' ), '3.0.0', true );
    wp_enqueue_script( 'green-haven-owl-carousel-js',     get_template_directory_uri() . '/assets/js/owl.carousel.min.js',       array( 'jquery' ), '2.3.4', true );
    wp_enqueue_script( 'green-haven-home-carousel-js',    get_template_directory_uri() . '/assets/js/home-page-carousel.js',     array( 'jquery', 'green-haven-owl-carousel-js' ), $version, true );
    
  
    wp_enqueue_style( 'green-haven-portfolio',    get_template_directory_uri() . '/assets/css/portfolio.css',                array(), $version, 'all' );
    wp_enqueue_style( 'green-haven-portfolio-lb', get_template_directory_uri() . '/assets/css/portfolio-page-glightbox.css', array(), $version, 'all' );
    wp_enqueue_script( 'green-haven-mixitup-js',          get_template_directory_uri() . '/assets/js/mixitup.min.js',             array( 'jquery' ), '3.3.1', true );
    wp_enqueue_script( 'green-haven-portfolio-filter-js', get_template_directory_uri() . '/assets/js/portfolio-filter.js',        array( 'jquery', 'green-haven-mixitup-js' ), $version, true );
    wp_enqueue_script( 'green-haven-portfolio-lb-js',     get_template_directory_uri() . '/assets/js/portfolio-page-lightbox.js', array( 'jquery', 'green-haven-glightbox-js' ), $version, true );

    
    wp_enqueue_script( 'green-haven-navigation-js',       get_template_directory_uri() . '/assets/js/navigation.js',             array( 'jquery' ), $version, true );
     wp_enqueue_script(
    'green-haven-review-carousel-js',
    get_template_directory_uri() . '/assets/js/woocomerce-single-page-plus-minus.js',
    array( 'jquery', 'green-haven-owl-carousel-js' ),
    $version,
    true
);
   
}
add_action( 'wp_enqueue_scripts', 'green_haven_theme_enqueue_assets' );



/**
 * Enqueue Comment Reply Script
 */
function green_haven_comment_reply_script() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'green_haven_comment_reply_script' );










/**
 * Load WordPress default color picker and media uploader.
 */
function green_haven_admin_assets( $hook ) {

	// Load these assets only on Green Haven Theme Options page.
	if (
		'toplevel_page_green-haven-theme-options' !== $hook &&
		'green-haven-theme-options_page_green-haven-theme-options' !== $hook &&
		'green-haven-theme-options_page_green-haven-phone-number' !== $hook &&
		'green-haven-theme-options_page_green-haven-footer-settings' !== $hook
	) {
		return;
	}

// Load WordPress default color picker CSS.
	wp_enqueue_style( 'wp-color-picker' );

	// Load WordPress default dashicons.
	wp_enqueue_style( 'dashicons' );

	// Load WordPress default color picker JS.
	wp_enqueue_script( 'wp-color-picker' );

	// Load WordPress default media uploader.
	wp_enqueue_media();

	// Load custom admin JS (color picker + image uploader + follow-us fields).
	wp_enqueue_script(
		'green-haven-admin-js',
		get_template_directory_uri() . '/assets/admin/green-haven-admin.js',
		array( 'jquery', 'wp-color-picker' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'admin_enqueue_scripts', 'green_haven_admin_assets' );



