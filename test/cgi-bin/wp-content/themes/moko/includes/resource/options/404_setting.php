<?php return array(
	'title'      => esc_html__( '404 Page Settings', 'moko' ),
	'id'         => '404_setting',
	'desc'       => '',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => '404_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( '404 Source Type', 'moko' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'moko' ),
				'e' => esc_html__( 'Elementor', 'moko' ),
			),
			'default' => 'd',
		),
		array(
			'id'       => '404_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'moko' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
			],
			'required' => [ '404_source_type', '=', 'e' ],
		),
		array(
			'id'       => '404_default_st',
			'type'     => 'section',
			'title'    => esc_html__( '404 Default', 'moko' ),
			'indent'   => true,
			'required' => [ '404_source_type', '=', 'd' ],
		),
		
		//404 Banner
		array(
			'id'      => '404_page_banner',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Banner', 'moko' ),
			'desc'    => esc_html__( 'Enable to show banner on blog', 'moko' ),
			'default' => true,
		),
		array(
			'id'       => '404_banner_title',
			'type'     => 'text',
			'title'    => esc_html__( 'Banner Section Title', 'moko' ),
			'desc'     => esc_html__( 'Enter the title to show in banner section', 'moko' ),
			'required' => array( '404_page_banner', '=', true ),
		),
		array(
			'id'       => '404_page_background',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Background Image', 'moko' ),
			'desc'     => esc_html__( 'Insert background image for banner', 'moko' ),
			'required' => array( '404_page_banner', '=', true ),
		),
		
		//404 Content
		array(
			'id'       => 'error_404_image',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( '404 Image', 'moko' ),
			'desc'     => esc_html__( 'Upload 404 image for content', 'moko' ),
			'required' => array( '404_page_banner', '=', true ),
		),
		array(
			'id'    => 'error_page_title',
			'type'  => 'text',
			'title' => esc_html__( '404 Title', 'moko' ),
			'desc'  => esc_html__( 'Enter 404 section title that you want to show', 'moko' ),
		),
		array(
			'id'    => 'error_page_text',
			'type'  => 'textarea',
			'title' => esc_html__( '404 Page Description', 'moko' ),
			'desc'  => esc_html__( 'Enter 404 page description that you want to show.', 'moko' ),
		),
		array(
			'id'    => 'back_to_home_btn',
			'type'  => 'switch',
			'title' => esc_html__( 'Show Button', 'moko' ),
			'desc'  => esc_html__( 'Enable to show back to home button.', 'moko' ),
			'default'  => true,
		),
		array(
			'id'       => 'back_home_btn_label',
			'type'     => 'text',
			'title'    => esc_html__( 'Button Label', 'moko' ),
			'desc'     => esc_html__( 'Enter back to home button label that you want to show.', 'moko' ),
			'default'  => esc_html__( 'Go To Home Page', 'moko' ),
			'required' => array( 'back_to_home_btn', '=', true ),
		),
		array(
			'id'     => '404_post_settings_end',
			'type'   => 'section',
			'indent' => false,
		),
	),
);