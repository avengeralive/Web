<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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

				<section class="error-404 not-found augusta-article">
					<header class="page-header">
						<h1 class="page-title mt-0"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'augusta' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'augusta' ); ?></p>

						<?php
							get_search_form();

							the_widget( 'WP_Widget_Recent_Posts', array(), array(
								'before_title' => '<h5 class="widget-title mt-4">',
								'after_title'  => '</h5>',
							) );
						?>

						<div class="widget widget_categories">
							<h5 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'augusta' ); ?></h5>
							<ul>
								<?php
								wp_list_categories( array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 10,
								) );
								?>
							</ul>
						</div><!-- .widget -->

						<?php
							the_widget( 'WP_Widget_Archives', 'dropdown=1', array(
								'before_title' => '<h5 class="widget-title">',
								'after_title'  => '</h5>',
							) );

							the_widget( 'WP_Widget_Tag_Cloud', array(), array(
								'before_title' => '<h5 class="widget-title">',
								'after_title'  => '</h5>',
							) );
						?>

					</div><!-- .page-content -->
				</section><!-- .error-404 -->

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
