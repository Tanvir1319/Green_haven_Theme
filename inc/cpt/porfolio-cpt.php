<?php
/**
 * Portfolio Custom Post Type, Taxonomy, Admin Columns, and Options Page.
 *
 * @package GreenHavenTheme
 * @since   1.0.0
 */


// =============================================================================
// 1. REGISTER CUSTOM POST TYPE: Portfolio
// =============================================================================

/**
 * Register the 'gh_portfolio' custom post type.
 */
function gh_register_portfolio_cpt() {

    $labels = array(
        'name'                  => _x( 'Portfolios', 'Post type general name', 'green-haven-theme' ),
        'singular_name'         => _x( 'Portfolio', 'Post type singular name', 'green-haven-theme' ),
        'menu_name'             => _x( 'Portfolio', 'Admin Menu text', 'green-haven-theme' ),
        'name_admin_bar'        => _x( 'Portfolio', 'Add New on Toolbar', 'green-haven-theme' ),
        'add_new'               => __( 'Add New', 'green-haven-theme' ),
        'add_new_item'          => __( 'Add New Portfolio', 'green-haven-theme' ),
        'new_item'              => __( 'New Portfolio', 'green-haven-theme' ),
        'edit_item'             => __( 'Edit Portfolio', 'green-haven-theme' ),
        'view_item'             => __( 'View Portfolio', 'green-haven-theme' ),
        'all_items'             => __( 'All Portfolio', 'green-haven-theme' ),
        'search_items'          => __( 'Search Portfolios', 'green-haven-theme' ),
        'not_found'             => __( 'No portfolios found.', 'green-haven-theme' ),
        'not_found_in_trash'    => __( 'No portfolios found in Trash.', 'green-haven-theme' ),
        'featured_image'        => __( 'Portfolio Featured Image', 'green-haven-theme' ),
        'set_featured_image'    => __( 'Set featured image', 'green-haven-theme' ),
        'remove_featured_image' => __( 'Remove featured image', 'green-haven-theme' ),
        'use_featured_image'    => __( 'Use as featured image', 'green-haven-theme' ),
        'archives'              => __( 'Portfolio archives', 'green-haven-theme' ),
        'insert_into_item'      => __( 'Insert into portfolio', 'green-haven-theme' ),
        'uploaded_to_this_item' => __( 'Uploaded to this portfolio', 'green-haven-theme' ),
        'filter_items_list'     => __( 'Filter portfolios list', 'green-haven-theme' ),
        'items_list_navigation' => __( 'Portfolios list navigation', 'green-haven-theme' ),
        'items_list'            => __( 'Portfolios list', 'green-haven-theme' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => false, // We'll build a custom menu below.
        'show_in_rest'       => true,  // Enables Gutenberg support.
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'portfolio' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array(
            'title',
            
            'thumbnail', // Featured image support.
            'excerpt',
            'revisions',
        ),
    );

    register_post_type( 'gh_portfolio', $args );
}
add_action( 'init', 'gh_register_portfolio_cpt' );


// =============================================================================
// 2. REGISTER TAXONOMY: Portfolio Category
// =============================================================================

/**
 * Register the 'gh_portfolio_cat' taxonomy for 'gh_portfolio'.
 */
function gh_register_portfolio_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Portfolio Categories', 'Taxonomy general name', 'green-haven-theme' ),
        'singular_name'              => _x( 'Portfolio Category', 'Taxonomy singular name', 'green-haven-theme' ),
        'search_items'               => __( 'Search Portfolio Categories', 'green-haven-theme' ),
        'all_items'                  => __( 'All Portfolio Categories', 'green-haven-theme' ),
        'parent_item'                => __( 'Parent Portfolio Category', 'green-haven-theme' ),
        'parent_item_colon'          => __( 'Parent Portfolio Category:', 'green-haven-theme' ),
        'edit_item'                  => __( 'Edit Portfolio Category', 'green-haven-theme' ),
        'update_item'                => __( 'Update Portfolio Category', 'green-haven-theme' ),
        'add_new_item'               => __( 'Add New Portfolio Category', 'green-haven-theme' ),
        'new_item_name'              => __( 'New Portfolio Category Name', 'green-haven-theme' ),
        'menu_name'                  => __( 'Portfolio Categories', 'green-haven-theme' ),
        'not_found'                  => __( 'No portfolio categories found.', 'green-haven-theme' ),
        'no_terms'                   => __( 'No portfolio categories', 'green-haven-theme' ),
        'items_list_navigation'      => __( 'Portfolio categories list navigation', 'green-haven-theme' ),
        'items_list'                 => __( 'Portfolio categories list', 'green-haven-theme' ),
        'back_to_items'              => __( '&larr; Go to Portfolio Categories', 'green-haven-theme' ),
    );

    $args = array(
        'hierarchical'      => true, // Like categories (use false for tag-like behavior).
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => false, // We handle the column manually below.
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'portfolio-category' ),
    );

    register_taxonomy( 'gh_portfolio_cat', array( 'gh_portfolio' ), $args );
}
add_action( 'init', 'gh_register_portfolio_taxonomy' );


