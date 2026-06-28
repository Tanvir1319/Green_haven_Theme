/**
 * =========================================
 * PORTFOLIO FILTER FUNCTIONALITY
 * Green Haven Website
 * 
 * @package    Green_Haven
 * @subpackage Portfolio
 * @version    1.0.0
 * 
 * Uses: MixItUp v3 for filtering animations
 * =========================================
 */

(function() {
    'use strict';

    /**
     * Initialize portfolio filtering when DOM is ready
     */
    document.addEventListener('DOMContentLoaded', function() {
        initPortfolioFilter();
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
               enable:false  // Simple fade only
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

})();
