<?php 
/*
Template Name: Service Page Template
*/


get_header(); 

require_once get_template_directory() . '/inc/service-page-parts/service-hero.php'; ?>



    <!-- Services Section -->
    <section class="services-section">
        <div class="container">
            <!-- Section Header -->
       <?php  require_once get_template_directory() . '/inc/service-page-parts/service-header.php'; ?>

            <!-- Services Grid -->
              <?php  require_once get_template_directory() . '/inc/service-page-parts/service-grid.php'; ?>
        </div>
    </section>

    <!-- CTA Section -->
   <?php require_once get_template_directory() . '/inc/common/cta-section.php';  ?>

  

<?php get_footer(); ?>