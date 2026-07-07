<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content' );


?>
<header class="gh-shop-header">
	<h1 class="gh-shop-title">Our Shop</h1>

	
</header>



<?php    


	

/**
 * Hook: woocommerce_shop_loop_header.
 *
 * @since 8.6.0
 *
 * @hooked woocommerce_product_taxonomy_archive_header - 10
 */
do_action('woocommerce_shop_loop_header' );





if ( woocommerce_product_loop() ) {


?> 



<div class="gh-shop-toolbar">
	
		<div class="gh-shop-result-box">
			<?php woocommerce_result_count(); ?>
		</div>

		<div class="gh-shop-ordering">
			<?php woocommerce_catalog_ordering(); ?>
		</div>



		
	</div>

	
<?php



	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

?>
<aside class="gh-shop-sidebar">


          <div class="gh-sidebar-block">
            <h3 class="gh-sidebar-title">Search</h3>
            <form class="gh-search-form">
              <input type="search" placeholder="Search products...">
              <button type="submit" aria-label="Search">
                <i class="fa-solid fa-magnifying-glass"></i>
              </button>
            </form>
          </div>

          <div class="gh-sidebar-block">
            <h3 class="gh-sidebar-title">Shop by Category</h3>
            <ul class="gh-shop-category-list">
              <li><a href="#">Plants <i class="fa-solid fa-chevron-right"></i></a></li>
              <li><a href="#">Tools <i class="fa-solid fa-chevron-right"></i></a></li>
              <li><a href="#">Fertilizer <i class="fa-solid fa-chevron-right"></i></a></li>
              <li><a href="#">Seeds <i class="fa-solid fa-chevron-right"></i></a></li>
            </ul>
          </div>

          <div class="gh-sidebar-block">
            <div class="gh-price-heading">
              <h3 class="gh-sidebar-title">Price</h3>
              <span><i class="fa-solid fa-cart-shopping"></i> Cart</span>
            </div>

            <div class="gh-range-line">
              <span></span>
              <span></span>
            </div>

            <div class="gh-price-values">
              <span>$19.99</span>
              <span>-</span>
              <span>$29.99</span>
            </div>
          </div>

        </aside>

<?php


	woocommerce_product_loop_start();



	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}
?>



<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
