<?php
/**
 * The template for displaying all pages
 */

get_header();
?>

<?php
	$default_sidebar_position = get_theme_mod( 'default_sidebar_position', 'right' );
?>

<div class="container">
	<div class="row">
		<?php if ( 'no' === $default_sidebar_position ) : ?>
			<div id="primary" class="content-area col-md-12">
		<?php else : ?>
			<div id="primary" class="content-area col-md-8">
		<?php endif; ?>
			<main id="main" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

			</main><!-- #main -->
		</div><!-- #primary -->

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
