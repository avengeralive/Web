<?
add_theme_support('menus');
add_theme_support('widgets');
add_theme_support('post-thumbnails');

function get_menu_array($name) {
    $result = array();
    $menu = wp_get_nav_menu_items($name);
    foreach ($menu as $element) {
        if ($element->menu_item_parent == 0) {
            $result[$element->ID] = $element;
            $result[$element->ID]->child_elements = array();
        }
        else {
            $result[$element->menu_item_parent]->child_elements[] = $element;
        }
    }
    return $result;
}
