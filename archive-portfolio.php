<?php
/**
 * The template for displaying portfolio archive
 *
 * @package Portfolite
 * @since 1.0.0
 */

get_header();
?>

<main id="main" class="site-main portfolio-archive" role="main">
    <div class="container">
        
        <!-- Archive Header -->
        <header class="archive-header">
            <h1 class="archive-title"><?php esc_html_e( 'Portfolio', 'portfolite' ); ?></h1>
            <p class="archive-description"><?php esc_html_e( 'Explore my creative work and projects.', 'portfolite' ); ?></p>
        </header>
        
        <!-- Portfolio Filter -->
        <?php
        $categories = get_terms( array(
            'taxonomy' => 'portfolio_category',
            'hide_empty' => true,
        ) );
        
        if ( $categories && ! is_wp_error( $categories ) ) :
        ?>
            <div class="portfolio-filter">
                <button class="filter-btn active" data-filter="*"><?php esc_html_e( 'All', 'portfolite' ); ?></button>
                <?php foreach ( $categories as $category ) : ?>
                    <button class="filter-btn" data-filter=".category-<?php echo esc_attr( $category->slug ); ?>">
                        <?php echo esc_html( $category->name ); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <!-- Portfolio Grid -->
        <?php if ( have_posts() ) : ?>
            <div class="portfolio-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    
                    <?php
                    $portfolio_categories = get_the_terms( get_the_ID(), 'portfolio_category' );
                    $category_classes = '';
                    if ( $portfolio_categories && ! is_wp_error( $portfolio_categories ) ) {
                        foreach ( $portfolio_categories as $category ) {
                            $category_classes .= ' category-' . $category->slug;
                        }
                    }
                    ?>
                    
                    <article class="portfolio-item<?php echo esc_attr( $category_classes ); ?>">
                        <div class="portfolio-item__inner">
                            
                            <!-- Portfolio Thumbnail -->
                            <div class="portfolio-item__thumbnail">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a href="<?php the_permalink(); ?>" class="portfolio-item__link">
                                        <?php the_post_thumbnail( 'large', array( 'class' => 'portfolio-item__image' ) ); ?>
                                        <div class="portfolio-item__overlay">
                                            <div class="portfolio-item__overlay-content">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                    <path d="M1 12S5 4 12 4S23 12 23 12S19 20 12 20S1 12 1 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                <span><?php esc_html_e( 'View Project', 'portfolite' ); ?></span>
                                            </div>
                                        </div>
                                    </a>
                                <?php else : ?>
                                    <a href="<?php the_permalink(); ?>" class="portfolio-item__link">
                                        <div class="portfolio-item__placeholder">
                                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                                                <circle cx="8.5" cy="8.5" r="1.5" stroke="currentColor" stroke-width="2"/>
                                                <path d="M21 15L16 10L5 21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Portfolio Content -->
                            <div class="portfolio-item__content">
                                <h2 class="portfolio-item__title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                
                                <?php if ( has_excerpt() ) : ?>
                                    <div class="portfolio-item__excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Portfolio Meta -->
                                <div class="portfolio-item__meta">
                                    <?php
                                    $client = get_post_meta( get_the_ID(), '_portfolio_client', true );
                                    if ( $client ) :
                                    ?>
                                        <span class="portfolio-item__client"><?php echo esc_html( $client ); ?></span>
                                    <?php endif; ?>
                                    
                                    <?php if ( $portfolio_categories && ! is_wp_error( $portfolio_categories ) ) : ?>
                                        <div class="portfolio-item__categories">
                                            <?php foreach ( $portfolio_categories as $category ) : ?>
                                                <a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="portfolio-item__category">
                                                    <?php echo esc_html( $category->name ); ?>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                        </div>
                    </article>
                    
                <?php endwhile; ?>
            </div>
            
            <!-- Pagination -->
            <?php
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( '&larr; Previous', 'portfolite' ),
                'next_text' => __( 'Next &rarr;', 'portfolite' ),
            ) );
            ?>
            
        <?php else : ?>
            
            <!-- No Portfolio Items -->
            <div class="no-portfolio">
                <div class="no-portfolio__content">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <h2><?php esc_html_e( 'No Portfolio Items Found', 'portfolite' ); ?></h2>
                    <p><?php esc_html_e( 'There are no portfolio items to display at the moment.', 'portfolite' ); ?></p>
                    
                    <?php if ( current_user_can( 'edit_posts' ) ) : ?>
                        <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=portfolio' ) ); ?>" class="btn btn--primary">
                            <?php esc_html_e( 'Add Portfolio Item', 'portfolite' ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            
        <?php endif; ?>
        
    </div>
</main>

<?php
get_footer();

