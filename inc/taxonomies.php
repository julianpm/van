<?php
function cod_taxonomies() {
    // Services
    $labels = array(
        'name'                => __( 'Service Category'),
        'singular_name'       => __( 'Service Category'),
        'search_items'        => __( 'Search Services' ),
        'all_items'           => __( 'All Services' ),
        'parent_item'         => __( 'Parent Service' ),
        'parent_item_colon'   => __( 'Parent Service:' ),
        'edit_item'           => __( 'Edit Service' ),
        'update_item'         => __( 'Update Service' ),
        'add_new_item'        => __( 'Add New Service' ),
        'new_item_name'       => __( 'New Service' ),
        'menu_name'           => __( 'Service Category' )
    );

    $args = array(
        'hierarchical'        => true,
        'labels'              => $labels,
        'show_ui'             => true,
        'show_in_nav_menus'   => false,
        'show_admin_column'   => true,
        'query_var'           => true,
        'show_admin_column'   => true,
        'rewrite'             => array( 'slug' => 'service' )
    );

    register_taxonomy( 'service', array('projects'), $args );

}
add_action( 'init', 'cod_taxonomies', 0 );