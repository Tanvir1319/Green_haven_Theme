<?php
/**
 * The template for displaying the footer.
 *
 * @package Green_Haven_Theme
 */

$options = get_option( 'green_haven_footer_options', array() );

if ( ! is_array( $options ) ) {
	$options = array();
}

$footer_logo                 = isset( $options['footer_logo'] ) ? $options['footer_logo'] : '';
$footer_description          = isset( $options['footer_description'] ) ? $options['footer_description'] : '';
$footer_menu_text            = isset( $options['footer_menu_text'] ) ? $options['footer_menu_text'] : '';
$footer_menu_id              = isset( $options['footer_menu_id'] ) ? absint( $options['footer_menu_id'] ) : 0;
$footer_follow_text          = isset( $options['footer_follow_text'] ) ? $options['footer_follow_text'] : '';
$footer_follow_us_type       = isset( $options['footer_follow_us_type'] ) && is_array( $options['footer_follow_us_type'] ) ? $options['footer_follow_us_type'] : array();
$footer_newsletter_text      = isset( $options['footer_newsletter_text'] ) ? $options['footer_newsletter_text'] : '';
$footer_newsletter_shortcode = isset( $options['footer_newsletter_shortcode'] ) ? $options['footer_newsletter_shortcode'] : '';

$social_icon_classes = array(
	'facebook'  => 'fab fa-facebook-f',
	'instagram' => 'fab fa-instagram',
	'youtube'   => 'fab fa-youtube',
	'linkedin'  => 'fab fa-linkedin-in',
);
?>

<!-- FOOTER -->
<footer class="footer">
	<div class="container-fluid main-container">
		<div class="row">
			<div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
				<div class="footer-logo">
					<div class="logo-container">

						<?php if ( ! empty( $footer_logo ) ) : ?>
							<img
								src="<?php echo esc_url( $footer_logo ); ?>"
								alt="<?php echo esc_attr__( 'Footer Logo', 'green-haven' ); ?>"
								class="footer-logo-image"
							>
						<?php else : ?>
							
						<?php endif; ?>

					</div>
				</div>

				<?php if ( ! empty( $footer_description ) ) : ?>
					<p class="footer-description">
						<?php echo esc_html( $footer_description ); ?>
					</p>
				<?php endif; ?>
			</div>

			<div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
				<?php if ( ! empty( $footer_menu_text ) ) : ?>
					<h4 class="footer-heading">
						<?php echo esc_html( $footer_menu_text ); ?>
					</h4>
				<?php endif; ?>

				<?php
				if ( ! empty( $footer_menu_id ) ) {
					wp_nav_menu(
						array(
							'menu'        => $footer_menu_id,
							'container'   => false,
							'menu_class'  => 'footer-links',
							'fallback_cb' => false,
							'depth'       => 1,
						)
					);
				}
				?>
			</div>

			<div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
				<?php if ( ! empty( $footer_follow_text ) ) : ?>
					<h4 class="footer-heading">
						<?php echo esc_html( $footer_follow_text ); ?>
					</h4>
				<?php endif; ?>

				<?php if ( ! empty( $footer_follow_us_type ) ) : ?>
					<div class="social-links">
						<?php
						foreach ( $footer_follow_us_type as $social_item ) :
							$social_url  = isset( $social_item['text'] ) ? $social_item['text'] : '';
							$social_icon = isset( $social_item['icon'] ) ? $social_item['icon'] : '';

							if ( empty( $social_url ) || empty( $social_icon ) || ! isset( $social_icon_classes[ $social_icon ] ) ) {
								continue;
							}
							?>
							<a
								href="<?php echo esc_url( $social_url ); ?>"
								class="social-icon"
								target="_blank"
								rel="noopener noreferrer"
							>
								<i class="<?php echo esc_attr( $social_icon_classes[ $social_icon ] ); ?>" aria-hidden="true"></i>
								<span class="screen-reader-text">
									<?php echo esc_html( ucfirst( $social_icon ) ); ?>
								</span>
							</a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="col-lg-3 col-md-6">
				<?php if ( ! empty( $footer_newsletter_text ) ) : ?>
					<h4 class="footer-heading">
						<?php echo esc_html( $footer_newsletter_text ); ?>
					</h4>
				<?php endif; ?>

				<?php if ( ! empty( $footer_newsletter_shortcode ) ) : ?>
					<div class="newsletter-form">
						

						<?php echo do_shortcode( $footer_newsletter_shortcode ); ?>
					</div>
				<?php else : ?>
					
				<?php endif; ?>
			</div>
		</div>
           <?php
$footer_copyright_text = isset( $options['footer_copyright_text'] ) ? $options['footer_copyright_text'] : '';
?>         
		<div class="footer-bottom">
			<?php if ( ! empty( $footer_copyright_text ) ) : ?>
		<p><?php echo esc_html( $footer_copyright_text ); ?></p>
	<?php else : ?>
		
	<?php endif; ?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>