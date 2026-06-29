<?php

// 1. Require the TGM Plugin Activation file
require_once get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';

// 2. Hook into TGM to register required and recommended plugins
add_action( 'tgmpa_register', 'green_haven_register_required_plugins' );

/**
 * Register the required and recommended plugins for Green Haven theme
 *
 * @since 1.0.0
 * @return void
 */
function green_haven_register_required_plugins() {
    
    // Array of plugins to install/activate
    $plugins = array(
        
            // Required Plugin
        array(
            'name'     => 'Contact Form 7',
            'slug'     => 'contact-form-7',
            'required' => true,
        ),


        // Required Plugin
         array(
            'name'     => 'Kirki Customizer Framework',
            'slug'     => 'kirki',
            'required' => true,
        ),

    
        
    );

    // TGM configuration settings
    $config = array(
        'id'           => 'green-haven-theme',           // Unique ID for this theme
        'default_path' => '',                            // Default absolute path to bundled plugins
        'menu'         => 'tgmpa-install-plugins',       // Menu slug
        'parent_slug'  => 'themes.php',                  // Parent menu slug
        'capability'   => 'edit_theme_options',          // Capability needed to view plugin install page
        'has_notices'  => true,                          // Show admin notices or not
        'dismissable'  => true,                          // Allow users to dismiss the notice
        'dismiss_msg'  => '',                            // Message to display when dismissing
        'is_automatic' => false,                         // Automatically activate plugins after installation
        'message'      => '',                            // Custom message to display
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'green-haven-theme' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'green-haven-theme' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'green-haven-theme' ),
            'updating'                        => esc_html__( 'Updating Plugin: %s', 'green-haven-theme' ),
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'green-haven-theme' ),
            'notice_can_install_required'     => _n_noop(
                'Green Haven theme requires the following plugin: %1$s.',
                'Green Haven theme requires the following plugins: %1$s.',
                'green-haven-theme'
            ),
            'notice_can_install_recommended'  => _n_noop(
                'Green Haven theme recommends the following plugin: %1$s.',
                'Green Haven theme recommends the following plugins: %1$s.',
                'green-haven-theme'
            ),
            'notice_ask_to_update'            => _n_noop(
                'The following plugin needs to be updated to its latest version: %1$s.',
                'The following plugins need to be updated to their latest version: %1$s.',
                'green-haven-theme'
            ),
            'notice_ask_to_update_maybe'      => _n_noop(
                'There is an update available for: %1$s.',
                'There are updates available for the following plugins: %1$s.',
                'green-haven-theme'
            ),
            'notice_can_activate_required'    => _n_noop(
                'The following required plugin is currently inactive: %1$s.',
                'The following required plugins are currently inactive: %1$s.',
                'green-haven-theme'
            ),
            'notice_can_activate_recommended' => _n_noop(
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                'green-haven-theme'
            ),
            'install_link'                    => _n_noop(
                'Begin installing plugin',
                'Begin installing plugins',
                'green-haven-theme'
            ),
            'update_link'                     => _n_noop(
                'Begin updating plugin',
                'Begin updating plugins',
                'green-haven-theme'
            ),
            'activate_link'                   => _n_noop(
                'Begin activating plugin',
                'Begin activating plugins',
                'green-haven-theme'
            ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'green-haven-theme' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'green-haven-theme' ),
            'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'green-haven-theme' ),
            'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'green-haven-theme' ),
            'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'green-haven-theme' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'green-haven-theme' ),
            'dismiss'                         => esc_html__( 'Dismiss this notice', 'green-haven-theme' ),
            'notice_cannot_install_activate'  => esc_html__( 'There are one or more required or recommended plugins to install, update or activate.', 'green-haven-theme' ),
            'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'green-haven-theme' ),
            'nag_type'                        => 'updated',
        ),
    );

    tgmpa( $plugins, $config );
}