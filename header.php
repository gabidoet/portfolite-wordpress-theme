<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package Portfolite
 * @since 1.0.0
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link sr-only" href="#main"><?php esc_html_e( 'Skip to content', 'portfolite' ); ?></a>

    <header id="masthead" class="site-header" role="banner">
        <div class="container">
            <div class="site-header__inner">
                
                <!-- Site Branding -->
                <div class="site-branding">
                    <?php
                    if ( has_custom_logo() ) :
                        the_custom_logo();
                    else :
                        if ( is_front_page() && is_home() ) :
                            ?>
                            <h1 class="site-title">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                    <?php bloginfo( 'name' ); ?>
                                </a>
                            </h1>
                            <?php
                        else :
                            ?>
                            <p class="site-title">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                    <?php bloginfo( 'name' ); ?>
                                </a>
                            </p>
                            <?php
                        endif;
                        
                        $portfolite_description = get_bloginfo( 'description', 'display' );
                        if ( $portfolite_description || is_customize_preview() ) :
                            ?>
                            <p class="site-description"><?php echo $portfolite_description; ?></p>
                            <?php
                        endif;
                    endif;
                    ?>
                </div><!-- .site-branding -->

                <!-- Primary Navigation -->
                <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'portfolite' ); ?>">
                    
                    <!-- Mobile Menu Toggle -->
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'portfolite' ); ?>">
                        <span class="menu-toggle__line"></span>
                        <span class="menu-toggle__line"></span>
                        <span class="menu-toggle__line"></span>
                        <span class="sr-only"><?php esc_html_e( 'Menu', 'portfolite' ); ?></span>
                    </button>

                    <!-- Navigation Menu -->
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'primary-menu',
                        'container'      => false,
                        'fallback_cb'    => 'portfolite_fallback_menu',
                    ) );
                    ?>

                </nav><!-- #site-navigation -->

                <!-- Header Actions -->
                <div class="header-actions">
                    
                    <!-- Search Toggle -->
                    <button class="search-toggle" aria-controls="search-modal" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle search', 'portfolite' ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="sr-only"><?php esc_html_e( 'Search', 'portfolite' ); ?></span>
                    </button>

                    <!-- Dark Mode Toggle -->
                    <button class="dark-mode-toggle" aria-label="<?php esc_attr_e( 'Toggle dark mode', 'portfolite' ); ?>">
                        <svg class="dark-mode-toggle__sun" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M12 17C14.7614 17 17 14.7614 17 12C17 9.23858 14.7614 7 12 7C9.23858 7 7 9.23858 7 12C7 14.7614 9.23858 17 12 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 1V3M12 21V23M4.22 4.22L5.64 5.64M18.36 18.36L19.78 19.78M1 12H3M21 12H23M4.22 19.78L5.64 18.36M18.36 5.64L19.78 4.22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <svg class="dark-mode-toggle__moon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="sr-only"><?php esc_html_e( 'Toggle dark mode', 'portfolite' ); ?></span>
                    </button>

                    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                        <!-- Cart Icon -->
                        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart-toggle" aria-label="<?php esc_attr_e( 'View cart', 'portfolite' ); ?>">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M3 3H5L5.4 5M7 13H17L21 5H5.4M7 13L5.4 5M7 13L4.7 15.3C4.3 15.7 4.6 16.5 5.1 16.5H17M17 13V16.5M9 19.5C9.8 19.5 10.5 20.2 10.5 21S9.8 22.5 9 22.5 7.5 21.8 7.5 21 8.2 19.5 9 19.5ZM20 19.5C20.8 19.5 21.5 20.2 21.5 21S20.8 22.5 20 22.5 18.5 21.8 18.5 21 19.2 19.5 20 19.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <?php if ( WC()->cart->get_cart_contents_count() > 0 ) : ?>
                                <span class="cart-count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
                            <?php endif; ?>
                            <span class="sr-only"><?php esc_html_e( 'Cart', 'portfolite' ); ?></span>
                        </a>
                    <?php endif; ?>

                </div><!-- .header-actions -->

            </div><!-- .site-header__inner -->
        </div><!-- .container -->

        <!-- Search Modal -->
        <div id="search-modal" class="search-modal" aria-hidden="true">
            <div class="search-modal__backdrop"></div>
            <div class="search-modal__content">
                <div class="container">
                    <div class="search-modal__inner">
                        <button class="search-modal__close" aria-label="<?php esc_attr_e( 'Close search', 'portfolite' ); ?>">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <div class="search-modal__form">
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- #search-modal -->

    </header><!-- #masthead -->

    <div id="content" class="site-content">

<?php
/**
 * Fallback menu for when no menu is assigned
 */
function portfolite_fallback_menu() {
    echo '<ul id="primary-menu" class="primary-menu">';
    echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'portfolite' ) . '</a></li>';
    
    if ( get_option( 'show_on_front' ) === 'page' ) {
        $portfolio_page = get_option( 'page_for_posts' );
        if ( $portfolio_page ) {
            echo '<li><a href="' . esc_url( get_permalink( $portfolio_page ) ) . '">' . esc_html__( 'Blog', 'portfolite' ) . '</a></li>';
        }
    }
    
    // Add portfolio link if portfolio post type exists
    if ( post_type_exists( 'portfolio' ) ) {
        echo '<li><a href="' . esc_url( get_post_type_archive_link( 'portfolio' ) ) . '">' . esc_html__( 'Portfolio', 'portfolite' ) . '</a></li>';
    }
    
    echo '</ul>';
}
?>

