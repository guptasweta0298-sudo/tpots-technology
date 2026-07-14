<?php
function register_cta_post_type() {

    $labels = array(
        'name'               => 'CTAs',
        'singular_name'      => 'CTA',
        'add_new'            => 'Add New CTA',
        'add_new_item'       => 'Add New CTA',
        'edit_item'          => 'Edit CTA',
        'new_item'           => 'New CTA',
        'view_item'          => 'View CTA',
        'search_items'       => 'Search CTAs',
        'not_found'          => 'No CTA Found',
        'menu_name'          => 'CTA',
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'supports'      => array('title','editor', 'author', 'thumbnail'),
        'menu_icon'     => 'dashicons-megaphone',
        'has_archive'   => false,
        'rewrite'       => array('slug' => 'cta'),
    );

    register_post_type('cta', $args);

}
add_action('init', 'register_cta_post_type');