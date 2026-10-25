<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Augusta
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function augusta_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'augusta_body_classes' );



/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function augusta_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'augusta_pingback_header' );



/**
* Custom excerpt length
*/
function augusta_custom_excerpt_length( $length ) {
	return 28;
}
add_filter( 'excerpt_length', 'augusta_custom_excerpt_length', 999 );


/**
* Get header markup
*/
function augusta_get_header() {
	get_template_part( 'template-parts/others/header' );
}
add_action( 'augusta_header', 'augusta_get_header' );


/**
* Get footer markup
*/
function augusta_get_footer() {
	get_template_part( 'template-parts/others/footer' );
}
add_action( 'augusta_footer', 'augusta_get_footer' );


/**
* Add classes to navigation buttons
*/
add_filter( 'next_posts_link_attributes', 'augusta_posts_link_attributes' );
add_filter( 'previous_posts_link_attributes', 'augusta_posts_link_attributes' );
add_filter( 'next_comments_link_attributes', 'augusta_comments_link_attributes' );
add_filter( 'previous_comments_link_attributes', 'augusta_comments_link_attributes' );

function augusta_posts_link_attributes() {
	return 'class="btn btn-outline-primary btn-sm mt-4 mb-4"';
}

function augusta_comments_link_attributes() {
	return 'class="btn btn-outline-primary btn-sm mt-4 mb-4"';
}
