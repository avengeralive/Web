<?php
/**
 * Reset options
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'daily_insight_reset_section', array(
	'title'             => esc_html__( 'Reset all settings','daily-insight' ),
	'description'       => esc_html__( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'daily-insight' ),
) );

// Add reset enable setting and control.
$wp_customize->add_setting( 'daily_insight_theme_options[reset_options]', array(
	'default'           => $options['reset_options'],
	'sanitize_callback' => 'daily_insight_sanitize_checkbox',
	'transport'			  => 'postMessage'
) );

$wp_customize->add_control( 'daily_insight_theme_options[reset_options]', array(
	'label'             => esc_html__( 'Check to reset all settings', 'daily-insight' ),
	'section'           => 'daily_insight_reset_section',
	'type'              => 'checkbox',
) );