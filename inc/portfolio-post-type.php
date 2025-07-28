<?php
/**
 * Portfolio Custom Post Type
 *
 * @package Portfolite
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Portfolio Post Type
 */
function portfolite_register_portfolio_post_type() {
    
    $labels = array(
        'name'                  => _x( 'Portfolio', 'Post type general name', 'portfolite' ),
        'singular_name'         => _x( 'Portfolio Item', 'Post type singular name', 'portfolite' ),
        'menu_name'             => _x( 'Portfolio', 'Admin Menu text', 'portfolite' ),
        'name_admin_bar'        => _x( 'Portfolio Item', 'Add New on Toolbar', 'portfolite' ),
        'add_new'               => __( 'Add New', 'portfolite' ),
        'add_new_item'          => __( 'Add New Portfolio Item', 'portfolite' ),
        'new_item'              => __( 'New Portfolio Item', 'portfolite' ),
        'edit_item'             => __( 'Edit Portfolio Item', 'portfolite' ),
        'view_item'             => __( 'View Portfolio Item', 'portfolite' ),
        'all_items'             => __( 'All Portfolio Items', 'portfolite' ),
        'search_items'          => __( 'Search Portfolio Items', 'portfolite' ),
        'parent_item_colon'     => __( 'Parent Portfolio Items:', 'portfolite' ),
        'not_found'             => __( 'No portfolio items found.', 'portfolite' ),
        'not_found_in_trash'    => __( 'No portfolio items found in Trash.', 'portfolite' ),
        'featured_image'        => _x( 'Portfolio Featured Image', 'Overrides the "Featured Image" phrase', 'portfolite' ),
        'set_featured_image'    => _x( 'Set featured image', 'Overrides the "Set featured image" phrase', 'portfolite' ),
        'remove_featured_image' => _x( 'Remove featured image', 'Overrides the "Remove featured image" phrase', 'portfolite' ),
        'use_featured_image'    => _x( 'Use as featured image', 'Overrides the "Use as featured image" phrase', 'portfolite' ),
        'archives'              => _x( 'Portfolio archives', 'The post type archive label', 'portfolite' ),
        'insert_into_item'      => _x( 'Insert into portfolio item', 'Overrides the "Insert into post" phrase', 'portfolite' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this portfolio item', 'Overrides the "Uploaded to this post" phrase', 'portfolite' ),
        'filter_items_list'     => _x( 'Filter portfolio items list', 'Screen reader text for the filter links', 'portfolite' ),
        'items_list_navigation' => _x( 'Portfolio items list navigation', 'Screen reader text for the pagination', 'portfolite' ),
        'items_list'            => _x( 'Portfolio items list', 'Screen reader text for the items list', 'portfolite' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'portfolio' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_nav_menus'  => true,
    );

    register_post_type( 'portfolio', $args );
}
add_action( 'init', 'portfolite_register_portfolio_post_type' );

/**
 * Register Portfolio Taxonomies
 */
function portfolite_register_portfolio_taxonomies() {
    
    // Portfolio Categories
    $category_labels = array(
        'name'              => _x( 'Portfolio Categories', 'taxonomy general name', 'portfolite' ),
        'singular_name'     => _x( 'Portfolio Category', 'taxonomy singular name', 'portfolite' ),
        'search_items'      => __( 'Search Portfolio Categories', 'portfolite' ),
        'all_items'         => __( 'All Portfolio Categories', 'portfolite' ),
        'parent_item'       => __( 'Parent Portfolio Category', 'portfolite' ),
        'parent_item_colon' => __( 'Parent Portfolio Category:', 'portfolite' ),
        'edit_item'         => __( 'Edit Portfolio Category', 'portfolite' ),
        'update_item'       => __( 'Update Portfolio Category', 'portfolite' ),
        'add_new_item'      => __( 'Add New Portfolio Category', 'portfolite' ),
        'new_item_name'     => __( 'New Portfolio Category Name', 'portfolite' ),
        'menu_name'         => __( 'Categories', 'portfolite' ),
    );

    $category_args = array(
        'hierarchical'      => true,
        'labels'            => $category_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'portfolio-category' ),
        'show_in_nav_menus' => true,
    );

    register_taxonomy( 'portfolio_category', array( 'portfolio' ), $category_args );

    // Portfolio Tags
    $tag_labels = array(
        'name'                       => _x( 'Portfolio Tags', 'taxonomy general name', 'portfolite' ),
        'singular_name'              => _x( 'Portfolio Tag', 'taxonomy singular name', 'portfolite' ),
        'search_items'               => __( 'Search Portfolio Tags', 'portfolite' ),
        'popular_items'              => __( 'Popular Portfolio Tags', 'portfolite' ),
        'all_items'                  => __( 'All Portfolio Tags', 'portfolite' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Portfolio Tag', 'portfolite' ),
        'update_item'                => __( 'Update Portfolio Tag', 'portfolite' ),
        'add_new_item'               => __( 'Add New Portfolio Tag', 'portfolite' ),
        'new_item_name'              => __( 'New Portfolio Tag Name', 'portfolite' ),
        'separate_items_with_commas' => __( 'Separate portfolio tags with commas', 'portfolite' ),
        'add_or_remove_items'        => __( 'Add or remove portfolio tags', 'portfolite' ),
        'choose_from_most_used'      => __( 'Choose from the most used portfolio tags', 'portfolite' ),
        'not_found'                  => __( 'No portfolio tags found.', 'portfolite' ),
        'menu_name'                  => __( 'Tags', 'portfolite' ),
    );

    $tag_args = array(
        'hierarchical'          => false,
        'labels'                => $tag_labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'show_in_rest'          => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'portfolio-tag' ),
        'show_in_nav_menus'     => true,
    );

    register_taxonomy( 'portfolio_tag', array( 'portfolio' ), $tag_args );
}
add_action( 'init', 'portfolite_register_portfolio_taxonomies' );

/**
 * Add Portfolio Meta Boxes
 */
function portfolite_add_portfolio_meta_boxes() {
    add_meta_box(
        'portfolio-details',
        __( 'Portfolio Details', 'portfolite' ),
        'portfolite_portfolio_details_callback',
        'portfolio',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'portfolite_add_portfolio_meta_boxes' );

/**
 * Portfolio Details Meta Box Callback
 */
function portfolite_portfolio_details_callback( $post ) {
    wp_nonce_field( 'portfolite_save_portfolio_details', 'portfolite_portfolio_details_nonce' );
    
    $client = get_post_meta( $post->ID, '_portfolio_client', true );
    $date = get_post_meta( $post->ID, '_portfolio_date', true );
    $skills = get_post_meta( $post->ID, '_portfolio_skills', true );
    $url = get_post_meta( $post->ID, '_portfolio_url', true );
    ?>
    
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for="portfolio_client"><?php esc_html_e( 'Client', 'portfolite' ); ?></label>
            </th>
            <td>
                <input type="text" id="portfolio_client" name="portfolio_client" value="<?php echo esc_attr( $client ); ?>" class="regular-text" />
                <p class="description"><?php esc_html_e( 'Enter the client name for this project.', 'portfolite' ); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="portfolio_date"><?php esc_html_e( 'Project Date', 'portfolite' ); ?></label>
            </th>
            <td>
                <input type="date" id="portfolio_date" name="portfolio_date" value="<?php echo esc_attr( $date ); ?>" class="regular-text" />
                <p class="description"><?php esc_html_e( 'Enter the project completion date.', 'portfolite' ); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="portfolio_skills"><?php esc_html_e( 'Skills Used', 'portfolite' ); ?></label>
            </th>
            <td>
                <textarea id="portfolio_skills" name="portfolio_skills" rows="3" class="large-text"><?php echo esc_textarea( $skills ); ?></textarea>
                <p class="description"><?php esc_html_e( 'List the skills or technologies used in this project (comma-separated).', 'portfolite' ); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="portfolio_url"><?php esc_html_e( 'Project URL', 'portfolite' ); ?></label>
            </th>
            <td>
                <input type="url" id="portfolio_url" name="portfolio_url" value="<?php echo esc_attr( $url ); ?>" class="regular-text" />
                <p class="description"><?php esc_html_e( 'Enter the live project URL (optional).', 'portfolite' ); ?></p>
            </td>
        </tr>
    </table>
    
    <?php
}

/**
 * Save Portfolio Meta Data
 */
function portfolite_save_portfolio_details( $post_id ) {
    
    // Check if nonce is valid
    if ( ! isset( $_POST['portfolite_portfolio_details_nonce'] ) || 
         ! wp_verify_nonce( $_POST['portfolite_portfolio_details_nonce'], 'portfolite_save_portfolio_details' ) ) {
        return;
    }

    // Check if user has permission to edit the post
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Don't save during autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Save meta fields
    $fields = array( 'client', 'date', 'skills', 'url' );
    
    foreach ( $fields as $field ) {
        $key = 'portfolio_' . $field;
        $meta_key = '_portfolio_' . $field;
        
        if ( isset( $_POST[ $key ] ) ) {
            $value = sanitize_text_field( $_POST[ $key ] );
            update_post_meta( $post_id, $meta_key, $value );
        }
    }
}
add_action( 'save_post', 'portfolite_save_portfolio_details' );

/**
 * Flush rewrite rules on theme activation
 */
function portfolite_flush_rewrite_rules() {
    portfolite_register_portfolio_post_type();
    portfolite_register_portfolio_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'portfolite_flush_rewrite_rules' );

