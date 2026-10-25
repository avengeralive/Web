<?php require_once get_template_directory() . '/includes/loader.php';

add_action( 'after_setup_theme', 'moko_setup_theme' );
add_action( 'after_setup_theme', 'moko_load_default_hooks' );


function moko_setup_theme() {

	load_theme_textdomain( 'moko', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-background' );
	add_theme_support('woocommerce');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support( 'post-formats', array( 'audio', 'gallery', 'link', 'quote', 'video' ) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );


	// Set the default content width.
	$GLOBALS['content_width'] = 525;
	
	/*---------- Register image sizes ----------*/
	
	//Register image sizes
	add_image_size( 'moko_300x415', 300, 414, true ); //'Our Team V1'
	add_image_size( 'moko_112x112', 112, 112, true ); //'Testimonials V1 & V4'
	add_image_size( 'moko_370x250', 370, 250, true ); //'Our Blog V1 & Blog Grid Sidebar'
	add_image_size( 'moko_370x300', 370, 300, true ); //'Recent Projects & Projects With Sidebar'
	add_image_size( 'moko_60x60', 60, 60, true ); //'Testimonials V2'
	add_image_size( 'moko_370x270', 370, 270, true ); //'Our Blog V2'
	add_image_size( 'moko_120x120', 120, 120, true ); //'Our Services V3'
	add_image_size( 'moko_105x105', 105, 105, true ); //'Testimonials V3'
	add_image_size( 'moko_350x470', 350, 470, true ); //'Our Team V2 & V3'
	add_image_size( 'moko_300x450', 350, 470, true ); //'Team Single'
	add_image_size( 'moko_370x300', 370, 300, true ); //'Our Blog V3'
	add_image_size( 'moko_770x400', 770, 400, true ); //'Blog Single'
	add_image_size( 'moko_1170x400', 770, 400, true ); //'Blog Single'
	add_image_size( 'moko_80x80', 80, 80, true ); //'Gallery Footer'
	add_image_size( 'moko_100x100', 100, 100, true ); //'Recent Post Blog Sidebar'
	add_image_size( 'moko_110x110', 110, 110, true ); //'Gallery Blog Sidebar'
	add_image_size( 'moko_570x360', 570, 360, true ); //'Blog 2 Column'
	
	/*---------- Register image sizes ends ----------*/
	
	
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'main_menu' => esc_html__( 'Main Menu', 'moko' ),
		'footer_menu' => esc_html__( 'Footer Menu', 'moko' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'      => 250,
		'height'     => 250,
		'flex-width' => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style();
	add_action( 'admin_init', 'moko_admin_init', 2000000 );
}

/**
 * [moko_admin_init]
 *
 * @param  array $data [description]
 *
 * @return [type]       [description]
 */


function moko_admin_init() {
	remove_action( 'admin_notices', array( 'ReduxFramework', '_admin_notices' ), 99 );
}

/*---------- Sidebar settings ----------*/

/**
 * [moko_widgets_init]
 *
 * @param  array $data [description]
 *
 * @return [type]       [description]
 */
function moko_widgets_init() {

	global $wp_registered_sidebars;

	$theme_options = get_theme_mod( 'moko' . '_options-mods' );

	register_sidebar( array(
		'name'          => esc_html__( 'Default Sidebar', 'moko' ),
		'id'            => 'default-sidebar',
		'description'   => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'moko' ),
		'before_widget'=>'<div id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget'=>'</div>',
		'before_title' => '<div class="sidebar-title"><h4>',
		'after_title' => '</h4></div>'
	) );
	register_sidebar(array(
		'name' => esc_html__('Footer Widget', 'moko'),
		'id' => 'footer-sidebar',
		'description' => esc_html__('Widgets in this area will be shown in Footer Area.', 'moko'),
		'before_widget' => '<div class="footer-column col-lg-3 col-md-6 col-sm-12"><div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
	if ( class_exists( '\Elementor\Plugin' )){
		register_sidebar(array(
			'name' => esc_html__('Footer Widget Two', 'moko'),
			'id' => 'footer-sidebar-2',
			'description' => esc_html__('Widgets in this area will be shown in Footer Area.', 'moko'),
			'before_widget' => '<div class="footer-column col-lg-3 col-md-6 col-sm-12"><div id="%1$s" class="footer-widget %2$s">',
			'after_widget' => '</div></div>',
			'before_title' => '<h4>',
			'after_title' => '</h4>'
		));
		register_sidebar(array(
			'name' => esc_html__('Services Widget', 'moko'),
			'id' => 'services-sidebar',
			'description' => esc_html__('Widgets in this area will be shown in Service Details Area.', 'moko'),
			'before_widget' => '<div id="%1$s" class="services-widget %2$s">',
			'after_widget' => '</div>',
		));
		register_sidebar(array(
			'name' => esc_html__('Products Widget', 'moko'),
			'id' => 'product-sidebar',
			'description' => esc_html__('Widgets in this area will be shown in products.', 'moko'),
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="sidebar-title"><h4>',
			'after_title' => '</h4></div>'
		));
	}
	register_sidebar(array(
		'name' => esc_html__( 'Blog Sidebar', 'moko' ),
		'id' => 'blog-sidebar',
		'description' => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'moko' ),
		'before_widget'=>'<div id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget'=>'</div>',
		'before_title' => '<div class="sidebar-title"><h4>',
		'after_title' => '</h4></div>'
	));
	if ( ! is_object( moko_WSH() ) ) {
		return;
	}

	$sidebars = moko_set( $theme_options, 'custom_sidebar_name' );

	foreach ( array_filter( (array) $sidebars ) as $sidebar ) {

		if ( moko_set( $sidebar, 'topcopy' ) ) {
			continue;
		}

		$name = $sidebar;
		if ( ! $name ) {
			continue;
		}
		$slug = str_replace( ' ', '_', $name );

		register_sidebar( array(
			'name'          => $name,
			'id'            => sanitize_title( $slug ),
			'before_widget' => '<div id="%1$s" class="%2$s widget ">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	update_option( 'wp_registered_sidebars', $wp_registered_sidebars );
}

add_action( 'widgets_init', 'moko_widgets_init' );

/*---------- Sidebar settings ends ----------*/

/*---------- Gutenberg settings ----------*/

function moko_gutenberg_editor_palette_styles() {
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => esc_html__( 'strong yellow', 'moko' ),
            'slug' => 'strong-yellow',
            'color' => '#f7bd00',
        ),
        array(
            'name' => esc_html__( 'strong white', 'moko' ),
            'slug' => 'strong-white',
            'color' => '#fff',
        ),
		array(
            'name' => esc_html__( 'light black', 'moko' ),
            'slug' => 'light-black',
            'color' => '#242424',
        ),
        array(
            'name' => esc_html__( 'very light gray', 'moko' ),
            'slug' => 'very-light-gray',
            'color' => '#797979',
        ),
        array(
            'name' => esc_html__( 'very dark black', 'moko' ),
            'slug' => 'very-dark-black',
            'color' => '#000000',
        ),
    ) );
	
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name' => esc_html__( 'Small', 'moko' ),
			'size' => 10,
			'slug' => 'small'
		),
		array(
			'name' => esc_html__( 'Normal', 'moko' ),
			'size' => 15,
			'slug' => 'normal'
		),
		array(
			'name' => esc_html__( 'Large', 'moko' ),
			'size' => 24,
			'slug' => 'large'
		),
		array(
			'name' => esc_html__( 'Huge', 'moko' ),
			'size' => 36,
			'slug' => 'huge'
		)
	) );
	
}
add_action( 'after_setup_theme', 'moko_gutenberg_editor_palette_styles' );

