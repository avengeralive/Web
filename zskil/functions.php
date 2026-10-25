<?
add_theme_support('menus');
add_theme_support('widgets');
add_theme_support('post-thumbnails');

add_action( 'init', 'register_types' );


function register_types() {
    $labels = array(
        'name'              => _x( 'Категории', 'taxonomy general name' ),
        'singular_name'     => _x( 'Категория', 'taxonomy singular name' ),
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
        'rewrite'           => array( 'slug' => 'event_category' ),
    );

        
    register_taxonomy( 'event_category', array( 'event_category' ), $args );
    register_post_type( 'events',
        array(
            'labels' => array(
                'name' => __( 'Мероприятия' ),
                'menu_name' => __( 'Мероприятия' ),
                'singular_name' => __( 'Мероприятия' ),
                'add_new' => __( 'Добавить мероприятие' ),
                'add_new_item' => __( 'Добавить новое мероприятие' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать мероприятие' ),
                'new_item' => __( 'Добавить новое мероприятие' ),
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
            'taxonomies' => array( 'event_category' ),
            'rewrite'     => array(
                'slug'       => 'events', // if you need slug
                'with_front' => false,
            )
        )
    );
}

?>