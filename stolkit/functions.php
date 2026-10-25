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
        'rewrite'           => array( 'slug' => 'texture_category' ),
    );

    
    register_taxonomy( 'texture_category', array( 'texture_category' ), $args );
    
	register_post_type( 'textrure',
        array(
            'labels' => array(
                'name' => __( 'Текстуры' ),
                'menu_name' => __( 'Текстуры' ),
                'singular_name' => __( 'Текстуры' ),
                'add_new' => __( 'Добавить текстуру' ),
                'add_new_item' => __( 'Добавить новую текстуру' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать текстуру' ),
                'new_item' => __( 'Добавить новую текстуру' ),
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
            'has_archive' => true,
            'can_export' => true,
            'taxonomies' => array( 'texture_category' ),
            'rewrite'     => array(
                 'slug'       => 'texture', // if you need slug
                 'with_front' => false,
             )
        )
    );

    register_post_type( 'services',
        array(
            'labels' => array(
                'name' => __( 'Услуги' ),
                'menu_name' => __( 'Услуги' ),
                'singular_name' => __( 'Услуги' ),
                'add_new' => __( 'Добавить услугу' ),
                'add_new_item' => __( 'Добавить новую услугу' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать услугу' ),
                'new_item' => __( 'Добавить новую услугу' ),
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
            'has_archive' => true,
            'can_export' => true,
            'rewrite'     => array(
                 'slug'       => 'services', // if you need slug
                 'with_front' => false,
             )
        )
    );

    register_post_type( 'reviews',
        array(
            'labels' => array(
                'name' => __( 'Отзывы' ),
                'menu_name' => __( 'Отзывы' ),
                'singular_name' => __( 'Отзыв' ),
                'add_new' => __( 'Добавить отзыв' ),
                'add_new_item' => __( 'Добавить новый отзыв' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать отзыв' ),
                'new_item' => __( 'Добавить новый отзыв' ),
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
            'has_archive' => true,
            'can_export' => true,
            'rewrite'     => array(
                 'slug'       => 'reviews', // if you need slug
                 'with_front' => false,
             )
        )
    );

    register_post_type( 'stol',
        array(
            'labels' => array(
                'name' => __( 'Столешницы' ),
                'menu_name' => __( 'Столешницы' ),
                'singular_name' => __( 'Столешницы' ),
                'add_new' => __( 'Добавить столешницу' ),
                'add_new_item' => __( 'Добавить новую столешницу' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать столешницу' ),
                'new_item' => __( 'Добавить новую столешницу' ),
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
            'has_archive' => true,
            'can_export' => true,
            'rewrite'     => array(
                 'slug'       => 'stol', // if you need slug
                 'with_front' => false,
             )
        )
    );

    register_post_type( 'podok',
        array(
            'labels' => array(
                'name' => __( 'Подоконники' ),
                'menu_name' => __( 'Подоконники' ),
                'singular_name' => __( 'Подоконники' ),
                'add_new' => __( 'Добавить подоконник' ),
                'add_new_item' => __( 'Добавить новый подоконник' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать подоконник' ),
                'new_item' => __( 'Добавить новый подоконник' ),
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
            'has_archive' => true,
            'can_export' => true,
            'rewrite'     => array(
                 'slug'       => 'podok', // if you need slug
                 'with_front' => false,
             )
        )
    );

    register_post_type( 'sanuz',
        array(
            'labels' => array(
                'name' => __( 'Столешницы в санузел' ),
                'menu_name' => __( 'Столешницы в санузел' ),
                'singular_name' => __( 'Столешницы в санузел' ),
                'add_new' => __( 'Добавить столешницу в санузел' ),
                'add_new_item' => __( 'Добавить новую столешницу в санузел' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать столешницу в санузел' ),
                'new_item' => __( 'Добавить новую столешницу в санузел' ),
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
            'has_archive' => true,
            'can_export' => true,
            'rewrite'     => array(
                 'slug'       => 'sanuz', // if you need slug
                 'with_front' => false,
             )
        )
    );
	
	register_post_type( 'stoyki_resepshn',
        array(
            'labels' => array(
                'name' => __( 'Стойки ресепшн' ),
                'menu_name' => __( 'Стойки ресепшн' ),
                'singular_name' => __( 'Стойки ресепшн' ),
                'add_new' => __( 'Добавить стойку ресепшн' ),
                'add_new_item' => __( 'Добавить новую стойку ресепшн' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать стойку ресепшн' ),
                'new_item' => __( 'Добавить новую стойку ресепшн' ),
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
            'has_archive' => true,
            'can_export' => true,
            'rewrite'     => array(
                 'slug'       => 'stoyki_resepshn', // if you need slug
                 'with_front' => false,
             )
        )
    );

    register_post_type( 'stoyki_bar',
        array(
            'labels' => array(
                'name' => __( 'Стойки бар' ),
                'menu_name' => __( 'Стойки бар' ),
                'singular_name' => __( 'Стойки бар' ),
                'add_new' => __( 'Добавить стойку бар' ),
                'add_new_item' => __( 'Добавить новую стойку бар' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать стойку бар' ),
                'new_item' => __( 'Добавить новую стойку бар' ),
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
            'has_archive' => true,
            'can_export' => true,
            'rewrite'     => array(
                 'slug'       => 'stoyki_bar', // if you need slug
                 'with_front' => false,
             )
        )
    );

    register_post_type( 'stoly',
        array(
            'labels' => array(
                'name' => __( 'Столы' ),
                'menu_name' => __( 'Столы' ),
                'singular_name' => __( 'Столы' ),
                'add_new' => __( 'Добавить стол' ),
                'add_new_item' => __( 'Добавить новый стол' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать стол' ),
                'new_item' => __( 'Добавить новый стол' ),
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
            'has_archive' => true,
            'can_export' => true,
            'rewrite'     => array(
                 'slug'       => 'stoly', // if you need slug
                 'with_front' => false,
             )
        )
    );

    register_post_type( 'other',
        array(
            'labels' => array(
                'name' => __( 'Другие изделия' ),
                'menu_name' => __( 'Другие изделия' ),
                'singular_name' => __( 'Другие изделия' ),
                'add_new' => __( 'Добавить другое изделие' ),
                'add_new_item' => __( 'Добавить новое другое изделие' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать другое изделие' ),
                'new_item' => __( 'Добавить новое другое изделие' ),
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
            'has_archive' => true,
            'can_export' => true,
            'rewrite'     => array(
                 'slug'       => 'other', // if you need slug
                 'with_front' => false,
             )
        )
    );
}

?>