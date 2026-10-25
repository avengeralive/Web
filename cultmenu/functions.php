<?php

/**
* загружаемые стили и скрипты
**/
function cultmenu_scripts() {
	wp_enqueue_style ('style-css', get_stylesheet_uri());
	wp_enqueue_style ('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style ('bootstrap-theme', get_template_directory_uri() . '/css/bootstrap-theme.min.css');
	wp_enqueue_style ('animate', get_template_directory_uri() . '/css/animate.min.css');
	wp_enqueue_style ('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');

	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js');
	wp_enqueue_script('css3-animate-it', get_template_directory_uri() . '/js/css3-animate-it.js');
	wp_enqueue_script('agency', get_template_directory_uri() . '/js/agency.js');
	wp_enqueue_script('jquery.easing', get_template_directory_uri() . '/js/jquery.easing.min.js');
	
}

/**
* загружаем стили и скрипты
**/
add_action('wp_enqueue_scripts', 'cultmenu_scripts');

/**
* поддержка миниатюр
**/
add_theme_support( 'post-thumbnails' );

/**
*Меню
**/
register_nav_menu( 'menu', Меню );

function the_breadcrumb() {
    echo '';
    if (!is_front_page()) {
        echo '<a href="'; echo get_option('home');  echo '">Home';
        echo "</a> / ";
        if (is_category() || is_single()) {
            the_category(' ');
            if (is_single()) {
                echo " / ";
                the_title();
            }
        } elseif (is_page()) {
            echo the_title();
        }
    }
    else {
        echo 'Home';
    }
}