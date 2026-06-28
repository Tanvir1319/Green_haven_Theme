<?php
/**
 * Register Green Haven Theme Options admin menus.
 */
function green_haven_register_theme_options_menu() {
	add_menu_page(
		__( 'Green Haven Theme Options', 'green-haven' ),
		__( 'Green Haven Theme Options', 'green-haven' ),
		'manage_options',
		'green-haven-theme-options',
		'green_haven_cta_option_page',
		'dashicons-admin-generic',
		60
	);

	add_submenu_page(
		'green-haven-theme-options',
		__( 'CTA Option', 'green-haven' ),
		__( 'CTA Option', 'green-haven' ),
		'manage_options',
		'green-haven-theme-options',
		'green_haven_cta_option_page'
	);

	add_submenu_page(
		'green-haven-theme-options',
		__( 'Phone Number Header', 'green-haven' ),
		__( 'Phone Number Header', 'green-haven' ),
		'manage_options',
		'green-haven-phone-number',
		'green_haven_phone_number_page'
	);

	add_submenu_page(
		'green-haven-theme-options',
		__( 'Footer Settings', 'green-haven' ),
		__( 'Footer Settings', 'green-haven' ),
		'manage_options',
		'green-haven-footer-settings',
		'green_haven_footer_settings_page'
	);
}
add_action( 'admin_menu', 'green_haven_register_theme_options_menu' );

/**
 * Register theme option settings.
 */
function green_haven_register_theme_settings() {
	register_setting(
		'green_haven_cta_options_group',
		'green_haven_cta_options',
		'green_haven_sanitize_cta_options'
	);

	register_setting(
		'green_haven_phone_number_options_group',
		'green_haven_phone_number_options',
		'green_haven_sanitize_phone_number_page'
	);

	register_setting(
		'green_haven_footer_options_group',
		'green_haven_footer_options',
		'green_haven_sanitize_footer_options'
	);
}
add_action( 'admin_init', 'green_haven_register_theme_settings' );

/**
 * Sanitize CTA option fields before saving.
 */
function green_haven_sanitize_cta_options( $input ) {
	$sanitized = array();

	$sanitized['title_text'] = isset( $input['title_text'] )
		? sanitize_text_field( $input['title_text'] )
		: '';

	$sanitized['button_text'] = isset( $input['button_text'] )
		? sanitize_text_field( $input['button_text'] )
		: '';

	$sanitized['button_background_color'] = isset( $input['button_background_color'] )
		? sanitize_hex_color( $input['button_background_color'] )
		: '';

	$sanitized['title_background_color'] = isset( $input['title_background_color'] )
		? sanitize_hex_color( $input['title_background_color'] )
		: '';

	$sanitized['title_background_image'] = isset( $input['title_background_image'] )
		? esc_url_raw( $input['title_background_image'] )
		: '';

	$sanitized['tick_mark_option'] = isset( $input['tick_mark_option'] ) ? 1 : 0;

	return $sanitized;
}

/**
 * Sanitize phone number option fields before saving.
 */
function green_haven_sanitize_phone_number_page( $input ) {
	$sanitized = array();

	$sanitized['phone_number'] = isset( $input['phone_number'] )
		? sanitize_text_field( $input['phone_number'] )
		: '';

	$sanitized['phone_number_background_color'] = isset( $input['phone_number_background_color'] )
		? sanitize_hex_color( $input['phone_number_background_color'] )
		: '';

	return $sanitized;
}

/**
 * Display CTA option page fields.
 */