// =============================================================================
// 3. CUSTOM ADMIN MENU (Top-Level + Submenus)
// =============================================================================

/**
 * Add a top-level "Portfolio" menu with three submenus:
 *   1. Portfolio Headline (options/settings form)
 *   2. All Portfolio
 *   3. Add New Portfolio
 */
function gh_portfolio_admin_menu() {

    // Top-level menu pointing to the Portfolio Headline page.
    add_menu_page(
        __( 'Portfolio', 'green-haven-theme' ),        // Page title.
        __( 'Portfolio', 'green-haven-theme' ),        // Menu title.
        'manage_options',                               // Capability.
        'gh-portfolio',                                 // Menu slug (points to headline page).
        'gh_portfolio_headline_page',                   // Callback function.
        'dashicons-portfolio',                          // Icon.
        25                                              // Position.
    );

    // Submenu 1: Portfolio Headline (settings form).
    add_submenu_page(
        'gh-portfolio',
        __( 'Portfolio Headline', 'green-haven-theme' ),
        __( 'Portfolio Headline', 'green-haven-theme' ),
        'manage_options',
        'gh-portfolio',                                 // Same slug as parent = first submenu.
        'gh_portfolio_headline_page'
    );

    // Submenu 2: All Portfolio.
    add_submenu_page(
        'gh-portfolio',
        __( 'All Portfolio', 'green-haven-theme' ),
        __( 'All Portfolio', 'green-haven-theme' ),
        'edit_posts',
        'edit.php?post_type=gh_portfolio'
    );

    // Submenu 3: Add New Portfolio.
    add_submenu_page(
        'gh-portfolio',
        __( 'Add New Portfolio', 'green-haven-theme' ),
        __( 'Add New Portfolio', 'green-haven-theme' ),
        'edit_posts',
        'post-new.php?post_type=gh_portfolio'
    );
}
add_action( 'admin_menu', 'gh_portfolio_admin_menu' );


// =============================================================================
// 4. PORTFOLIO HEADLINE OPTIONS PAGE
// =============================================================================

/**
 * Render the Portfolio Headline settings page with a sanitized form.
 */
function gh_portfolio_headline_page() {

    // Save handler.
    if (
        isset( $_POST['gh_portfolio_headline_nonce'] ) &&
        wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['gh_portfolio_headline_nonce'] ) ), 'gh_save_portfolio_headline' ) &&
        current_user_can( 'manage_options' )
    ) {
        $headline    = isset( $_POST['gh_portfolio_headline'] )
            ? sanitize_text_field( wp_unslash( $_POST['gh_portfolio_headline'] ) )
            : '';
    

        update_option( 'gh_portfolio_headline', $headline );
     

        echo '<div class="notice notice-success is-dismissible"><p>'
            . esc_html__( 'Portfolio headline saved successfully.', 'green-haven-theme' )
            . '</p></div>';
    }

    $saved_headline    = get_option( 'gh_portfolio_headline', '' );
  
    ?>

    <div class="wrap">
        <h1><?php esc_html_e( 'Portfolio Headline', 'green-haven-theme' ); ?></h1>
        <form method="post" action="">
            <?php wp_nonce_field( 'gh_save_portfolio_headline', 'gh_portfolio_headline_nonce' ); ?>
            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for="gh_portfolio_headline">
                                <?php esc_html_e( 'Portfolio Headline', 'green-haven-theme' ); ?>
                            </label>
                        </th>
                        <td>
                            <input
                                type="text"
                                id="gh_portfolio_headline"
                                name="gh_portfolio_headline"
                                value="<?php echo esc_attr( $saved_headline ); ?>"
                                class="regular-text"
                                placeholder="<?php esc_attr_e( 'Enter portfolio section headline...', 'green-haven-theme' ); ?>"
                            />
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <?php submit_button( __( 'Save', 'green-haven-theme' ) ); ?>
        </form>
    </div>

    <?php
}


// =============================================================================
// 5. ADMIN COLUMNS FOR "ALL PORTFOLIO"
//    Shows: Featured Image | Title | Taxonomy | Date
// =============================================================================

