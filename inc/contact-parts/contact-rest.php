<?php
/**
 * Contact Info Section (Frontend)
 */

// Get values
$heading      = get_theme_mod( 'contact_info_heading', 'Our Information' );
$baddress      = get_theme_mod( 'contact_info_busaddress', '' );
$address      = get_theme_mod( 'contact_info_address', '' );
$phone_label  = get_theme_mod( 'contact_info_phone_label', 'Phone Number:' );
$phone        = get_theme_mod( 'contact_info_phone', '' );
$email        = get_theme_mod( 'contact_info_email', '' );
$hours_label  = get_theme_mod( 'contact_info_hours_label', 'Business Hours:' );
$hours        = get_theme_mod( 'contact_info_hours', '' );
$map_iframe   = get_theme_mod( 'contact_info_map_iframe', '' );

// Sanitize
$heading     = $heading ? esc_html( $heading ) : '';
$baddress     = $baddress ? esc_html( $baddress ) : '';
$address     = $address ? esc_html( $address ) : '';
$phone_label = $phone_label ? esc_html( $phone_label ) : '';
$phone       = $phone ? esc_html( $phone ) : '';
$email       = $email ? sanitize_email( $email ) : '';
$hours_label = $hours_label ? esc_html( $hours_label ) : '';
$hours       = $hours ? wp_kses_post( $hours ) : '';

// Allow only safe iframe
$allowed_iframe = [
    'iframe' => [
        'src'             => [],
        'width'           => [],
        'height'          => [],
        'style'           => [],
        'allowfullscreen' => [],
        'loading'         => [],
    ],
];

$map_iframe = $map_iframe ? wp_kses( $map_iframe, $allowed_iframe ) : '';
?>

<div class="col-lg-6">
    <div class="company-info-container">

        <?php if ( $heading ) : ?>
            <h2 class="section-heading"><?php echo $heading; ?></h2>
        <?php endif; ?>

        <?php if ( $address ) : ?>
            <div class="info-block">
                <h3 class="info-label"><?php echo $baddress;  ?></h3>
                <p class="info-value"><?php echo $address; ?></p>
            </div>
        <?php endif; ?>

        <?php if ( $phone || $phone_label ) : ?>
            <div class="info-block">
                <?php if ( $phone_label ) : ?>
                    <h3 class="info-label"><?php echo $phone_label; ?></h3>
                <?php endif; ?>

                <?php if ( $phone ) : ?>
                    <p class="info-value">
                        <a href="tel:<?php echo esc_attr( preg_replace('/[^0-9+]/', '', $phone) ); ?>">
                            <?php echo $phone; ?>
                        </a>
                    </p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ( $email ) : ?>
            <div class="info-block">
                <p class="info-value">
                    <a href="mailto:<?php echo esc_attr( $email ); ?>">
                        <?php echo esc_html( $email ); ?>
                    </a>
                </p>
            </div>
        <?php endif; ?>

        <?php if ( $hours || $hours_label ) : ?>
            <div class="info-block">
                <?php if ( $hours_label ) : ?>
                    <h3 class="info-label"><?php echo $hours_label; ?></h3>
                <?php endif; ?>

                <?php if ( $hours ) : ?>
                    <div class="business-hours">
                        <?php echo $hours; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ( $map_iframe ) : ?>
            <div class="map-container">
                <?php echo $map_iframe; ?>
            </div>
        <?php endif; ?>

    </div>
</div>