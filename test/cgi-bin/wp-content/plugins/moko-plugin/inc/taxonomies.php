<?php namespace MOKOPLUGIN\Inc;
use MOKOPLUGIN\Inc\Abstracts\Taxonomy;

class Taxonomies extends Taxonomy {

	public static function init() {

		$labels = array(
			'name'              => _x( 'Project Category', 'moko' ),
			'singular_name'     => _x( 'Project Category', 'moko' ),
			'search_items'      => __( 'Search Category', 'moko' ),
			'all_items'         => __( 'All Categories', 'moko' ),
			'parent_item'       => __( 'Parent Category', 'moko' ),
			'parent_item_colon' => __( 'Parent Category:', 'moko' ),
			'edit_item'         => __( 'Edit Category', 'moko' ),
			'update_item'       => __( 'Update Category', 'moko' ),
			'add_new_item'      => __( 'Add New Category', 'moko' ),
			'new_item_name'     => __( 'New Category Name', 'moko' ),
			'menu_name'         => __( 'Project Category', 'moko' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'project_cat' ),
		);
		register_taxonomy( 'project_cat', 'project', $args );
		
		//Services Taxonomy Start
		$labels = array(
			'name'              => _x( 'Service Category', 'moko' ),
			'singular_name'     => _x( 'Service Category', 'moko' ),
			'search_items'      => __( 'Search Category', 'moko' ),
			'all_items'         => __( 'All Categories', 'moko' ),
			'parent_item'       => __( 'Parent Category', 'moko' ),
			'parent_item_colon' => __( 'Parent Category:', 'moko' ),
			'edit_item'         => __( 'Edit Category', 'moko' ),
			'update_item'       => __( 'Update Category', 'moko' ),
			'add_new_item'      => __( 'Add New Category', 'moko' ),
			'new_item_name'     => __( 'New Category Name', 'moko' ),
			'menu_name'         => __( 'Service Category', 'moko' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'service_cat' ),
		);
		register_taxonomy( 'service_cat', 'service', $args );
		
		//Testimonials Taxonomy Start
		$labels = array(
			'name'              => _x( 'Testimonials Category', 'moko' ),
			'singular_name'     => _x( 'Testimonials Category', 'moko' ),
			'search_items'      => __( 'Search Category', 'moko' ),
			'all_items'         => __( 'All Categories', 'moko' ),
			'parent_item'       => __( 'Parent Category', 'moko' ),
			'parent_item_colon' => __( 'Parent Category:', 'moko' ),
			'edit_item'         => __( 'Edit Category', 'moko' ),
			'update_item'       => __( 'Update Category', 'moko' ),
			'add_new_item'      => __( 'Add New Category', 'moko' ),
			'new_item_name'     => __( 'New Category Name', 'moko' ),
			'menu_name'         => __( 'Testimonials Category', 'moko' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'testimonials_cat' ),
		);
		register_taxonomy( 'testimonials_cat', 'testimonials', $args );
		
		
		//Team Taxonomy Start
		$labels = array(
			'name'              => _x( 'Team Category', 'moko' ),
			'singular_name'     => _x( 'Team Category', 'moko' ),
			'search_items'      => __( 'Search Category', 'moko' ),
			'all_items'         => __( 'All Categories', 'moko' ),
			'parent_item'       => __( 'Parent Category', 'moko' ),
			'parent_item_colon' => __( 'Parent Category:', 'moko' ),
			'edit_item'         => __( 'Edit Category', 'moko' ),
			'update_item'       => __( 'Update Category', 'moko' ),
			'add_new_item'      => __( 'Add New Category', 'moko' ),
			'new_item_name'     => __( 'New Category Name', 'moko' ),
			'menu_name'         => __( 'Team Category', 'moko' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'team_cat' ),
		);
		register_taxonomy( 'team_cat', 'team', $args );
		
		//Faqs Taxonomy Start
		$labels = array(
			'name'              => _x( 'Faqs Category', 'moko' ),
			'singular_name'     => _x( 'Faq Category', 'moko' ),
			'search_items'      => __( 'Search Category', 'moko' ),
			'all_items'         => __( 'All Categories', 'moko' ),
			'parent_item'       => __( 'Parent Category', 'moko' ),
			'parent_item_colon' => __( 'Parent Category:', 'moko' ),
			'edit_item'         => __( 'Edit Category', 'moko' ),
			'update_item'       => __( 'Update Category', 'moko' ),
			'add_new_item'      => __( 'Add New Category', 'moko' ),
			'new_item_name'     => __( 'New Category Name', 'moko' ),
			'menu_name'         => __( 'Faq Category', 'moko' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'faqs_cat' ),
		);
		register_taxonomy( 'faqs_cat', 'faqs', $args );
	}
	
}
