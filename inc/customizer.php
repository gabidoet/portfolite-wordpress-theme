<?php
/**
 * Portfolite Theme Customizer
 *
 * @package Portfolite
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 */
function portfolite_customize_register( $wp_customize ) {
    
    // Add postMessage support for built-in settings
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'portfolite_customize_partial_blogname',
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'portfolite_customize_partial_blogdescription',
        ) );
    }

    // Theme Options Panel
    $wp_customize->add_panel( 'portfolite_theme_options', array(
        'title'       => __( 'Portfolite Options', 'portfolite' ),
        'description' => __( 'Customize your Portfolite theme settings.', 'portfolite' ),
        'priority'    => 30,
    ) );

    // Colors Section
    $wp_customize->add_section( 'portfolite_colors', array(
        'title'    => __( 'Colors', 'portfolite' ),
        'panel'    => 'portfolite_theme_options',
        'priority' => 10,
    ) );

    // Primary Color
    $wp_customize->add_setting( 'portfolite_primary_color', array(
        'default'           => '#2563eb',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'portfolite_primary_color', array(
        'label'    => __( 'Primary Color', 'portfolite' ),
        'section'  => 'portfolite_colors',
        'settings' => 'portfolite_primary_color',
    ) ) );
}
add_action( 'customize_register', 'portfolite_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 */
function portfolite_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function portfolite_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

