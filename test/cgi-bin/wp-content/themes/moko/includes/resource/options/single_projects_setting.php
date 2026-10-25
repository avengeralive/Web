<?php return array(
	'title'      => esc_html__( 'Single Projects Settings', 'moko' ),
	'id'         => 'single_projects_setting',
	'desc'       => '',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'single_project_date',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Date', 'moko' ),
			'desc'    => esc_html__( 'Enable to show date on projects detail page', 'moko' ),
			'default' => false,
		),
		array(
			'id'      => 'single_project_category',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Category', 'moko' ),
			'desc'    => esc_html__( 'Enable to show category on projects detail page', 'moko' ),
			'default' => false,
		),
		array(
			'id'      => 'single_project_client',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Client', 'moko' ),
			'desc'    => esc_html__( 'Enable to show client on projects single page', 'moko' ),
			'default' => false,
		),
		array(
			'id'      => 'project_facebook_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Facebook Projects Share', 'moko' ),
			'desc'    => esc_html__( 'Enable to show Projects Share to Facebook', 'moko' ),
			'default' => false,
		),
		array(
			'id'      => 'project_twitter_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Twitter Projects Share', 'moko' ),
			'desc'    => esc_html__( 'Enable to show Projects Share to Twitter', 'moko' ),
			'default' => false,
		),
		array(
			'id'      => 'project_linkedin_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Linkedin Projects Share', 'moko' ),
			'desc'    => esc_html__( 'Enable to show Projects Share to Linkedin', 'moko' ),
			'default' => false,
		),
		array(
			'id'      => 'project_pinterest_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Pinterest Projects Share', 'moko' ),
			'desc'    => esc_html__( 'Enable to show Projects Share to Pinterest', 'moko' ),
			'default' => false,
		),
		array(
			'id'      => 'project_reddit_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Reddit Projects Share', 'moko' ),
			'desc'    => esc_html__( 'Enable to show Projects Share to Reddit', 'moko' ),
			'default' => false,
		),
		array(
			'id'      => 'project_tumblr_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Tumblr Projects Share', 'moko' ),
			'desc'    => esc_html__( 'Enable to show Projects Share to Tumblr', 'moko' ),
			'default' => false,
		),
		array(
			'id'      => 'project_digg_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Digg Projects Share', 'moko' ),
			'desc'    => esc_html__( 'Enable to show Projects Share to Digg', 'moko' ),
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





