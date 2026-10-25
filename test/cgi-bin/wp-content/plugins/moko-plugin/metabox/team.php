<?php
return array(
	'title'      => 'Moko Team Setting',
	'id'         => 'moko_meta_team',
	'icon'       => 'el el-cogs',
	'position'   => 'normal',
	'priority'   => 'core',
	'post_types' => array( 'team' ),
	'sections'   => array(
		array(
			'id'     => 'moko_team_meta_setting',
			'fields' => array(
				array(
					'id'    => 'designation',
					'type'  => 'text',
					'title' => esc_html__( 'Designation', 'moko' ),
				),
				array(
					'id'    => 'email_address',
					'type'  => 'text',
					'title' => esc_html__( 'Email Address', 'moko' ),
				),
				array(
					'id'    => 'phone_number',
					'type'  => 'text',
					'title' => esc_html__( 'Phone Number', 'moko' ),
				),
				array(
					'id'    => 'whatsapp',
					'type'  => 'text',
					'title' => esc_html__( 'Whatsapp', 'moko' ),
				),
				array(
					'id'    => 'features',
					'type'  => 'textarea',
					'title' => esc_html__( 'Features', 'moko' ),
				),
				array(
					'id'    => 'social_profile',
					'type'  => 'social_media',
					'title' => esc_html__( 'Social Profiles', 'moko' ),
				),
			),
		),
	),
);