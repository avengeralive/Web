<?php return array(
	'title'      => esc_html__( 'Header Setting', 'moko' ),
	'id'         => 'headers_setting',
	'desc'       => '',
	'subsection' => false,
	'fields'     => array(
		array(
			'id'      => 'header_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Header Source Type', 'moko' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'moko' ),
				'e' => esc_html__( 'Elementor', 'moko' ),
			),
			'default' => 'd',
		),
		array(
			'id'       => 'header_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'moko' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
				'posts_per_page'	=> -1
			],
			'required' => [ 'header_source_type', '=', 'e' ],
		),
		array(
			'id'       => 'header_style_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Settings', 'moko' ),
			'required' => array( 'header_source_type', '=', 'd' ),
		),
		array(
		    'id'       => 'header_style_settings',
		    'type'     => 'image_select',
		    'title'    => esc_html__( 'Choose Header Styles', 'moko' ),
		    'subtitle' => esc_html__( 'Choose Header Styles', 'moko' ),
		    'options'  => array(

			    'header_v1'  => array(
				    'alt' => esc_html__( 'Header Style 1', 'moko' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/header/header1.png',
			    ),
			    'header_v2'  => array(
				    'alt' => esc_html__( 'Header Style 2', 'moko' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/header/header2.png',
			    ),
				'header_v3'  => array(
				    'alt' => esc_html__( 'Header Style 3', 'moko' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/header/header3.png',
			    ),
				'header_v4'  => array(
				    'alt' => esc_html__( 'Header Style 4', 'moko' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/header/header4.png',
			    ),
			),
			'required' => array( 'header_source_type', '=', 'd' ),
			'default' => 'header_v1',
	    ),
		
		/***********************************************************************
								Header Version 1 Start
		************************************************************************/
		array(
			'id'       => 'header_v1_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Style One Settings', 'moko' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
		),
		array(
		    'id'       => 'show_button_v1',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable Button', 'moko' ),
		    'desc'     => esc_html__( 'Enable/Disable Button.', 'moko' ),
			'default'  => '',
		    'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    ),
		array(
		    'id'       => 'button_name_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Name', 'moko' ),
			'required' => array( 'show_button_v1', '=', true ),
		),
		array(
		    'id'       => 'button_link_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Link', 'moko' ),
			'required' => array( 'show_button_v1', '=', true ),
		),
		array(
		    'id'       => 'button_style_v1',
		    'type'     => 'select',
		    'default' => 'one',
		    'title'    => esc_html__( 'Button Style', 'moko' ),
		    'options'  => moko_button_style(),
			'required' => array( 'show_button_v1', '=', true ),
	    ),
		array(
		    'id'       => 'button_style_sticky_v1',
		    'type'     => 'select',
		    'default' => 'two',
		    'title'    => esc_html__( 'Sticky Button Style', 'moko' ),
		    'options'  => moko_button_style(),
			'required' => array( 'show_button_v1', '=', true ),
	    ),
		array(
		    'id'       => 'show_search_v1',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable Search Icon', 'moko' ),
		    'desc'     => esc_html__( 'Enable/Disable Search Icon.', 'moko' ),
			'default'  => '',
		    'required' => array( 'header_style_settings', '=', 'header_v1' ),
	    ),
		
		/***********************************************************************
								Header Version 2 Start
		************************************************************************/
		array(
			'id'       => 'header_v2_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Style Two Settings', 'moko' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
		),
		array(
		    'id'       => 'show_top_bar_v2',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable Show Top Bar', 'moko' ),
		    'desc'     => esc_html__( 'Enable/Disable Show Top Bar.', 'moko' ),
			'default'  => '',
		    'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    ),
		array(
		    'id'       => 'show_welcome_message_v2',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable Welcome Message', 'moko' ),
		    'desc'     => esc_html__( 'Enable/Disable Welcome Message.', 'moko' ),
			'default'  => '',
		    'required' => array( 'show_top_bar_v2', '=', true ),
	    ),
		array(
		    'id'       => 'welcome_message_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Welcome Message', 'moko' ),
			'required' => array( 'show_welcome_message_v2', '=', true ),
		),
		array(
		    'id'       => 'show_address_v2',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable Address', 'moko' ),
		    'desc'     => esc_html__( 'Enable/Disable Address.', 'moko' ),
			'default'  => '',
		    'required' => array( 'show_top_bar_v2', '=', true ),
	    ),
		array(
		    'id'       => 'address_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Address', 'moko' ),
			'required' => array( 'show_address_v2', '=', true ),
		),
		array(
		    'id'       => 'show_email_address_v2',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable Email Address', 'moko' ),
		    'desc'     => esc_html__( 'Enable/Disable Email Address.', 'moko' ),
			'default'  => '',
		    'required' => array( 'show_top_bar_v2', '=', true ),
	    ),
		array(
		    'id'       => 'email_address_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Email Address', 'moko' ),
			'required' => array( 'show_email_address_v2', '=', true ),
		),
		array(
		    'id'       => 'show_cart_v2',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable Cart Icon', 'moko' ),
		    'desc'     => esc_html__( 'Enable/Disable Cart Icon.', 'moko' ),
			'default'  => '',
		    'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    ),
		array(
		    'id'       => 'show_search_v2',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable Search Icon', 'moko' ),
		    'desc'     => esc_html__( 'Enable/Disable Search Icon.', 'moko' ),
			'default'  => '',
		    'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    ),
		array(
		    'id'       => 'show_button_v2',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable Button', 'moko' ),
		    'desc'     => esc_html__( 'Enable/Disable Button.', 'moko' ),
			'default'  => '',
		    'required' => array( 'header_style_settings', '=', 'header_v2' ),
	    ),
		array(
		    'id'       => 'button_name_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Name', 'moko' ),
			'required' => array( 'show_button_v2', '=', true ),
		),
		array(
		    'id'       => 'button_link_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Link', 'moko' ),
			'required' => array( 'show_button_v2', '=', true ),
		),
		array(
		    'id'       => 'button_style_v2',
		    'type'     => 'select',
		    'default' => 'one',
		    'title'    => esc_html__( 'Button Style', 'moko' ),
		    'options'  => moko_button_style(),
			'required' => array( 'show_button_v2', '=', true ),
	    ),
		array(
		    'id'       => 'button_style_sticky_v2',
		    'type'     => 'select',
		    'default' => 'two',
		    'title'    => esc_html__( 'Sticky Button Style', 'moko' ),
		    'options'  => moko_button_style(),
			'required' => array( 'show_button_v2', '=', true ),
	    ),
		/***********************************************************************
								Sidebar Info V2
		************************************************************************/
		array(
            'id' => 'sidebar_info_v2',
            'type' => 'switch',
            'title' => esc_html__('Enable Sidebar Information', 'moko'),
            'default' => false,
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
        ),
		array(
		    'id'       => 'sidebar_about_title_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'About Us Title', 'moko' ),
			'default'  => '',
		    'required' => array( 'sidebar_info_v2', '=', true ),
	    ),
		array(
		    'id'       => 'sidebar_about_text_v2',
		    'type'     => 'textarea',
		    'title'    => esc_html__( 'About Us Text', 'moko' ),
			'required' => array( 'sidebar_info_v2', '=', true ),
		),
		array(
		    'id'       => 'show_sidebar_button_v2',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable Button', 'moko' ),
		    'desc'     => esc_html__( 'Enable/Disable Button.', 'moko' ),
			'default'  => '',
		    'required' => array( 'sidebar_info_v2', '=', true ),
	    ),
		array(
		    'id'       => 'sidebar_button_name_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Name', 'moko' ),
			'required' => array( 'show_sidebar_button_v2', '=', true ),
		),
		array(
		    'id'       => 'sidebar_button_link_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Link', 'moko' ),
			'required' => array( 'show_sidebar_button_v2', '=', true ),
		),
		array(
		    'id'       => 'sidebar_button_style_v2',
		    'type'     => 'select',
		    'default' => 'two',
		    'title'    => esc_html__( 'Button Style', 'moko' ),
		    'options'  => moko_button_style(),
			'required' => array( 'show_sidebar_button_v2', '=', true ),
	    ),
		array(
		    'id'       => 'sidebar_contact_title_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Contact Title', 'moko' ),
			'default'  => '',
		    'required' => array( 'sidebar_info_v2', '=', true ),
	    ),
		array(
		    'id'       => 'sidebar_address_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Address', 'moko' ),
			'required' => array( 'sidebar_info_v2', '=', true ),
		),
		array(
		    'id'       => 'sidebar_phone_number_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Phone Number', 'moko' ),
			'required' => array( 'sidebar_info_v2', '=', true ),
		),
		array(
		    'id'       => 'sidebar_email_address_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Email Address', 'moko' ),
			'required' => array( 'sidebar_info_v2', '=', true ),
		),
		array(
		    'id'       => 'sidebar_working_hours_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Email Working Hours', 'moko' ),
			'required' => array( 'sidebar_info_v2', '=', true ),
		),
		array(
		    'id'       => 'show_sidebar_social_media_v2',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable Social Media', 'moko' ),
		    'desc'     => esc_html__( 'Enable/Disable Social Media.', 'moko' ),
			'default'  => '',
		    'required' => array( 'sidebar_info_v2', '=', true ),
	    ),
		array(
			'id'    => 'sidebar_social_media_v2',
			'type'  => 'social_media',
			'title' => esc_html__( 'Social Media', 'moko' ),
			'required' => array( 'show_sidebar_social_media_v2', '=', true ),
		),
		
		/***********************************************************************
								Header Version 3 Start
		************************************************************************/
		array(
			'id'       => 'header_v3_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Style Three Settings', 'moko' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
		),
		array(
		    'id'       => 'show_search_v3',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable Search Icon', 'moko' ),
		    'desc'     => esc_html__( 'Enable/Disable Search Icon.', 'moko' ),
			'default'  => '',
		    'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    ),
		array(
		    'id'       => 'show_button_v3',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable Button', 'moko' ),
		    'desc'     => esc_html__( 'Enable/Disable Button.', 'moko' ),
			'default'  => '',
		    'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    ),
		array(
		    'id'       => 'button_name_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Name', 'moko' ),
			'required' => array( 'show_button_v3', '=', true ),
		),
		array(
		    'id'       => 'button_link_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Link', 'moko' ),
			'required' => array( 'show_button_v3', '=', true ),
		),
		array(
		    'id'       => 'button_style_v3',
		    'type'     => 'select',
		    'default' => 'one',
		    'title'    => esc_html__( 'Button Style', 'moko' ),
		    'options'  => moko_button_style(),
			'required' => array( 'show_button_v3', '=', true ),
	    ),
		array(
		    'id'       => 'button_style_sticky_v3',
		    'type'     => 'select',
		    'default' => 'two',
		    'title'    => esc_html__( 'Sticky Button Style', 'moko' ),
		    'options'  => moko_button_style(),
			'required' => array( 'show_button_v3', '=', true ),
	    ),
		array(
		    'id'       => 'show_cart_v3',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable Cart Icon', 'moko' ),
		    'desc'     => esc_html__( 'Enable/Disable Cart Icon.', 'moko' ),
			'default'  => '',
		    'required' => array( 'header_style_settings', '=', 'header_v3' ),
	    ),
		/***********************************************************************
								Sidebar Info V3
		************************************************************************/
		array(
            'id' => 'sidebar_info_v3',
            'type' => 'switch',
            'title' => esc_html__('Enable Sidebar Information', 'moko'),
            'default' => false,
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
        ),
		array(
		    'id'       => 'sidebar_about_title_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'About Us Title', 'moko' ),
			'default'  => '',
		    'required' => array( 'sidebar_info_v3', '=', true ),
	    ),
		array(
		    'id'       => 'sidebar_about_text_v3',
		    'type'     => 'textarea',
		    'title'    => esc_html__( 'About Us Text', 'moko' ),
			'required' => array( 'sidebar_info_v3', '=', true ),
		),
		array(
		    'id'       => 'show_sidebar_button_v3',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable Button', 'moko' ),
		    'desc'     => esc_html__( 'Enable/Disable Button.', 'moko' ),
			'default'  => '',
		    'required' => array( 'sidebar_info_v3', '=', true ),
	    ),
		array(
		    'id'       => 'sidebar_button_name_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Name', 'moko' ),
			'required' => array( 'show_sidebar_button_v3', '=', true ),
		),
		array(
		    'id'       => 'sidebar_button_link_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Link', 'moko' ),
			'required' => array( 'show_sidebar_button_v3', '=', true ),
		),
		array(
		    'id'       => 'sidebar_button_style_v3',
		    'type'     => 'select',
		    'default' => 'two',
		    'title'    => esc_html__( 'Button Style', 'moko' ),
		    'options'  => moko_button_style(),
			'required' => array( 'show_sidebar_button_v3', '=', true ),
	    ),
		array(
		    'id'       => 'sidebar_contact_title_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Contact Title', 'moko' ),
			'default'  => '',
		    'required' => array( 'sidebar_info_v3', '=', true ),
	    ),
		array(
		    'id'       => 'sidebar_address_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Address', 'moko' ),
			'required' => array( 'sidebar_info_v3', '=', true ),
		),
		array(
		    'id'       => 'sidebar_phone_number_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Phone Number', 'moko' ),
			'required' => array( 'sidebar_info_v3', '=', true ),
		),
		array(
		    'id'       => 'sidebar_email_address_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Email Address', 'moko' ),
			'required' => array( 'sidebar_info_v3', '=', true ),
		),
		array(
		    'id'       => 'sidebar_working_hours_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Email Working Hours', 'moko' ),
			'required' => array( 'sidebar_info_v3', '=', true ),
		),
		array(
		    'id'       => 'show_sidebar_social_media_v3',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable Social Media', 'moko' ),
		    'desc'     => esc_html__( 'Enable/Disable Social Media.', 'moko' ),
			'default'  => '',
		    'required' => array( 'sidebar_info_v3', '=', true ),
	    ),
		array(
			'id'    => 'sidebar_social_media_v3',
			'type'  => 'social_media',
			'title' => esc_html__( 'Social Media', 'moko' ),
			'required' => array( 'show_sidebar_social_media_v3', '=', true ),
		),
		
		/***********************************************************************
								Header Version 4 Start
		************************************************************************/
		array(
			'id'       => 'header_v4_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Style Four Settings', 'moko' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
		),
		
		//Search
		
		array(
		    'id'       => 'show_search_v4',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable Search Icon', 'moko' ),
		    'desc'     => esc_html__( 'Enable/Disable Search Icon.', 'moko' ),
			'default'  => '',
		    'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    ),
		
		//Button
		array(
		    'id'       => 'show_button_v4',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable Button', 'moko' ),
		    'desc'     => esc_html__( 'Enable/Disable Button.', 'moko' ),
			'default'  => '',
		    'required' => array( 'header_style_settings', '=', 'header_v4' ),
	    ),
		array(
		    'id'       => 'button_name_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Name', 'moko' ),
			'required' => array( 'show_button_v4', '=', true ),
		),
		array(
		    'id'       => 'button_link_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Link', 'moko' ),
			'required' => array( 'show_button_v4', '=', true ),
		),
		array(
		    'id'       => 'button_style_v4',
		    'type'     => 'select',
		    'default' => 'one',
		    'title'    => esc_html__( 'Button Style', 'moko' ),
		    'options'  => moko_button_style(),
			'required' => array( 'show_button_v4', '=', true ),
	    ),
		array(
		    'id'       => 'button_style_sticky_v4',
		    'type'     => 'select',
		    'default' => 'two',
		    'title'    => esc_html__( 'Sticky Button Style', 'moko' ),
		    'options'  => moko_button_style(),
			'required' => array( 'show_button_v4', '=', true ),
	    ),
		
		array(
			'id'       => 'header_style_section_end',
			'type'     => 'section',
			'indent'      => false,
			'required' => [ 'header_source_type', '=', 'd' ],
		),
	),
);
