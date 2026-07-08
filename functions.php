<?php
/**
 * Green Haven Theme Functions
 *
 * @package Green_Haven_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


// 1. Require the Theme Setup File
require_once get_template_directory() . '/inc/functions-php-parts/theme-setup.php';


// 2. Require the Assets File
require_once get_template_directory() . '/inc/functions-php-parts/assets.php';


// 3. Require the TGM related file
require_once get_template_directory() . '/inc/functions-php-parts/tgm.php';

// 4. Require the kirki customizer  file for homepage
require_once get_template_directory() . '/inc/kirki-customizer/home-kirki-customizer.php';


// 5. Require the kirki customizer  file for service page
require_once get_template_directory() . '/inc/kirki-customizer/service-kirki-customizer.php';


// 5. Require the kirki customizer  file for contact page
require_once get_template_directory() . '/inc/kirki-customizer/contact-kirki-customizer.php';

/**
 * Require Bootstrap NavWalker
 */
require_once get_template_directory() . '/inc/class-bootstrap-navwalker.php';

// 1. Require the Theme Setup File


require_once get_template_directory() . '/inc/cpt/porfolio-cpt.php'; 





require_once get_template_directory() . '/inc/green-haven-theme-options.php';

if ( class_exists( 'WooCommerce' ) ) { 
    require_once get_template_directory() . '/inc/functions-php-parts/woo-hooks/woo-removed-hooks.php'; 
    require_once get_template_directory() . '/inc/functions-php-parts/woo-hooks/woo-hooks.php'; 

	require_once get_template_directory() . '/inc/functions-php-parts/woo-hooks/woo-shop-page-custom-functions.php'; 
	require_once get_template_directory() . '/inc/functions-php-parts/woo-hooks/woo-shop-single-page.php'; 
	
}




















// for pagination
function green_haven_pagination( $query ) {
    if ( ! is_admin() && $query->is_main_query() && $query->is_home() ) {
        $query->set( 'paged', get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 );
    }
}
add_action( 'pre_get_posts', 'green_haven_pagination' );












/**
 * Register Blog Sidebar Widget Area
 */
function green_haven_register_blog_sidebar() {
	register_sidebar(
		array(
			'name'          => __( 'Blog Sidebar', 'green-haven-theme' ),
			'id'            => 'blog-sidebar',
			'description'   => __( 'Widgets added here will appear in the blog sidebar.', 'green-haven-theme' ),

			// Sidebar wrapper
			'before_widget' => '<aside class="gh-sidebar"><div id="%1$s" class="gh-sidebar-card widget blog-widget %2$s">',
			'after_widget'  => '</div></aside>',

			// Widget title wrapper
			'before_title'  => '<h3 class="gh-sidebar-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'green_haven_register_blog_sidebar' );

// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );




