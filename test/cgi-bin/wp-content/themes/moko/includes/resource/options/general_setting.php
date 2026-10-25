<?php
$styles = [];
foreach(range(1, 28) as $val) {
    $styles[$val] = sprintf(esc_html__('Style %s', 'moko'), $val);
}

return  array(
    'title'      => esc_html__( 'General Setting', 'moko' ),
    'id'         => 'general_setting',
    'desc'       => '',
    'icon'       => 'el el-wrench',
    'fields'     => array(
        array(
            'id' => 'theme_preloader',
            'type' => 'switch',
            'title' => esc_html__('Enable Preloader', 'moko'),
            'default' => false,
        ),
		
		//RTL Version
        array(
            'id' => 'theme_rtl',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable RTL Version', 'moko'),
            'default' => false,
        ),
		
		//Boxed Version
        array(
            'id' => 'theme_boxed',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable Boxed Version', 'moko'),
            'default' => false,
        ),
		
		//Dark Version
        array(
            'id' => 'theme_dark',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable Dark Version', 'moko'),
            'default' => false,
        ),
		
		//Sticky Menu
        array(
            'id' => 'sticky_menu',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable Sticky Menu', 'moko'),
            'default' => false,
        ),
    ),
);
