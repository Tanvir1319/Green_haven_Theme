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
  global $product;
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
<div class="gh-cart-form">
	<?php woocommerce_template_single_add_to_cart(); ?>
</div>

          <div class="gh-product-meta">
             <strong><?php if ( ! $product ) {
	$product = wc_get_product( get_the_ID() );
}

if ( $product ) :
	$is_in_stock = $product->is_in_stock();
	$stock_text  = $is_in_stock ? __( 'In Stock', 'green-haven' ) : __( 'Out of Stock', 'green-haven' );
	$stock_color = $is_in_stock ? '#16a34a' : '#dc2626';
	?>
	
	<p class="gh-stock-status" style="color: <?php echo esc_attr( $stock_color ); ?>;">
		<strong><?php echo esc_html( $stock_text ); ?></strong>
	</p>

<?php endif; ?> </strong> 
        <?php   if ( ! $product ) {
	$product = wc_get_product( get_the_ID() );
}

if ( $product && $product->get_sku() ) :
	?>
	<p>
		<strong>SKU:</strong>
		<?php echo esc_html( $product->get_sku() ); ?>
	</p>
<?php endif; ?>
         <?php
global $product;

if ( ! $product ) {
	$product = wc_get_product( get_the_ID() );
}

if ( $product ) {
	$category_list = wc_get_product_category_list(
		$product->get_id(),
		', ',
		'',
		''
	);

	if ( ! empty( $category_list ) ) :
		?>
		<p>
			<strong>Category:</strong>
			<?php echo wp_kses_post( $category_list ); ?>
		</p>
		<?php
	endif;
}
?>
           <?php
           if ( ! $product ) {
	$product = wc_get_product( get_the_ID() );
}

if ( $product ) {
	$tag_list = wc_get_product_tag_list(
		$product->get_id(),
		', ',
		'',
		''
	);

	if ( ! empty( $tag_list ) ) :
		?>
		<p>
			<strong>Tags:</strong>
			<?php echo wp_kses_post( $tag_list ); ?>
		</p>
		<?php
	endif;
} ?>
          </div>

         


<?php


}


add_action( 'woocommerce_single_product_summary','green_haven_single_product_grid' );





function green_haven_single_product_you_may_like() {
	global $product;

	if ( ! $product ) {
		$product = wc_get_product( get_the_ID() );
	}

	if ( ! $product ) {
		return;
	}

	$product_ids = array();

	// 1. First try upsell products selected by admin.
	$upsell_ids = $product->get_upsell_ids();

	if ( ! empty( $upsell_ids ) ) {
		$product_ids = array_slice( $upsell_ids, 0, 3 );
	} else {
		// 2. If no upsells, show related products.
		$product_ids = wc_get_related_products( $product->get_id(), 3 );
	}

	// If no upsell and no related products, hide full section.
	if ( empty( $product_ids ) ) {
		return;
	}
	?>

	<section class="gh-related-section">
		<h2 class="gh-related-title">
			<?php esc_html_e( 'May Also Like', 'green-haven' ); ?>
		</h2>

		<div class="gh-related-grid">

			<?php
			foreach ( $product_ids as $product_id ) :

				$related_product = wc_get_product( $product_id );

				if ( ! $related_product || ! $related_product->is_visible() ) {
					continue;
				}

				$product_link  = get_permalink( $product_id );
				$product_name  = $related_product->get_name();
				$product_price = $related_product->get_price_html();
				?>

				<article class="gh-related-card">

					<a href="<?php echo esc_url( $product_link ); ?>" class="gh-related-card-image">
						<?php
						echo $related_product->get_image(
							'woocommerce_thumbnail',
							array(
								'alt' => esc_attr( $product_name ),
							)
						);
						?>
					</a>

					<div>
						<h3>
							<a href="<?php echo esc_url( $product_link ); ?>">
								<?php echo esc_html( $product_name ); ?>
							</a>
						</h3>

						<?php if ( ! empty( $product_price ) ) : ?>
							<p><?php echo wp_kses_post( $product_price ); ?></p>
						<?php endif; ?>

						<a href="<?php echo esc_url( $product_link ); ?>">
							<?php esc_html_e( 'View Product', 'green-haven' ); ?>
						</a>
					</div>

				</article>

			<?php endforeach; ?>

		</div>
	</section>

	<?php
}



add_action( 'woocommerce_after_single_product_summary','green_haven_single_product_you_may_like' );



function green_haven_single_product_tabs_after_related() {
	?>
	<div class="gh-tabs-wrap">
		<?php woocommerce_output_product_data_tabs(); ?>
	</div>
	<?php
}

add_action( 'woocommerce_after_single_product_summary', 'green_haven_single_product_tabs_after_related', 30 );