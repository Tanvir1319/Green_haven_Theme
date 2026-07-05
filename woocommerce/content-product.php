<?php
/**
 * content-product.php
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
?>

<article <?php wc_product_class( 'gh-product-card', $product ); ?>>

    <a href="<?php the_permalink(); ?>">
        <?php
        if ( has_post_thumbnail() ) {
            the_post_thumbnail( 'woocommerce_thumbnail', array(
                'class' => 'gh-product-image',
                'alt'   => get_the_title(),
            ) );
        } else {
            echo wc_placeholder_img( 'woocommerce_thumbnail', array(
                'class' => 'gh-product-image',
            ) );
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
            <?php
            echo wc_get_product_category_list( $product->get_id(), ', ' );
            ?>
        </p>

        <div class="gh-rating">
            <?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
        </div>

        <p class="gh-product-price">
            <?php echo $product->get_price_html(); ?>
        </p>

        <?php
        echo apply_filters(
            'woocommerce_loop_add_to_cart_link',
            sprintf(
                '<a href="%s" data-quantity="1" class="gh-cart-btn %s" %s><i class="fa-solid fa-cart-shopping"></i> %s</a>',
                esc_url( $product->add_to_cart_url() ),
                esc_attr( implode( ' ', array_filter( array(
                    'button',
                    'product_type_' . $product->get_type(),
                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                    $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
                ) ) ) ),
                wc_implode_html_attributes( array(
                    'data-product_id'  => $product->get_id(),
                    'data-product_sku' => $product->get_sku(),
                    'aria-label'       => $product->add_to_cart_description(),
                    'rel'              => 'nofollow',
                ) ),
                esc_html( $product->add_to_cart_text() )
            ),
            $product
        );
        ?>

    </div>

</article>