<?
add_theme_support('menus');
add_theme_support('widgets');
add_theme_support('post-thumbnails');

add_action( 'init', 'register_types', 0 );
function register_types() {
    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
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
        'rewrite'           => true,
    );

    register_taxonomy( 'casino_category', array( 'casino' ), $args );
	
    register_post_type( 'casinos',
        array(
            'labels' => array(
                'name' => __( 'Казино' ),
				'menu_name' => __( 'Казино' ),
                'singular_name' => __( 'Казино' ),
                'add_new' => __( 'Добавить казино' ),
                'add_new_item' => __( 'Добавить новое казино' ),
                'edit' => __( 'Редактировать' ),
                'edit_item' => __( 'Редактировать казино' ),
                'new_item' => __( 'Добавить новую казино' ),
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
			'taxonomies' => array( 'casino_category' ),
			'rewrite'     => array(
                 'slug'       => 'casinos', // if you need slug
                 'with_front' => false,
             )
        )
    );
    flush_rewrite_rules();
}

class magomra_walker_nav_menu extends Walker_Nav_Menu {

	// add classes to ul sub-menus
	function start_lvl( &$output, $depth ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'sub-menu dropdown-menu',
			( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
			( $display_depth >=2 ? 'sub-sub-menu' : '' ),
			'menu-depth-' . $display_depth
			);
		$class_names = implode( ' ', $classes );

		// build html
		$output .= "\n" . $indent . '<ul class="' . $class_names . '"><li><ul class="inner-dropdown-menu">' . "\n";
	}
	
	function end_lvl( &$output, $depth ) {
		$output .= '</ul></li></ul>';
	}

	// add main/sub classes to li's and links
	 function start_el( &$output, $item, $depth, $args ) {
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'main-menu-item dropdown' : 'sub-menu-item dropdown' ),
			( $depth >=2 ? 'sub-sub-menu-item' : '' ),
			( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
			'menu-item-depth-' . $depth
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
		
		// build html
		global $post; //var_dump($post);
		if ($post->ID == $item->object_id) $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="nav-item active ' . $depth_class_names . ' ' . $class_names . '">';
		else $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="nav-item ' . $depth_class_names . ' ' . $class_names . '">';

		// link attributes
		//var_dump($item);
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		if ($args->walker->has_children) $attributes .= ' class="menu-link nav-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '" '.( $depth == 0 ? 'aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"' : '');
		else $attributes .= ' class="menu-link nav-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
		if ($args->walker->has_children) $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s<span class="caret"></span></a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);
		 else $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);

		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

// И там, где нужно выводим меню так:
function magomra_nav_menu( $menu_id ) {
	// main navigation menu
	$args = array(
		'theme_location'    => 'navigation_menu_primary',
		'container'     => 'false',
		'echo'          => true,
		'items_wrap'        => '%3$s',
		'depth'         => 10, 
		'walker'        => new magomra_walker_nav_menu,
		'menu' => $menu_id
	);

	// print menu
	wp_nav_menu( $args );
}

if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Sidebar',
    'before_widget' => '<div class = "widgetizedArea">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  )
);

function load_cat_parent_template($template) {

    $cat_ID = absint( get_query_var('cat') );
    $category = get_category( $cat_ID );

    $templates = array();

    if ( !is_wp_error($category) )
        $templates[] = "category-{$category->slug}.php";

    $templates[] = "category-$cat_ID.php";

    // trace back the parent hierarchy and locate a template
    if ( !is_wp_error($category) ) {
        $category = $category->parent ? get_category($category->parent) : '';

        if( !empty($category) ) {
            if ( !is_wp_error($category) )
                $templates[] = "category-{$category->slug}.php";

            $templates[] = "category-{$category->term_id}.php";
        }
    }

    $templates[] = "category.php";
    $template = locate_template($templates);

    return $template;
}
add_action('category_template', 'load_cat_parent_template');

function load_tax_parent_template($template) {
    global $wp_query;

    $templates = array();

    if (in_array($wp_query->queried_object->term_id, array(13, 15, 17, 18, 19))) $templates[] = "taxonomy-casino_category-bonus.php";

    $templates[] = "taxonomy-casino_category.php";

    $template = locate_template($templates);

    return $template;
}
add_action('taxonomy_template', 'load_tax_parent_template');

?>