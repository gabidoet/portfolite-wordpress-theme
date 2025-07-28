<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package Portfolite
 * @since 1.0.0
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
    <div class="container">
        
        <?php if ( is_home() && ! is_front_page() ) : ?>
            <header class="page-header section--sm">
                <h1 class="page-title"><?php single_post_title(); ?></h1>
            </header>
        <?php endif; ?>

        <?php if ( have_posts() ) : ?>
            
            <div class="posts-grid grid grid--2">
                <?php while ( have_posts() ) : the_post(); ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
                        
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-card__thumbnail">
                                <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                                    <?php the_post_thumbnail( 'medium_large', array(
                                        'alt' => the_title_attribute( array( 'echo' => false ) ),
                                        'loading' => 'lazy'
                                    ) ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="post-card__content">
                            
                            <header class="post-card__header">
                                <?php
                                the_title( sprintf(
                                    '<h2 class="post-card__title"><a href="%s" rel="bookmark">',
                                    esc_url( get_permalink() )
                                ), '</a></h2>' );
                                ?>
                                
                                <div class="post-card__meta">
                                    <time class="post-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                        <?php echo esc_html( get_the_date() ); ?>
                                    </time>
                                    
                                    <?php if ( get_the_category_list() ) : ?>
                                        <span class="post-card__separator">•</span>
                                        <div class="post-card__categories">
                                            <?php the_category( ', ' ); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </header>
                            
                            <div class="post-card__excerpt">
                                <?php
                                if ( has_excerpt() ) {
                                    the_excerpt();
                                } else {
                                    echo wp_kses_post( wp_trim_words( get_the_content(), 25, '...' ) );
                                }
                                ?>
                            </div>
                            
                            <footer class="post-card__footer">
                                <a href="<?php the_permalink(); ?>" class="btn btn--outline btn--sm">
                                    <?php esc_html_e( 'Read More', 'portfolite' ); ?>
                                    <span class="sr-only"><?php the_title(); ?></span>
                                </a>
                            </footer>
                            
                        </div>
                        
                    </article>
                    
                <?php endwhile; ?>
            </div>
            
            <?php
            // Pagination
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( '&larr; Previous', 'portfolite' ),
                'next_text' => __( 'Next &rarr;', 'portfolite' ),
                'class'     => 'pagination',
            ) );
            ?>
            
        <?php else : ?>
            
            <div class="no-posts section">
                <div class="no-posts__content text-center">
                    <h1 class="no-posts__title">
                        <?php esc_html_e( 'Nothing Found', 'portfolite' ); ?>
                    </h1>
                    <p class="no-posts__description">
                        <?php
                        if ( is_search() ) {
                            printf(
                                /* translators: %s: search query */
                                esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'portfolite' )
                            );
                        } else {
                            esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'portfolite' );
                        }
                        ?>
                    </p>
                    
                    <?php if ( is_search() ) : ?>
                        <div class="no-posts__search">
                            <?php get_search_form(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
        <?php endif; ?>
        
    </div>
</main>

<?php get_footer(); ?>

