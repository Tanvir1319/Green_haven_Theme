<?php
/**
 * The template for displaying standard WordPress pages.
 *
 * WooCommerce Cart and Checkout pages, and plugin pages such as Wishlist,
 * are normal WordPress pages. Their blocks/shortcodes must be rendered with
 * the_content(). Without this template WordPress falls back to index.php.
 *
 * @package Green_Haven_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main gh-standard-page">
	<section class="gh-standard-page-section">
		<div class="gh-container">
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'gh-standard-page-entry' ); ?>>
					<?php
					// WooCommerce's default Checkout block template does not print a page title.
					$is_checkout_page = function_exists( 'is_checkout' ) && is_checkout();
					?>

					<?php if ( ! $is_checkout_page ) : ?>
						<header class="gh-standard-page-header">
							<h1 class="gh-standard-page-title"><?php the_title(); ?></h1>
						</header>
					<?php endif; ?>

					<div class="entry-content gh-page-content">
						<?php
						the_content();

						wp_link_pages(
							array(
								'before' => '<nav class="page-links">' . esc_html__( 'Pages:', 'green-haven-theme' ),
								'after'  => '</nav>',
							)
						);
						?>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
	</section>
</main>

<?php
get_footer();