/**
 * Register custom columns for the gh_portfolio post list table.
 *
 * @param array $columns Existing columns.
 * @return array Modified columns.
 */
function gh_portfolio_register_columns( $columns ) {

    $new_columns = array();

    // Inject thumbnail column right at the start, before 'cb'.
    $new_columns['cb']                   = $columns['cb'];
   
    $new_columns['title']                = $columns['title'];
    $new_columns['gh_featured_image']    = __( 'Image', 'green-haven-theme' );
    $new_columns['gh_portfolio_cat_col'] = __( 'Category', 'green-haven-theme' );
    $new_columns['date']                 = $columns['date'];

    return $new_columns;
}
add_filter( 'manage_gh_portfolio_posts_columns', 'gh_portfolio_register_columns' );


/**
 * Populate custom columns for the gh_portfolio post list table.
 *
 * @param string $column  Column slug.
 * @param int    $post_id Current post ID.
 */
function gh_portfolio_render_columns( $column, $post_id ) {

    switch ( $column ) {

        case 'gh_featured_image':
            if ( has_post_thumbnail( $post_id ) ) {
                echo '<a href="' . esc_url( get_edit_post_link( $post_id ) ) . '">';
                echo get_the_post_thumbnail( $post_id, array( 60, 60 ), array( 'style' => 'border-radius:4px;object-fit:cover;' ) );
                echo '</a>';
            } else {
                echo '<span aria-hidden="true">&#8212;</span>';
            }
            break;

        case 'gh_portfolio_cat_col':
            $terms = get_the_terms( $post_id, 'gh_portfolio_cat' );
            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                $term_links = array();
                foreach ( $terms as $term ) {
                    $term_links[] = sprintf(
                        '<a href="%s">%s</a>',
                        esc_url(
                            add_query_arg(
                                array(
                                    'post_type'       => 'gh_portfolio',
                                    'gh_portfolio_cat' => $term->slug,
                                ),
                                admin_url( 'edit.php' )
                            )
                        ),
                        esc_html( $term->name )
                    );
                }
                echo wp_kses_post( implode( ', ', $term_links ) );
            } else {
                echo '<span aria-hidden="true">&#8212;</span>';
            }
            break;
    }
}
add_action( 'manage_gh_portfolio_posts_custom_column', 'gh_portfolio_render_columns', 10, 2 );


/**
 * Make the category column sortable.
 *
 * @param array $columns Sortable columns.
 * @return array Modified sortable columns.
 */
function gh_portfolio_sortable_columns( $columns ) {
    $columns['gh_portfolio_cat_col'] = 'gh_portfolio_cat_col';
    return $columns;
}
add_filter( 'manage_edit-gh_portfolio_sortable_columns', 'gh_portfolio_sortable_columns' );


/**
 * Inline CSS for the image column width in admin.
 */
function gh_portfolio_admin_column_styles() {
    $screen = get_current_screen();
    if ( isset( $screen->post_type ) && 'gh_portfolio' === $screen->post_type ) {
        echo '<style>
            .column-gh_featured_image { width: 70px !important; }
            .column-gh_portfolio_cat_col { width: 160px; }
        </style>';
    }
}
add_action( 'admin_head', 'gh_portfolio_admin_column_styles' );


// =============================================================================
// 6. FIX ACTIVE MENU HIGHLIGHTING FOR CPT SUBMENUS
// =============================================================================

/**
 * Highlight the correct parent menu when editing/adding a portfolio item.
 *
 * @param string $parent_file The parent file slug.
 * @return string Corrected parent file slug.
 */
function gh_portfolio_fix_menu_highlight( $parent_file ) {
    global $current_screen;

    if ( 'gh_portfolio' === $current_screen->post_type ) {
        $parent_file = 'gh-portfolio';
    }

    return $parent_file;
}
add_filter( 'parent_file', 'gh_portfolio_fix_menu_highlight' );


/**
 * Highlight the correct submenu when on CPT screens.
 *
 * @param string $submenu_file The submenu file slug.
 * @return string Corrected submenu file slug.
 */
function gh_portfolio_fix_submenu_highlight( $submenu_file ) {
    global $current_screen, $pagenow;

    if ( 'gh_portfolio' !== $current_screen->post_type ) {
        return $submenu_file;
    }

    if ( 'post-new.php' === $pagenow ) {
        $submenu_file = 'post-new.php?post_type=gh_portfolio';
    } elseif ( 'edit.php' === $pagenow || 'post.php' === $pagenow ) {
        $submenu_file = 'edit.php?post_type=gh_portfolio';
    }

    return $submenu_file;
}
add_filter( 'submenu_file', 'gh_portfolio_fix_submenu_highlight' );