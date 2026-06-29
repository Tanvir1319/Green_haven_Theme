<?php
/**
 * Service Section Middle - Frontend Output
 * Retrieves values from Kirki Customizer and displays them safely.
 */

// Get values from Customizer
$service_title       = get_theme_mod( 'service_middle_text_field', '' );
$service_description = get_theme_mod( 'service_middle_textarea_field', '' );
?>

<div class="section-header">
    
    <?php if ( ! empty( $service_title ) ) : ?>
        <!-- Output heading safely -->
        <h2 class="section-title">
            <?php echo esc_html( $service_title ); ?>
        </h2>
    <?php endif; ?>

    <?php if ( ! empty( $service_description ) ) : ?>
        <!-- Output textarea content safely (allow basic HTML if needed) -->
        <p class="section-description">
            <?php echo esc_html( $service_description ); ?>
        </p>
    <?php endif; ?>

</div>