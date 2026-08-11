<?php


/**
 * Set up theme defaults and register support for WordPress features
 *
 * @since 1.0.0
 * @return void
 */

/**
 * Enqueue theme scripts and styles
 *
 * @since 1.0.0
 * @return void
 */





function green_haven_theme_setup() {
	// Make theme available for translation
	load_theme_textdomain( 'green-haven-theme', get_template_directory() . '/languages' );
	

add_post_type_support( 'post', 'comments' );
	


	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );
	
	// Enable support for Post Thumbnails on posts and pages
	add_theme_support( 'post-thumbnails' );
	
	// Register navigation menus
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'green-haven-theme' ),
		'footer'  => esc_html__( 'Footer Menu', 'green-haven-theme' ),
	) );
	
	// Switch default core markup to output valid HTML5
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	// Add theme support for selective refresh for widgets
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	// Add support for core custom logo
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );
	
	// Add support for full and wide align images
	add_theme_support( 'align-wide' );
	
	// Add support for editor styles
	add_theme_support( 'editor-styles' );
	
	// Add support for responsive embedded content
	add_theme_support( 'responsive-embeds' );
	
	// Add support for block styles
	add_theme_support( 'wp-block-styles' );


/**
 * WooCommerce theme support
 */
add_theme_support( 'woocommerce' );
add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	
}
add_action( 'after_setup_theme', 'green_haven_theme_setup' );








