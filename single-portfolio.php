<?php
/**
 * The template for displaying single portfolio items
 *
 * @package Portfolite
 * @since 1.0.0
 */

get_header();
?>

<main id="main" class="site-main single-portfolio" role="main">
    <div class="container">
        
        <?php while ( have_posts() ) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-single' ); ?>>
                
                <!-- Portfolio Header -->
                <header class="portfolio-header">
                    <div class="portfolio-header__content">
                        <h1 class="portfolio-title"><?php the_title(); ?></h1>
                        
                        <?php if ( has_excerpt() ) : ?>
                            <div class="portfolio-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Portfolio Meta -->
                        <div class="portfolio-meta">
                            <?php
                            $client = get_post_meta( get_the_ID(), '_portfolio_client', true );
                            $date = get_post_meta( get_the_ID(), '_portfolio_date', true );
                            $skills = get_post_meta( get_the_ID(), '_portfolio_skills', true );
                            $url = get_post_meta( get_the_ID(), '_portfolio_url', true );
                            ?>
                            
                            <?php if ( $client ) : ?>
                                <div class="portfolio-meta__item">
                                    <span class="portfolio-meta__label"><?php esc_html_e( 'Client:', 'portfolite' ); ?></span>
                                    <span class="portfolio-meta__value"><?php echo esc_html( $client ); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ( $date ) : ?>
                                <div class="portfolio-meta__item">
                                    <span class="portfolio-meta__label"><?php esc_html_e( 'Date:', 'portfolite' ); ?></span>
                                    <span class="portfolio-meta__value"><?php echo esc_html( date( 'F Y', strtotime( $date ) ) ); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ( $skills ) : ?>
                                <div class="portfolio-meta__item">
                                    <span class="portfolio-meta__label"><?php esc_html_e( 'Skills:', 'portfolite' ); ?></span>
                                    <span class="portfolio-meta__value"><?php echo esc_html( $skills ); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ( $url ) : ?>
                                <div class="portfolio-meta__item">
                                    <span class="portfolio-meta__label"><?php esc_html_e( 'Live Project:', 'portfolite' ); ?></span>
                                    <span class="portfolio-meta__value">
                                        <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" class="portfolio-link">
                                            <?php esc_html_e( 'View Project', 'portfolite' ); ?>
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path d="M18 13V19C18 19.5304 17.7893 20.0391 17.4142 20.4142C17.0391 20.7893 16.5304 21 16 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V8C3 7.46957 3.21071 6.96086 3.58579 6.58579C3.96086 6.21071 4.46957 6 5 6H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M15 3H21V9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 14L21 3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Portfolio Categories -->
                        <?php
                        $categories = get_the_terms( get_the_ID(), 'portfolio_category' );
                        if ( $categories && ! is_wp_error( $categories ) ) :
                        ?>
                            <div class="portfolio-categories">
                                <?php foreach ( $categories as $category ) : ?>
                                    <a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="portfolio-category">
                                        <?php echo esc_html( $category->name ); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Featured Image -->
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="portfolio-featured-image">
                            <?php the_post_thumbnail( 'full', array( 'class' => 'portfolio-image' ) ); ?>
                        </div>
                    <?php endif; ?>
                </header>
                
                <!-- Portfolio Content -->
                <div class="portfolio-content">
                    <?php the_content(); ?>
                </div>
                
                <!-- Portfolio Tags -->
                <?php
                $tags = get_the_terms( get_the_ID(), 'portfolio_tag' );
                if ( $tags && ! is_wp_error( $tags ) ) :
                ?>
                    <div class="portfolio-tags">
                        <h3 class="portfolio-tags__title"><?php esc_html_e( 'Tags:', 'portfolite' ); ?></h3>
                        <div class="portfolio-tags__list">
                            <?php foreach ( $tags as $tag ) : ?>
                                <a href="<?php echo esc_url( get_term_link( $tag ) ); ?>" class="portfolio-tag">
                                    <?php echo esc_html( $tag->name ); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Portfolio Navigation -->
                <nav class="portfolio-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Portfolio Navigation', 'portfolite' ); ?>">
                    <div class="portfolio-nav__links">
                        <?php
                        $prev_post = get_previous_post( true, '', 'portfolio_category' );
                        $next_post = get_next_post( true, '', 'portfolio_category' );
                        ?>
                        
                        <?php if ( $prev_post ) : ?>
                            <div class="portfolio-nav__prev">
                                <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="portfolio-nav__link">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="portfolio-nav__content">
                                        <span class="portfolio-nav__label"><?php esc_html_e( 'Previous Project', 'portfolite' ); ?></span>
                                        <span class="portfolio-nav__title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="portfolio-nav__back">
                            <a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>" class="portfolio-nav__link portfolio-nav__link--back">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M3 7V17C3 17.5304 3.21071 18.0391 3.58579 18.4142C3.96086 18.7893 4.46957 19 5 19H19C19.5304 19 20.0391 18.7893 20.4142 18.4142C20.7893 18.0391 21 17.5304 21 17V7C21 6.46957 20.7893 5.96086 20.4142 5.58579C20.0391 5.21071 19.5304 5 19 5H5C4.46957 5 3.96086 5.21071 3.58579 5.58579C3.21071 5.96086 3 6.46957 3 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8 11L12 15L16 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <?php esc_html_e( 'All Projects', 'portfolite' ); ?>
                            </a>
                        </div>
                        
                        <?php if ( $next_post ) : ?>
                            <div class="portfolio-nav__next">
                                <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="portfolio-nav__link">
                                    <div class="portfolio-nav__content">
                                        <span class="portfolio-nav__label"><?php esc_html_e( 'Next Project', 'portfolite' ); ?></span>
                                        <span class="portfolio-nav__title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
                                    </div>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </nav>
                
            </article>
            
        <?php endwhile; ?>
        
    </div>
</main>

<?php
get_footer();

