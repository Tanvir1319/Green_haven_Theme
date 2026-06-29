<?php
/**
 * Template part for Contact Hero section.
 *
 * @package Green_Haven_Theme
 */

defined( 'ABSPATH' ) || exit;

/*
 * Get heading.
 * Uses new setting first, then falls back to old setting for backward compatibility.
 */
$contact_heading = get_theme_mod(
	'green_haven_theme_contact_heading',
	get_theme_mod(
		'contact_text_field',
		__( 'Get In Touch', 'green-haven-theme' )
	)
);

/*
 * Get description.
 * Uses new setting first, then falls back to old setting for backward compatibility.
 */
$contact_description = get_theme_mod(
	'green_haven_theme_contact_description',
	get_theme_mod(
		'contact_textarea_field',
		__( 'The power of green is grounded in natural beauty. Connect with us to start transforming your outdoor today. We look forward to hearing from you and becoming part of your oasis.', 'green-haven-theme' )
	)
);

/*
 * Get background color.
 * If you are still using the old color field, this will continue to work.
 * If no valid color is found, a safe default is used.
 */
$contact_bg_color = get_theme_mod(
	'green_haven_theme_contact_background_color',
	get_theme_mod( 'contact_color_field', '#17351f' )
);

$contact_bg_color = sanitize_hex_color( $contact_bg_color );

if ( empty( $contact_bg_color ) ) {
	$contact_bg_color = '#17351f';
}

/*
 * Get background image.
 * Supports both:
 * - old URL-based value
 * - new attachment ID-based value
 */
$contact_image_value = get_theme_mod(
	'green_haven_theme_contact_background_image',
	get_theme_mod( 'contact_image_field', '' )
);

$contact_bg_image = '';

if ( is_numeric( $contact_image_value ) ) {
	$contact_image_id = absint( $contact_image_value );

	if ( $contact_image_id && wp_attachment_is_image( $contact_image_id ) ) {
		$contact_bg_image = wp_get_attachment_image_url( $contact_image_id, 'full' );
	}
} elseif ( ! empty( $contact_image_value ) && is_string( $contact_image_value ) ) {
	$contact_bg_image = esc_url_raw( $contact_image_value );
}

/*
 * Build CSS classes.
 */
$contact_hero_classes = 'green-haven-contact-hero';

if ( ! empty( $contact_bg_image ) ) {
	$contact_hero_classes .= ' green-haven-contact-hero--has-image';
}

/*
 * Build inline style.
 * Background image is used when available.
 * Background color always exists as fallback.
 */
$contact_hero_style = 'background-color:' . $contact_bg_color . ';';

if ( ! empty( $contact_bg_image ) ) {
	$contact_hero_style .= 'background-image:url("' . esc_url_raw( $contact_bg_image ) . '");';
}
?>

<section class="<?php echo esc_attr( $contact_hero_classes ); ?>" style="<?php echo esc_attr( $contact_hero_style ); ?>">
	<div class="green-haven-contact-hero__overlay" aria-hidden="true"></div>

	<div class="container-fluid main-container">
		<div class="green-haven-contact-hero__content">

			<?php if ( ! empty( $contact_heading ) ) : ?>
				<h1 class="green-haven-contact-hero__title">
					<?php echo esc_html( $contact_heading ); ?>
				</h1>
			<?php endif; ?>

			<?php if ( ! empty( $contact_description ) ) : ?>
				<p class="green-haven-contact-hero__subtitle">
					<?php echo esc_html( $contact_description ); ?>
				</p>
			<?php endif; ?>

		</div>
	</div>
</section>