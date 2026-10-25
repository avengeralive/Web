<?php return array(
	'title'      => 'Moko Blog MetaBox',
	'id'         => 'moko_meta_blog',
	'icon'       => 'el el-cogs',
	'position'   => 'normal',
	'priority'   => 'core',
	'post_types' => array( 'post' ),
	'sections'   => array(
		array(
			'id'     => 'moko_post_meta_setting',
			'fields' => array(
				array(
					'id'       => 'gallery_imgs',
					'type'     => 'gallery',
					'url'      => true,
					'title'    => esc_html__('Slider Image', 'moko'),
					'desc'     => esc_html__('Upload Slide Image URl', 'moko'),
				),
				array(
					'id'    => 'audio',
					'type'  => 'textarea',
					'title' => esc_html__( 'Audio', 'moko' ),
					'desc' => esc_html__( 'Enter iframe for Audio.', 'moko' ),
				),
				array(
					'id'    => 'quote',
					'type'  => 'textarea',
					'title' => esc_html__( 'Quote', 'moko' ),
				),
				array(
					'id'    => 'video',
					'type'  => 'text',
					'title' => esc_html__( 'Video URL', 'moko' ),
				),
			),
		),
	),
);