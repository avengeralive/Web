<?
add_theme_support('post-thumbnails');
add_theme_support('menus');
add_theme_support( 'custom-background' );
add_theme_support( 'custom-header' );
add_theme_support( 'custom-logo' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
add_theme_support( 'title-tag' );
add_theme_support( 'customize-selective-refresh-widgets' );
add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

    return $content;
});

add_action( 'init', 'register_types' );

function register_types() {
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
                 'slug'       => 'slider', // if you need slug
                 'with_front' => false,
             )
        )
    );
	
}

?>