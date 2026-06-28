<?php
// Get all Kirki customizer values for the service section header
$service_heading     = get_theme_mod( 'service_text_field', 'OUR SERVICES' );
$service_description = get_theme_mod( 'service_textarea_field', 'The power of green is grounded in natural beauty. Connect with us to start transforming your outdoor today. We look forward to hearing from you and becoming part of your oasis.' );
$service_bg_color    = get_theme_mod( 'service_color_field', '#000000' );
$service_bg_image    = get_theme_mod( 'service_image_field', '' );

// Build inline style string for the hero section
// Priority: if user uploads an image, show it as background; otherwise fall back to the color
$inline_style = '';

if ( ! empty( $service_bg_image ) ) {
    // User has uploaded a background image — use it with an overlay-friendly setup
    $inline_style = 'background-image: url(' . esc_url( $service_bg_image ) . '); background-color: ' . esc_attr( $service_bg_color ) . ';';
} else {
    // No image uploaded — use the selected background color only
    $inline_style = 'background-color: ' . esc_attr( $service_bg_color ) . ';';
}
?>

<!-- Hero / Service Section Header -->
<section 
    class="hero-section <?php echo ! empty( $service_bg_image ) ? 'has-bg-image' : 'has-bg-color'; ?>"
    style="<?php echo esc_attr( $inline_style ); ?>"
>
    <!-- Dark overlay — only visible when a background image is set -->
    <?php if ( ! empty( $service_bg_image ) ) : ?>
        <div class="hero-overlay"></div>
    <?php endif; ?>

    <div class="hero-content">

        <!-- Dynamic heading from Kirki Text Field (service_text_field) -->
        <?php if ( ! empty( $service_heading ) ) : ?>
            <h1 class="hero-title">
                <?php echo esc_html( $service_heading ); ?>
            </h1>
        <?php endif; ?>

        <!-- Dynamic description from Kirki Textarea Field (service_textarea_field) -->
        <?php if ( ! empty( $service_description ) ) : ?>
            <p class="hero-subtitle">
                <?php echo wp_kses_post( $service_description ); ?>
            </p>
        <?php endif; ?>

    </div>
</section>