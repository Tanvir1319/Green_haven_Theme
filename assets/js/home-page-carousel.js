/**
 * =========================================
 * HERO CAROUSEL INITIALIZATION
 * Green Haven Website
 * 
 * @package    Green_Haven
 * @subpackage Hero_Slider
 * @version    1.0.0
 * 
 * Uses: Owl Carousel 2 for hero slider
 * =========================================
 */

(function($) {
    'use strict';

    /**
     * Initialize hero carousel when DOM is ready
     */
    $(document).ready(function() {
        initHeroCarousel();
    });

    /**
     * Initialize Owl Carousel for hero slider
     * 
     * @since 1.0.0
     */
    function initHeroCarousel() {
        var $heroCarousel = $('.hero-carousel');

        if (!$heroCarousel.length) {
            console.warn('Hero carousel element not found');
            return;
        }

        // Initialize Owl Carousel - No arrows, only dots
        $heroCarousel.owlCarousel({
            items: 1,
            loop: true,
            margin: 0,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            smartSpeed: 600
        });

        console.log('Hero carousel initialized successfully');
    }

})(jQuery);