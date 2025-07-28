<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Portfolite
 * @since 1.0.0
 */
?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer" role="contentinfo">
        
        <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
            <div class="footer-widgets">
                <div class="container">
                    <div class="footer-widgets__grid">
                        
                        <?php for ( $i = 1; $i <= 4; $i++ ) : ?>
                            <?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>
                                <div class="footer-widget-area footer-widget-area--<?php echo esc_attr( $i ); ?>">
                                    <?php dynamic_sidebar( 'footer-' . $i ); ?>
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                        
                    </div><!-- .footer-widgets__grid -->
                </div><!-- .container -->
            </div><!-- .footer-widgets -->
        <?php endif; ?>

        <div class="site-info">
            <div class="container">
                <div class="site-info__inner">
                    
                    <div class="site-info__content">
                        <p class="copyright">
                            <?php
                            printf(
                                /* translators: 1: Copyright symbol, 2: Current year, 3: Site name */
                                esc_html__( '%1$s %2$s %3$s. All rights reserved.', 'portfolite' ),
                                '&copy;',
                                date( 'Y' ),
                                get_bloginfo( 'name' )
                            );
                            ?>
                        </p>
                        
                        <?php if ( has_nav_menu( 'footer' ) ) : ?>
                            <nav class="footer-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'portfolite' ); ?>">
                                <?php
                                wp_nav_menu( array(
                                    'theme_location' => 'footer',
                                    'menu_class'     => 'footer-menu',
                                    'container'      => false,
                                    'depth'          => 1,
                                ) );
                                ?>
                            </nav>
                        <?php endif; ?>
                    </div>

                    <div class="site-info__credits">
                        <p>
                            <?php
                            printf(
                                /* translators: 1: Theme name, 2: WordPress link */
                                esc_html__( 'Powered by %1$s and %2$s', 'portfolite' ),
                                '<a href="https://portfolite-theme.com" rel="nofollow">Portfolite</a>',
                                '<a href="https://wordpress.org/" rel="nofollow">WordPress</a>'
                            );
                            ?>
                        </p>
                    </div>

                </div><!-- .site-info__inner -->
            </div><!-- .container -->
        </div><!-- .site-info -->

    </footer><!-- #colophon -->

    <!-- Back to Top Button -->
    <button id="back-to-top" class="back-to-top" aria-label="<?php esc_attr_e( 'Back to top', 'portfolite' ); ?>" style="display: none;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M18 15L12 9L6 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span class="sr-only"><?php esc_html_e( 'Back to top', 'portfolite' ); ?></span>
    </button>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

