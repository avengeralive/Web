<?php
/**
 * Daily Insight customizer default options
 *
 * @package Theme Palace
 * @subpackage Daily Insight
 * @since Daily Insight 0.1
 */


/**
 * Returns the default options for Daily Insight.
 *
 * @since Daily Insight 0.1
 * @return array An array of default values
 */
function daily_insight_get_default_theme_options() {
	$theme_data  = wp_get_theme(); // get theme data
	$daily_insight_default_options = array(

		//breaking-news
		'enable_breaking_news'			=> false,
		'breaking_news_type'			=> 'category',
		'breaking_news_title'			=> esc_html__( 'Breaking News','daily-insight' ),
		'breaking_news_category_type'	=> '',

		//main-slider
		'enable_main_slider'			=> 'disabled',
		'main_slider_type'				=> 'category',
		'main_slider_category_type'		=> '',
	
		//latest-post
		'enable_latest_post'			=> 'static-frontpage',
		'latest_post_type'				=> 'recent-post',
		'latest_post_title'				=> esc_html__( 'Latest Post','daily-insight' ),

		//category block three
		'enable_category_block_three'		=> false,
		'category_block_three_type'			=> 'category',
		'category_block_three_icon'			=> 'fa-plane',
		'category_block_three_category_type'=> '',

		//category block seven
		'enable_category_block_seven'		=> false,
		'category_block_seven_type'			=> 'category',
		'category_block_seven_title'		=> esc_html__( 'Trending News','daily-insight' ),
		'category_block_seven_no_of_posts'  => 5,
		'category_block_seven_category_type'=> '',

		//category block two section one
		'enable_category_block_two'			=> true,
		'category_block_two_type'			=> 'category',
		'category_block_two_section_two_icon'			=> 'fa-heart',
		'category_block_two_section_three_icon'			=> 'fa-globe',
		'category_block_two_section_three_category_type'=> '',
		'category_block_two_section_two_category_type'=> '',

		
		// Theme Options
		'pagination_enable'         	=> true,
		'pagination_type'         		=> 'default',
		'copyright_text'           		=> sprintf( esc_html__( 'Copyright &copy; . All Rights Reserved','daily-insight' ) ),
		'reset_options'      			=> false,
		'search_text'					=> esc_html__( 'Search..','daily-insight' ),
		'readmore_text'					=> esc_html__( 'Read More','daily-insight' ),
		
		// archive content type
		'archive_content_type'			=> 'excerpt',	
		'archive_image' 				=> false,
		'archive_meta' 					=> false,

	);

	$output = apply_filters( 'daily_insight_default_theme_options', $daily_insight_default_options );
	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}