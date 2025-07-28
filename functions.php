<?php
/**
 * Portfolite functions and definitions
 *
 * @package Portfolite
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Define theme constants
 */
define( 'PORTFOLITE_VERSION', '1.0.0' );
define( 'PORTFOLITE_THEME_DIR', get_template_directory() );
define( 'PORTFOLITE_THEME_URI', get_template_directory_uri() );

/**
 * Theme setup
 */
function portfolite_setup() {
    
    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );
    
    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );
    
    // Enable support for Post Thumbnails on posts and pages
    add_theme_support( 'post-thumbnails' );
    
    // Add custom image sizes
    add_image_size( 'portfolite-hero', 1200, 600, true );
    add_image_size( 'portfolite-portfolio', 600, 400, true );
    add_image_size( 'portfolite-thumbnail', 300, 200, true );
    
    // Register navigation menus
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'portfolite' ),
        'footer'  => esc_html__( 'Footer Menu', 'portfolite' ),
    ) );
    
    // Switch default core markup to output valid HTML5
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );
    
    // Add theme support for selective refresh for widgets
    add_theme_support( 'customize-selective-refresh-widgets' );
    
    // Add support for custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-width'  => true,
        'flex-height' => true,
    ) );
    
    // Add support for custom background
    add_theme_support( 'custom-background', array(
        'default-color' => 'ffffff',
    ) );
    
    // Add support for editor styles
    add_theme_support( 'editor-styles' );
    add_editor_style( 'assets/css/editor-style.css' );
    
    // Add support for responsive embeds
    add_theme_support( 'responsive-embeds' );
    
    // Add support for wide and full alignment
    add_theme_support( 'align-wide' );
    
    // Add support for block styles
    add_theme_support( 'wp-block-styles' );
    
    // Add support for custom line height
    add_theme_support( 'custom-line-height' );
    
    // Add support for custom units
    add_theme_support( 'custom-units' );
    
    // Add support for custom spacing
    add_theme_support( 'custom-spacing' );
    
    // Add support for link color
    add_theme_support( 'link-color' );
    
    // Add support for appearance tools
    add_theme_support( 'appearance-tools' );
    
    // Add support for border
    add_theme_support( 'border' );
    
    // Set content width
    if ( ! isset( $content_width ) ) {
        $content_width = 800;
    }
}
add_action( 'after_setup_theme', 'portfolite_setup' );

/**
 * Enqueue scripts and styles
 */
