<?
add_theme_support('post-formats');
add_theme_support('post-thumbnails');
add_theme_support('html5');
add_theme_support('custom-logo');
add_theme_support('custom-header-uploads');
add_theme_support('custom-header');
add_theme_support('custom-background');
add_theme_support('title-tag');
add_theme_support('starter-content');
add_theme_support('responsive-embeds');
add_theme_support('menus');
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' ); 
add_filter('show_admin_bar', '__return_false');