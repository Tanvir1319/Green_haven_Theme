<?php
/**
 * Green Haven Hero Section
 * 
 * Displays the hero slider with dynamic content from Kirki Customizer
 *
 * @package Green_Haven_Theme
 * @since 1.0.0
 */

// Get the slider repeater data from Customizer
$slider_items = get_theme_mod( 'green_haven_slider_repeater', [] );

// Only display if we have slider items
if ( ! empty( $slider_items ) ) :
    
    // Group items into slides of 3 (to match your static structure)
    $slides = array_chunk( $slider_items, 3 );
    
    ?>
    <section class="hero-section">
        <div class="container-fluid main-container">
            <div class="owl-carousel owl-theme hero-carousel">
                
                <?php foreach ( $slides as $slide_items ) : ?>
                    <div class="hero-slide">
                        <div class="hero-cards-container">
                            
                            <?php foreach ( $slide_items as $item ) : 
                                
                                // Extract data with fallbacks
                                $image_url = ! empty( $item['slide_image'] ) ? $item['slide_image'] : '';
                                $title = ! empty( $item['slide_title'] ) ? $item['slide_title'] : '';
                                $description = ! empty( $item['slide_description'] ) ? $item['slide_description'] : '';
                                $button_text = ! empty( $item['slide_button_text'] ) ? $item['slide_button_text'] : '';
                                $button_url = ! empty( $item['slide_button_url'] ) ? $item['slide_button_url'] : '';
                                $button_color = ! empty( $item['slide_overlay_color'] ) ? $item['slide_overlay_color'] : '';
                            ?>
                                
                                <div class="hero-card"<?php if ( ! empty( $image_url ) ) : ?> style="background-image: url('<?php echo esc_url( $image_url ); ?>');"<?php endif; ?>>
                                    <div class="hero-card-overlay">
                                        
                                        <?php if ( ! empty( $title ) ) : ?>
                                            <h2 class="hero-card-title"><?php echo esc_html( $title ); ?></h2>
                                        <?php endif; ?>
                                        
                                        <?php if ( ! empty( $description ) ) : ?>
                                            <p class="hero-card-text"><?php echo esc_html( $description ); ?></p>
                                        <?php endif; ?>
                                        
                                        <?php 
                                        $button_style = ! empty( $button_color ) ? ' style="background-color: ' . esc_attr( $button_color ) . ';"' : '';
                                        ?>
                                        <a href="<?php echo esc_url( $button_url ); ?>" class="btn-primary-custom"<?php echo $button_style; ?>>
                                            <?php echo esc_html( $button_text ); ?>
                                        </a>
                                        
                                    </div>
                                </div>
                            
                            <?php endforeach; ?>
                            
                        </div>
                    </div>
                <?php endforeach; ?>
                
            </div>
        </div>
    </section>
    
    <?php
else :
    // Fallback: Show a default message if no slider items are configured
    ?>
    <section class="hero-section">
        <div class="container-fluid main-container">
            <div class="owl-carousel owl-theme hero-carousel">
                <div class="hero-slide">
                    <div class="hero-cards-container">
                        <div class="hero-card">
                            <div class="hero-card-overlay">
                                <h2 class="hero-card-title"><?php esc_html_e( 'Welcome to Green Haven', 'green-haven-theme' ); ?></h2>
                                <p class="hero-card-text"><?php esc_html_e( 'Configure your hero slider in the Customizer.', 'green-haven-theme' ); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
endif;
?>