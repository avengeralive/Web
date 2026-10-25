<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Augusta
 */

?>
<!doctype html>
<?php augusta_html_before(); ?>
<html <?php language_attributes(); ?>>
	<head>
		<?php augusta_head_top(); ?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php augusta_head_bottom(); ?>
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<?php augusta_body_top(); ?>
		<div id="page" class="site">

			<?php augusta_header_before(); ?>
			<?php augusta_header(); ?>
			<?php augusta_header_after(); ?>

			<div id="content" class="site-content">
