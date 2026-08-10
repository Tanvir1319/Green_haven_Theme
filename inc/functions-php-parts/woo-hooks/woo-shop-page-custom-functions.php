<?php



function green_haven_wooc_add_to_cart( $args = array() ) {

	$product = wc_get_product( get_the_ID() );

	if ( ! $product ) {
		return;
	}

	$defaults = array(
		'quantity'   => 1,
		'class'      => implode(
			' ',
			array_filter(
				array(
					'gh-cart-btn',
					'product_type_' . $product->get_type(),
					$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
					$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
				)
			)
		),
		'attributes' => array(
			'data-product_id'  => $product->get_id(),
			'data-product_sku' => $product->get_sku(),
			'aria-label'       => wp_strip_all_tags( $product->add_to_cart_description() ),
			'rel'              => 'nofollow',
		),
	);

	$args = wp_parse_args( $args, $defaults );

	if ( $product->is_type( 'variable' ) ) {
		$btntext = esc_html__( 'Select Options', 'green-haven' );
	} elseif ( $product->is_type( 'external' ) ) {
		$btntext = esc_html__( 'Buy Now', 'green-haven' );
	} elseif ( $product->is_type( 'grouped' ) ) {
		$btntext = esc_html__( 'View Products', 'green-haven' );
	} else {
		$btntext = esc_html__( 'Add to Cart', 'green-haven' );
	}

	echo sprintf(
		'<a title="%s" href="%s" data-quantity="%s" class="%s" %s><i class="fa-solid fa-cart-shopping"></i> %s</a>',
		esc_attr( $btntext ),
		esc_url( $product->add_to_cart_url() ),
		esc_attr( $args['quantity'] ),
		esc_attr( $args['class'] ),
		wc_implode_html_attributes( $args['attributes'] ),
		esc_html( $btntext )
	);
}


function green_haven_product_grid(){
?>

<article <?php wc_product_class( 'gh-product-card' ); ?>>

    <a href="<?php the_permalink(); ?>">
        <?php
        if ( has_post_thumbnail() ) {
            the_post_thumbnail(
                'woocommerce_thumbnail',
                array(
                    'class' => 'gh-product-image',
                    'alt'   => the_title_attribute( array( 'echo' => false ) ),
                )
            );
        } else {
            echo wc_placeholder_img(
                'woocommerce_thumbnail',
                array(
                    'class' => 'gh-product-image',
                )
            );
        }
        ?>
    </a>

    <div class="gh-product-body">

        <h2 class="gh-product-title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>

        <p class="gh-product-category">
            <?php echo wc_get_product_category_list( get_the_ID(), ', ' ); ?>
        </p>

       <?php
$product = wc_get_product( get_the_ID() );

if ( $product->get_average_rating() > 0 ) {
?>
    <div class="gh-rating">
        <?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
    </div>
<?php
} else {
    // No rating
}
?>

        <p class="gh-product-price">
            <?php echo wc_get_product( get_the_ID() )->get_price_html(); ?>
        </p>

      <?php green_haven_wooc_add_to_cart(); ?>
        
   <?php
/**
 * Display Wishlist button only if WPC Smart Wishlist is active.
 */
if ( function_exists( 'woosw_init' ) ) :
	echo do_shortcode( '[woosw id="' . get_the_ID() . '"]' );
endif;
/**
 * Display Wishlist button only if WPC Smart Compare is active.
 */
      if ( function_exists( 'woosc_init' ) ) :
	echo do_shortcode( '[woosc id="' . get_the_ID() . '"]' );
endif; ?>
    </div>

</article>

         


<?php


}


add_action( 'woocommerce_before_shop_loop_item_title','green_haven_product_grid' );


