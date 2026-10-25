<?php
return array(
	'title'      => 'Moko Setting',
	'id'         => 'moko_meta',
	'icon'       => 'el el-cogs',
	'position'   => 'normal',
	'priority'   => 'core',
	'post_types' => array( 'page', 'post', 'team', 'project', 'product' ),
	'sections'   => array(
		require_once MOKOPLUGIN_PLUGIN_PATH . '/metabox/header.php',
		require_once MOKOPLUGIN_PLUGIN_PATH . '/metabox/banner.php',
		require_once MOKOPLUGIN_PLUGIN_PATH . '/metabox/sidebar.php',
		require_once MOKOPLUGIN_PLUGIN_PATH . '/metabox/footer.php',
	),
);