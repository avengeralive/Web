<?
add_theme_support( 'menus' );
add_theme_support( 'widgets' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array(
	'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
) );
add_theme_support( 'post-formats', array(
	'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
) );
add_theme_support( 'custom-logo', array(
	'height'      => 248,
	'width'       => 248,
	'flex-height' => true,
) );
add_action( 'init', 'register_types' );
function register_types() {
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
            'description' => __('Websites to be shown in Resources section.'),
            'public' => true,
            'show_ui' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'menu_position' => 5,
            'taxonomies' => array( '' ),
            'has_archive' => true,
            'can_export' => true,
            'menu_icon' => 'dashicons-shield'
        )
    );
    add_post_type_support( 'services', 'thumbnail' );
    add_post_type_support( 'services', 'page-attributes' );
    add_post_type_support( 'services', 'post-formats' );

    register_post_type( 'slider',
        array(
            'labels' => array(
                'name' => __( 'Слайдер' ),
                'menu_name' => __( 'Слайдер' ),
                'singular_name' => __( 'Слайдер' ),
                'add_new' => __( 'Добавить слайд' ),
                'add_new_item' => __( 'Добавить новый слайд' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать слайд' ),
                'new_item' => __( 'Добавить новый слайд' ),
                'view' => __( 'Просмотр' ),
                'view_item' => __( 'Просмотр' ),
                'search_items' => __( 'Поиск' ),
                'not_found' => __( 'Не найдено' ),
                'not_found_in_trash' => __( 'Не найдено' ),
            ),
            'description' => __('Websites to be shown in Resources section.'),
            'public' => true,
            'show_ui' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'menu_position' => 5,
            'taxonomies' => array( '' ),
            'has_archive' => true,
            'can_export' => true,
            'menu_icon' => 'dashicons-format-gallery'
        )
    );
    add_post_type_support( 'slider', 'thumbnail' );
    add_post_type_support( 'slider', 'page-attributes' );
    add_post_type_support( 'slider', 'post-formats' );
    add_post_type_support( 'post', 'excerpt' );
}
?>