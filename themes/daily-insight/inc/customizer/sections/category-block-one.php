<?php
/**
 * Category Block Three Customizer options
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

// Add Category Block Three enable section
$wp_customize->add_section( 'daily_insight_category_block_three_section', array(
	'title'             => esc_html__( 'Category Block One','daily-insight' ),
	'description'       => esc_html__( 'Category Block One section options.', 'daily-insight' ),
	'priority'			=> '10',
	'panel'             => 'daily_insight_sections_panel'
) );

// Add Category Block Three enable setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[enable_category_block_three]', array(
	'default'           => $options['enable_category_block_three'],
	'sanitize_callback' => 'daily_insight_sanitize_checkbox'
) );

$wp_customize->add_control( 'daily_insight_theme_options[enable_category_block_three]', array(
	'label'             => esc_html__( 'Check To Enable', 'daily-insight' ),
	'section'           => 'daily_insight_category_block_three_section',
	'type'              => 'checkbox',
) );

// Add Category Block Three content type setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[category_block_three_type]', array(
	'default'           => $options['category_block_three_type'],
	'sanitize_callback' => 'daily_insight_sanitize_select'
) );

$wp_customize->add_control( 'daily_insight_theme_options[category_block_three_type]', array(
	'label'           	=> esc_html__( 'Content Type', 'daily-insight' ),
	'section'         	=> 'daily_insight_category_block_three_section',
	'type'            	=> 'select',
	'active_callback' 	=> 'daily_insight_is_category_block_three_active',
	'choices'         	=> array(
		'category'		=> esc_html__( 'Category', 'daily-insight' ),
	)
) );

// Add Category Block Three icon setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[category_block_three_icon]', array(
	'default'           => $options['category_block_three_icon'],
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'daily_insight_theme_options[category_block_three_icon]', array(
	'label'                 =>  esc_html__( 'Category Block One Icon', 'daily-insight' ),
    'section'               => 'daily_insight_category_block_three_section',
    'type'                  => 'text',
    'active_callback' 	=> 'daily_insight_is_category_block_three_content_as_category',
    'description'           => sprintf( esc_html__( 'Use font awesome icon: Eg: %1$s. %2$s See more here%3$s', 'daily-insight' ), 'fa-plane','<a href="'.esc_url('http://fontawesome.io/icons/').'" target="_blank">','</a>' )
) );

// Add Category Block Three category drop-down setting and control
$wp_customize->add_setting( 'daily_insight_theme_options[category_block_three_category_type]', array(
	'default'			=> $options['category_block_three_category_type'],
	'sanitize_callback'	=> 'absint',
) );

$wp_customize->add_control( new Daily_Insight_Dropdown_Taxonomies_Control( $wp_customize, 'daily_insight_theme_options[category_block_three_category_type]', array(
	'active_callback' 	=> 'daily_insight_is_category_block_three_content_as_category',
	'label'           	=> esc_html__( 'Select Category', 'daily-insight' ),
	'section'         	=> 'daily_insight_category_block_three_section',
	'type'            	=> 'dropdown-taxonomies',
 ) ) );