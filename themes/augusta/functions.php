<?php
/**
 * Augusta functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Augusta
 */


 /**
 * Define Constants
 */
define( 'TEMPLATIC_THEME_VERSION', '1.0.6' );
define( 'TEMPLATIC_THEME_DIR', get_template_directory() );
define( 'TEMPLATIC_THEME_URI', get_template_directory_uri() );



/**
* Basic Theme Setup
*/
if ( ! function_exists( 'augusta_setup' ) ) :
	function augusta_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'augusta', TEMPLATIC_THEME_DIR . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'augusta' ),
		) );

		// Switch default core markup for search form, comment form, and comments
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'augusta_custom_background_args', array(
			'default-color' => 'f4f4f4',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for core custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'augusta_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function augusta_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'augusta_content_width', 1000 );
}
add_action( 'after_setup_theme', 'augusta_content_width', 0 );



/**
 * Register widget area.
 */
function augusta_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'augusta' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'augusta' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Header Right', 'augusta' ),
		'id'            => 'header-right',
		'description'   => esc_html__( 'Add widgets to display in header right.', 'augusta' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );
}
add_action( 'widgets_init', 'augusta_widgets_init' );



/**
 * Enqueue scripts and styles.
 */
function augusta_scripts() {
	wp_enqueue_style( 'augusta-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400,600' );
	wp_enqueue_style( 'slicknavcss', TEMPLATIC_THEME_URI . '/assets/css/slicknav.css', array(), 'v1.0.10', 'all' );
	wp_enqueue_style( 'font-awesome-5', TEMPLATIC_THEME_URI . '/assets/css/fontawesome-all.css', array(), '5.0.13', 'all' );
	wp_enqueue_style( 'bootstrap-4', TEMPLATIC_THEME_URI . '/assets/css/bootstrap.css', array(), 'v4.1.1', 'all' );
	wp_enqueue_style( 'augusta-style', get_stylesheet_uri(), array(), 'v1.0.0', 'all' );

	wp_enqueue_script( 'slicknav', TEMPLATIC_THEME_URI . '/assets/js/jquery.slicknav.js', array( 'jquery' ), 'v1.0.10', true );
	wp_enqueue_script( 'augusta-theme', TEMPLATIC_THEME_URI . '/assets/js/theme.js', array( 'jquery' ), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'augusta_scripts' );

// Add theme hooks.
require TEMPLATIC_THEME_DIR . '/inc/theme-hooks.php';

// Implement the Custom Header feature.
require TEMPLATIC_THEME_DIR . '/inc/custom-header.php';

// Custom template tags for this theme.
require TEMPLATIC_THEME_DIR . '/inc/template-tags.php';

// Functions which enhance the theme by hooking into WordPress.
require TEMPLATIC_THEME_DIR . '/inc/template-functions.php';

// Customizer additions.
require TEMPLATIC_THEME_DIR . '/inc/customizer.php';

// Load Jetpack compatibility file.
if ( defined( 'JETPACK__VERSION' ) ) {
	require TEMPLATIC_THEME_DIR . '/inc/jetpack.php';
}
