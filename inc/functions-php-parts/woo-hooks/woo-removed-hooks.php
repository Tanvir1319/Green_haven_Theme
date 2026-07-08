<?php
 

//removed hooks in archive product
//upper product hooks in shop page
 remove_action(  'woocommerce_shop_loop_header',
    'woocommerce_product_taxonomy_archive_header',
    10);


     remove_action(  'woocommerce_before_main_content',
    'woocommerce_breadcrumb',
    20);


//product hooks in shop page
 // Remove result count
/**
 * Remove default Result Count.
 * From archive-product.php hook: woocommerce_before_shop_loop.
 */
remove_action(
	'woocommerce_before_shop_loop',
	'woocommerce_result_count',
	20
);

/**
 * Remove default Catalog Ordering.
 * From archive-product.php hook: woocommerce_before_shop_loop.
 */
remove_action(
	'woocommerce_before_shop_loop',
	'woocommerce_catalog_ordering',
	30
);

/**
 * Remove default Product Link Open.
 * From content-product.php hook: woocommerce_before_shop_loop_item.
 */
remove_action(
	'woocommerce_before_shop_loop_item',
	'woocommerce_template_loop_product_link_open',
	10
);

/**
 * Remove default Sale Flash.
 * From content-product.php hook: woocommerce_before_shop_loop_item_title.
 */
remove_action(
	'woocommerce_before_shop_loop_item_title',
	'woocommerce_show_product_loop_sale_flash',
	10
);

/**
 * Remove default Product Image.
 * From content-product.php hook: woocommerce_before_shop_loop_item_title.
 */
remove_action(
	'woocommerce_before_shop_loop_item_title',
	'woocommerce_template_loop_product_thumbnail',
	10
);

/**
 * Remove default Product Title.
 * From content-product.php hook: woocommerce_shop_loop_item_title.
 */
remove_action(
	'woocommerce_shop_loop_item_title',
	'woocommerce_template_loop_product_title',
	10
);

/**
 * Remove default Product Rating.
 * From content-product.php hook: woocommerce_after_shop_loop_item_title.
 */
remove_action(
	'woocommerce_after_shop_loop_item_title',
	'woocommerce_template_loop_rating',
	5
);

/**
 * Remove default Product Price.
 * From content-product.php hook: woocommerce_after_shop_loop_item_title.
 */
remove_action(
	'woocommerce_after_shop_loop_item_title',
	'woocommerce_template_loop_price',
	10
);

/**
 * Remove default Product Link Close.
 * From content-product.php hook: woocommerce_after_shop_loop_item.
 */
remove_action(
	'woocommerce_after_shop_loop_item',
	'woocommerce_template_loop_product_link_close',
	5
);


/**
 * Remove Default WooCommerce Sidebar.
 * From hook: woocommerce_sidebar.
 */
remove_action(
	'woocommerce_sidebar',
	'woocommerce_get_sidebar',
	10
);



/**
 * Remove default Add to Cart Button.
 * From content-product.php hook: woocommerce_after_shop_loop_item.
 */
remove_action(
	'woocommerce_after_shop_loop_item',
	'woocommerce_template_loop_add_to_cart',
	10
);





//removed default button of wishlist plugin

add_filter( 'woosw_button_position_archive', '__return_false' );
add_filter( 'woosw_button_position_single', '__return_false' );






//removed default button of compare plugin

add_filter( 'woosc_button_position_archive', '__return_false' );
add_filter( 'woosc_button_position_single', '__return_false' );




// removed hooks from single product


/**
 * ============================================
 * Remove Default WooCommerce Single Product Hooks
 * ============================================
 */

/**
 * Remove Sale Flash Badge.
 * From hook: woocommerce_before_single_product_summary.
 */
remove_action(
	'woocommerce_before_single_product_summary',
	'woocommerce_show_product_sale_flash',
	10
);

/**
 * Remove Product Gallery / Featured Image.
 * From hook: woocommerce_before_single_product_summary.
 *
*remove_action(
*	'woocommerce_before_single_product_summary',
*	'woocommerce_show_product_images',
*	20
 *);
*/
/**
 * Remove Product Title.
 * From hook: woocommerce_single_product_summary.
 */
remove_action(
	'woocommerce_single_product_summary',
	'woocommerce_template_single_title',
	5
);

/**
 * Remove Product Rating.
 * From hook: woocommerce_single_product_summary.
 */
remove_action(
	'woocommerce_single_product_summary',
	'woocommerce_template_single_rating',
	10
);

/**
 * Remove Product Price.
 * From hook: woocommerce_single_product_summary.
 */
remove_action(
	'woocommerce_single_product_summary',
	'woocommerce_template_single_price',
	10
);

/**
 * Remove Product Short Description.
 * From hook: woocommerce_single_product_summary.
 */
remove_action(
	'woocommerce_single_product_summary',
	'woocommerce_template_single_excerpt',
	20
);

/**
 * Remove Add to Cart Form.
 * From hook: woocommerce_single_product_summary.
 */
remove_action(
	'woocommerce_single_product_summary',
	'woocommerce_template_single_add_to_cart',
	30
);

/**
 * Remove Product Meta (SKU, Categories, Tags).
 * From hook: woocommerce_single_product_summary.
 */
remove_action(
	'woocommerce_single_product_summary',
	'woocommerce_template_single_meta',
	40
);

/**
 * Remove Product Sharing Buttons.
 * From hook: woocommerce_single_product_summary.
 */
remove_action(
	'woocommerce_single_product_summary',
	'woocommerce_template_single_sharing',
	50
);

/**
 * Remove Product Data Tabs.
 * (Description, Additional Information, Reviews)
 * From hook: woocommerce_after_single_product_summary.
 */
remove_action(
	'woocommerce_after_single_product_summary',
	'woocommerce_output_product_data_tabs',
	10
);

/**
 * Remove Upsell Products.
 * From hook: woocommerce_after_single_product_summary.
 */
remove_action(
	'woocommerce_after_single_product_summary',
	'woocommerce_upsell_display',
	15
);

/**
 * Remove Related Products.
 * From hook: woocommerce_after_single_product_summary.
 */
remove_action(
	'woocommerce_after_single_product_summary',
	'woocommerce_output_related_products',
	20
);






