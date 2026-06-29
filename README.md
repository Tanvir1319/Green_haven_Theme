# 🌿 Green Haven Theme

> A clean, modern, responsive WordPress theme purpose-built for garden businesses, landscaping companies, and plant-related service providers. Built from scratch without using any page-builder starter template.

---

## Table of Contents

1. [Project Overview](#1-project-overview)
2. [Theme Details](#2-theme-details)
3. [File & Folder Structure](#3-file--folder-structure)
4. [Core WordPress Features Supported](#4-core-wordpress-features-supported)
5. [Page Templates](#5-page-templates)
6. [Custom Post Type (CPT) — Portfolio](#6-custom-post-type-cpt--portfolio)
7. [Custom Taxonomy — Portfolio Category](#7-custom-taxonomy--portfolio-category)
8. [Kirki Customizer Integration](#8-kirki-customizer-integration)
9. [Theme Options Panel (Admin Settings)](#9-theme-options-panel-admin-settings)
10. [Navigation & Bootstrap NavWalker](#10-navigation--bootstrap-navwalker)
11. [Widget Areas & Sidebar](#11-widget-areas--sidebar)
12. [Third-Party Libraries & Assets](#12-third-party-libraries--assets)
13. [TGM Plugin Activation](#13-tgm-plugin-activation)
14. [WooCommerce Compatibility](#14-woocommerce-compatibility)
15. [Blog & Comment System](#15-blog--comment-system)
16. [Security & Best Practices](#16-security--best-practices)
17. [Installation Guide](#17-installation-guide)
18. [Required & Recommended Plugins](#18-required--recommended-plugins)
19. [Known Limitations](#19-known-limitations)
20. [Changelog](#20-changelog)

---

## 1. Project Overview

**Green Haven Theme** is an independently developed custom WordPress theme created as a personal project to demonstrate hands-on WordPress theme development skills. It targets businesses in the garden, landscaping, and horticultural industry and provides a complete website solution that includes a homepage, service page, portfolio page, contact page, and a fully functional blog — all manageable entirely through the WordPress admin panel and Customizer without touching any code.

The theme was built with the following goals in mind:

- Content editors should be able to manage every visible piece of text and imagery from the WordPress admin area or Customizer.
- The theme should follow WordPress coding standards and use native WordPress APIs (hooks, filters, `get_theme_mod`, `get_option`, `register_post_type`, etc.) rather than custom database queries.
- The codebase should be modular and maintainable — no monolithic `functions.php`.

---

## 2. Theme Details

| Property        | Value                                          |
|-----------------|------------------------------------------------|
| **Theme Name**  | Green Haven Theme                              |
| **Version**     | 1.0                                            |
| **Author**      | Tanvir                                         |
| **Text Domain** | `green-haven-theme`                            |
| **License**     | GNU General Public License v2 or later (GPLv2) |
| **Tags**        | blog, responsive, modern, minimal, elementor-supported |
| **Tested With** | WordPress 6.x                                  |
| **PHP Version** | 7.4+                                           |

---

## 3. File & Folder Structure

Understanding the file layout is essential for maintaining this theme. The theme follows a modular structure where `functions.php` acts purely as a loader and delegates all logic to dedicated files inside the `/inc` directory.

```
Green-Haven-Theme/
│
├── style.css                          # Theme header declaration (required by WordPress)
├── index.php                          # Blog listing page (main loop)
├── single.php                         # Single blog post template
├── home_page.php                      # Custom page template for the Homepage
├── service.php                        # Custom page template for the Services page
├── contact.php                        # Custom page template for the Contact page
├── archive-gh_portfolio.php           # Archive/Portfolio page template (CPT archive)
├── header.php                         # Site-wide header (navbar, logo, phone)
├── footer.php                         # Site-wide footer (logo, nav, social, newsletter)
├── sidebar.php                        # Blog sidebar
├── comments.php                       # Comment form and comment list
├── searchform.php                     # Custom search form markup
├── functions.php                      # Master loader — requires all /inc files
├── screenshot.png                     # Theme thumbnail shown in WP Appearance panel
│
├── assets/
│   ├── css/                           # All custom and vendor CSS files
│   ├── js/                            # All custom and vendor JavaScript files
│   ├── img/                           # Placeholder and default images
│   ├── webfonts/                      # Bundled Font Awesome web font files
│   └── admin/
│       └── green-haven-admin.js       # Admin-only JS (color picker, media uploader)
│
└── inc/
    ├── functions-php-parts/
    │   ├── theme-setup.php            # add_theme_support() declarations
    │   ├── assets.php                 # wp_enqueue_scripts() — all CSS & JS
    │   └── tgm.php                    # TGM Plugin Activation configuration
    │
    ├── kirki-customizer/
    │   ├── home-kirki-customizer.php  # Customizer panels/sections for Homepage
    │   ├── service-kirki-customizer.php # Customizer panels/sections for Service page
    │   └── contact-kirki-customizer.php # Customizer panels/sections for Contact page
    │
    ├── cpt/
    │   └── porfolio-cpt.php           # Portfolio CPT, Taxonomy, Admin Menu & Columns
    │
    ├── common/
    │   └── cta-section.php            # Reusable Call-To-Action section partial
    │
    ├── home-page-1-parts/
    │   ├── slider.php                 # Hero carousel section
    │   ├── about-us.php               # About Us section
    │   ├── why-choose-us.php          # Why Choose Us feature cards
    │   ├── complete-garden-solution.php # Services overview cards
    │   └── our-latest-transformation.php # Portfolio preview section on homepage
    │
    ├── service-page-parts/
    │   ├── service-hero.php           # Service page hero/banner
    │   ├── service-header.php         # Service page title header
    │   └── service-grid.php           # Services grid with load-more
    │
    ├── contact-parts/
    │   ├── contact-hero.php           # Contact page hero banner
    │   └── contact-rest.php           # Contact form and details section
    │
    ├── tgm/
    │   └── class-tgm-plugin-activation.php # TGM library (third-party, unmodified)
    │
    ├── class-bootstrap-navwalker.php  # Bootstrap 5 compatible nav menu walker
    └── green-haven-theme-options.php  # Admin Settings: CTA, Phone, Footer options
```

### Why this modular structure?

Rather than writing all functionality in a single `functions.php` — which becomes unmanageable as a theme grows — this theme splits each concern into its own file. `functions.php` simply requires each file in order. This mirrors the approach used in professionally sold themes on ThemeForest and makes onboarding new developers straightforward.

---

## 4. Core WordPress Features Supported

Declared inside `inc/functions-php-parts/theme-setup.php` via the `after_setup_theme` hook:

| Feature                          | What It Does                                                                 |
|----------------------------------|------------------------------------------------------------------------------|
| `title-tag`                      | Lets WordPress control the `<title>` tag rather than hard-coding it          |
| `post-thumbnails`                | Enables Featured Image support on posts and pages                            |
| `automatic-feed-links`           | Adds RSS feed links to the `<head>` automatically                            |
| `html5`                          | Outputs valid HTML5 markup for forms, galleries, and comment lists           |
| `custom-logo`                    | Enables the built-in WordPress logo uploader (flex width and height)         |
| `align-wide`                     | Allows the Gutenberg block editor to output full-width and wide-aligned blocks |
| `editor-styles`                  | Applies theme styles inside the Gutenberg editor for a true WYSIWYG experience |
| `responsive-embeds`              | Makes embedded videos and iframes scale responsively                         |
| `wp-block-styles`                | Loads default block styles from WordPress core                               |
| `customize-selective-refresh-widgets` | Enables live preview of widget changes in the Customizer                |
| `woocommerce`                    | Declares WooCommerce compatibility (see Section 14)                          |

Two navigation menu locations are also registered:

- **Primary Menu** — displayed in the sticky navbar at the top of every page.
- **Footer Menu** — displayed inside the footer widget area.

---

## 5. Page Templates

WordPress supports **Custom Page Templates**, which allow the same CMS to power completely different page layouts simply by selecting a template from the page edit screen. Green Haven uses this pattern extensively.

| Template File              | Template Name          | Purpose                                                              |
|----------------------------|------------------------|----------------------------------------------------------------------|
| `home_page.php`            | *(set as front page)*  | Full homepage — slider, about, why choose us, services, portfolio preview |
| `service.php`              | Service Page Template  | Dedicated services page with hero, header, and services grid         |
| `contact.php`              | Contact Page Template  | Contact page with hero section and Contact Form 7 integration        |
| `archive-gh_portfolio.php` | Portfolio Page Template | Filterable portfolio grid powered by the `gh_portfolio` CPT          |
| `index.php`                | Blog                   | Standard WordPress blog listing with pagination and sidebar           |
| `single.php`               | Single Post            | Single blog post view with featured image, meta, content, and comments |

Each template calls `get_header()` and `get_footer()` to maintain consistent site-wide markup, and then includes the relevant partial files from `/inc/`.

---

## 6. Custom Post Type (CPT) — Portfolio

**File:** `inc/cpt/porfolio-cpt.php`

### What is a Custom Post Type?

By default, WordPress ships with two built-in content types: **Posts** (for blog articles) and **Pages** (for static content). A **Custom Post Type (CPT)** extends WordPress to support entirely new types of content with their own admin screens, URLs, and data management — without requiring a separate plugin or database table outside of WordPress's own `wp_posts` table.

In Green Haven, a `gh_portfolio` CPT was created to manage portfolio items (completed garden projects) independently from blog posts. This means portfolio items have their own section in the admin, their own archive URL (`/portfolio/`), and can be categorised using a dedicated taxonomy.

### Registration Details

| Property             | Value                                     |
|----------------------|-------------------------------------------|
| **Post Type Slug**   | `gh_portfolio`                            |
| **Archive URL**      | `/portfolio/`                             |
| **Gutenberg Ready**  | Yes (`show_in_rest: true`)                |
| **Supports**         | Title, Featured Image, Excerpt, Revisions |
| **Hierarchical**     | No (flat list, like Posts)                |
| **Has Archive**      | Yes                                       |

> **Why `show_in_rest: true`?** This makes the post type available to the WordPress REST API and also enables the Gutenberg (block) editor for this post type. Without it, the classic editor fallback would be used.

### Custom Admin Menu

Rather than having the Portfolio post type appear buried inside the default "Posts" section of the admin, a completely custom top-level admin menu was built using `add_menu_page()`. It contains three submenus:

1. **Portfolio Headline** — A settings page (described in Section 9) to set the heading text shown at the top of the portfolio page.
2. **All Portfolio** — The standard CPT list table showing all portfolio entries.
3. **Add New Portfolio** — Direct link to the post creation screen for the CPT.

The active menu state is also corrected using the `parent_file` and `submenu_file` filters, because WordPress does not automatically highlight custom admin menus when you are on a CPT edit screen — this is a known WordPress quirk that requires explicit handling.

### Custom Admin Columns

The default list table for any post type shows only Title and Date. For the Portfolio CPT, three additional columns were added:

| Column       | What It Shows                                             |
|--------------|-----------------------------------------------------------|
| **Image**    | A 60×60 px thumbnail of the portfolio item's featured image |
| **Category** | The `gh_portfolio_cat` taxonomy terms assigned to the item, as clickable filter links |
| **Date**     | Standard WordPress date column                            |

The Category column is also made **sortable**, allowing editors to reorder the list table by category.

---

## 7. Custom Taxonomy — Portfolio Category

**Registered inside:** `inc/cpt/porfolio-cpt.php`

### What is a Custom Taxonomy?

A **taxonomy** in WordPress is a way to group or classify content. The two built-in ones are **Categories** (hierarchical) and **Tags** (flat). A Custom Taxonomy allows creating new classification systems for any post type.

For the `gh_portfolio` CPT, a custom taxonomy called `gh_portfolio_cat` (Portfolio Category) was registered. This allows portfolio items to be organised into named groups such as "Garden Design", "Lawn Care", or "Landscaping".

| Property         | Value                                                          |
|------------------|----------------------------------------------------------------|
| **Taxonomy Slug**| `gh_portfolio_cat`                                             |
| **Archive URL**  | `/portfolio-category/{term-slug}/`                             |
| **Hierarchical** | Yes (behaves like Categories, not Tags — supports parent/child)|
| **REST API**     | Enabled (`show_in_rest: true`)                                 |

### How It Powers the Portfolio Filter

On the front-end portfolio page (`archive-gh_portfolio.php`), the taxonomy terms are dynamically fetched using `get_terms()` and rendered as filter buttons. The JavaScript library **MixItUp** reads the taxonomy slug from each portfolio card and shows or hides items based on the active filter — without any page reload. This creates an interactive, filterable gallery purely from WordPress data with no hardcoded categories.

---

## 8. Kirki Customizer Integration

**Files:** `inc/kirki-customizer/`

### What is the WordPress Customizer?

The **WordPress Customizer** (Appearance → Customize) is the live preview tool built into WordPress core that lets site owners change settings and see results in real time before publishing. It natively supports simple fields like Site Title, Logo, and Background Color.

**Kirki** is a framework that dramatically extends the Customizer with advanced field types such as Repeaters (dynamic, addable rows), Image pickers, Color pickers with alpha channel support, and more — all while integrating cleanly with WordPress core APIs.

### Why Kirki instead of ACF or a theme options page for this?

The Customizer provides **real-time live preview**. When a content editor changes a slider image or section heading, they can see the result on the right side of the screen instantly before saving. This is a better editorial experience than a standard settings page. Kirki was chosen because it extends the Customizer with the field types needed (especially Repeater fields) without requiring a paid plugin.

### Panel Structure

Three separate Kirki panels and their sections are registered — one per page template. Each panel is controlled by an `active_callback` function that checks the current page's template, so the Customizer only shows relevant sections when previewing the corresponding page. This prevents the Customizer sidebar from becoming cluttered with irrelevant options.

---

### Homepage Customizer (`home-kirki-customizer.php`)

**Panel:** Green Haven Theme Panel *(visible only on the Homepage template)*

| Section                     | Field Type | What It Controls                                                         |
|-----------------------------|------------|--------------------------------------------------------------------------|
| **Slider Section**          | Repeater   | Up to 9 slide cards. Each slide has: background image, title, description, button text, button URL, and button colour (with alpha) |
| **About Us Section**        | Image + Text | Left-side image, section label/title, subtitle, and a rich-text description |
| **Complete Garden Solutions** | Repeater + Text | Section headline and up to 4 service cards with Font Awesome icon, title, and description |
| **Why Choose Us**           | Repeater + Text | Section headline and up to 3 feature cards with Font Awesome icon, title, and description |
| **Our Latest Transformation** | *(pulled from CPT)* | Displays the latest portfolio items automatically from the `gh_portfolio` CPT |

> **Repeater fields** work like a dynamic table of rows — the content editor clicks "Add New Slide" (or "Add New Card") and fills in a form. The rows can be reordered by dragging. Each row maps to one slide or one service card on the front end.

---

### Service Page Customizer (`service-kirki-customizer.php`)

**Panel:** Green Haven Theme Panel *(visible only on the Service page template)*

| Section             | What It Controls                                                  |
|---------------------|-------------------------------------------------------------------|
| **Service Hero**    | Hero banner heading, subheading, and background image             |
| **Service Grid**    | Individual service cards with icon, title, description, and a load-more button |

---

### Contact Page Customizer (`contact-kirki-customizer.php`)

**Panel:** Green Haven Theme Panel *(visible only on the Contact page template)*

| Section            | What It Controls                                     |
|--------------------|------------------------------------------------------|
| **Contact Hero**   | Hero banner heading and background image             |
| **Contact Details**| Address, phone, email, and embedded map options       |

---

## 9. Theme Options Panel (Admin Settings)

**File:** `inc/green-haven-theme-options.php`

Beyond the Customizer, some settings are better suited to a traditional admin options page — settings that are site-wide, not page-specific, and do not need live preview. Green Haven implements these using the native WordPress **Settings API** (`register_setting`, `settings_fields`, `options.php`).

A top-level admin menu called **Green Haven Theme Options** is added, with three sub-pages:

### CTA Option (Call To Action)

Controls the site-wide CTA banner that appears on multiple pages. All fields are saved to the `green_haven_cta_options` option in `wp_options`.

| Field                       | Type              | What It Controls                                  |
|-----------------------------|-------------------|---------------------------------------------------|
| Title Text                  | Text              | The main heading in the CTA section               |
| Button Text                 | Text              | Label on the CTA action button                    |
| Button Background Colour    | Colour Picker     | Uses the native WordPress `wp_color_picker`        |
| Title Background Colour     | Colour Picker     | Background colour behind the CTA headline         |
| Title Background Image      | Media Uploader    | Optional background image for the CTA section     |
| Tick Mark Option            | Checkbox          | Toggle to show or hide decorative tick mark icons |

### Phone Number Header

Controls the phone number and its background colour shown in the top navigation bar. Saved to `green_haven_phone_number_options`.

| Field                      | Type          | What It Controls                            |
|----------------------------|---------------|---------------------------------------------|
| Phone Number               | Text          | The phone number displayed in the navbar    |
| Background Colour          | Colour Picker | The colour of the phone number badge/button |

### Footer Settings

Controls the entire footer content. Saved to `green_haven_footer_options`.

| Field                | Type           | What It Controls                                              |
|----------------------|----------------|---------------------------------------------------------------|
| Footer Logo          | Media Uploader | Logo image displayed in the footer                            |
| Footer Description   | Textarea       | Tagline or short paragraph below the footer logo             |
| Footer Menu Text     | Text           | Label above the footer navigation links                       |
| Footer Menu          | Menu Selector  | Dropdown to select which registered menu displays in the footer |
| Follow Us Text       | Text           | Label above the social media icons                            |
| Social Links         | Repeater (JS)  | Up to 4 social profiles with URL and icon (Facebook, Instagram, YouTube, LinkedIn) |
| Newsletter Text      | Text           | Heading above the newsletter form                             |
| Newsletter Shortcode | Text           | Paste any form shortcode (e.g., from Contact Form 7) here    |

> **Admin JS (`assets/admin/green-haven-admin.js`):** The admin options page loads WordPress's built-in colour picker (`wp-color-picker`) and media uploader (`wp_enqueue_media`) only on the relevant admin pages — not globally — to avoid any performance impact on unrelated admin screens.

### Portfolio Headline (inside Portfolio admin menu)

A separate lightweight settings page within the Portfolio CPT admin menu allows setting the headline text displayed at the top of the Portfolio archive page. This keeps portfolio-related settings logically grouped with the CPT rather than inside the theme options panel.

---

## 10. Navigation & Bootstrap NavWalker

**File:** `inc/class-bootstrap-navwalker.php`

WordPress generates navigation menus using its built-in `wp_nav_menu()` function, which outputs HTML. However, the default output is not compatible with Bootstrap 5's navbar markup (which requires specific classes like `nav-link`, `dropdown-toggle`, and `dropdown-menu`).

The `Green_Haven_Bootstrap_Navwalker` class extends WordPress's native `Walker_Nav_Menu` class to transform the WordPress menu output into markup that Bootstrap 5 can understand. This enables:

- **Dropdown submenus** created by nesting items in Appearance → Menus.
- **Active state** styling consistent with Bootstrap's `active` class.
- **ARIA accessibility attributes** on dropdown toggle buttons.

The navwalker is passed to `wp_nav_menu()` via the `'walker'` argument. No plugin is required.

---

## 11. Widget Areas & Sidebar

**Registered in:** `functions.php`

A single widget area — the **Blog Sidebar** — is registered using `register_sidebar()`. It appears on the blog listing page (`index.php`) and single post pages (`single.php`).

```
Widget Area ID:     blog-sidebar
Widget Wrapper:     <aside class="gh-sidebar"><div id="%1$s" class="gh-sidebar-card widget blog-widget %2$s">
Title Wrapper:      <h3 class="gh-sidebar-title">
```

The block-based widget editor (introduced in WordPress 5.8) is intentionally disabled using the `use_widgets_block_editor` filter, so the classic drag-and-drop widget screen is used instead. This is a deliberate decision for simpler sidebar management without requiring Gutenberg knowledge.

---

## 12. Third-Party Libraries & Assets

All front-end libraries are bundled locally within the theme. No CDN calls are made from the front end, which improves reliability and eliminates external dependencies.

**File:** `inc/functions-php-parts/assets.php`

All assets are registered and enqueued using `wp_enqueue_style()` and `wp_enqueue_script()` inside the `wp_enqueue_scripts` hook with proper dependency declarations. This ensures WordPress loads them in the correct order and prevents duplicate loading.

| Library                   | Version | Type       | Purpose                                                    |
|---------------------------|---------|------------|------------------------------------------------------------|
| **Bootstrap**             | 5.3.0   | CSS + JS   | Responsive grid, navbar, utility classes                   |
| **Font Awesome**          | 6.4.0   | CSS + Fonts| Icon library (used for service icons, social icons, etc.)  |
| **Owl Carousel**          | 2.3.4   | CSS + JS   | Powers the homepage hero slider                            |
| **GLightbox**             | 3.0.0   | CSS + JS   | Lightbox popup for portfolio images                        |
| **MixItUp**               | 3.3.1   | JS         | Animated portfolio filter (category-based show/hide)       |
| **jQuery**                | (WP Core) | JS       | JavaScript foundation (bundled with WordPress)             |

### Custom JavaScript Files

| File                            | Purpose                                                               |
|---------------------------------|-----------------------------------------------------------------------|
| `home-page-carousel.js`         | Initialises the Owl Carousel on the homepage hero section             |
| `portfolio-filter.js`           | Initialises MixItUp on the portfolio grid and wires it to filter buttons |
| `portfolio-page-lightbox.js`    | Initialises GLightbox on portfolio images for full-screen preview     |
| `navigation.js`                 | Handles mobile menu accessibility and keyboard navigation             |
| `green-haven-admin.js`          | *(Admin only)* Colour picker initialisation and media uploader logic  |

---

## 13. TGM Plugin Activation

**File:** `inc/functions-php-parts/tgm.php`  
**Library:** `inc/tgm/class-tgm-plugin-activation.php`

### What is TGM Plugin Activation?

**TGM Plugin Activation (TGMPA)** is a widely used PHP library in the WordPress theme development community (used by thousands of ThemeForest themes) that allows a theme to notify users about required or recommended plugins via a managed admin notice, and provides a one-click install-and-activate workflow directly from the WordPress dashboard.

Without TGMPA, if a theme requires a plugin (e.g., Kirki for the Customizer), there is no native WordPress mechanism to prompt the user to install it. TGMPA fills this gap cleanly.

### Plugins Managed by TGMPA

| Plugin                       | Status       | Why It Is Needed                                                                              |
|------------------------------|--------------|-----------------------------------------------------------------------------------------------|
| **Contact Form 7**           | Required     | Powers the contact form on the Contact page. The Contact page includes a CF7 shortcode block. |
| **Kirki Customizer Framework**| Required    | Provides the advanced Customizer fields (Repeater, Image, Colour with Alpha) used throughout the theme. Without Kirki, the Customizer panels will not appear and homepage/service/contact content cannot be managed. |

> When a user installs the theme without these plugins, a dismissable admin notice appears at the top of the dashboard with a direct link to the plugin installation page. This is standard behaviour for professionally developed WordPress themes.

---

## 14. WooCommerce Compatibility

**Declared in:** `inc/functions-php-parts/theme-setup.php`

The theme declares WooCommerce compatibility via three `add_theme_support()` calls:

```php
add_theme_support( 'woocommerce' );
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
```

| Declaration                     | What It Enables                                                      |
|---------------------------------|----------------------------------------------------------------------|
| `woocommerce`                   | Tells WooCommerce the theme has been tested for compatibility; prevents WooCommerce from showing "unsupported theme" warnings |
| `wc-product-gallery-zoom`       | Enables zoom-on-hover on product images                              |
| `wc-product-gallery-lightbox`   | Enables the built-in WooCommerce lightbox for product images         |
| `wc-product-gallery-slider`     | Enables a thumbnail slider for multiple product images               |

> **Note on scope:** WooCommerce template overrides (custom `woocommerce/` folder templates for cart, checkout, product pages, etc.) are **not included** in this version of the theme. The declarations above ensure WooCommerce can activate and display its default templates without breaking the site layout. Full WooCommerce template customisation is planned for a future version.

---

## 15. Blog & Comment System

### Blog Listing (`index.php`)

The standard WordPress loop is used with a `pre_get_posts` hook to ensure pagination works correctly on the blog listing page:

```php
function green_haven_pagination( $query ) {
    if ( ! is_admin() && $query->is_main_query() && $query->is_home() ) {
        $query->set( 'paged', get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 );
    }
}
add_action( 'pre_get_posts', 'green_haven_pagination' );
```

Each blog card displays: featured image, post title, post date, author, categories, and an excerpt with a Read More link.

### Single Post (`single.php`)

The single post template includes:
- Large featured image
- Post meta card (author, date, categories, reading time)
- Full post content via `the_content()`
- Comment form and threaded comment list via `comments_template()`

### Comments (`comments.php`)

The comment reply script (`comment-reply`) is conditionally loaded only on singular posts where comments are open and threaded comments are enabled — using the `wp_enqueue_scripts` hook with an appropriate conditional check. This avoids loading unnecessary JavaScript on all pages.

---

## 16. Security & Best Practices

The following WordPress security best practices are implemented throughout the theme:

| Practice               | Where Applied                                                                |
|------------------------|------------------------------------------------------------------------------|
| **Nonce Verification** | All form submissions in admin pages (portfolio headline, CTA, phone, footer) use `wp_nonce_field()` and `wp_verify_nonce()` to prevent Cross-Site Request Forgery (CSRF) |
| **Capability Checks**  | Admin pages check `current_user_can( 'manage_options' )` before processing any form data |
| **Output Escaping**    | All output uses the appropriate escaping function: `esc_html()`, `esc_url()`, `esc_attr()`, `wp_kses_post()` |
| **Input Sanitisation** | All saved input is sanitised: `sanitize_text_field()`, `sanitize_hex_color()`, `esc_url_raw()`, `absint()` |
| **Direct Access Block**| `if ( ! defined( 'ABSPATH' ) ) { exit; }` is placed at the top of each PHP file to block direct HTTP access |
| **`wp_enqueue_*`**     | Scripts and styles are always registered through WordPress's enqueue system — never printed directly into HTML |

---

## 17. Installation Guide

### Step 1 — Upload the Theme

1. Log in to your WordPress admin dashboard.
2. Go to **Appearance → Themes**.
3. Click **Add New → Upload Theme**.
4. Upload the `Green-Haven-Theme.zip` file.
5. Click **Install Now**, then **Activate**.

### Step 2 — Install Required Plugins

After activating the theme, a notice will appear at the top of the dashboard:

> *"Green Haven theme requires the following plugins: Contact Form 7, Kirki Customizer Framework."*

Click **Begin installing plugins** and install both. Activate them when prompted.

### Step 3 — Create Your Pages

Create the following WordPress pages and assign their templates:

| Page Title     | Page Template to Assign   |
|----------------|---------------------------|
| Home           | *(Set as Front Page — no template needed, it uses `home_page.php` automatically when set as the static front page)* |
| Services       | Service Page Template     |
| Portfolio      | Portfolio Page Template   |
| Contact        | Contact Page Template     |
| Blog           | *(Set as Posts Page in Settings → Reading)* |

### Step 4 — Assign Menus

1. Go to **Appearance → Menus**.
2. Create a menu, add your pages to it, and assign it to the **Primary Menu** location.
3. Optionally, create a second menu for the **Footer Menu** location.

### Step 5 — Customise via the Customizer

1. Go to **Appearance → Customize**.
2. Navigate to the **Green Haven Theme Panel** (visible when previewing the Homepage or Service/Contact pages).
3. Add your slider images, section content, and feature card data.

### Step 6 — Configure Admin Settings

1. Go to **Green Haven Theme Options** in the left admin sidebar.
2. Set your CTA text, phone number, footer content, and social links.

### Step 7 — Add Portfolio Items

1. Go to **Portfolio → Portfolio Categories** and create category terms (e.g., Lawn Care, Garden Design).
2. Go to **Portfolio → Add New Portfolio** and add portfolio entries with a featured image, title, excerpt, and assign a category.

---

## 18. Required & Recommended Plugins

| Plugin                       | Type        | Why Needed                                                |
|------------------------------|-------------|-----------------------------------------------------------|
| Contact Form 7               | Required    | Contact page form functionality                           |
| Kirki Customizer Framework   | Required    | All Customizer fields (Repeater, Image, Color)            |
| WooCommerce                  | Optional    | E-commerce functionality (theme is compatible, not required) |
| Elementor                    | Optional    | The theme is tagged as Elementor-compatible; Elementor can be used on any page |

---

## 19. Known Limitations

- **WooCommerce template overrides** are not included. WooCommerce will use its own default templates (shop page, product page, cart, checkout). These default templates will render correctly but will not inherit the theme's custom styling fully.
- The **Portfolio CPT** does not have a single post template (`single-gh_portfolio.php`). Clicking a portfolio item will use WordPress's default fallback template. A dedicated single portfolio view is planned for the next version.
- The **Kirki Customizer Framework** must be installed as a plugin. If Kirki is deactivated, Customizer content (slider, about section, etc.) will not appear on the front end.
- The theme is currently **single-language** (English). The text domain `green-haven-theme` is set up correctly for translation, and a `/languages` directory is present, but no `.pot` file or translations have been provided yet.

---

## 20. Changelog

### Version 1.0 — Initial Release (June 2026)

- Custom Homepage template with Kirki-powered Repeater slider (up to 9 slides), About Us, Why Choose Us, Garden Solutions, and Portfolio Preview sections.
- Custom Service page template with Kirki Customizer integration.
- Custom Contact page template with Contact Form 7 support.
- `gh_portfolio` Custom Post Type with `gh_portfolio_cat` Custom Taxonomy.
- Custom Portfolio admin menu with Headline settings, All Portfolio list, and Add New.
- Custom Admin Columns for Portfolio CPT (thumbnail, category, sortable).
- Admin Theme Options panel: CTA section, phone number header, and full footer settings.
- Bootstrap 5 NavWalker for dropdown menu support.
- Blog listing page with paginated loop and sidebar.
- Single post template with featured image, meta, content, and comments.
- TGM Plugin Activation for required plugin notices.
- WooCommerce theme support declarations.
- Fully modular `functions.php` with split `/inc` files.
- All CSS and JS bundled locally (no CDN dependencies).
- Security: nonce verification, capability checks, output escaping, input sanitisation.

---

*Green Haven Theme — Built by Tanvir | Version 1.0 | GPLv2 License*