function green_haven_cta_option_page() {
	$options = get_option( 'green_haven_cta_options' );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'CTA Option', 'green-haven' ); ?></h1>

		<form method="post" action="options.php">
			<?php settings_fields( 'green_haven_cta_options_group' ); ?>

			<table class="form-table">
				<tr>
					<th scope="row">
						<label for="green_haven_title_text">
							<?php esc_html_e( 'Title Text', 'green-haven' ); ?>
						</label>
					</th>
					<td>
						<input
							type="text"
							id="green_haven_title_text"
							name="green_haven_cta_options[title_text]"
							value="<?php echo isset( $options['title_text'] ) ? esc_attr( $options['title_text'] ) : ''; ?>"
							class="regular-text"
						>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="green_haven_button_text">
							<?php esc_html_e( 'Button Text', 'green-haven' ); ?>
						</label>
					</th>
					<td>
						<input
							type="text"
							id="green_haven_button_text"
							name="green_haven_cta_options[button_text]"
							value="<?php echo isset( $options['button_text'] ) ? esc_attr( $options['button_text'] ) : ''; ?>"
							class="regular-text"
						>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="green_haven_button_background_color">
							<?php esc_html_e( 'Button Background Colour', 'green-haven' ); ?>
						</label>
					</th>
					<td>
						<input
							type="text"
							id="green_haven_button_background_color"
							name="green_haven_cta_options[button_background_color]"
							value="<?php echo isset( $options['button_background_color'] ) ? esc_attr( $options['button_background_color'] ) : ''; ?>"
							class="green-haven-color-picker"
						>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="green_haven_title_background_color">
							<?php esc_html_e( 'Title Background Colour', 'green-haven' ); ?>
						</label>
					</th>
					<td>
						<input
							type="text"
							id="green_haven_title_background_color"
							name="green_haven_cta_options[title_background_color]"
							value="<?php echo isset( $options['title_background_color'] ) ? esc_attr( $options['title_background_color'] ) : ''; ?>"
							class="green-haven-color-picker"
						>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="green_haven_title_background_image">
							<?php esc_html_e( 'Title Background Image', 'green-haven' ); ?>
						</label>
					</th>
					<td>
						<input
							type="hidden"
							id="green_haven_title_background_image"
							name="green_haven_cta_options[title_background_image]"
							value="<?php echo isset( $options['title_background_image'] ) ? esc_url( $options['title_background_image'] ) : ''; ?>"
							class="green-haven-image-url"
						>

						<button type="button" class="button green-haven-upload-image">
							<?php esc_html_e( 'Choose Image', 'green-haven' ); ?>
						</button>

						<button
							type="button"
							class="button green-haven-remove-image"
							style="<?php echo empty( $options['title_background_image'] ) ? 'display: none;' : ''; ?>"
						>
							<?php esc_html_e( 'Remove Image', 'green-haven' ); ?>
						</button>

						<div class="green-haven-image-preview" style="margin-top: 15px;">
							<?php if ( ! empty( $options['title_background_image'] ) ) : ?>
								<img
									src="<?php echo esc_url( $options['title_background_image'] ); ?>"
									alt="<?php esc_attr_e( 'Title Background Image', 'green-haven' ); ?>"
									style="max-width: 250px; height: auto; display: block;"
								>
							<?php endif; ?>
						</div>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<?php esc_html_e( 'Want To Enable CTA Part', 'green-haven' ); ?>
					</th>
					<td>
						<label>
							<input
								type="checkbox"
								name="green_haven_cta_options[tick_mark_option]"
								value="1"
								<?php checked( isset( $options['tick_mark_option'] ) ? $options['tick_mark_option'] : 0, 1 ); ?>
							>
							<?php esc_html_e( 'Enable', 'green-haven' ); ?>
						</label>
					</td>
				</tr>
			</table>

			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

/**
 * Display phone number option page fields.
 */
