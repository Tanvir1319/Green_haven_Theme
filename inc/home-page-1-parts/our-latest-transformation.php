<?php
/**
 * OUR LATEST TRANSFORMATIONS Section
 * Dynamically rendered using Kirki Customizer settings.
 * Controls: headline text, font family, and repeater items (image, title, categories).
 */

// Get the section headline from customizer (fallback to default)
$headline = get_theme_mod( 'green_haven_latest_transformations_headline', 'OUR LATEST TRANSFORMATIONS' );


// Get all transformation items from the repeater field
$transformation_items = get_theme_mod( 'green_haven_latest_transformations_repeater', [] );


/**
 * Category label map
 * Maps the stored select value (slug) to a human-readable display label.
 * Used to convert 'eco_friendly' → 'ECO-FRIENDLY' for the tag spans.
 */
$category_labels = [
    'residential'  => 'RESIDENTIAL',
    'commercial'   => 'COMMERCIAL',
    'eco_friendly' => 'ECO-FRIENDLY',
    'eco-friendly' => 'ECO-FRIENDLY', // handles both underscore and hyphen variants
];
?>

<!-- OUR LATEST TRANSFORMATIONS Section -->
<!-- Font family is applied inline via CSS custom property scoped to this section -->
<section
    class="projects-section"
    id="projects"
    
>
    <div class="container-fluid main-container">

        <!-- Section Headline: controlled by green_haven_latest_transformations_headline -->
        <div class="text-center mb-5">
            <h2 class="section-heading">
                <?php echo esc_html( $headline ); ?>
            </h2>
        </div>

        <!-- Project Cards Row -->
        <div class="row">

            <?php
            // Safety check: only render if repeater has items
            if ( ! empty( $transformation_items ) && is_array( $transformation_items ) ) :

                // Loop through each repeater item (max 3 enforced by Kirki 'limit' => 3)
                foreach ( $transformation_items as $item ) :

                    /**
                     * Item Image
                     * The repeater stores image as an array with 'url' key (Kirki image field behavior).
                     * We extract the URL safely with a fallback to empty string.
                     */
                    $image_data = isset( $item['item_image'] ) ? $item['item_image'] : '';

                    // Kirki image fields return an array like [ 'url' => '...', 'id' => ... ]
                    if ( is_array( $image_data ) ) {
                        $image_url = isset( $image_data['url'] ) ? $image_data['url'] : '';
                    } else {
                        // Sometimes it returns just the URL string directly
                        $image_url = $image_data;
                    }

                    // Item Title: controlled by 'item_title' text field in repeater
                    $item_title = isset( $item['item_title'] ) ? $item['item_title'] : '';

                    // Primary Category slug (e.g. 'residential', 'commercial', 'eco_friendly')
                    $primary_cat = isset( $item['primary_category'] ) ? $item['primary_category'] : '';

                    // Secondary Category slug
                    $secondary_cat = isset( $item['secondary_category'] ) ? $item['secondary_category'] : '';

                    // Convert slugs to display labels using the map above
                    $primary_label   = isset( $category_labels[ $primary_cat ] )   ? $category_labels[ $primary_cat ]   : strtoupper( $primary_cat );
                    $secondary_label = isset( $category_labels[ $secondary_cat ] ) ? $category_labels[ $secondary_cat ] : strtoupper( $secondary_cat );

                ?>

                <!-- Single Project Card -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="project-card">

                        <!-- Project Background Image: controlled by 'item_image' in repeater -->
                        <div
                            class="project-image"
                            <?php if ( ! empty( $image_url ) ) : ?>
                                style="background-image: url('<?php echo esc_url( $image_url ); ?>');"
                            <?php endif; ?>
                        ></div>

                        <div class="project-content">

                            <!-- Project Title: controlled by 'item_title' in repeater -->
                            <?php if ( ! empty( $item_title ) ) : ?>
                                <h3 class="project-title">
                                    <?php echo esc_html( $item_title ); ?>
                                </h3>
                            <?php endif; ?>

                            <!-- Primary Category Tag: controlled by 'primary_category' select in repeater -->
                            <?php if ( ! empty( $primary_cat ) ) : ?>
                                <span class="project-tag">
                                    <?php echo esc_html( $primary_label ); ?>
                                </span>
                            <?php endif; ?>

                            <!-- Secondary Category Tag: controlled by 'secondary_category' select in repeater -->
                            <!-- Only renders if a secondary category is actually selected (not empty '') -->
                            <?php if ( ! empty( $secondary_cat ) ) : ?>
                                <span class="project-tag">
                                    <?php echo esc_html( $secondary_label ); ?>
                                </span>
                            <?php endif; ?>

                        </div><!-- .project-content -->

                    </div><!-- .project-card -->
                </div><!-- .col -->

                <?php
                endforeach; // end foreach item

            else :
                
            endif; // end if items exist
            ?>

        </div><!-- .row -->

    </div><!-- .container-fluid -->
</section><!-- .projects-section -->