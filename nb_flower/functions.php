<?
add_theme_support('menus');
add_theme_support( 'post-thumbnails' ); 
function create_taxonomy()
{
	$args = array( 
		"public" => true,
		"label" => "Продукция",
		"show_in_menu" => true
	);
	register_post_type('products', $args);
}

add_action( 'init', 'create_taxonomy' );
add_post_type_support('products', 'thumbnail');
