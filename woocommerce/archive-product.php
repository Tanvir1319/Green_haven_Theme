<?php
defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
?>

<section class="gh-shop-section">
	<div class="gh-container">

		<h1 class="gh-shop-title"><?php woocommerce_page_title(); ?></h1>

		<?php do_action( 'woocommerce_before_main_content' ); ?>

		<div class="gh-shop-layout">

			<aside class="gh-shop-sidebar">
				<?php
				if ( is_active_sidebar( 'shop-sidebar' ) ) {
					dynamic_sidebar( 'shop-sidebar' );
				}
				?>
			</aside>

			<div class="gh-shop-products">

				<?php if ( woocommerce_product_loop() ) : ?>

					<?php do_action( 'woocommerce_before_shop_loop' ); ?>

					<?php woocommerce_product_loop_start(); ?>

					<?php
					while ( have_posts() ) {
						the_post();
						do_action( 'woocommerce_shop_loop' );
						wc_get_template_part( 'content', 'product' );
					}
					?>

					<?php woocommerce_product_loop_end(); ?>

					<?php do_action( 'woocommerce_after_shop_loop' ); ?>

				<?php else : ?>

					<?php do_action( 'woocommerce_no_products_found' ); ?>

				<?php endif; ?>

			</div>

		</div>

		<?php do_action( 'woocommerce_after_main_content' ); ?>

	</div>
</section>

<?php
get_footer( 'shop' );