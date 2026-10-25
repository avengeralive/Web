<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Augusta
 */

get_header();
?>

<?php
	$default_sidebar_position = get_theme_mod( 'default_sidebar_position', 'right' );
?>

<div class="container">
	<div class="row">

		<?php if ( 'no' === $default_sidebar_position ) : ?>
			<section id="primary" class="content-area col-md-12">
		<?php else : ?>
			<section id="primary" class="content-area col-md-8">
		<?php endif; ?>
			<main id="main" class="site-main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</header><!-- .page-header -->

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

			</main><!-- #main -->
		</section><!-- #primary -->

		<?php if ( 'no' !== $default_sidebar_position ) : ?>
			<?php if ( 'right' === $default_sidebar_position ) : ?>
				<div class="col-md-4">
			<?php elseif ( 'left' === $default_sidebar_position ) : ?>
				<div class="col-md-4 order-md-first">
			<?php endif; ?>
				<?php get_sidebar(); ?>
			</div>
			<!-- /.col-md-4 -->
		<?php endif; ?>
	</div>
	<!-- /.row -->
</div>
<!-- /.container -->

<?php
get_footer();
