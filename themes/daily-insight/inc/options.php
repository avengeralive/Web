<?php
/**
 * Daily Insight options
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */

/**
 * Pagination
 * @return array site pagination options
 */
function daily_insight_pagination_options() {
  $daily_insight_pagination_options = array(
    'numeric'         => esc_html__( 'Numeric', 'daily-insight' ),
    'default'         => esc_html__( 'Default(Older/Newer)', 'daily-insight' ),
    'infinite-scroll' => esc_html__( 'Infinite-Scroll', 'daily-insight' ),
    'infinite-click'  => esc_html__( 'Infinite-Click', 'daily-insight' ),
  );

  $output = apply_filters( 'daily_insight_pagination_options', $daily_insight_pagination_options );

  return $output;
}

/**
 * Slider
 * @return array slider options
 */
function daily_insight_enable_disable_options() {
  $daily_insight_enable_disable_options = array(
    'static-frontpage'  => esc_html__( 'Static Frontpage', 'daily-insight' ),
    'disabled'          => esc_html__( 'Disabled', 'daily-insight' ),
  );

  $output = apply_filters( 'daily_insight_enable_disable_options', $daily_insight_enable_disable_options );

  return $output;
}