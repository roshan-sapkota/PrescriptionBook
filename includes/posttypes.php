<?php
 /**
 * Register a custom post type called "Prescription".
 *
 * @see get_post_type_labels() for label keys.
 */
function prescriptionbook_cpt_init() {
    $labels = array(
        'name'                  => _x( 'Prescriptions', 'Post type general name', 'prescriptionbook' ),
        'singular_name'         => _x( 'Prescription', 'Post type singular name', 'prescriptionbook' ),
        'menu_name'             => _x( 'Prescriptions', 'Admin Menu text', 'prescriptionbook' ),
        'name_admin_bar'        => _x( 'Prescription', 'Add New on Toolbar', 'prescriptionbook' ),
        'add_new'               => __( 'Add New', 'prescriptionbook' ),
        'add_new_item'          => __( 'Add New Prescription', 'prescriptionbook' ),
        'new_item'              => __( 'New Prescription', 'prescriptionbook' ),
        'edit_item'             => __( 'Edit Prescription', 'prescriptionbook' ),
        'view_item'             => __( 'View Prescription', 'prescriptionbook' ),
        'all_items'             => __( 'All Prescriptions', 'prescriptionbook' ),
        'search_items'          => __( 'Search Prescriptions', 'prescriptionbook' ),
        'parent_item_colon'     => __( 'Parent Prescriptions:', 'prescriptionbook' ),
        'not_found'             => __( 'No Prescriptions found.', 'prescriptionbook' ),
        'not_found_in_trash'    => __( 'No Prescriptions found in Trash.', 'prescriptionbook' ),
        'featured_image'        => _x( 'Prescription Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'prescriptionbook' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'prescriptionbook' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'prescriptionbook' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'prescriptionbook' ),
        'archives'              => _x( 'Prescription archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'prescriptionbook' ),
        'insert_into_item'      => _x( 'Insert into Prescription', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'prescriptionbook' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Prescription', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'prescriptionbook' ),
        'filter_items_list'     => _x( 'Filter Prescriptions list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'prescriptionbook' ),
        'items_list_navigation' => _x( 'Prescriptions list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'prescriptionbook' ),
        'items_list'            => _x( 'Prescriptions list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'prescriptionbook' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'prescriptions' ),
        'capability_type'    => 'prescription',
        'has_archive'        => true,
        'hierarchical'       => false,
        'show_in_rest'       => true,
        'rest_base'          => 'prescriptions',  
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-clipboard',
        'supports'           => array( 'title', 'editor', 'author'),
        'map_meta_cap'       => true,
    );
 
    register_post_type( 'prescription', $args );
}
 
add_action( 'init', 'prescriptionbook_cpt_init' );

/**
 * Flush Rewrite rules on activation
 *
 */

 function prescriptionbook_rewrite_flush () {
    prescriptionbook_cpt_init();
    flush_rewrite_rules();
 }