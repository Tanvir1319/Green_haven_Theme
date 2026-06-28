<?php 

add_action( 'after_setup_theme', 'initialize_kirki_settings_contact_page', 20 );

function initialize_kirki_settings_contact_page() {
	if ( ! class_exists( 'Kirki' ) ) {
		return;
	}

    // confining this page to only servicepage
$contact_page_template_callback = function() {
    $page = get_queried_object();

    // Must be a WP_Post (a page), not a term, user, or null
    if ( ! $page instanceof WP_Post ) {
        return false;
    }

    
    $template = get_post_meta( $page->ID, '_wp_page_template', true );

    return $template === 'contact.php';
};

    new \Kirki\Panel(
	'contact_panel',
	[
		'priority'    => 10,
		'title'       => esc_html__( 'Green Haven Theme Panel', 'kirki' ),
		'description' => esc_html__( 'Green Haven Theme Panel Description.', 'kirki' ),
        'active_callback' => $contact_page_template_callback,
	]
);
// contact header part
new \Kirki\Section(
	'contact_section_header',
	[
		'title'       => esc_html__( 'Contact Section Header', 'kirki' ),
		'description' => esc_html__( 'Contact Section Header Description.', 'kirki' ),
		'panel'       => 'contact_panel',
		'priority'    => 160,
	]
);


// Text Field (for heading or short text)
new \Kirki\Field\Text(
	[
		'settings'    => 'contact_text_field',
		'label'       => esc_html__( 'Text Field', 'kirki' ),
		'description' => esc_html__( 'Enter a short text or heading', 'kirki' ),
		'section'     => 'contact_section_header',
		'priority'    => 10,
		'default'     => '',
	]
);

// Textarea Field (for longer content/description)
new \Kirki\Field\Textarea(
	[
		'settings'    => 'contact_textarea_field',
		'label'       => esc_html__( 'Textarea Field', 'kirki' ),
		'description' => esc_html__( 'Enter detailed description', 'kirki' ),
		'section'     => 'contact_section_header',
		'priority'    => 20,
		'default'     => '',
	]
);

// Color Picker Field (for selecting a color)
new \Kirki\Field\Color(
	[
		'settings'    => 'contact_color_field',
		'label'       => esc_html__( 'Color Picker', 'kirki' ),
		'description' => esc_html__( 'Choose a color', 'kirki' ),
		'section'     => 'contact_section_header',
		'priority'    => 30,
		'default'     => '#000000',
	]
);

// Image Field (for uploading an image)
new \Kirki\Field\Image(
	[
		'settings'    => 'contact_image_field',
		'label'       => esc_html__( 'Image Upload', 'kirki' ),
		'description' => esc_html__( 'Upload an image', 'kirki' ),
		'section'     => 'contact_section_header',
		'priority'    => 40,
		'default'     => '',
	]
);








// contact area info part

new \Kirki\Section(
    'contact_section_info',
    [
        'title'       => esc_html__( 'Contact Info Section', 'green-haven-theme' ),
        'panel'       => 'contact_panel',
        'priority'    => 160,
    ]
);

// Section Heading
new \Kirki\Field\Text([
    'settings' => 'contact_info_heading',
    'label'    => esc_html__( 'Section Heading', 'green-haven-theme' ),
    'section'  => 'contact_section_info',
    'default'  => 'Our Information',
]);



// Business Address
new \Kirki\Field\Text([
    'settings' => 'contact_info_busaddress',
    'label'    => esc_html__( 'Business Address', 'green-haven-theme' ),
    'section'  => 'contact_section_info',
    'default'  => '',
]);


// Address
new \Kirki\Field\Text([
    'settings' => 'contact_info_address',
    'label'    => esc_html__( 'Business Address Below', 'green-haven-theme' ),
    'section'  => 'contact_section_info',
    'default'  => '',
]);

// Phone Label
new \Kirki\Field\Text([
    'settings' => 'contact_info_phone_label',
    'label'    => esc_html__( 'Phone Label', 'green-haven-theme' ),
    'section'  => 'contact_section_info',
    'default'  => 'Phone Number:',
]);

// Phone Number
new \Kirki\Field\Text([
    'settings' => 'contact_info_phone',
    'label'    => esc_html__( 'Phone Number', 'green-haven-theme' ),
    'section'  => 'contact_section_info',
    'default'  => '',
]);


// Business Hours Label
new \Kirki\Field\Text([
    'settings' => 'contact_info_hours_label',
    'label'    => esc_html__( 'Business Hours Label', 'green-haven-theme' ),
    'section'  => 'contact_section_info',
    'default'  => 'Business Hours:',
]);

// Business Hours Content
new \Kirki\Field\Textarea([
    'settings' => 'contact_info_hours',
    'label'    => esc_html__( 'Business Hours Content', 'green-haven-theme' ),
    'section'  => 'contact_section_info',
    'default'  => '',
]);

// Google Map Embed (iframe)
new \Kirki\Field\Textarea([
    'settings' => 'contact_info_map_iframe',
    'label'    => esc_html__( 'Google Map Embed Code (iframe)', 'green-haven-theme' ),
    'section'  => 'contact_section_info',
    'default'  => '',
]);






}