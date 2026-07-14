<?php 

    $themename="tpotstech";

    // This theme uses wp_nav_menu() in header location.  

    register_nav_menus( array(  

        'primary' => __( 'Header Menu', '$themename' ),

       ) );

    //Theme Title-tag support

    add_theme_support( 'title-tag' );

       

    //Theme support post thumb nil

    add_theme_support( 'post-thumbnails' );
    require get_template_directory() . '/inc/meta-boxes/alumni.php';
    require get_template_directory() . '/inc/meta-boxes/cpt-metabox.php';
    require get_template_directory() . '/inc/meta-boxes/statistics-metabox.php';
    require get_template_directory() . '/inc/cpt/cta.php';
    require get_template_directory() . '/inc/cpt/statistics.php';

    /**
 * Allow SVG Upload
 */
function allow_svg_upload($mimes) {

    $mimes['svg'] = 'image/svg+xml';

    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_upload');
    