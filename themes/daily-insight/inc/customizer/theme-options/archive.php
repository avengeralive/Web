<?php 

// Add archive section
$wp_customize->add_section( 'daily_insight_archive_option', array(
	'title'             => esc_html__( 'Archive Options','daily-insight' ),
	'description'       => esc_html__( 'These options works only on archive pages like: blog, search and other archive pages.', 'daily-insight' ),
	'panel'             => 'daily_insight_theme_options_panel',
) );

// Show archive image setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[archive_image]', array(
	'default'           => $options['archive_image'],
	'sanitize_callback' => 'daily_insight_sanitize_checkbox',
) );

$wp_customize->add_control( 'daily_insight_theme_options[archive_image]', array(
	'label'       => esc_html__( 'Hide Featured Image', 'daily-insight' ),
	'description' => esc_html__( 'Check to hide featured images.', 'daily-insight' ),
	'section'     => 'daily_insight_archive_option',
	'type'        => 'checkbox',
) );

// Show archive meta setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[archive_meta]', array(
	'default'           => $options['archive_meta'],
	'sanitize_callback' => 'daily_insight_sanitize_checkbox',
) );

$wp_customize->add_control( 'daily_insight_theme_options[archive_meta]', array(
	'label'             => esc_html__( 'Hide Meta', 'daily-insight' ),
	'description'       => esc_html__( 'Check to hide meta like date, author, category.', 'daily-insight' ),
	'section'           => 'daily_insight_archive_option',
	'type'				=> 'checkbox',
) );
