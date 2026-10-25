<?php return array(
	'id'     => 'moko_banner_settings',
	'title'  => esc_html__( "Moko Banner Settings", "moko" ),
	'fields' => array(
		array(
			'id'      => 'banner_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Banner Source Type', 'moko' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'moko' ),
				'e' => esc_html__( 'Elementor', 'moko' ),
			),
			'default' => '',
		),
		array(
			'id'       => 'banner_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'moko' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
				'posts_per_page'=> -1,
			],
			'required' => [ 'banner_source_type', '=', 'e' ],
		),
		array(
			'id'       => 'banner_page_banner',
			'type'     => 'switch',
			'title'    => esc_html__( 'Show Banner', 'moko' ),
			'default'  => false,
			'required' => [ 'banner_source_type', '=', 'd' ],
		),
		array(
			'id'       => 'banner_banner_title',
			'type'     => 'text',
			'title'    => esc_html__( 'Banner Section Title', 'moko' ),
			'desc'     => esc_html__( 'Enter the title to show in banner section', 'moko' ),
			'required' => array( 'banner_page_banner', '=', true ),
		),
		array(
			'id'       => 'banner_page_background',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Background Image', 'moko' ),
			'desc'     => esc_html__( 'Insert background image for banner', 'moko' ),
			'required' => array( 'banner_page_banner', '=', true ),
		),
	),
);