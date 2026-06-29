<?php
/**
 * Why Choose Us Section Template
 * 
 * Displays the why choose us section with customizable content from Kirki Customizer
 * Uses repeater field to allow up to 3 customizable reason items
 * 
 * @package Green_Haven_Theme
 */

// Get customizer values
$why_choose_headline = get_theme_mod( 'green_haven_why_choose_us_headline', esc_html__( 'Why Choose Us', 'green-haven-theme' ) );
$why_choose_items    = get_theme_mod( 'green_haven_why_choose_us_repeater', [] );
?>

<section class="why-choose-section">
    <div class="container-fluid main-container">
        
        <!-- Section Headline -->
        <div class="text-center mb-4">
            <?php if ( ! empty( $why_choose_headline ) ) : ?>
                <h2 class="section-heading"><?php echo esc_html( $why_choose_headline ); ?></h2>
            <?php endif; ?>
        </div>
        
        <!-- Why Choose Card Container -->
        <div class="why-choose-card">
            <div class="row">
                
                <?php if ( ! empty( $why_choose_items ) && is_array( $why_choose_items ) ) : ?>
                    
                    <?php foreach ( $why_choose_items as $item ) : ?>
                        
                        <?php
                        // Get individual item values
                        $icon        = isset( $item['reason_icon'] ) ? $item['reason_icon'] : 'fas fa-leaf';
                        $title       = isset( $item['reason_title'] ) ? $item['reason_title'] : '';
                        $description = isset( $item['reason_description'] ) ? $item['reason_description'] : '';
                        ?>
                        
                        <!-- Single Feature Item -->
                        <div class="col-md-4 mb-4 mb-md-0">
                            <div class="feature-item">
                                
                                <!-- Feature Icon -->
                                <div class="feature-icon">
                                    <i class="<?php echo esc_attr( $icon ); ?>"></i>
                                </div>
                                
                                <!-- Feature Title -->
                                <?php if ( ! empty( $title ) ) : ?>
                                    <h3 class="feature-title"><?php echo esc_html( $title ); ?></h3>
                                <?php endif; ?>
                                
                                <!-- Feature Description -->
                                <?php if ( ! empty( $description ) ) : ?>
                                    <p class="feature-description"><?php echo esc_html( $description ); ?></p>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                        
                    <?php endforeach; ?>
                    
                <?php else : ?>
                    
                    <!-- Fallback: Default Features (if no items added in customizer) -->
                    <div class="col-md-4 mb-4 mb-md-0">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <h3 class="feature-title"><?php echo esc_html__( 'ECO-FRIENDLY', 'green-haven-theme' ); ?></h3>
                            <p class="feature-description"><?php echo esc_html__( 'Use sustainable practices and sustainable pesticides', 'green-haven-theme' ); ?></p>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-4 mb-md-0">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h3 class="feature-title"><?php echo esc_html__( 'EXPERIENCED TEAM', 'green-haven-theme' ); ?></h3>
                            <p class="feature-description"><?php echo esc_html__( 'Dedicated professionals using latest technology capabilities', 'green-haven-theme' ); ?></p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                            <h3 class="feature-title"><?php echo esc_html__( 'EXPERIENCE TRUST', 'green-haven-theme' ); ?></h3>
                            <p class="feature-description"><?php echo esc_html__( 'Certified top builders and quality packages', 'green-haven-theme' ); ?></p>
                        </div>
                    </div>
                    
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</section>