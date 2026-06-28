<?php
$options = get_option( 'green_haven_cta_options' );

$cta_enabled              = isset( $options['tick_mark_option'] ) ? absint( $options['tick_mark_option'] ) : 0;
$title_text               = isset( $options['title_text'] ) ? $options['title_text'] : '';
$button_text              = isset( $options['button_text'] ) ? $options['button_text'] : '';
$button_background_color  = isset( $options['button_background_color'] ) ? $options['button_background_color'] : '';
$title_background_color   = isset( $options['title_background_color'] ) ? $options['title_background_color'] : '';
$title_background_image   = isset( $options['title_background_image'] ) ? $options['title_background_image'] : '';
?>

<?php if ( 1 === $cta_enabled ) : ?>
	<section
		class="cta-section"
		style="<?php echo ! empty( $title_background_image ) ? 'background-image: url(' . esc_url( $title_background_image ) . ');' : ''; ?>"
	>
		<div
	class="cta-overlay"
	style="<?php echo ! empty( $title_background_color ) ? 'background-color: ' . esc_attr( $title_background_color ) . ';' : ''; ?>"
></div>

		<div class="container">
			<div class="cta-content">
				<?php if ( ! empty( $title_text ) ) : ?>
					<h2
						class="cta-title"
						
					>
						<?php echo esc_html( $title_text ); ?>
					</h2>
				<?php endif; ?>

				<?php if ( ! empty( $button_text ) ) : ?>
					<a
						href="#"
						class="btn-cta"
						style="<?php echo ! empty( $button_background_color ) ? 'background-color: ' . esc_attr( $button_background_color ) . ';' : ''; ?>"
					>
						<?php echo esc_html( $button_text ); ?>
						<i class="fas fa-chevron-right"></i>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php endif; ?>