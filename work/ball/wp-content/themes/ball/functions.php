<?
add_theme_support('menus');
add_theme_support('widgets');
add_theme_support('post-thumbnails');
add_theme_support( 'woocommerce' );

function get_menu_array($name) {
    $result = array();
    $menu = wp_get_nav_menu_items($name);
    foreach ($menu as $element) {
        $result[$element->ID] = $element;
        $result[$element->ID]->child_elements = array();
    }
    $result2 = $result;
    foreach (array_reverse($result2) as $value) {
        if ($value->menu_item_parent != 0) {
          $result[$value->menu_item_parent]->child_elements[] = $value;
          unset($result[$value->ID]);
        }
    }
    foreach ($result as $val) {
        $result[$val->ID]->child_elements = array_reverse($result[$val->ID]->child_elements);
    }
    return $result;
}