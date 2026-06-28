<?php
/**
 * Helper: Get a usable image URL from a Kirki image field.
 *
 * Supports:
 * - URL string
 * - attachment ID
 * - array with url/URL/id
 */
if ( ! function_exists( 'green_haven_get_customizer_image_url' ) ) {
	function green_haven_get_customizer_image_url( $image ) {
		if ( empty( $image ) ) {
			return '';
		}

		// If the image is saved as an attachment ID.
		if ( is_numeric( $image ) ) {
			$image_url = wp_get_attachment_image_url( absint( $image ), 'full' );
			return $image_url ? $image_url : '';
		}

		// If the image is saved as an array.
		if ( is_array( $image ) ) {
			if ( ! empty( $image['id'] ) ) {
				$image_url = wp_get_attachment_image_url( absint( $image['id'] ), 'full' );
				if ( $image_url ) {
					return $image_url;
				}
			}

			if ( ! empty( $image['url'] ) ) {
				return esc_url_raw( $image['url'] );
			}

			if ( ! empty( $image['URL'] ) ) {
				return esc_url_raw( $image['URL'] );
			}

			return '';
		}

		// Default: saved as URL string.
		return is_string( $image ) ? esc_url_raw( $image ) : '';
	}
}

/**
 * Helper: Return ribbon data based on badge value.
 *
 * Keep these class names aligned with your existing CSS.
 */
if ( ! function_exists( 'green_haven_get_service_badge_data' ) ) {
	function green_haven_get_service_badge_data( $badge ) {
		$badge = sanitize_key( $badge );

		$badges = array(
			'new' => array(
				'class' => 'ribbon-new',
				'icon'  => 'fas fa-star',
				'label' => __( 'New', 'green-haven-theme' ),
			),
			'hottest' => array(
				'class' => 'ribbon-rated',
				'icon'  => 'fas fa-crown',
				'label' => __( 'Hottest', 'green-haven-theme' ),
			),
			'popular' => array(
				'class' => 'ribbon-popular',
				'icon'  => 'fas fa-fire',
				'label' => __( 'Popular', 'green-haven-theme' ),
			),
		);

		return isset( $badges[ $badge ] ) ? $badges[ $badge ] : false;
	}
}

$raw_services = get_theme_mod( 'green_haven_service_repeater', array() );
$services     = array();

if ( ! empty( $raw_services ) && is_array( $raw_services ) ) {
	foreach ( $raw_services as $index => $item ) {
		if ( ! is_array( $item ) ) {
			continue;
		}

		// Card fields.
		$card_image      = green_haven_get_customizer_image_url( isset( $item['image_one'] ) ? $item['image_one'] : '' );
		$title           = isset( $item['title'] ) ? sanitize_text_field( $item['title'] ) : '';
		$description     = isset( $item['description'] ) ? sanitize_textarea_field( $item['description'] ) : '';
		$badge           = green_haven_get_service_badge_data( isset( $item['badge'] ) ? $item['badge'] : '' );
		$button_text     = isset( $item['button_text'] ) ? sanitize_text_field( $item['button_text'] ) : '';
		$button_bg_color = isset( $item['button_bg_color'] ) ? sanitize_hex_color( $item['button_bg_color'] ) : '';

		// Modal fields.
		$modal_title       = isset( $item['extra_text'] ) ? sanitize_text_field( $item['extra_text'] ) : '';
		$modal_description = isset( $item['extra_description'] ) ? sanitize_textarea_field( $item['extra_description'] ) : '';
		$modal_end_text    = isset( $item['end_button_text'] ) ? sanitize_text_field( $item['end_button_text'] ) : '';
		$modal_end_color   = isset( $item['end_button_color'] ) ? sanitize_hex_color( $item['end_button_color'] ) : '';

		$modal_images = array_filter(
			array(
				green_haven_get_customizer_image_url( isset( $item['extra_image_one'] ) ? $item['extra_image_one'] : '' ),
				green_haven_get_customizer_image_url( isset( $item['extra_image_two'] ) ? $item['extra_image_two'] : '' ),
				green_haven_get_customizer_image_url( isset( $item['extra_image_three'] ) ? $item['extra_image_three'] : '' ),
			)
		);

		$modal_images = array_values( $modal_images );

		/*
		 * Important rule:
		 * If button_text is empty, do not show the button
		 * and do not render the modal on the frontend.
		 */
		$has_modal_content = ! empty( $modal_title ) || ! empty( $modal_description ) || ! empty( $modal_images ) || ! empty( $modal_end_text );
		$show_modal        = ! empty( $button_text ) && $has_modal_content;

		$services[] = array(
			'modal_id'          => 'project-detail-modal-' . absint( $index + 1 ),
			'card_image'        => $card_image,
			'title'             => $title,
			'description'       => $description,
			'badge'             => $badge,
			'button_text'       => $button_text,
			'button_bg_color'   => $button_bg_color,
			'show_modal'        => $show_modal,
			'modal_title'       => $modal_title,
			'modal_description' => $modal_description,
			'modal_images'      => $modal_images,
			'modal_end_text'    => $modal_end_text,
			'modal_end_color'   => $modal_end_color,
		);
	}
}
?>

