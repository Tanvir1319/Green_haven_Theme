/**
 * =========================================
 * PORTFOLIO FILTER & LIGHTBOX FUNCTIONALITY
 * Green Haven Website
 * 
 * @package    Green_Haven
 * @subpackage Portfolio
 * @version    1.0.0
 * 
 * Uses: MixItUp v3 for filtering + GLightbox for image lightbox
 * 
 * SVG Icons: Feather Icons (https://feathericons.com)
 * License: MIT License
 * Copyright (c) 2013-2023 Cole Bemis
 * =========================================
 */

(function() {
    'use strict';

    /**
     * Initialize portfolio filtering and lightbox when DOM is ready
     */
    document.addEventListener('DOMContentLoaded', function() {
        initPortfolioFilter();
        initLightbox();
    });

    /**
     * Initialize MixItUp filtering
     * 
     * @since 1.0.0
     */
    function initPortfolioFilter() {
        var containerEl = document.querySelector('.portfolio-grid');


        // Initialize MixItUp with simple fade animation
        var mixer = mixitup(containerEl, {
            selectors: {
                target: '.mix'
            },
            animation: {
                duration: 250,
                animateResizeContainer: false,
                animateResizeTargets: false,
                effects: 'fade'
            }
        });

        // Handle filter button clicks
        var filterButtons = document.querySelectorAll('.filter-btn');

        filterButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var filter = this.getAttribute('data-filter');

                // Remove active class from all buttons
                filterButtons.forEach(function(btn) {
                    btn.classList.remove('active');
                });

                // Add active class to clicked button
                this.classList.add('active');

                // Apply filter
                if (filter === 'all') {
                    mixer.filter('all');
                } else {
                    mixer.filter(filter);
                }
            });
        });

    
    }

    /**
     * Resolve the theme base URL from this script's own <script> src attribute.
     * This avoids hardcoding paths and works regardless of WordPress install location.
     * 
     * @since 1.0.0
     * @returns {string} Base URL ending without trailing slash
     */
    function getThemeBaseUrl() {
        var scripts = document.querySelectorAll('script[src]');
        for (var i = 0; i < scripts.length; i++) {
            var src = scripts[i].getAttribute('src');
            if (src && src.indexOf('portfolio-page-lightbox.js') !== -1) {
                
                return src.split('?')[0].replace('/assets/js/portfolio-page-lightbox.js', '');
            }
        }
        return '';
    }

    /**
     * Initialize GLightbox for image lightbox
     * 
     * @since 1.0.0
     */
    function initLightbox() {
        if (typeof GLightbox === 'undefined') {
           
            return;
        }

        var themeUrl = getThemeBaseUrl();

        // Load SVG files and initialize GLightbox
        Promise.all([
            fetch(themeUrl + '/assets/img/icons/glightbox-close.svg').then(r => r.text()),
            fetch(themeUrl + '/assets/img/icons/glightbox-next.svg').then(r => r.text()),
            fetch(themeUrl + '/assets/img/icons/glightbox-prev.svg').then(r => r.text())
        ]).then(function(svgIcons) {
            // Initialize GLightbox with loaded SVG content
            var lightbox = GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true,
                autoplayVideos: true,
                closeButton: true,
                zoomable: true,
                draggable: true,
                closeOnOutsideClick: true,
                svg: {
                    close: svgIcons[0],
                    next: svgIcons[1],
                    prev: svgIcons[2]
                }
            });

        }).catch(function(error) {
           

            // Fallback: Initialize without custom icons
            var lightbox = GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true,
                autoplayVideos: true,
                closeButton: true,
                zoomable: true,
                draggable: true,
                closeOnOutsideClick: true
            });

        
        });
    }

})();