<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

add_action( 'after_setup_theme', 'hostels_setup' );

if ( ! function_exists( 'hostels_setup' ) ):
    function hostels_setup() {
        // Navigations
        register_nav_menus(array(
            'main-menu' => __('Главное меню', 'hostels'),
            'hostels-menu' => __('Хостелы', 'hostels')
        ));

        // Add posts thumbs
        add_theme_support( 'post-thumbnails' );	
                
        /*
         * Makes Phoenix available for translation.
         *
         * Translations can be added to the /languages/ directory.
         */
        load_theme_textdomain( 'hostels', get_template_directory() . '/languages' );
    }
endif;

/**
 * A safe way of adding JavaScripts to a WordPress generated page.
 */
 
if (!is_admin())
    add_action('wp_enqueue_scripts', 'hostels_js');

if (!function_exists('hostels_js')) {
    function hostels_js() {

        // stylesheet
        wp_enqueue_style('core-style', get_template_directory_uri() . '/css/app.css', false, '1');
        wp_enqueue_style('theme-style', get_stylesheet_uri(), false, '1');

    }
}

if (function_exists('add_theme_support')) {
    add_theme_support('menus');
}

function hostels_footer_script(){
    wp_enqueue_script('core-script', get_template_directory_uri() . '/js/app.js');
}
add_action('wp_footer', 'hostels_footer_script');

function wp_42573_fix_template_caching( WP_Screen $current_screen ) {
    // Only flush the file cache with each request to post list table, edit post screen, or theme editor.
    if ( ! in_array( $current_screen->base, array( 'post', 'edit', 'theme-editor' ), true ) ) {
        return;
    }
    $theme = wp_get_theme();
    if ( ! $theme ) {
        return;
    }
    $cache_hash = md5( $theme->get_theme_root() . '/' . $theme->get_stylesheet() );
    $label = sanitize_key( 'files_' . $cache_hash . '-' . $theme->get( 'Version' ) );
    $transient_key = substr( $label, 0, 29 ) . md5( $label );
    delete_transient( $transient_key );
}
add_action( 'current_screen', 'wp_42573_fix_template_caching' );


function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// stop wp removing div tags
function ikreativ_tiny_mce_fix( $init )
{
    // html elements being stripped
    $init['extended_valid_elements'] = 'span[*]';

    // pass back to wordpress
    return $init;
}
add_filter('tiny_mce_before_init', 'ikreativ_tiny_mce_fix');

function change_mce_options($init){
    $init["forced_root_block"] = false;
    $init["force_br_newlines"] = true;
    $init["force_p_newlines"] = false;
    $init["convert_newlines_to_brs"] = true;
    return $init;
}
add_filter('tiny_mce_before_init','change_mce_options');

if( function_exists('acf_add_options_page') ) {
	$option_page = acf_add_options_page(array(
		'page_title' 	=> 'Настройки шаблона',
		'menu_title' 	=> 'Настройки шаблона',
		'menu_slug' 	=> 'theme-general-settings',
		'capability' 	=> 'edit_posts',
		'redirect' 	=> false
	));
}

if( function_exists('acf_add_options_page') ) {
	$option_page = acf_add_options_page(array(
		'page_title' 	=> 'Хостелы',
		'menu_title' 	=> 'Хостелы',
		'menu_slug' 	=> 'theme-hostels',
		'capability' 	=> 'edit_posts',
		'redirect' 	=> false
	));
}