<?php
/**
 * About Us Section Template
 * 
 * Displays the about us section with customizable content from Kirki Customizer
 * 
 * @package Green_Haven_Theme
 */

// Get customizer values
$about_image       = get_theme_mod( 'green_haven_about_us_image', '' );
$about_title       = get_theme_mod( 'green_haven_about_us_title', '' );
$about_subtitle    = get_theme_mod( 'green_haven_about_us_subtitle', '');
$about_description = get_theme_mod( 'green_haven_about_us_description', '' );
?>

<section class="about-section" id="about">
    <div class="container-fluid main-container">
        <div class="row align-items-center">
            
            <!-- About Us Image Column -->
            <div class="col-lg-6 about-image-col">
                <?php if ( ! empty( $about_image ) ) : ?>
                    <img src="<?php echo esc_url( $about_image ); ?>" alt="" class="about-image">
                <?php else : ?>
                   
                <?php endif; ?>
            </div>
            
            <!-- About Us Content Column -->
            <div class="col-lg-6 about-content-col">
                
                <!-- Section Label (Title) -->
                <?php if ( ! empty( $about_title ) ) : ?>
                    <div class="section-label"><?php echo esc_html( $about_title ); ?></div>
                <?php endif; ?>
                
                <!-- Section Heading (Subtitle) -->
                <?php if ( ! empty( $about_subtitle ) ) : ?>
                    <h2 class="section-heading"><?php echo esc_html( $about_subtitle ); ?></h2>
                <?php endif; ?>
                
                <!-- Section Description -->
                <?php if ( ! empty( $about_description ) ) : ?>
                    <div class="section-text">
                        <?php echo wp_kses_post( wpautop( $about_description ) ); ?>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</section>