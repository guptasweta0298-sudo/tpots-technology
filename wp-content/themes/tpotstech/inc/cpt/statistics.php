<?php
function register_statistics_post_type() {

    $labels = array(
        'name'               => 'Statistics',
        'singular_name'      => 'Statistic',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Statistic',
        'edit_item'          => 'Edit Statistic',
        'new_item'           => 'New Statistic',
        'view_item'          => 'View Statistic',
        'search_items'       => 'Search Statistics',
        'not_found'          => 'No Statistics Found',
        'menu_name'          => 'Statistics',
    );

    $args = array(

        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 25,
        'menu_icon'          => 'dashicons-chart-bar',

        'supports'           => array(
            'title',
            'thumbnail'
        ),

        'has_archive'        => false,

        'rewrite'            => array(
            'slug' => 'statistics'
        ),

        'show_in_rest'       => true,

    );

    register_post_type(
        'statistics',
        $args
    );

}

add_action(
    'init',
    'register_statistics_post_type'
);