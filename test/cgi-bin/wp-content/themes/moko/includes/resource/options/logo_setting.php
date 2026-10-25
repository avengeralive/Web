<?php return array(
	'title'      => esc_html__( 'Logo Setting', 'moko' ),
	'id'         => 'logo_setting',
	'desc'       => '',
	'subsection' => false,
	'fields'     => array(
		array(
			'id'       => 'image_favicon',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Favicon', 'moko' ),
			'subtitle' => esc_html__( 'Upload site favicon image', 'moko' ),
		),
		
		/***********************************************************************
								Light Logo
		************************************************************************/
		array(
            'id' => 'normal_logo_show',
            'type' => 'switch',
            'title' => esc_html__('Enable Light Logo', 'moko'),
            'default' => true,
        ),
		array(
			'id'       => 'image_normal_logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Light Logo', 'moko' ),
			'subtitle' => esc_html__( 'Upload Light logo image', 'moko' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/logo.png' ),
			'required' => array( 'normal_logo_show', '=', true ),
		),
		array(
			'id'       => 'normal_logo_dimension',
			'type'     => 'dimensions',
			'title'    => esc_html__( 'Light Logo Dimentions', 'moko' ),
			'subtitle' => esc_html__( 'Upload Light Logo Dimentions', 'moko' ),
			'units'    => array( 'em', 'px', '%' ),
			'default'  => array( 'Width' => '', 'Height' => '' ),
			'required' => array( 'normal_logo_show', '=', true ),
		),
		
		/***********************************************************************
								Dark Logo
		************************************************************************/
		array(
            'id' => 'normal_logo_show2',
            'type' => 'switch',
            'title' => esc_html__('Enable Dark Logo', 'moko'),
            'default' => true,
        ),
		array(
			'id'       => 'image_normal_logo2',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Dark Logo', 'moko' ),
			'subtitle' => esc_html__( 'Insert site Dark logo image', 'moko' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/logo-4.png' ),
			'required' => array( 'normal_logo_show2', '=', true ),
		),
		array(
			'id'       => 'normal_logo_dimension2',
			'type'     => 'dimensions',
			'title'    => esc_html__( 'Dark Logo Dimentions', 'moko' ),
			'subtitle' => esc_html__( 'Select Dark Logo Dimentions', 'moko' ),
			'units'    => array( 'em', 'px', '%' ),
			'default'  => array( 'Width' => '', 'Height' => '' ),
			'required' => array( 'normal_logo_show2', '=', true ),
		),
		
		/***********************************************************************
								Sticky Logo
		************************************************************************/
		array(
            'id' => 'normal_logo_show3',
            'type' => 'switch',
            'title' => esc_html__('Enable Sticky Logo', 'moko'),
            'default' => true,
        ),
		array(
			'id'       => 'image_normal_logo3',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Sticky Logo', 'moko' ),
			'subtitle' => esc_html__( 'Insert site Sticky logo image', 'moko' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/logo-small.png' ),
			'required' => array( 'normal_logo_show3', '=', true ),
		),
		array(
			'id'       => 'normal_logo_dimension3',
			'type'     => 'dimensions',
			'title'    => esc_html__( 'Sticky Logo Dimentions', 'moko' ),
			'subtitle' => esc_html__( 'Select Sticky Logo Dimentions', 'moko' ),
			'units'    => array( 'em', 'px', '%' ),
			'default'  => array( 'Width' => '', 'Height' => '' ),
			'required' => array( 'normal_logo_show3', '=', true ),
		),
		
		/***********************************************************************
								Mobile Sidebar Logo
		************************************************************************/
		array(
            'id' => 'normal_logo_show4',
            'type' => 'switch',
            'title' => esc_html__('Enable Mobile Sidebar Logo', 'moko'),
            'default' => true,
        ),
		array(
			'id'       => 'image_normal_logo4',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Mobile Sidebar Logo', 'moko' ),
			'subtitle' => esc_html__( 'Insert site Mobile Sidebar logo image', 'moko' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/logo-3.png' ),
			'required' => array( 'normal_logo_show4', '=', true ),
		),
		array(
			'id'       => 'normal_logo_dimension4',
			'type'     => 'dimensions',
			'title'    => esc_html__( 'Mobile Sidebar Logo Dimentions', 'moko' ),
			'subtitle' => esc_html__( 'Select Mobile Sidebar +Logo Dimentions', 'moko' ),
			'units'    => array( 'em', 'px', '%' ),
			'default'  => array( 'Width' => '', 'Height' => '' ),
			'required' => array( 'normal_logo_show4', '=', true ),
		),
		
		/***********************************************************************
								Sidebar Logo
		************************************************************************/
		array(
            'id' => 'normal_logo_show5',
            'type' => 'switch',
            'title' => esc_html__('Enable Sidebar Logo', 'moko'),
            'default' => true,
        ),
		array(
			'id'       => 'image_normal_logo5',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Sidebar Logo', 'moko' ),
			'subtitle' => esc_html__( 'Insert site Sidebar logo image', 'moko' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/logo.png' ),
			'required' => array( 'normal_logo_show5', '=', true ),
		),
		array(
			'id'       => 'normal_logo_dimension5',
			'type'     => 'dimensions',
			'title'    => esc_html__( 'Sidebar Logo Dimentions', 'moko' ),
			'subtitle' => esc_html__( 'Select Sidebar +Logo Dimentions', 'moko' ),
			'units'    => array( 'em', 'px', '%' ),
			'default'  => array( 'Width' => '', 'Height' => '' ),
			'required' => array( 'normal_logo_show5', '=', true ),
		),
		
		array(
			'id'       => 'logo_settings_section_end',
			'type'     => 'section',
			'indent'      => false,
		),
	),
);
