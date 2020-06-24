<?php
/**
 * Custom post type for Pets
 *
 */
function pet_custom_type() {
    $labels = array(
        'name'               => 'Pets',
        'singular_name'      => 'Pet',
        'add_new'            => 'New Pet',
        'add_new_item'       => 'New Pet',
        'edit_item'          => 'Edit Pet',
        'new_item'           => 'New',
        'all_items'          => 'All Pets',
        'view_item'          => 'View Pet',
        'search_items'       => 'Search for a pet',
        'not_found'          => 'Nothing found',
        'not_found_in_trash' => 'Nothing found on trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Pets'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'query_var'          => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => _( 5 ),
        'menu_icon'          => 'dashicons-heart',
        'supports'           => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'comments'
        ),
        'show_in_rest'      => true
    );
    register_post_type( 'pet', $args );
    flush_rewrite_rules( true );
}
add_action( 'init', 'pet_custom_type' );