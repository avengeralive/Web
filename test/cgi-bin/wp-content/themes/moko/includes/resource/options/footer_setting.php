<?php return array(
	'title'      => esc_html__( 'Footer Setting', 'moko' ),
	'id'         => 'footer_setting',
	'desc'       => '',
	'subsection' => false,
	'fields'     => array(
		array(
			'id'      => 'footer_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Footer Source Type', 'moko' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'moko' ),
				'e' => esc_html__( 'Elementor', 'moko' ),
			),
			'default' => 'd',
		),
		array(
			'id'       => 'footer_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'moko' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
				'posts_per_page'	=> -1
			],
			'required' => [ 'footer_source_type', '=', 'e' ],
		),
		array(
			'id'       => 'footer_style_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Footer Settings', 'moko' ),
			'required' => array( 'footer_source_type', '=', 'd' ),
		),
		array(
		    'id'       => 'footer_style_settings',
		    'type'     => 'image_select',
		    'title'    => esc_html__( 'Choose Footer Styles', 'moko' ),
		    'subtitle' => esc_html__( 'Choose Footer Styles', 'moko' ),
		    'options'  => array(

			    'footer_v1'  => array(
				    'alt' => esc_html__( 'Footer Style 1', 'moko' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/footer/footer1.png',
			    ),
			    'footer_v2'  => array(
				    'alt' => esc_html__( 'Footer Style 2', 'moko' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/footer/footer2.png',
			    ),
			    'footer_v3'  => array(
				    'alt' => esc_html__( 'Footer Style 3', 'moko' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/footer/footer3.png',
			    ),
			    'footer_v4'  => array(
				    'alt' => esc_html__( 'Footer Style 4', 'moko' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/footer/footer4.png',
			    ),
			),
			'required' => array( 'footer_source_type', '=', 'd' ),
			'default' => 'footer_v6',
	    ),
		
		/***********************************************************************
								Footer Version 1 Start
		************************************************************************/
		array(
			'id'       => 'footer_v1_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Footer Style One Settings', 'moko' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v1' ),
		),
		
		//Copyrights
		array(
			'id'      => 'copyrights_v1',
			'type'    => 'textarea',
			'title'   => __( 'Copyright Text', 'moko' ),
			'desc'    => esc_html__( 'Enter the Copyright Text', 'moko' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v1' ),
		),
		
		/***********************************************************************
								Footer Version 2 Start
		************************************************************************/
		array(
			'id'       => 'footer_v2_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Footer Style Two Settings', 'moko' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v2' ),
		),
		
		//Background Image
		array(
			'id'       => 'footer_bg_img_v2',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Footer Background Image', 'moko' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/background/map-pattern-2.png' ),
		    'required' => array( 'footer_style_settings', '=', 'footer_v2' ),
		),
		
		//Copyrghts
		array(
			'id'      => 'copyrights_v2',
			'type'    => 'textarea',
			'title'   => __( 'Copyright Text', 'moko' ),
			'desc'    => esc_html__( 'Enter the Copyright Text', 'moko' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v2' ),
		),
		
		//Footer Navigation
		array(
		    'id'       => 'show_footer_menu_v2',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable Footer Menu', 'moko' ),
		    'desc'     => esc_html__( 'Enable/Disable Footer Menu.', 'moko' ),
		    'required' => array( 'footer_style_settings', '=', 'footer_v2' ),
	    ),
		
		/***********************************************************************
								Footer Version 3 Start
		************************************************************************/
		array(
			'id'       => 'footer_v3_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Footer Style Three Settings', 'moko' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v3' ),
		),
		
		//Copyrights
		array(
			'id'      => 'copyrights_v3',
			'type'    => 'textarea',
			'title'   => __( 'Copyright Text', 'moko' ),
			'desc'    => esc_html__( 'Enter the Copyright Text', 'moko' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v3' ),
		),
		
		/***********************************************************************
								Footer Version 4 Start
		************************************************************************/
		array(
			'id'       => 'footer_v4_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Footer Style Four Settings', 'moko' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v4' ),
		),
		array(
			'id'      => 'copyrights_v4',
			'type'    => 'textarea',
			'title'   => __( 'Copyright Text', 'moko' ),
			'desc'    => esc_html__( 'Enter the Copyright Text', 'moko' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v4' ),
		),
		
		array(
			'id'       => 'footer_default_ed',
			'type'     => 'section',
			'indent'   => false,
			'required' => [ 'footer_source_type', '=', 'd' ],
		),
	),
);