<?php if ( ! empty( $services ) ) : ?>
	<div class="services-grid">
		<?php foreach ( $services as $service ) : ?>
			<div class="service-card">
				<?php if ( ! empty( $service['card_image'] ) ) : ?>
					<div class="service-image">
						<img
							src="<?php echo esc_url( $service['card_image'] ); ?>"
							alt="<?php echo esc_attr( ! empty( $service['title'] ) ? $service['title'] : __( 'Service image', 'green-haven-theme' ) ); ?>"
						>

						<?php if ( ! empty( $service['badge'] ) ) : ?>
							<div class="ribbon <?php echo esc_attr( $service['badge']['class'] ); ?>">
								<i class="<?php echo esc_attr( $service['badge']['icon'] ); ?>" aria-hidden="true"></i>
								<span><?php echo esc_html( $service['badge']['label'] ); ?></span>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div class="service-content">
					<?php if ( ! empty( $service['title'] ) ) : ?>
						<h3 class="service-title"><?php echo esc_html( $service['title'] ); ?></h3>
					<?php endif; ?>

					<?php if ( ! empty( $service['description'] ) ) : ?>
						<p class="service-description"><?php echo esc_html( $service['description'] ); ?></p>
					<?php endif; ?>

					<?php if ( $service['show_modal'] ) : ?>
						<a
							href="#<?php echo esc_attr( $service['modal_id'] ); ?>"
							class="btn-service"
							data-bs-toggle="modal"
							data-bs-target="#<?php echo esc_attr( $service['modal_id'] ); ?>"
							<?php if ( ! empty( $service['button_bg_color'] ) ) : ?>
								style="<?php echo esc_attr( 'background-color: ' . $service['button_bg_color'] . ';' ); ?>"
							<?php endif; ?>
						>
							<?php echo esc_html( $service['button_text'] ); ?>
							<i class="fas fa-chevron-right" aria-hidden="true"></i>
						</a>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

	<?php foreach ( $services as $service ) : ?>
		<?php if ( ! $service['show_modal'] ) : ?>
			<?php continue; ?>
		<?php endif; ?>

		<div
			class="modal fade"
			id="<?php echo esc_attr( $service['modal_id'] ); ?>"
			tabindex="-1"
			aria-labelledby="<?php echo esc_attr( $service['modal_id'] . '-label' ); ?>"
			aria-hidden="true"
		>
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<?php if ( ! empty( $service['modal_title'] ) ) : ?>
							<h2 class="modal-title" id="<?php echo esc_attr( $service['modal_id'] . '-label' ); ?>">
								<?php echo esc_html( $service['modal_title'] ); ?>
							</h2>
						<?php else : ?>
							<h2 class="modal-title visually-hidden" id="<?php echo esc_attr( $service['modal_id'] . '-label' ); ?>">
								<?php echo esc_html( ! empty( $service['title'] ) ? $service['title'] : __( 'Service details', 'green-haven-theme' ) ); ?>
							</h2>
						<?php endif; ?>

						<button
							type="button"
							class="btn-close"
							data-bs-dismiss="modal"
							aria-label="<?php esc_attr_e( 'Close', 'green-haven-theme' ); ?>"
						></button>
					</div>

					<div class="modal-body">
						<?php if ( ! empty( $service['modal_images'] ) ) : ?>
							<div class="row g-3 mb-4">
								<?php
								$image_count  = count( $service['modal_images'] );
								$column_class = ( 3 === $image_count ) ? 'col-md-4' : ( ( 2 === $image_count ) ? 'col-md-6' : 'col-12' );
								?>

								<?php foreach ( $service['modal_images'] as $image_url ) : ?>
									<div class="<?php echo esc_attr( $column_class ); ?>">
										<img
											src="<?php echo esc_url( $image_url ); ?>"
											class="img-fluid rounded"
											alt="<?php echo esc_attr( ! empty( $service['modal_title'] ) ? $service['modal_title'] : ( ! empty( $service['title'] ) ? $service['title'] : __( 'Project image', 'green-haven-theme' ) ) ); ?>"
										>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $service['modal_description'] ) ) : ?>
							<div class="project-detail-description">
								<?php echo wp_kses_post( wpautop( esc_html( $service['modal_description'] ) ) ); ?>
							</div>
						<?php endif; ?>
					</div>

					<?php if ( ! empty( $service['modal_end_text'] ) ) : ?>
						<div class="modal-footer">
							<button
								type="button"
								class="btn btn-secondary"
								data-bs-dismiss="modal"
								<?php if ( ! empty( $service['modal_end_color'] ) ) : ?>
									style="<?php echo esc_attr( 'background-color: ' . $service['modal_end_color'] . ';' ); ?>"
								<?php endif; ?>
							>
								<?php echo esc_html( $service['modal_end_text'] ); ?>
							</button>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>