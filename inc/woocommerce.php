<?php
/**
 * WooCommerce Integration
 *
 * @package Portfolite
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WooCommerce setup function
 */
function portfolite_woocommerce_setup() {
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 300,
        'single_image_width'    => 600,
        'product_grid'          => array(
            'default_rows'    => 4,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 3,
            'min_columns'     => 2,
            'max_columns'     => 4,
        ),
    ) );

    // Add support for WC features
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'portfolite_woocommerce_setup' );

/**
 * Remove default WooCommerce wrappers
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

/**
 * Add custom WooCommerce wrappers
 */
function portfolite_woocommerce_wrapper_start() {
    echo '<main id="main" class="site-main woocommerce-main" role="main"><div class="container">';
}
add_action( 'woocommerce_before_main_content', 'portfolite_woocommerce_wrapper_start', 10 );

function portfolite_woocommerce_wrapper_end() {
    echo '</div></main>';
}
add_action( 'woocommerce_after_main_content', 'portfolite_woocommerce_wrapper_end', 10 );

/**
 * Enqueue WooCommerce styles
 */
function portfolite_woocommerce_scripts() {
    wp_enqueue_style( 
        'portfolite-woocommerce-style', 
        PORTFOLITE_THEME_URI . '/assets/css/woocommerce.css', 
        array( 'portfolite-style' ), 
        PORTFOLITE_VERSION 
    );
}
add_action( 'wp_enqueue_scripts', 'portfolite_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Change number of products per row
 */
function portfolite_woocommerce_loop_columns() {
    return 3;
}
add_filter( 'loop_shop_columns', 'portfolite_woocommerce_loop_columns' );

/**
 * Change number of products per page
 */
function portfolite_woocommerce_products_per_page() {
    return 12;
}
add_filter( 'loop_shop_per_page', 'portfolite_woocommerce_products_per_page', 20 );

/**
 * Remove WooCommerce breadcrumbs
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/**
 * Add cart icon to header
 */
function portfolite_woocommerce_cart_link() {
    if ( ! WC()->cart ) {
        return;
    }
    
    $cart_count = WC()->cart->get_cart_contents_count();
    $cart_url = wc_get_cart_url();
    
    ?>
    <a href="<?php echo esc_url( $cart_url ); ?>" class="cart-toggle" aria-label="<?php esc_attr_e( 'View cart', 'portfolite' ); ?>">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M3 3H5L5.4 5M7 13H17L21 5H5.4M7 13L5.4 5M7 13L4.7 15.3C4.3 15.7 4.6 16.5 5.1 16.5H17M17 13V16.5M9 19.5C9.8 19.5 10.5 20.2 10.5 21S9.8 22.5 9 22.5 7.5 21.8 7.5 21 8.2 19.5 9 19.5ZM20 19.5C20.8 19.5 21.5 20.2 21.5 21S20.8 22.5 20 22.5 18.5 21.8 18.5 21 19.2 19.5 20 19.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <?php if ( $cart_count > 0 ) : ?>
            <span class="cart-count"><?php echo esc_html( $cart_count ); ?></span>
        <?php endif; ?>
        <span class="sr-only"><?php esc_html_e( 'Cart', 'portfolite' ); ?></span>
    </a>
    <?php
}

/**
 * Update cart count via AJAX
 */
function portfolite_woocommerce_add_to_cart_fragments( $fragments ) {
    if ( ! WC()->cart ) {
        return $fragments;
    }
    
    $cart_count = WC()->cart->get_cart_contents_count();
    
    ob_start();
    if ( $cart_count > 0 ) {
        echo '<span class="cart-count">' . esc_html( $cart_count ) . '</span>';
    }
    $fragments['.cart-count'] = ob_get_clean();
    
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'portfolite_woocommerce_add_to_cart_fragments' );

/**
 * Customize WooCommerce pagination
 */
function portfolite_woocommerce_pagination_args( $args ) {
    $args['prev_text'] = __( '&larr; Previous', 'portfolite' );
    $args['next_text'] = __( 'Next &rarr;', 'portfolite' );
    return $args;
}
add_filter( 'woocommerce_pagination_args', 'portfolite_woocommerce_pagination_args' );

/**
 * Customize single product tabs
 */
function portfolite_woocommerce_product_tabs( $tabs ) {
    // Rename the description tab
    if ( isset( $tabs['description'] ) ) {
        $tabs['description']['title'] = __( 'Product Details', 'portfolite' );
    }
    
    // Rename the additional information tab
    if ( isset( $tabs['additional_information'] ) ) {
        $tabs['additional_information']['title'] = __( 'Specifications', 'portfolite' );
    }
    
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'portfolite_woocommerce_product_tabs' );

/**
 * Add custom body classes for WooCommerce pages
 */
function portfolite_woocommerce_body_classes( $classes ) {
    if ( is_woocommerce() ) {
        $classes[] = 'woocommerce-page';
    }
    
    if ( is_shop() ) {
        $classes[] = 'woocommerce-shop';
    }
    
    if ( is_product() ) {
        $classes[] = 'woocommerce-product';
    }
    
    if ( is_cart() ) {
        $classes[] = 'woocommerce-cart';
    }
    
    if ( is_checkout() ) {
        $classes[] = 'woocommerce-checkout';
    }
    
    return $classes;
}
add_filter( 'body_class', 'portfolite_woocommerce_body_classes' );

/**
 * Customize WooCommerce messages
 */
function portfolite_woocommerce_message_classes( $classes ) {
    $classes[] = 'portfolite-message';
    return $classes;
}
add_filter( 'woocommerce_message_classes', 'portfolite_woocommerce_message_classes' );
add_filter( 'woocommerce_error_classes', 'portfolite_woocommerce_message_classes' );
add_filter( 'woocommerce_info_classes', 'portfolite_woocommerce_message_classes' );

/**
 * Remove WooCommerce sidebar on shop pages
 */
function portfolite_woocommerce_remove_sidebar() {
    if ( is_shop() || is_product_category() || is_product_tag() ) {
        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
    }
}
add_action( 'wp', 'portfolite_woocommerce_remove_sidebar' );

/**
 * Customize WooCommerce sale flash
 */
function portfolite_woocommerce_sale_flash( $html, $post, $product ) {
    if ( $product->is_on_sale() ) {
        if ( $product->is_type( 'variable' ) ) {
            $percentage = 0;
            $variations = $product->get_available_variations();
            
            foreach ( $variations as $variation ) {
                $variation_obj = wc_get_product( $variation['variation_id'] );
                if ( $variation_obj->is_on_sale() ) {
                    $regular_price = (float) $variation_obj->get_regular_price();
                    $sale_price = (float) $variation_obj->get_sale_price();
                    
                    if ( $regular_price > 0 ) {
                        $variation_percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
                        if ( $variation_percentage > $percentage ) {
                            $percentage = $variation_percentage;
                        }
                    }
                }
            }
            
            if ( $percentage > 0 ) {
                return '<span class="onsale">-' . $percentage . '%</span>';
            }
        } else {
            $regular_price = (float) $product->get_regular_price();
            $sale_price = (float) $product->get_sale_price();
            
            if ( $regular_price > 0 ) {
                $percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
                return '<span class="onsale">-' . $percentage . '%</span>';
            }
        }
    }
    
    return $html;
}
add_filter( 'woocommerce_sale_flash', 'portfolite_woocommerce_sale_flash', 10, 3 );

