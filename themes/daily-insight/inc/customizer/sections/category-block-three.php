<?php
/**
 * Category Block Two Section One Customizer options
 *
 * @package Theme Palace
 * @subpackage Daily Insight 
 * @since Daily Insight 0.1
 */


// Add Category Block Two Section One enable section
$wp_customize->add_section( 'daily_insight_category_block_two', array(
	'title'             => esc_html__( 'Category Block Two ','daily-insight' ),
	'description'       => esc_html__( 'Category Block Two section options.', 'daily-insight' ),
	'priority'			=> '10',
	'panel'             => 'daily_insight_sections_panel'
) );

// Add Category Block Two Section One enable setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[enable_category_block_two]', array(
	'default'           => $options['enable_category_block_two'],
	'sanitize_callback' => 'daily_insight_sanitize_checkbox'
) );

$wp_customize->add_control( 'daily_insight_theme_options[enable_category_block_two]', array(
	'label'             => esc_html__( 'Check To Enable', 'daily-insight' ),
	'section'           => 'daily_insight_category_block_two',
	'type'              => 'checkbox',
) ); 

// Add Category Block Two Section One content type setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[category_block_two_type]', array(
	'default'           => $options['category_block_two_type'],
	'sanitize_callback' => 'daily_insight_sanitize_select'
) );

$wp_customize->add_control( 'daily_insight_theme_options[category_block_two_type]', array(
	'label'           	=> esc_html__( 'Content Type', 'daily-insight' ),
	'section'         	=> 'daily_insight_category_block_two',
	'type'            	=> 'select',
	'active_callback' 	=> 'daily_insight_is_category_block_two_active',
	'choices'         	=> array(
		'category'		=> esc_html__( 'Category', 'daily-insight' ),	
	)
) );


// Note control setting and control 
$wp_customize->add_setting( 'daily_insight_theme_options[category_block_two_section_two_description]', array(
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new Daily_Insight_Note_Control( $wp_customize, 'daily_insight_theme_options[category_block_two_section_two_description]',
	array(
		'section'         => 'daily_insight_category_block_two',
		'label'			  => 'Category Block Two Section One',
		'type'			  => 'description',
		'active_callback' => 'daily_insight_is_category_block_two_content_as_category'
) ) );

// Add Category Block Two Section Two icon setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[category_block_two_section_two_icon]', array(
	'default'           => $options['category_block_two_section_two_icon'],
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'daily_insight_theme_options[category_block_two_section_two_icon]', array(
	'label'                 =>  esc_html__( 'Section One Icon', 'daily-insight' ),
    'section'               => 'daily_insight_category_block_two',
    'type'                  => 'text',
    'active_callback' 	=> 'daily_insight_is_category_block_two_content_as_category',
    'description'           => sprintf( esc_html__( 'Use font awesome icon: Eg: %1$s. %2$sSee more here%3$s', 'daily-insight' ), 'fa-heart','<a href="'.esc_url('http://fontawesome.io/icons/').'" target="_blank">','</a>' )
) );

// Add Category Block Two Section Two category drop-down setting and control
$wp_customize->add_setting( 'daily_insight_theme_options[category_block_two_section_two_category_type]', array(
	'default'			=> $options['category_block_two_section_two_category_type'],			
	'sanitize_callback'	=> 'absint',
) );

$wp_customize->add_control( new Daily_Insight_Dropdown_Taxonomies_Control( $wp_customize, 'daily_insight_theme_options[category_block_two_section_two_category_type]', array(
	'active_callback' 	=> 'daily_insight_is_category_block_two_content_as_category',
	'label'           	=> esc_html__( 'Select Category', 'daily-insight' ),
	'section'         	=> 'daily_insight_category_block_two',
	'type'            	=> 'dropdown-taxonomies',
 ) ) );



// Note control setting and control 
$wp_customize->add_setting( 'daily_insight_theme_options[category_block_two_section_three_description]', array(
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new Daily_Insight_Note_Control( $wp_customize, 'daily_insight_theme_options[category_block_two_section_three_description]',
	array(
		'section'         => 'daily_insight_category_block_two',
		'label'			  => 'Category Block Two Section Two',
		'type'			  => 'description',
		'active_callback' => 'daily_insight_is_category_block_two_content_as_category'
) ) );

// Add Category Block Two Section Three icon setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[category_block_two_section_three_icon]', array(
	'default'           => $options['category_block_two_section_three_icon'],
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'daily_insight_theme_options[category_block_two_section_three_icon]', array(
	'label'                 =>  esc_html__( 'Section Two Icon', 'daily-insight' ),
    'section'               => 'daily_insight_category_block_two',
    'type'                  => 'text',
    'active_callback' 	=> 'daily_insight_is_category_block_two_content_as_category',
    'description'           => sprintf( esc_html__( 'Use font awesome icon: Eg: %1$s. %2$sSee more here%3$s', 'daily-insight' ), 'fa-globe','<a href="'.esc_url('http://fontawesome.io/icons/').'" target="_blank">','</a>' )
) );

// Add Category Block Two Section Three category drop-down setting and control
$wp_customize->add_setting( 'daily_insight_theme_options[category_block_two_section_three_category_type]', array(
	'default'			=> $options['category_block_two_section_three_category_type'],			
	'sanitize_callback'	=> 'absint',
) );

$wp_customize->add_control( new Daily_Insight_Dropdown_Taxonomies_Control( $wp_customize, 'daily_insight_theme_options[category_block_two_section_three_category_type]', array(
	'active_callback' 	=> 'daily_insight_is_category_block_two_content_as_category',
	'label'           	=> esc_html__( 'Select Category', 'daily-insight' ),
	'section'         	=> 'daily_insight_category_block_two',
	'type'            	=> 'dropdown-taxonomies',
 ) ) );

