<?php
/**
 * Theme functions and definitions.
 */
function moko_child_enqueue_styles() {

    if ( SCRIPT_DEBUG ) {
        wp_enqueue_style( 'moko-style' , get_template_directory_uri() . '/style.css' );
    } else {
        wp_enqueue_style( 'moko-minified-style' , get_template_directory_uri() . '/style.min.css' );
    }

    wp_enqueue_style( 'moko-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'moko-style' ),
        wp_get_theme()->get('Version')
    );
}

add_action(  'wp_enqueue_scripts', 'moko_child_enqueue_styles' );