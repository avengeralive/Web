<?php
/**
* pagination options
*
* @package Theme Palace
* @subpackage Daily Insight
* @since Daily Insight 0.1
*/

// Add pagination section
$wp_customize->add_section( 'daily_insight_pagination', array(
	'title'               => esc_html__( 'Pagination','daily-insight' ),
	'description'         => esc_html__( 'Pagination section options.', 'daily-insight' ),
	'panel'               => 'daily_insight_theme_options_panel'
) );

// pagination section setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[pagination_enable]', array(
	'sanitize_callback'   => 'daily_insight_sanitize_checkbox',
	'default'             => $options['pagination_enable']
) );

$wp_customize->add_control( 'daily_insight_theme_options[pagination_enable]', array(
	'label'               => esc_html__( 'Pagination Enable', 'daily-insight' ),
	'section'             => 'daily_insight_pagination',
	'type'                => 'checkbox',
) );

// pagination type section setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[pagination_type]', array(
	'sanitize_callback'   => 'daily_insight_sanitize_select',
	'default'             => $options['pagination_type']
) );

$wp_customize->add_control( 'daily_insight_theme_options[pagination_type]', array(
	'label'               => esc_html__( 'Pagination Type', 'daily-insight' ),
	'section'             => 'daily_insight_pagination',
	'type'                => 'select',
	'choices'			  => daily_insight_pagination_options(),
	'description'		  => sprintf( esc_html__( 'Enable Jetpack Plugin To Use Infinite-Scroll And Infinte-click Options : %1$sJetpack%2$s', 'daily-insight' ),'<a href="'.esc_url('http://jetpack.com/').'" target="_blank">','</a>' ),
	'active_callback'	  => 'daily_insight_is_pagination_enable'
) );
