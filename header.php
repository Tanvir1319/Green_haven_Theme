<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container-fluid main-container">
            <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <div class="logo-container">
                    <div class="logo-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <?php if ( has_custom_logo() ) : ?>
	<?php the_custom_logo(); ?>
<?php else : ?>
	<span class="logo-text"><?php bloginfo( 'name' ); ?></span>
<?php endif; ?>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <?php
                wp_nav_menu( array(
                    'theme_location'  => 'primary',
                    'container'       => false,
                    'menu_class'      => 'navbar-nav mx-auto',
                    'fallback_cb'     => '__return_false',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 2,
                    'walker'          => new Green_Haven_Bootstrap_Navwalker(),
                ) );
                ?>

                <?php
                $phone_options = get_option( 'green_haven_phone_number_options' );

                $phone_number = isset( $phone_options['phone_number'] ) ? $phone_options['phone_number'] : '';
                $phone_color  = isset( $phone_options['phone_number_background_color'] ) ? $phone_options['phone_number_background_color'] : '';
                ?>

                <?php if ( ! empty( $phone_number ) ) : ?>
                    <div
                        class="phone-container"
                        style="<?php echo ! empty( $phone_color ) ? 'color: ' . esc_attr( $phone_color ) . ';' : ''; ?>"
                    >
                        <i class="fas fa-phone-alt"></i>
                        <span><?php echo esc_html( $phone_number ); ?></span>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </nav>