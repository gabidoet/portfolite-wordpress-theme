<?php
/**
 * Portfolite Block Styles
 *
 * @package Portfolite
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Block Styles
 */
function portfolite_register_block_styles() {
    
    // Check if block styles are supported
    if ( ! function_exists( 'register_block_style' ) ) {
        return;
    }

    // Button Styles
    register_block_style(
        'core/button',
        array(
            'name'  => 'portfolite-outline',
            'label' => __( 'Outline', 'portfolite' ),
        )
    );

    // Quote Styles
    register_block_style(
        'core/quote',
        array(
            'name'  => 'portfolite-modern',
            'label' => __( 'Modern', 'portfolite' ),
        )
    );

    // Group Styles
    register_block_style(
        'core/group',
        array(
            'name'  => 'portfolite-card',
            'label' => __( 'Card', 'portfolite' ),
        )
    );
}
add_action( 'init', 'portfolite_register_block_styles' );