function green_haven_phone_number_page() {
	$options = get_option( 'green_haven_phone_number_options' );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Phone Number Options', 'green-haven' ); ?></h1>

		<form method="post" action="options.php">
			<?php settings_fields( 'green_haven_phone_number_options_group' ); ?>

			<table class="form-table">
				<tr>
					<th scope="row">
						<label for="green_haven_phone_number">
							<?php esc_html_e( 'Phone Number', 'green-haven' ); ?>
						</label>
					</th>
					<td>
						<input
							type="text"
							id="green_haven_phone_number"
							name="green_haven_phone_number_options[phone_number]"
							value="<?php echo isset( $options['phone_number'] ) ? esc_attr( $options['phone_number'] ) : ''; ?>"
							class="regular-text"
						>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="green_haven_phone_number_background_color">
							<?php esc_html_e( 'Phone Number Background Colour', 'green-haven' ); ?>
						</label>
					</th>
					<td>
						<input
							type="text"
							id="green_haven_phone_number_background_color"
							name="green_haven_phone_number_options[phone_number_background_color]"
							value="<?php echo isset( $options['phone_number_background_color'] ) ? esc_attr( $options['phone_number_background_color'] ) : ''; ?>"
							class="green-haven-color-picker"
						>
					</td>
				</tr>
			</table>

			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

/**
 * Sanitize footer option fields before saving.
 */
function green_haven_sanitize_footer_options( $input ) {
	$sanitized = array();

	$sanitized['footer_logo'] = isset( $input['footer_logo'] )
		? esc_url_raw( $input['footer_logo'] )
		: '';

	$sanitized['footer_description'] = isset( $input['footer_description'] )
		? sanitize_textarea_field( $input['footer_description'] )
		: '';

	$sanitized['footer_menu_text'] = isset( $input['footer_menu_text'] )
		? sanitize_text_field( $input['footer_menu_text'] )
		: '';

	$sanitized['footer_menu_id'] = isset( $input['footer_menu_id'] )
		? absint( $input['footer_menu_id'] )
		: 0;

	$sanitized['footer_follow_text'] = isset( $input['footer_follow_text'] )
		? sanitize_text_field( $input['footer_follow_text'] )
		: '';

	$sanitized['footer_newsletter_text'] = isset( $input['footer_newsletter_text'] )
		? sanitize_text_field( $input['footer_newsletter_text'] )
		: '';

	$sanitized['footer_copyright_text'] = isset( $input['footer_copyright_text'] )
		? sanitize_text_field( $input['footer_copyright_text'] )
		: '';

	$sanitized['footer_newsletter_shortcode'] = isset( $input['footer_newsletter_shortcode'] )
		? wp_kses_post( $input['footer_newsletter_shortcode'] )
		: '';

	$sanitized['footer_follow_us_type'] = array();

	if ( ! empty( $input['footer_follow_us_type'] ) && is_array( $input['footer_follow_us_type'] ) ) {
		$allowed_icons = array( 'facebook', 'youtube', 'linkedin', 'instagram' );
		$count         = 0;

		foreach ( $input['footer_follow_us_type'] as $item ) {
			if ( $count >= 4 ) {
				break;
			}

			$text = isset( $item['text'] ) ? esc_url_raw( $item['text'] ) : '';
			$icon = isset( $item['icon'] ) ? sanitize_key( $item['icon'] ) : '';

			if ( ! in_array( $icon, $allowed_icons, true ) ) {
				$icon = '';
			}

			if ( '' !== $text || '' !== $icon ) {
				$sanitized['footer_follow_us_type'][] = array(
					'text' => $text,
					'icon' => $icon,
				);

				$count++;
			}
		}
	}

	return $sanitized;
}

/**
 * Display footer settings page.
 */
function green_haven_footer_settings_page() {
	$options = get_option( 'green_haven_footer_options' );
	$menus   = wp_get_nav_menus();

	$footer_logo                 = isset( $options['footer_logo'] ) ? $options['footer_logo'] : '';
	$footer_description          = isset( $options['footer_description'] ) ? $options['footer_description'] : '';
	$footer_menu_text            = isset( $options['footer_menu_text'] ) ? $options['footer_menu_text'] : '';
	$footer_menu_id              = isset( $options['footer_menu_id'] ) ? absint( $options['footer_menu_id'] ) : 0;
	$footer_follow_text          = isset( $options['footer_follow_text'] ) ? $options['footer_follow_text'] : '';
	$footer_newsletter_text      = isset( $options['footer_newsletter_text'] ) ? $options['footer_newsletter_text'] : '';
	$footer_copyright_text       = isset( $options['footer_copyright_text'] ) ? $options['footer_copyright_text'] : '';
	$footer_newsletter_shortcode = isset( $options['footer_newsletter_shortcode'] ) ? $options['footer_newsletter_shortcode'] : '';
	$footer_follow_us_type       = isset( $options['footer_follow_us_type'] ) && is_array( $options['footer_follow_us_type'] ) ? $options['footer_follow_us_type'] : array();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Footer Settings', 'green-haven' ); ?></h1>

		<form method="post" action="options.php">
			<?php settings_fields( 'green_haven_footer_options_group' ); ?>

			<table class="form-table">
				<tr>
					<th scope="row">
						<label for="green_haven_footer_logo">
							<?php esc_html_e( 'Upload Your Logo', 'green-haven' ); ?>
						</label>
					</th>
					<td>
						<input
							type="hidden"
							id="green_haven_footer_logo"
							name="green_haven_footer_options[footer_logo]"
							value="<?php echo esc_url( $footer_logo ); ?>"
							class="green-haven-image-url"
						>

						<button type="button" class="button green-haven-upload-image">
							<?php esc_html_e( 'Choose Logo', 'green-haven' ); ?>
						</button>

						<button
							type="button"
							class="button green-haven-remove-image"
							style="<?php echo empty( $footer_logo ) ? 'display: none;' : ''; ?>"
						>
							<?php esc_html_e( 'Remove Image', 'green-haven' ); ?>
						</button>

						<div class="green-haven-image-preview" style="margin-top: 15px;">
							<?php if ( ! empty( $footer_logo ) ) : ?>
								<img
									src="<?php echo esc_url( $footer_logo ); ?>"
									alt="<?php esc_attr_e( 'Footer Logo', 'green-haven' ); ?>"
									style="max-width: 180px; height: auto; display: block;"
								>
							<?php endif; ?>
						</div>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="green_haven_footer_description">
							<?php esc_html_e( 'Description', 'green-haven' ); ?>
						</label>
					</th>
					<td>
						<textarea
							id="green_haven_footer_description"
							name="green_haven_footer_options[footer_description]"
							rows="5"
							class="large-text"
						><?php echo esc_textarea( $footer_description ); ?></textarea>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="green_haven_footer_menu_text">
							<?php esc_html_e( 'Menu Text', 'green-haven' ); ?>
						</label>
					</th>
					<td>
						<input
							type="text"
							id="green_haven_footer_menu_text"
							name="green_haven_footer_options[footer_menu_text]"
							value="<?php echo esc_attr( $footer_menu_text ); ?>"
							class="regular-text"
						>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="green_haven_footer_menu_id">
							<?php esc_html_e( 'Choose Your Menu', 'green-haven' ); ?>
						</label>
					</th>
					<td>
						<select
							id="green_haven_footer_menu_id"
							name="green_haven_footer_options[footer_menu_id]"
						>
							<option value="0"><?php esc_html_e( 'Select Menu', 'green-haven' ); ?></option>

							<?php foreach ( $menus as $menu ) : ?>
								<option
									value="<?php echo esc_attr( $menu->term_id ); ?>"
									<?php selected( $footer_menu_id, $menu->term_id ); ?>
								>
									<?php echo esc_html( $menu->name ); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="green_haven_footer_follow_text">
							<?php esc_html_e( 'Follow Text', 'green-haven' ); ?>
						</label>
					</th>
					<td>
						<input
							type="text"
							id="green_haven_footer_follow_text"
							name="green_haven_footer_options[footer_follow_text]"
							value="<?php echo esc_attr( $footer_follow_text ); ?>"
							class="regular-text"
						>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<?php esc_html_e( 'Folloiw Us Type', 'green-haven' ); ?>
					</th>
					<td>
						<div id="green-haven-follow-us-wrapper">
							<?php
							if ( empty( $footer_follow_us_type ) ) {
								$footer_follow_us_type = array();
							}

							foreach ( $footer_follow_us_type as $index => $item ) :
								$item_text = isset( $item['text'] ) ? $item['text'] : '';
								$item_icon = isset( $item['icon'] ) ? $item['icon'] : '';

								$dashicon_class = '';

								if ( 'facebook' === $item_icon ) {
									$dashicon_class = 'dashicons-facebook-alt';
								}

								if ( 'youtube' === $item_icon ) {
									$dashicon_class = 'dashicons-youtube';
								}

								if ( 'linkedin' === $item_icon ) {
									$dashicon_class = 'dashicons-linkedin';
								}

								if ( 'instagram' === $item_icon ) {
									$dashicon_class = 'dashicons-instagram';
								}
								?>
								<div class="green-haven-follow-us-item" style="margin-bottom: 15px; padding: 15px; border: 1px solid #ccd0d4;">
									<input
										type="url"
										name="green_haven_footer_options[footer_follow_us_type][<?php echo esc_attr( $index ); ?>][text]"
										value="<?php echo esc_url( $item_text ); ?>"
										class="regular-text"
										placeholder="<?php esc_attr_e( 'Enter social URL', 'green-haven' ); ?>"
									>

									<select
										name="green_haven_footer_options[footer_follow_us_type][<?php echo esc_attr( $index ); ?>][icon]"
										class="green-haven-follow-us-icon"
										style="margin-top: 10px;"
									>
										<option value=""><?php esc_html_e( 'Select Icon', 'green-haven' ); ?></option>
										<option value="facebook" <?php selected( $item_icon, 'facebook' ); ?>>
											<?php esc_html_e( 'Facebook', 'green-haven' ); ?>
										</option>
										<option value="linkedin" <?php selected( $item_icon, 'linkedin' ); ?>>
											<?php esc_html_e( 'LinkedIn', 'green-haven' ); ?>
										</option>
										<option value="instagram" <?php selected( $item_icon, 'instagram' ); ?>>
											<?php esc_html_e( 'Instagram', 'green-haven' ); ?>
										</option>
										<option value="youtube" <?php selected( $item_icon, 'youtube' ); ?>>
											<?php esc_html_e( 'YouTube', 'green-haven' ); ?>
										</option>
									</select>

									<span class="dashicons green-haven-icon-preview <?php echo esc_attr( $dashicon_class ); ?>" style="margin-top: 12px;"></span>

									<button type="button" class="button green-haven-remove-follow-us" style="margin-top: 10px;">
										<?php esc_html_e( 'Remove', 'green-haven' ); ?>
									</button>
								</div>
							<?php endforeach; ?>
						</div>

						<button type="button" class="button" id="green-haven-add-follow-us">
							<?php esc_html_e( 'Add Follow Us Type', 'green-haven' ); ?>
						</button>

						<p class="description">
							<?php esc_html_e( 'Maximum 4 fields allowed.', 'green-haven' ); ?>
						</p>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="green_haven_footer_newsletter_text">
							<?php esc_html_e( 'Newsletter Text', 'green-haven' ); ?>
						</label>
					</th>
					<td>
						<input
							type="text"
							id="green_haven_footer_newsletter_text"
							name="green_haven_footer_options[footer_newsletter_text]"
							value="<?php echo esc_attr( $footer_newsletter_text ); ?>"
							class="regular-text"
						>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="green_haven_footer_copyright_text">
							<?php esc_html_e( 'Copyright Text', 'green-haven' ); ?>
						</label>
					</th>
					<td>
						<input
							type="text"
							id="green_haven_footer_copyright_text"
							name="green_haven_footer_options[footer_copyright_text]"
							value="<?php echo esc_attr( $footer_copyright_text ); ?>"
							class="regular-text"
						>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="green_haven_footer_newsletter_shortcode">
							<?php esc_html_e( 'Newsletter Plugin Shortcode', 'green-haven' ); ?>
						</label>
					</th>
					<td>
						<textarea
							id="green_haven_footer_newsletter_shortcode"
							name="green_haven_footer_options[footer_newsletter_shortcode]"
							rows="4"
							class="large-text"
							placeholder="<?php esc_attr_e( '[your_newsletter_shortcode]', 'green-haven' ); ?>"
						><?php echo esc_textarea( $footer_newsletter_shortcode ); ?></textarea>
					</td>
				</tr>
			</table>

			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}