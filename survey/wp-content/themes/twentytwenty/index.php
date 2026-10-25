<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content" role="main">
	<table>
		<tr>
			<th>Утверждение</th>
			<th>Никогда</th>
			<th>Очень редко</th>
			<th>Редко</th>
			<th>Иногда</th>
			<th>Часто</th>
			<th>Очень часто</th>
			<th>Каждый день</th>
		</tr>
	<?
		$questions = get_field(2, 'voprosy');
		foreach ($questions as $key => $question) { var_dump($question);
	?>
		<tr>
			<td><?=$question['vopros'];?></td>
		</tr>
	<?
		}
	?>
	</table>
</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
get_footer();
