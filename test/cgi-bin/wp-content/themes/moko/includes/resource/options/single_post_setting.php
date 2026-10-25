<?php return array(
	'title'      => esc_html__( 'Single Post Settings', 'moko' ),
	'id'         => 'single_post_setting',
	'desc'       => '',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'single_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Single Post Source Type', 'moko' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'moko' ),
				'e' => esc_html__( 'Elementor', 'moko' ),
			),
			'default' => 'd',
		),

		array(
			'id'       => 'single_default_st',
			'type'     => 'section',
			'title'    => esc_html__( 'Post Default', 'moko' ),
			'indent'   => true,
			'required' => [ 'single_source_type', '=', 'd' ],
		),
		array(
			'id'      => 'single_post_meta',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Post Meta', 'moko' ),
			'desc'    => esc_html__( 'Enable to show post post meta on posts detail page', 'moko' ),
			'default' => false,
		),
		array(
			'id'      => 'single_post_author',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Author', 'moko' ),
			'desc'    => esc_html__( 'Enable to show author on posts detail page', 'moko' ),
			'default' => false,
		),
		array(
			'id'      => 'single_post_tag',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Tags', 'moko' ),
			'desc'    => esc_html__( 'Enable to show post tags on posts single page', 'moko' ),
			'default' => false,
		),
		array(
			'id'      => 'facebook_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Facebook Post Share', 'moko' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Facebook', 'moko' ),
			'default' => false,
		),
		array(
			'id'      => 'twitter_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Twitter Post Share', 'moko' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Twitter', 'moko' ),
			'default' => false,
		),
		array(
			'id'      => 'linkedin_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Linkedin Post Share', 'moko' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Linkedin', 'moko' ),
			'default' => false,
		),
		array(
			'id'      => 'pinterest_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Pinterest Post Share', 'moko' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Pinterest', 'moko' ),
			'default' => false,
		),
		array(
			'id'      => 'reddit_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Reddit Post Share', 'moko' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Reddit', 'moko' ),
			'default' => false,
		),
		array(
			'id'      => 'tumblr_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Tumblr Post Share', 'moko' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Tumblr', 'moko' ),
			'default' => false,
		),
		array(
			'id'      => 'digg_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Digg Post Share', 'moko' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Digg', 'moko' ),
			'default' => false,
		),
		
		array(
			'id'       => 'single_section_default_ed',
			'type'     => 'section',
			'indent'   => false,
			'required' => [ 'single_source_type', '=', 'd' ],
		),
	),
);





