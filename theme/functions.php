<?
add_theme_support('menus');

add_action( 'init', 'register_types' );
function register_types() {
    register_post_type( 'portfolio',
        array(
            'labels' => array(
                'name' => __( 'Работы' ),
				'menu_name' => __( 'Работы' ),
                'singular_name' => __( 'Работы' ),
                'add_new' => __( 'Добавить работу' ),
                'add_new_item' => __( 'Добавить новую работу' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать работу' ),
                'new_item' => __( 'Добавить новую работу' ),
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
            'can_export' => true
        )
    );
	
	register_post_type( 'advertis',
        array(
            'labels' => array(
                'name' => __( 'Рекламы' ),
				'menu_name' => __( 'Рекламы' ),
                'singular_name' => __( 'Рекламы' ),
                'add_new' => __( 'Добавить рекламу' ),
                'add_new_item' => __( 'Добавить новую рекламу' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать рекламу' ),
                'new_item' => __( 'Добавить новую рекламу' ),
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
            'can_export' => true
        )
    );
}
?>