function portfolite_scripts() {
    
    // Main stylesheet
    wp_enqueue_style( 
        'portfolite-style', 
        get_stylesheet_uri(), 
        array(), 
        PORTFOLITE_VERSION 
    );
    
    // Additional stylesheets
    wp_enqueue_style( 
        'portfolite-main', 
        PORTFOLITE_THEME_URI . '/assets/css/main.css', 
        array( 'portfolite-style' ), 
        PORTFOLITE_VERSION 
    );
    
    // Dark mode styles
    wp_enqueue_style( 
        'portfolite-dark-mode', 
        PORTFOLITE_THEME_URI . '/assets/css/dark-mode.css', 
        array( 'portfolite-main' ), 
        PORTFOLITE_VERSION 
    );
    
    // Animations
    wp_enqueue_style( 
        'portfolite-animations', 
        PORTFOLITE_THEME_URI . '/assets/css/animations.css', 
        array( 'portfolite-main' ), 
        PORTFOLITE_VERSION 
    );
    
    // Main JavaScript
    wp_enqueue_script( 
        'portfolite-main', 
        PORTFOLITE_THEME_URI . '/assets/js/main.js', 
        array(), 
        PORTFOLITE_VERSION, 
        true 
    );
    
    // Dark mode toggle
    wp_enqueue_script( 
        'portfolite-dark-mode', 
        PORTFOLITE_THEME_URI . '/assets/js/dark-mode.js', 
        array( 'portfolite-main' ), 
        PORTFOLITE_VERSION, 
        true 
    );
    
    // Portfolio filter (only on portfolio pages)
    if ( is_post_type_archive( 'portfolio' ) || is_tax( 'portfolio_category' ) ) {
        wp_enqueue_script( 
            'portfolite-portfolio-filter', 
            PORTFOLITE_THEME_URI . '/assets/js/portfolio-filter.js', 
            array( 'portfolite-main' ), 
            PORTFOLITE_VERSION, 
            true 
        );
    }
    
    // Comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    
    // Localize script for AJAX
    wp_localize_script( 'portfolite-main', 'portfolite_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'portfolite_nonce' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'portfolite_scripts' );

/**
 * Register widget areas
 */
function portfolite_widgets_init() {
    
    // Main sidebar
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'portfolite' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'portfolite' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    // Footer widgets
    for ( $i = 1; $i <= 4; $i++ ) {
        register_sidebar( array(
            'name'          => sprintf( esc_html__( 'Footer %d', 'portfolite' ), $i ),
            'id'            => 'footer-' . $i,
            'description'   => sprintf( esc_html__( 'Add widgets here to appear in footer column %d.', 'portfolite' ), $i ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ) );
    }
}
add_action( 'widgets_init', 'portfolite_widgets_init' );

/**
 * Include required files
 */
require_once PORTFOLITE_THEME_DIR . '/inc/customizer.php';
require_once PORTFOLITE_THEME_DIR . '/inc/portfolio-post-type.php';
require_once PORTFOLITE_THEME_DIR . '/inc/block-patterns.php';
require_once PORTFOLITE_THEME_DIR . '/inc/block-styles.php';

// WooCommerce support
if ( class_exists( 'WooCommerce' ) ) {
    require_once PORTFOLITE_THEME_DIR . '/inc/woocommerce.php';
}

/**
 * Add WooCommerce support
 */
function portfolite_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'portfolite_add_woocommerce_support' );

/**
 * Custom excerpt length
 */
function portfolite_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'portfolite_excerpt_length', 999 );

/**
 * Custom excerpt more
 */
function portfolite_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'portfolite_excerpt_more' );

/**
 * Add custom body classes
 */
function portfolite_body_classes( $classes ) {
    
    // Add class for dark mode (will be toggled by JavaScript)
    if ( get_theme_mod( 'portfolite_dark_mode_default', false ) ) {
        $classes[] = 'dark-mode-default';
    }
    
    // Add class if sidebar is active
    if ( is_active_sidebar( 'sidebar-1' ) && ! is_page_template( 'templates/full-width.php' ) ) {
        $classes[] = 'has-sidebar';
    }
    
    // Add class for portfolio pages
    if ( is_post_type_archive( 'portfolio' ) || is_singular( 'portfolio' ) || is_tax( 'portfolio_category' ) ) {
        $classes[] = 'portfolio-page';
    }
    
    return $classes;
}
add_filter( 'body_class', 'portfolite_body_classes' );

/**
 * Enqueue Google Fonts
 */
function portfolite_fonts() {
    $fonts_url = '';
    
    if ( ! class_exists( 'WP_Theme_JSON_Resolver' ) ) {
        $font_families = array();
        $font_families[] = 'Inter:wght@300;400;500;600;700;800';
        
        $query_args = array(
            'family'  => urlencode( implode( '|', $font_families ) ),
            'subset'  => urlencode( 'latin,latin-ext' ),
            'display' => urlencode( 'swap' ),
        );
        
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css2' );
    }
    
    if ( $fonts_url ) {
        wp_enqueue_style( 'portfolite-fonts', $fonts_url, array(), null );
    }
}
add_action( 'wp_enqueue_scripts', 'portfolite_fonts', 1 );

/**
 * Determine if the current page should display the sidebar
 */
function portfolite_show_sidebar() {
    return is_active_sidebar( 'sidebar-1' ) && 
           ! is_page_template( 'templates/full-width.php' ) &&
           ! is_post_type_archive( 'portfolio' ) &&
           ! is_singular( 'portfolio' );
}

/**
 * Security: Remove WordPress version from head
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Performance: Remove unnecessary emoji scripts
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * Performance: Remove unnecessary REST API links
 */
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

/**
 * Clean up wp_head
 */
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

