<?php
return array(
	'title'      => 'Moko Project Setting',
	'id'         => 'moko_meta_project',
	'icon'       => 'el el-cogs',
	'position'   => 'normal',
	'priority'   => 'core',
	'post_types' => array( 'project' ),
	'sections'   => array(
		array(
			'id'     => 'moko_project_meta_setting',
			'fields' => array(
				array(
					'id'    => 'published',
					'type'  => 'text',
					'title' => esc_html__( 'Published', 'moko' ),
				),
				array(
					'id'    => 'category',
					'type'  => 'text',
					'title' => esc_html__( 'Category', 'moko' ),
				),
				array(
					'id'    => 'client',
					'type'  => 'text',
					'title' => esc_html__( 'Client', 'moko' ),
				),
			),
		),
	),
);