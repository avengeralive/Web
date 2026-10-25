<?php
/**
 * The Header: Logo and main menu
 *
 * @package WordPress
 * @subpackage FIXTEAM
 * @since FIXTEAM 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js scheme_<?php
										 // Class scheme_xxx need in the <html> as context for the <body>!
										 echo esc_attr(fixteam_get_theme_option('color_scheme'));
										 ?>">
<head>
	
	<link rel="stylesheet" href="http://xn--b1afk4ade.xn--90aokicgv.xn--p1ai/wp-content/themes/fixteam_ru/fonts/stylesheet.css" type="text/css" media="all">
	<?php wp_head(); ?>
</head>

<body <?php	body_class(); ?>>

	<?php do_action( 'fixteam_action_before_body' ); ?>

	<div class="body_wrap">

		<div class="page_wrap"><?php
			
			// Desktop header
			$fixteam_header_type = fixteam_get_theme_option("header_type");
			if ($fixteam_header_type == 'custom' && !fixteam_is_layouts_available())
				$fixteam_header_type = 'default';
			get_template_part( "templates/header-{$fixteam_header_type}");

			// Side menu
			if (in_array(fixteam_get_theme_option('menu_style'), array('left', 'right'))) {
				get_template_part( 'templates/header-navi-side' );
			}

			// Mobile header
			get_template_part( 'templates/header-mobile');
			?>

			<div class="page_content_wrap">

				<?php if (fixteam_get_theme_option('body_style') != 'fullscreen') { ?>
				<div class="content_wrap">
				<?php } ?>

					<?php
					// Widgets area above page content
					fixteam_create_widgets_area('widgets_above_page');
					?>				

					<div class="content">
						<?php
						// Widgets area inside page content
						fixteam_create_widgets_area('widgets_above_content');
						?>				
