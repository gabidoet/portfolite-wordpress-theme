<?php
/**
 * Portfolite Block Patterns
 *
 * @package Portfolite
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Block Patterns
 */
function portfolite_register_block_patterns() {
    
    // Check if block patterns are supported
    if ( ! function_exists( 'register_block_pattern' ) ) {
        return;
    }

    // Register pattern category
    register_block_pattern_category(
        'portfolite',
        array( 'label' => __( 'Portfolite', 'portfolite' ) )
    );

    // Hero Section Pattern
    register_block_pattern(
        'portfolite/hero-section',
        array(
            'title'       => __( 'Hero Section', 'portfolite' ),
            'description' => __( 'A hero section with heading, description, and call-to-action button.', 'portfolite' ),
            'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"6rem","bottom":"6rem"}}},"backgroundColor":"primary","textColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-white-color has-primary-background-color has-text-color has-background" style="padding-top:6rem;padding-bottom:6rem"><!-- wp:heading {"textAlign":"center","level":1,"fontSize":"huge"} -->
<h1 class="wp-block-heading has-text-align-center has-huge-font-size">Creative Professional</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","fontSize":"large"} -->
<p class="has-text-align-center has-large-font-size">I create beautiful, functional designs that help businesses grow and connect with their audience.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"2rem"}}}} -->
<div class="wp-block-buttons" style="margin-top:2rem"><!-- wp:button {"backgroundColor":"white","textColor":"primary","className":"is-style-fill"} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button">View My Work</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->',
            'categories'  => array( 'portfolite' ),
        )
    );
}
add_action( 'init', 'portfolite_register_block_patterns' );

