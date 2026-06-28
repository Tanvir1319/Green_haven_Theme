<?php 

add_action( 'after_setup_theme', 'initialize_kirki_settings', 20 );

function initialize_kirki_settings() {
	if ( ! class_exists( 'Kirki' ) ) {
		return;
	}

// confining this page to only homepage
$home_template_callback = function() {
    $page = get_queried_object();

    // Must be a WP_Post (a page), not a term, user, or null
    if ( ! $page instanceof WP_Post ) {
        return false;
    }

    
    $template = get_post_meta( $page->ID, '_wp_page_template', true );

    return $template === 'home_page.php';
};




// Panel
new \Kirki\Panel(
    'green_haven_home_panel',
    [
        'priority'    => 10,
        'title'       => esc_html__( 'Green Haven Theme Panel', 'green-haven-theme' ),
        'description' => esc_html__( 'This is Green Haven Panel', 'green-haven-theme' ),
        'active_callback' => $home_template_callback,
    ]
);

//Slider  Section
new \Kirki\Section(
    'green_haven_slider_section',
    [
        'title'       => esc_html__( 'Slider Section', 'green-haven-theme' ),
        'description' => esc_html__( 'This is Slider Section - Add up to 9 slides', 'green-haven-theme' ),
        'panel'       => 'green_haven_home_panel',
        
        'priority'    => 160,
    ]
);

// Repeater Field for Slider
new \Kirki\Field\Repeater(
    [
        'settings'     => 'green_haven_slider_repeater',
        'label'        => esc_html__( 'Slider Items', 'green-haven-theme' ),
        'description'  => esc_html__( 'Add your slider items here (Maximum 9 slides)', 'green-haven-theme' ),
        'section'      => 'green_haven_slider_section',
        'priority'     => 10,
        'row_label'    => [
            'type'  => 'field',
            'value' => esc_html__( 'Slide', 'green-haven-theme' ),
            'field' => 'slide_title',
        ],
        'button_label' => esc_html__( 'Add New Slide', 'green-haven-theme' ),
        'default'      => [],
        'fields'       => [
            // Image Control
            'slide_image' => [
                'type'        => 'image',
                'label'       => esc_html__( 'Slider Background Image', 'green-haven-theme' ),
                'description' => esc_html__( 'Upload your slider background image', 'green-haven-theme' ),
                'default'     => '',
            ],
            // Text Control (Title)
            'slide_title' => [
                'type'        => 'text',
                'label'       => esc_html__( 'Slider Title', 'green-haven-theme' ),
                'description' => esc_html__( 'Enter the slide title', 'green-haven-theme' ),
                'default'     => '',
            ],
            // Textarea Control (Description)
            'slide_description' => [
                'type'        => 'textarea',
                'label'       => esc_html__( 'Slider Description', 'green-haven-theme' ),
                'description' => esc_html__( 'Enter the slide description', 'green-haven-theme' ),
                'default'     => '',
            ],
            // Button Text Control
            'slide_button_text' => [
                'type'        => 'text',
                'label'       => esc_html__( 'Button Text', 'green-haven-theme' ),
                'description' => esc_html__( 'Enter the button text', 'green-haven-theme' ),
                'default'     => esc_html__( 'Learn More', 'green-haven-theme' ),
            ],
            // URL Control
            'slide_button_url' => [
                'type'        => 'url',
                'label'       => esc_html__( 'Button URL', 'green-haven-theme' ),
                'description' => esc_html__( 'Enter the button link URL', 'green-haven-theme' ),
                'default'     => '',
            ],
            // Color Control
            'slide_overlay_color' => [
                'type'        => 'color',
                'label'       => esc_html__( 'Button Color', 'green-haven-theme' ),
                'description' => esc_html__( 'Choose the button color for this button', 'green-haven-theme' ),
                'default'     => 'rgba(0, 0, 0, 0.3)',
                'choices'     => [
                    'alpha' => true,
                ],
            ],
        ],
        // Limit to 9 items
        'choices' => [
            'limit' => 9,
        ],
    ]
);


// About Us Section
new \Kirki\Section(
    'green_haven_about_us_section',
    [
        'title'       => esc_html__( 'About Us Section', 'green-haven-theme' ),
        'description' => esc_html__( 'Customize your About Us section', 'green-haven-theme' ),
        'panel'       => 'green_haven_home_panel',
        'priority'    => 170,
    ]
);

// About Us Image
new \Kirki\Field\Image(
    [
        'settings'    => 'green_haven_about_us_image',
        'label'       => esc_html__( 'About Us Image Part', 'green-haven-theme' ),
        'description' => esc_html__( 'Upload your about us section image for left side', 'green-haven-theme' ),
        'section'     => 'green_haven_about_us_section',
        'priority'    => 10,
        'default'     => '',
    ]
);

// About Us Title (First Text Field)
new \Kirki\Field\Text(
    [
        'settings'    => 'green_haven_about_us_title',
        'label'       => esc_html__( 'About Us Title', 'green-haven-theme' ),
        'description' => esc_html__( 'Enter the main title for about us section', 'green-haven-theme' ),
        'section'     => 'green_haven_about_us_section',
        'priority'    => 20,
        
    ]
);

// About Us Subtitle (Second Text Field)
new \Kirki\Field\Text(
    [
        'settings'    => 'green_haven_about_us_subtitle',
        'label'       => esc_html__( 'About Us Subtitle', 'green-haven-theme' ),
        'description' => esc_html__( 'Enter the subtitle or tagline', 'green-haven-theme' ),
        'section'     => 'green_haven_about_us_section',
        'priority'    => 30,
        'default'     => '',
    ]
);

// About Us Description (Textarea)
new \Kirki\Field\Textarea(
    [
        'settings'    => 'green_haven_about_us_description',
        'label'       => esc_html__( 'About Us Description', 'green-haven-theme' ),
        'description' => esc_html__( 'Enter the detailed description for about us section', 'green-haven-theme' ),
        'section'     => 'green_haven_about_us_section',
        'priority'    => 40,
        'default'     => '',
    ]
);









// Complete Garden Solutions Section

new \Kirki\Section(
    'green_haven_complete_garden_solutions_section',
    [
        'title'       => esc_html__( 'Complete Garden Solutions Section', 'green-haven-theme' ),
        'description' => esc_html__( 'Complete Garden Solutions Section', 'green-haven-theme' ),
        'panel'       => 'green_haven_home_panel',
        'priority'    => 180,
    ]
);

// Main Headline
new \Kirki\Field\Text(
    [
        'settings'    => 'green_haven_garden_solutions_headline',
        'label'       => esc_html__( 'Section Headline', 'green-haven-theme' ),
        'description' => esc_html__( 'Enter the main headline for garden solutions section', 'green-haven-theme' ),
        'section'     => 'green_haven_complete_garden_solutions_section',
        'priority'    => 10,
        'default'     => esc_html__( 'Complete Garden Solutions', 'green-haven-theme' ),
    ]
);

// Repeater Field for Garden Solutions
new \Kirki\Field\Repeater(
    [
        'settings'     => 'green_haven_garden_solutions_repeater',
        'label'        => esc_html__( 'Garden Solutions Items', 'green-haven-theme' ),
        'description'  => esc_html__( 'Add your garden solutions (Maximum 3 items)', 'green-haven-theme' ),
        'section'      => 'green_haven_complete_garden_solutions_section',
        'priority'     => 20,
        'row_label'    => [
            'type'  => 'field',
            'value' => esc_html__( 'Solution', 'green-haven-theme' ),
            'field' => 'solution_title',
        ],
        'button_label' => esc_html__( 'Add New Solution', 'green-haven-theme' ),
        'default'      => [],
        'fields'       => [
            // Icon Dropdown
            'solution_icon' => [
                'type'        => 'select',
                'label'       => esc_html__( 'Select Icon', 'green-haven-theme' ),
                'description' => esc_html__( 'Choose an icon for this solution', 'green-haven-theme' ),
                'default'     => 'fas fa-drafting-compass',
                'choices'     => [
                    'fas fa-drafting-compass'    => esc_html__( 'Landscape Design', 'green-haven-theme' ),
                    'fas fa-seedling'  => esc_html__( 'Garden Maintenance', 'green-haven-theme' ),
                    'fas fa-layer-group'  => esc_html__( 'Irrigation Systems', 'green-haven-theme' ),
                    'fas fa-tint'          => esc_html__( 'Lawn Care', 'green-haven-theme' ),
                    'fas fa-leaf'      => esc_html__( 'ECO-FRIENDLY', 'green-haven-theme' ),
                    'fas fa-shield-alt'   => esc_html__( 'EXPERIENCED TEAM', 'green-haven-theme' ),
                    'fas fa-hand-holding-usd'   => esc_html__( 'EXPERIENCE TRUST', 'green-haven-theme' )
                    
                    
                ],
            ],
            // Small Text (Title)
            'solution_title' => [
                'type'        => 'text',
                'label'       => esc_html__( 'Solution Title', 'green-haven-theme' ),
                'description' => esc_html__( 'Enter a short title for this solution', 'green-haven-theme' ),
                'default'     => '',
            ],
            // Textarea (Description)
            'solution_description' => [
                'type'        => 'textarea',
                'label'       => esc_html__( 'Solution Description', 'green-haven-theme' ),
                'description' => esc_html__( 'Enter the detailed description', 'green-haven-theme' ),
                'default'     => '',
            ],
        ],
        // Limit to 4 items
        'choices' => [
            'limit' => 4,
        ],
    ]
);





















// Why Choose Us Section
new \Kirki\Section(
    'green_haven_why_choose_us_section',
    [
        'title'       => esc_html__( 'Why Choose Us Section', 'green-haven-theme' ),
        'description' => esc_html__( 'Why Choose Us Section', 'green-haven-theme' ),
        'panel'       => 'green_haven_home_panel',
        'priority'    => 190,
    ]
);

// Main Headline
new \Kirki\Field\Text(
    [
        'settings'    => 'green_haven_why_choose_us_headline',
        'label'       => esc_html__( 'Section Headline', 'green-haven-theme' ),
        'description' => esc_html__( 'Enter the main headline for why choose us section', 'green-haven-theme' ),
        'section'     => 'green_haven_why_choose_us_section',
        'priority'    => 10,
        'default'     => esc_html__( 'Why Choose Us', 'green-haven-theme' ),
    ]
);

// Repeater Field for Why Choose Us
new \Kirki\Field\Repeater(
    [
        'settings'     => 'green_haven_why_choose_us_repeater',
        'label'        => esc_html__( 'Why Choose Us Items', 'green-haven-theme' ),
        'description'  => esc_html__( 'Add your why choose us items (Maximum 3 items)', 'green-haven-theme' ),
        'section'      => 'green_haven_why_choose_us_section',
        'priority'     => 20,
        'row_label'    => [
            'type'  => 'field',
            'value' => esc_html__( 'Reason', 'green-haven-theme' ),
            'field' => 'reason_title',
        ],
        'button_label' => esc_html__( 'Add New Reason', 'green-haven-theme' ),
        'default'      => ['fas fa-tint'],
        'fields'       => [
            // Icon Dropdown
            'reason_icon' => [
                'type'        => 'select',
                'label'       => esc_html__( 'Select Icon', 'green-haven-theme' ),
                'description' => esc_html__( 'Choose an icon for this reason', 'green-haven-theme' ),
                'default'     => 'fas fa-drafting-compass',
                'choices'     => [
                    'fas fa-drafting-compass'    => esc_html__( 'Landscape Design', 'green-haven-theme' ),
                    'fas fa-seedling'            => esc_html__( 'Garden Maintenance', 'green-haven-theme' ),
                    'fas fa-layer-group'         => esc_html__( 'Irrigation Systems', 'green-haven-theme' ),
                    'fas fa-tint'                => esc_html__( 'Lawn Care', 'green-haven-theme' ),
                    'fas fa-leaf'                => esc_html__( 'ECO-FRIENDLY', 'green-haven-theme' ),
                    'fas fa-shield-alt'          => esc_html__( 'EXPERIENCED TEAM', 'green-haven-theme' ),
                    'fas fa-hand-holding-usd'    => esc_html__( 'EXPERIENCE TRUST', 'green-haven-theme' )
                ],
            ],
            // Small Text (Title)
            'reason_title' => [
                'type'        => 'text',
                'label'       => esc_html__( 'Reason Title', 'green-haven-theme' ),
                'description' => esc_html__( 'Enter a short title for this reason', 'green-haven-theme' ),
                'default'     => '',
            ],
            // Textarea (Description)
            'reason_description' => [
                'type'        => 'textarea',
                'label'       => esc_html__( 'Reason Description', 'green-haven-theme' ),
                'description' => esc_html__( 'Enter the detailed description', 'green-haven-theme' ),
                'default'     => '',
            ],
        ],
        // Limit to 3 items
        'choices' => [
            'limit' => 3,
        ],
    ]
);






// OUR LATEST TRANSFORMATIONS Section
new \Kirki\Section(
    'our_latest_transformations_section',
    [
        'title'       => esc_html__( 'OUR LATEST TRANSFORMATIONS', 'green-haven-theme' ),
        'description' => esc_html__( 'Customize your OUR LATEST TRANSFORMATIONS section', 'green-haven-theme' ),
        'panel'       => 'green_haven_home_panel',
        'priority'    => 190,
    ]
);

// Main Headline
new \Kirki\Field\Text(
    [
        'settings'    => 'green_haven_latest_transformations_headline',
        'label'       => esc_html__( 'Section Headline', 'green-haven-theme' ),
        'description' => esc_html__( 'Enter the main headline', 'green-haven-theme' ),
        'section'     => 'our_latest_transformations_section',
        'priority'    => 10,
        'default'     => esc_html__( 'OUR LATEST TRANSFORMATIONS', 'green-haven-theme' ),
    ]
);














// Repeater Field for Latest Transformations (Max 3 items)
new \Kirki\Field\Repeater(
    [
        'settings'     => 'green_haven_latest_transformations_repeater',
        'label'        => esc_html__( 'Transformation Items', 'green-haven-theme' ),
        'description'  => esc_html__( 'Add up to 3 transformation items', 'green-haven-theme' ),
        'section'      => 'our_latest_transformations_section',
        'priority'     => 20,
        'row_label'    => [
            'type'  => 'field',
            'value' => esc_html__( 'Item', 'green-haven-theme' ),
            'field' => 'item_title',
        ],
        'button_label' => esc_html__( 'Add New Item', 'green-haven-theme' ),
        'default'      => [],
        'fields'       => [
            // Image
            'item_image' => [
                'type'        => 'image',
                'label'       => esc_html__( 'Item Image', 'green-haven-theme' ),
                'description' => esc_html__( 'Upload image for this item', 'green-haven-theme' ),
                'default'     => '',
            ],
            // Title Text
            'item_title' => [
                'type'        => 'text',
                'label'       => esc_html__( 'Item Title', 'green-haven-theme' ),
                'description' => esc_html__( 'Enter the title', 'green-haven-theme' ),
                'default'     => '',
            ],
            // Primary Category Select (always visible)
            'primary_category' => [
                'type'        => 'select',
                'label'       => esc_html__( 'Primary Category', 'green-haven-theme' ),
                'description' => esc_html__( 'Select primary category', 'green-haven-theme' ),
                'default'     => 'residential',
                'choices'     => [
                      ''    => esc_html__( '', 'green-haven-theme' ),
                    'residential'    => esc_html__( 'Residential', 'green-haven-theme' ),
                    'commercial'     => esc_html__( 'Commercial', 'green-haven-theme' ),
                    'eco_friendly'   => esc_html__( 'Eco-Friendly', 'green-haven-theme' ),
                ],
            ],
            // Secondary Category Select (always visible)
           'secondary_category' => [
                'type'        => 'select',
                'label'       => esc_html__( 'Secondary Category', 'green-haven-theme' ),
                'description' => esc_html__( 'select secondary category', 'green-haven-theme' ),
                'default'     => 'residential',
                'choices'     => [
                      ''    => esc_html__( '', 'green-haven-theme' ),
                    'residential'    => esc_html__( 'Residential', 'green-haven-theme' ),
                    'commercial'     => esc_html__( 'Commercial', 'green-haven-theme' ),
                    'eco_friendly'   => esc_html__( 'Eco-Friendly', 'green-haven-theme' ),
                ],
            ],
         
           
         
            // Font Family Select
           
        ],
        'choices' => [
            'limit' => 3,
        ],
    ]
);




}



















































