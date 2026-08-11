<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form role="search" method="get" class="gh-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <input 
    type="search"
    name="s"
    value="<?php echo get_search_query(); ?>"
    placeholder="<?php echo esc_attr__( 'Search products…', 'woocommerce' ); ?>"
  >

  <input type="hidden" name="post_type" value="product">

  <button type="submit" aria-label="<?php esc_attr_e( 'Search', 'woocommerce' ); ?>">
    <i class="fa-solid fa-magnifying-glass"></i>
  </button>
</form>