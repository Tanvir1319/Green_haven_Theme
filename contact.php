<?php 
/*
Template Name: Contact Page Template
*/


get_header(); ?>

    <!-- HERO SECTION -->
   <?php  require_once get_template_directory() . '/inc/contact-parts/contact-hero.php'; ?>

    <!-- MAIN CONTACT SECTION -->
    <section class="contact-main-section">
        <div class="container-fluid main-container">
            <div class="row">

                <!-- CONTACT FORM (LEFT) -->
                <div class="col-lg-6 mb-5 mb-lg-0">
             <?php echo do_shortcode('[contact-form-7 id="a5bab5e" title="Contact Form For Contact Us"]'); ?>
                </div>

                <!-- COMPANY INFORMATION (RIGHT) -->
                <?php  require_once get_template_directory() . '/inc/contact-parts/contact-rest.php'; ?>

            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <?php require_once get_template_directory() . '/inc/common/cta-section.php';  ?>

<?php get_footer(); ?>