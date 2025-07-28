/**
 * Portfolite Main JavaScript
 * 
 * @package Portfolite
 * @since 1.0.0
 */

(function() {
    'use strict';

    // DOM Ready
    document.addEventListener('DOMContentLoaded', function() {
        initMobileNavigation();
        initSearchModal();
        initBackToTop();
        initSmoothScrolling();
        initDarkMode();
    });

    /**
     * Mobile Navigation
     */
    function initMobileNavigation() {
        const menuToggle = document.querySelector('.menu-toggle');
        const navigation = document.querySelector('.main-navigation');

        if (!menuToggle || !navigation) return;

        menuToggle.addEventListener('click', function() {
            const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
            
            menuToggle.setAttribute('aria-expanded', !isExpanded);
            navigation.setAttribute('aria-expanded', !isExpanded);
            
            // Prevent body scroll when menu is open
            document.body.style.overflow = !isExpanded ? 'hidden' : '';
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!navigation.contains(e.target) && !menuToggle.contains(e.target)) {
                menuToggle.setAttribute('aria-expanded', 'false');
                navigation.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            }
        });
    }

    /**
     * Search Modal
     */
    function initSearchModal() {
        const searchToggle = document.querySelector('.search-toggle');
        const searchModal = document.querySelector('.search-modal');
        const searchClose = document.querySelector('.search-modal__close');
        const searchBackdrop = document.querySelector('.search-modal__backdrop');

        if (!searchToggle || !searchModal) return;

        function openSearchModal() {
            searchModal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function closeSearchModal() {
            searchModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        searchToggle.addEventListener('click', openSearchModal);
        
        if (searchClose) {
            searchClose.addEventListener('click', closeSearchModal);
        }

        if (searchBackdrop) {
            searchBackdrop.addEventListener('click', closeSearchModal);
        }

        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && searchModal.getAttribute('aria-hidden') === 'false') {
                closeSearchModal();
            }
        });
    }

    /**
     * Back to Top Button
     */
    function initBackToTop() {
        const backToTop = document.querySelector('.back-to-top');
        
        if (!backToTop) return;

        function toggleBackToTop() {
            if (window.pageYOffset > 300) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }
        }

        window.addEventListener('scroll', toggleBackToTop);

        backToTop.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    /**
     * Smooth Scrolling for Anchor Links
     */
    function initSmoothScrolling() {
        const anchorLinks = document.querySelectorAll('a[href^="#"]');

        anchorLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                if (href === '#') return;

                const target = document.querySelector(href);
                
                if (target) {
                    e.preventDefault();
                    
                    const headerHeight = document.querySelector('.site-header').offsetHeight;
                    const targetPosition = target.offsetTop - headerHeight - 20;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    /**
     * Dark Mode Toggle
     */
    function initDarkMode() {
        const darkModeToggle = document.querySelector('.dark-mode-toggle');
        
        if (!darkModeToggle) return;

        // Check for saved theme preference or default to light mode
        const currentTheme = localStorage.getItem('portfolite-theme') || 'light';
        document.documentElement.setAttribute('data-theme', currentTheme);

        darkModeToggle.addEventListener('click', function() {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('portfolite-theme', newTheme);
        });
    }

})();
