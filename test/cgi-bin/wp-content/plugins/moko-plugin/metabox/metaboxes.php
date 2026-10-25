<?php
if ( ! function_exists( "moko_add_metaboxes" ) ) {
	function moko_add_metaboxes( $metaboxes ) {
		$directories_array = array(
			'page.php',
			'blog.php',
			'project.php',
			'service.php',
			'team.php',
			'testimonials.php',
		);
		foreach ( $directories_array as $dir ) {
			$metaboxes[] = require_once( MOKOPLUGIN_PLUGIN_PATH . '/metabox/' . $dir );
		}

		return $metaboxes;
	}

	add_action( "redux/metaboxes/moko_options/boxes", "moko_add_metaboxes" );
}
