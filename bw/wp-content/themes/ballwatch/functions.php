<?php
include_once('acf-repeater/acf-repeater.php');
add_theme_support('menus');

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}

add_action( 'init', 'register_types' );


function register_types() {
	$labels = array(
        'name'              => _x( 'Категории каталога', 'taxonomy general name' ),
        'singular_name'     => _x( 'Категория каталого', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Categories' ),
        'all_items'         => __( 'All Categories' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Categories' ),
    );

    $args = array(
        'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'catalog_category' ),
    );

        
    register_taxonomy( 'catalog_category', array( 'catalog_category' ), $args );
	
	register_post_type( 'catalog',
        array(
            'labels' => array(
                'name' => __( 'Каталог' ),
                'menu_name' => __( 'Каталог' ),
                'singular_name' => __( 'Каталог' ),
                'add_new' => __( 'Добавить каталог' ),
                'add_new_item' => __( 'Добавить новый каталог' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать каталог' ),
                'new_item' => __( 'Добавить новый каталог' ),
                'view' => __( 'Просмотр' ),
                'view_item' => __( 'Просмотр' ),
                'search_items' => __( 'Поиск' ),
                'not_found' => __( 'Не найдено' ),
                'not_found_in_trash' => __( 'Не найдено' ),
            ),
            'supports' => array( 'title', 'editor', 'thumbnail'),
            'description' => __('Websites to be shown in Resources section.'),
            'public' => true,
            'show_ui' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'menu_position' => 5,
            'has_archive' => false,
            'can_export' => true,
			'taxonomies' => array( 'catalog_category' ),
            'rewrite'     => array(
                'slug'       => 'catalog', // if you need slug
                'with_front' => false,
            )
        )
    );
}
?>
