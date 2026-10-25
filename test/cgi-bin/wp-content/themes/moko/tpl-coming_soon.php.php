<?php 
/* Template Name: Coming Soon Page */ 
/**
 * @package MOKO
 * @author  Noor Tech
 * @version 1.0
 */
?>
<?php 
get_header('coming_soon');
$data  = \MOKO\Includes\Classes\Common::instance()->data( 'single' )->get(); ?>
<?php while ( have_posts() ): the_post(); ?>
	<?php the_content(); ?>
<?php endwhile; ?>
<?php get_footer('coming_soon'); ?>