/*---------- Gutenberg settings ends ----------*/

/*---------- More functions ----------*/

// 1) moko_set function

/**
 * [moko_set description]
 *
 * @param  array $data [description]
 *
 * @return [type]       [description]
 */
if ( ! function_exists( 'moko_set' ) ) {
	function moko_set( $var, $key, $def = '' ) {
		//if( ! $var ) return false;

		if ( is_object( $var ) && isset( $var->$key ) ) {
			return $var->$key;
		} elseif ( is_array( $var ) && isset( $var[ $key ] ) ) {
			return $var[ $key ];
		} elseif ( $def ) {
			return $def;
		} else {
			return false;
		}
	}
}

// 2) moko_add_editor_styles function
function moko_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'moko_add_editor_styles' );

// 3) Add specific CSS class by filter body class.
$options = moko_WSH()->option(); 
if( moko_set($options, 'boxed_wrapper') ){

add_filter( 'body_class', function( $classes ) {
    $classes[] = 'boxed_wrapper';
    return $classes;
} );
}

// 4) moko_related_products_limit function 
function moko_related_products_limit() {
  global $product;
	
	$args['posts_per_page'] = 6;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'moko_related_products_args', 20 );
  function moko_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 4 related products
	$args['columns'] = 1; // arranged in 2 columns
	return $args;
}

//Shop Product per page
function moko_shop_per_page( $cols ) {
  $cols = 12;
  return $cols;
}
add_filter( 'loop_shop_per_page', 'moko_shop_per_page', 20 );
/*---------- More functions ends ----------*/

add_action( 'woocommerce_after_add_to_cart_quantity', 'moko_quantity_plus_sign' );
 function moko_quantity_plus_sign() {
   echo '<button type="button" class="plus" >+</button>';
}
 
add_action( 'woocommerce_before_add_to_cart_quantity', 'moko_quantity_minus_sign' );
function moko_quantity_minus_sign() {
   echo '<button type="button" class="minus" >-</button>';
}
 
add_action( 'wp_footer', 'moko_quantity_plus_minus' );
function moko_quantity_plus_minus() { ?>
	<script type="text/javascript">
	jQuery(document).ready(function($){   
		$('form.cart').on( 'click', 'button.plus, button.minus', function() {
			// Get current quantity values
			var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
			var val   = parseFloat(qty.val());
			var max = parseFloat(qty.attr( 'max' ));
			var min = parseFloat(qty.attr( 'min' ));
			var step = parseFloat(qty.attr( 'step' ));

			// Change the value if plus or minus
			if ( $( this ).is( '.plus' ) ) {
				if ( max && ( max <= val ) ) {
					qty.val( max );
				} 
				else {
					qty.val( val + step );
				}
			} else {
				if ( min && ( min >= val ) ) {
					qty.val( min );
				} 
				else if ( val > 1 ) {
					qty.val( val - step );
				}
			}
		});
	});
	</script>
<?php
}
