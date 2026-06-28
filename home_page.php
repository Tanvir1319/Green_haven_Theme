<?php 
/*
Template Name: Home Template
*/


get_header(); 

   /*
Slider Part
*/
   
require_once get_template_directory() . '/inc/home-page-1-parts/slider.php';
  /*
About Us Part
*/
  
 require_once get_template_directory() . '/inc/home-page-1-parts/about-us.php';
  /*
COMPLETE GARDEN SOLUTIONS
*/
    
    require_once get_template_directory() . '/inc/home-page-1-parts/complete-garden-solution.php';
 /*
WHY CHOOSE US
*/
    
  
require_once get_template_directory() . '/inc/home-page-1-parts/why-choose-us.php';
 /* OUR LATEST TRANSFORMATIONS 
*/

   
require_once get_template_directory() . '/inc/home-page-1-parts/our-latest-transformation.php';
/* BIG CTA SECTION
*/
    
    
require_once get_template_directory() . '/inc/common/cta-section.php';


    
 get_footer(); ?>
   