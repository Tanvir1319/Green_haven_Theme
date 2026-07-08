<?php




function green_haven_single_product_breadcrumb(){
?>


	<?php
	woocommerce_breadcrumb(
		array(
			'delimiter'   => ' <span>&gt;</span> ',
			'wrap_before' => '',
			'wrap_after'  => '',
			'before'      => '',
			'after'       => '',
			'home'        => get_the_title( get_option( 'page_on_front' ) ),
		)
	);
	?>


         


<?php


}


add_action( 'woocommerce_before_main_content','green_haven_single_product_breadcrumb' );












function green_haven_single_product_grid(){
?>
<h2 class="gh-product-title">
           <?php woocommerce_template_single_title();?><h2><?php
	$terms = get_the_terms( get_the_ID(), 'product_cat' );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
	?>
		<a href="<?php echo esc_url( get_term_link( $terms[0] ) ); ?>" class="gh-product-category-link">
			<span>[<?php echo esc_html( $terms[0]->name ); ?>]</span>
		</a>
	<?php endif; ?></h2>
          </h2>

          <p class="gh-product-price"><?php woocommerce_template_single_price(); ?></p>

          <div class="gh-rating-row">
           <?php
$product = wc_get_product( get_the_ID() );
$rating  = $product ? (float) $product->get_average_rating() : 0;
?>

<div class="gh-stars" aria-label="<?php echo esc_attr( $rating ); ?> star rating">
	<?php
	for ( $i = 1; $i <= 5; $i++ ) {

		if ( $rating >= $i ) {
			echo '<i class="fa-solid fa-star"></i>';
		} elseif ( $rating >= ( $i - 0.5 ) ) {
			echo '<i class="fa-solid fa-star-half-stroke"></i>';
		} 
	}
	?>
</div>
<?php
$product = wc_get_product( get_the_ID() );
$review_count = $product ? $product->get_review_count() : 0;
?>

<?php if ( $review_count > 0 ) : ?>
	<span>
		<?php
		printf(
			_n( '%s customer review', '%s customer reviews', $review_count, 'woocommerce' ),
			number_format_i18n( $review_count )
		);
		?>
	</span>
<?php endif; ?>
           
          </div>

          <p class="gh-product-desc">
           <?php
$product = wc_get_product( get_the_ID() );
$excerpt = $product ? $product->get_short_description() : '';
?>

<?php if ( ! empty( $excerpt ) ) : ?>
	<p class="gh-product-desc">
		<?php echo wp_kses_post( $excerpt ); ?>
	</p>
<?php endif; ?>
          </p>

          <form class="gh-cart-form">
            <label class="gh-qty-label">Quantity</label>

            <div class="gh-qty-box">
              <button type="button" class="gh-qty-minus">−</button>
              <input type="number" value="1" min="1" aria-label="Quantity">
              <button type="button" class="gh-qty-plus">+</button>
            </div>

            <button type="submit" class="gh-add-cart-btn">
              Add to Cart <i class="fa-solid fa-cart-shopping"></i>
            </button>
          </form>

          <div class="gh-product-meta">
            <p><strong>SKU:</strong> 3615</p>
            <p><strong>Category:</strong> <a href="#">Plants</a></p>
            <p><strong>Tags:</strong> <a href="#">Purple</a>, <a href="#">Flowering</a></p>
          </div>

         


<?php


}


add_action( 'woocommerce_single_product_summary','green_haven_single_product_grid' );





function green_haven_single_product_you_may_like(){
?>

  <section class="gh-related-section">
        <h2 class="gh-related-title"> May Also Like</h2>

        <div class="gh-related-grid">

          <article class="gh-related-card">
            <img src="assets/images/related-1.jpg" alt="Organic garden soil mix">
            <div>
              <h3>Organic Garden Soil Mix</h3>
              <p>$19.99</p>
              <a href="#">View Product</a>
            </div>
          </article>

          <article class="gh-related-card">
            <img src="assets/images/related-2.jpg" alt="Garden tool premium pruning shears">
            <div>
              <h3>Garden Tool Premium Pruning Shears</h3>
              <p>$34.99</p>
              <a href="#">View Product</a>
            </div>
          </article>

          <article class="gh-related-card">
            <img src="assets/images/related-2.jpg" alt="Garden tool premium pruning shears">
            <div>
              <h3>Garden Tool Premium Pruning Shears</h3>
              <p>$34.99</p>
              <a href="#">View Product</a>
            </div>
          </article>

          <article class="gh-related-card">
            <img src="assets/images/related-2.jpg" alt="Garden tool premium pruning shears">
            <div>
              <h3>Garden Tool Premium Pruning Shears</h3>
              <p>$34.99</p>
              <a href="#">View Product</a>
            </div>
          </article>

        </div>
      </section>

         


<?php


}


add_action( 'woocommerce_after_single_product_summary','green_haven_single_product_you_may_like' );