jQuery(document).ready(function($) {
    // Get current page filename
    var currentPage = window.location.pathname.split('/').pop() || 'index.php';  // Changed to 'index.php' for WordPress, as it often uses this instead of 'index.html'
    
    // Get all navigation links
    var navLinks = $('.navbar-nav .nav-link');
    
    // Remove active class from all links first
    navLinks.removeClass('active');
    
    // Add active class to the current page link
    navLinks.each(function() {
        var href = $(this).attr('href');
        
        // Match exact filename or handle home page
        if (href === currentPage || 
            (currentPage === 'index.php' && href === 'index.php') || 
            (currentPage === '' && href === 'index.php')) {
            $(this).addClass('active');
        }
    });
});