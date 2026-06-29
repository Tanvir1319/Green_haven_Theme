<?php 

add_action( 'after_setup_theme', 'initialize_kirki_settings_service_page', 20 );

function initialize_kirki_settings_service_page() {
	if ( ! class_exists( 'Kirki' ) ) {
		return;
	}

    // confining this page to only servicepage
$service_template_callback = function() {
    $page = get_queried_object();

    // Must be a WP_Post (a page), not a term, user, or null
    if ( ! $page instanceof WP_Post ) {
        return false;
    }

    
    $template = get_post_meta( $page->ID, '_wp_page_template', true );

    return $template === 'service.php';
};

    new \Kirki\Panel(
	'service_panel',
	[
		'priority'    => 10,
		'title'       => esc_html__( 'Green Haven Theme Panel', 'kirki' ),
		'description' => esc_html__( 'Green Haven Theme Panel Description.', 'kirki' ),
        'active_callback' => $service_template_callback,
	]
);

new \Kirki\Section(
	'service_section_header',
	[
		'title'       => esc_html__( 'Service Section Hero Part', 'kirki' ),
		'description' => esc_html__( 'Service Section Hero Part Description.', 'kirki' ),
		'panel'       => 'service_panel',
		'priority'    => 160,
	]
);


// Text Field (for heading or short text)
new \Kirki\Field\Text(
	[
		'settings'    => 'service_text_field',
		'label'       => esc_html__( 'Text Field', 'kirki' ),
		'description' => esc_html__( 'Enter a short text or heading', 'kirki' ),
		'section'     => 'service_section_header',
		'priority'    => 10,
		'default'     => '',
	]
);

// Textarea Field (for longer content/description)
new \Kirki\Field\Textarea(
	[
		'settings'    => 'service_textarea_field',
		'label'       => esc_html__( 'Textarea Field', 'kirki' ),
		'description' => esc_html__( 'Enter detailed description', 'kirki' ),
		'section'     => 'service_section_header',
		'priority'    => 20,
		'default'     => '',
	]
);

// Color Picker Field (for selecting a color)
new \Kirki\Field\Color(
	[
		'settings'    => 'service_color_field',
		'label'       => esc_html__( 'Color Picker', 'kirki' ),
		'description' => esc_html__( 'Choose a color', 'kirki' ),
		'section'     => 'service_section_header',
		'priority'    => 30,
		'default'     => '#000000',
	]
);

// Image Field (for uploading an image)
new \Kirki\Field\Image(
	[
		'settings'    => 'service_image_field',
		'label'       => esc_html__( 'Image Upload', 'kirki' ),
		'description' => esc_html__( 'Upload an image', 'kirki' ),
		'section'     => 'service_section_header',
		'priority'    => 40,
		'default'     => '',
	]
);




// Service Page Middle Part
new \Kirki\Section(
	'service_section_middle',
	[
		'title'       => esc_html__( 'Service Page Middle Part', 'kirki' ),
		'description' => esc_html__( 'Service Page Middle Part Description.', 'kirki' ),
		'panel'       => 'service_panel',
		'priority'    => 170,
	]
);

// Text Field (for heading or short text)
new \Kirki\Field\Text(
	[
		'settings'    => 'service_middle_text_field',
		'label'       => esc_html__( 'Text Field', 'kirki' ),
		'description' => esc_html__( 'Enter a short text or heading', 'kirki' ),
		'section'     => 'service_section_middle',
		'priority'    => 10,
		'default'     => '',
	]
);

// Textarea Field (
new \Kirki\Field\Textarea(
	[
		'settings'    => 'service_middle_textarea_field',
		'label'       => esc_html__( 'Textarea Field', 'kirki' ),
		'description' => esc_html__( 'Enter detailed description', 'kirki' ),
		'section'     => 'service_section_middle',
		'priority'    => 170,
		'default'     => '',
	]
);



// =============================
	// 🔹 SERVICE REPEATER SECTION
	// =============================
	new \Kirki\Section(
		'green_haven_service_section',
		[
			'title'    => esc_html__( 'Service Items', 'green-haven-theme' ),
			'panel'    => 'service_panel',
			'priority' => 1000,
		]
	);

	new \Kirki\Field\Repeater(
		[
			'settings' => 'green_haven_service_repeater',
			'label'    => esc_html__( 'Service Items', 'green-haven-theme' ),
			'section'  => 'green_haven_service_section',
			'priority' => 10,

			'row_label' => [
				'type'  => 'field',
				'value' => esc_html__( 'Service Item', 'green-haven-theme' ),
				'field' => 'title',
			],

			'button_label' => esc_html__( 'Add Service Item', 'green-haven-theme' ),

			'default' => [],

			'choices' => [
				'limit' => 12, 
			],

			'fields' => [

				//  First  Image
				'image_one' => [
					'type'  => 'image',
					'label' => esc_html__( 'Background Image', 'green-haven-theme' ),
				],
				

				//  Title
				'title' => [
					'type'  => 'text',
					'label' => esc_html__( 'Title', 'green-haven-theme' ),
				],

				//  Description
				'description' => [
					'type'  => 'textarea',
					'label' => esc_html__( 'Description', 'green-haven-theme' ),
				],

				// 🔹 Badge Select
				'badge' => [
					'type'    => 'select',
					'label'   => esc_html__( 'Badge Type', 'green-haven-theme' ),
					'default' => 'new',
					'choices' => [
                        ''     => esc_html__( '', 'green-haven-theme' ),
						'new'     => esc_html__( 'New', 'green-haven-theme' ),
						'hottest' => esc_html__( 'Hottest', 'green-haven-theme' ),
						'popular' => esc_html__( 'Popular', 'green-haven-theme' ),
					],
				],

				// 🔹 Button Text
				'button_text' => [
					'type'  => 'text',
					'label' => esc_html__( 'Button Text', 'green-haven-theme' ),
				],

				// 🔹 Button Color
				'button_bg_color' => [
					'type'  => 'color',
					'label' => esc_html__( 'Button Background Color', 'green-haven-theme' ),
				],

				// 🔹 Extra Text
				'extra_text' => [
					'type'  => 'text',
					'label' => esc_html__( 'Project Name', 'green-haven-theme' ),
				],

				// 🔹 Project Images
				'extra_image_one' => [
					'type'  => 'image',
					'label' => esc_html__( 'Project Image One', 'green-haven-theme' ),
				],
				'extra_image_two' => [
					'type'  => 'image',
					'label' => esc_html__( 'Project Image Two', 'green-haven-theme' ),
				],
				'extra_image_three' => [
					'type'  => 'image',
					'label' => esc_html__( 'Project Image Three', 'green-haven-theme' ),
				],

				// 🔹 Project Description
				'extra_description' => [
					'type'  => 'textarea',
					'label' => esc_html__( 'Project Description', 'green-haven-theme' ),
				],

				// 🔹 End Button Text
				'end_button_text' => [
					'type'  => 'text',
					'label' => esc_html__( 'End Button Text', 'green-haven-theme' ),
				],

				// 🔹 End Button Color
				'end_button_color' => [
					'type'  => 'color',
					'label' => esc_html__( 'End Button Color', 'green-haven-theme' ),
				],
			],
		]
	);



}