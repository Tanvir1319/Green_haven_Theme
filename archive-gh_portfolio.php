<?php
/*
Template Name: Portfolio Page Template
*/

get_header();

// =========================================================
// Dynamic headline from admin settings
// =========================================================
$portfolio_headline = get_option( 'gh_portfolio_headline', 'OUR PORTFOLIO OF WORK' );
?>

<!-- PAGE TITLE SECTION -->
<section class="page-title-section">
    <div class="container-fluid main-container">
        <h1 class="page-title"><?php echo esc_html( $portfolio_headline ); ?></h1>
    </div>
</section>

<!-- FILTER BUTTONS SECTION — dynamic from gh_portfolio_cat taxonomy -->
<section class="filter-section">
    <div class="container-fluid main-container">
        <div class="filter-buttons">

            <button class="filter-btn active" data-filter="all">
                <?php esc_html_e( 'All', 'green-haven-theme' ); ?>
            </button>

            <?php
            $portfolio_terms = get_terms(
                array(
                    'taxonomy'   => 'gh_portfolio_cat',
                    'hide_empty' => true,
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                )
            );

            if ( ! empty( $portfolio_terms ) && ! is_wp_error( $portfolio_terms ) ) {
                foreach ( $portfolio_terms as $portfolio_term ) {
                    ?>
                    <button class="filter-btn" data-filter=".<?php echo esc_attr( $portfolio_term->slug ); ?>">
                        <?php echo esc_html( $portfolio_term->name ); ?>
                    </button>
                    <?php
                }
            }
            ?>

        </div>
    </div>
</section>

<!-- PORTFOLIO GRID SECTION — dynamic from gh_portfolio CPT -->
<section class="portfolio-section">
    <div class="container-fluid main-container">
        <div class="portfolio-grid">

            <?php
            $portfolio_query = new WP_Query(
                array(
                    'post_type'      => 'gh_portfolio',
                    'posts_per_page' => -1,
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                )
            );

            if ( $portfolio_query->have_posts() ) :
                while ( $portfolio_query->have_posts() ) :
                    $portfolio_query->the_post();

                    $post_id   = get_the_ID();
                    $title     = get_the_title();
                    $excerpt   = get_the_excerpt();
                    $image_url = get_the_post_thumbnail_url( $post_id, 'large' );

                    // Taxonomy classes for MixItUp filter.
                    $item_terms   = get_the_terms( $post_id, 'gh_portfolio_cat' );
                    $term_classes = '';

                    if ( ! empty( $item_terms ) && ! is_wp_error( $item_terms ) ) {
                        foreach ( $item_terms as $item_term ) {
                            $term_classes .= ' ' . sanitize_html_class( $item_term->slug );
                        }
                    }

                    // Fallback if no featured image.
                    $bg_image = $image_url ? $image_url : '';

                    // Lightbox href: use full image or permalink as fallback.
                    $lightbox_href = $image_url ? $image_url : get_permalink();
                    ?>

                    <div class="portfolio-card mix<?php echo esc_attr( $term_classes ); ?>">
                        <a href="<?php echo esc_url( $lightbox_href ); ?>"
                           class="glightbox"
                           data-gallery="portfolio"
                           data-glightbox="title: <?php echo esc_attr( $title ); ?>; description: <?php echo esc_attr( $excerpt ); ?>">

                            <div class="portfolio-image"
                                 style="background-image: url('<?php echo esc_url( $bg_image ); ?>');">
                            </div>

                            <div class="portfolio-content">
                                <h3 class="portfolio-title"><?php echo esc_html( $title ); ?></h3>
                            </div>

                        </a>
                    </div>

                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <p class="no-portfolio">
                    <?php esc_html_e( 'No portfolio items found.', 'green-haven-theme' ); ?>
                </p>
                <?php
            endif;
            ?>

        </div>
    </div>
</section>

<!-- CTA SECTION -->
<?php require_once get_template_directory() . '/inc/common/cta-section.php';  ?>


<?php get_footer(); ?>