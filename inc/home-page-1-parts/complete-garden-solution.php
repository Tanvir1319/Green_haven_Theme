<?php
/**
 * Complete Garden Solutions Section Template
 * 
 * Displays the garden solutions section with customizable content from Kirki Customizer
 * Uses repeater field to allow up to 4 customizable solution items
 * 
 * @package Green_Haven_Theme
 */

// Get customizer values
$solutions_headline = get_theme_mod( 'green_haven_garden_solutions_headline', esc_html__( 'Complete Garden Solutions', 'green-haven-theme' ) );
$solutions_items    = get_theme_mod( 'green_haven_garden_solutions_repeater', [] );
?>

<section class="services-section" id="services">
    <div class="container-fluid main-container">
        
        <!-- Section Headline -->
        <div class="text-center mb-5">
            <?php if ( ! empty( $solutions_headline ) ) : ?>
                <h2 class="section-heading"><?php echo esc_html( $solutions_headline ); ?></h2>
            <?php endif; ?>
        </div>
        
        <!-- Solutions Items Row -->
        <div class="row services-row">
            
            <?php if ( ! empty( $solutions_items ) && is_array( $solutions_items ) ) : ?>
                
                <?php foreach ( $solutions_items as $item ) : ?>
                    
                    <?php
                    // Get individual item values
                    $icon        = isset( $item['solution_icon'] ) ? $item['solution_icon'] : 'fas fa-leaf';
                    $title       = isset( $item['solution_title'] ) ? $item['solution_title'] : '';
                    $description = isset( $item['solution_description'] ) ? $item['solution_description'] : '';
                    ?>
                    
                    <!-- Single Solution Item -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="service-item">
                            
                            <!-- Solution Icon -->
                            <div class="service-icon">
                                <i class="<?php echo esc_attr( $icon ); ?>"></i>
                            </div>
                            
                            <!-- Solution Title -->
                            <?php if ( ! empty( $title ) ) : ?>
                                <h3 class="service-title"><?php echo esc_html( $title ); ?></h3>
                            <?php endif; ?>
                            
                            <!-- Solution Description -->
                            <?php if ( ! empty( $description ) ) : ?>
                                <p class="service-description"><?php echo esc_html( $description ); ?></p>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                    
                <?php endforeach; ?>
                
            <?php else : ?>
                
                <!-- Fallback: Default Solutions (if no items added in customizer) -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="fas fa-drafting-compass"></i>
                        </div>
                        <h3 class="service-title"><?php echo esc_html__( 'LANDSCAPE DESIGN', 'green-haven-theme' ); ?></h3>
                        <p class="service-description"><?php echo esc_html__( 'Custom and stunning plans', 'green-haven-theme' ); ?></p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="fas fa-seedling"></i>
                        </div>
                        <h3 class="service-title"><?php echo esc_html__( 'GARDEN MAINTENANCE', 'green-haven-theme' ); ?></h3>
                        <p class="service-description"><?php echo esc_html__( 'Weekly or monthly care packages', 'green-haven-theme' ); ?></p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <h3 class="service-title"><?php echo esc_html__( 'HARDSCAPING', 'green-haven-theme' ); ?></h3>
                        <p class="service-description"><?php echo esc_html__( 'Patios and retaining walls', 'green-haven-theme' ); ?></p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="fas fa-tint"></i>
                        </div>
                        <h3 class="service-title"><?php echo esc_html__( 'IRRIGATION SYSTEMS', 'green-haven-theme' ); ?></h3>
                        <p class="service-description"><?php echo esc_html__( 'Efficient water solutions', 'green-haven-theme' ); ?></p>
                    </div>
                </div>
                
            <?php endif; ?>
            
        </div>
    </div>
</section>