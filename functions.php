<?php
function simplent_child_enqueue_styles() {

    $parent_style = 'simplent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'simplent-child-style',
                      get_stylesheet_directory_uri() . '/style.css',
                      array( $parent_style ),
                      wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'simplent_child_enqueue_styles' );
?>