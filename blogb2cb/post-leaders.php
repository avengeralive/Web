<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Miteri
 * @since Miteri 1.0
 */

get_header();
 if ( have_posts() ) :
 	$page_style = get_theme_mod('page_style', 'fimg-classic');
        $page_banner_thumbnail = ($page_style=='fimg-banner') ? 'full' : 'miteri-cp-1200x580';
        $show_page_thumbnail = has_post_thumbnail() && get_theme_mod('page_has_featured_image', 1);
        if ( $page_style == 'fimg-fullwidth' || $page_style == 'fimg-banner' ):
	  ?>
		<div class="featured-image <?php echo ($show_page_thumbnail) ? ' has_featured_image' : ''; ?>">
			<div class="entry-header">
				<?php the_title( '<h1 class="entry-title"><span>', '</span></h1>' ); ?>
			</div>
			<?php if ( $show_page_thumbnail ) : ?>
				<figure class="entry-thumbnail <?php echo esc_attr($page_style == 'fimg-banner' ) ? 'parallax-window' : ''; ?>" <?php echo ($page_style=='fimg-banner') ? 'data-parallax="scroll" data-image-src="'.get_the_post_thumbnail_url(get_the_ID(), $page_banner_thumbnail).'"' : ''; ?>>
					<?php 
					if($page_style=='fimg-fullwidth'):
						the_post_thumbnail($page_banner_thumbnail); 
					endif;
					?>
				</figure>
			<?php endif; // Featured Image ?>
		</div>
	<?php endif; ?>
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

			?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( get_theme_mod( 'page_style', 'fimg-classic' ) == 'fimg-classic' ) : ?>
					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title"><span>', '</span></h1>' ); ?>
					</header><!-- .entry-header -->
				<?php endif; ?>

				<?php if ( has_post_thumbnail() && get_theme_mod( 'page_has_featured_image', 1 ) && get_theme_mod( 'page_style', 'fimg-classic' ) == 'fimg-classic' ) : ?>
					<figure class="entry-thumbnail"> SOME TEXT
						<?php the_post_thumbnail( 'thumbnail' ); ?>
					</figure>
				<?php endif; // Featured Image ?>

				<div class="entry-content">
					<?php
					the_content();
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'miteri' ),
						'after'  => '</div>',
					) );
					?>
				</div><!-- .entry-content -->

				<footer class="entry-footer">
					<?php
					if ( get_edit_post_link() ) :
						edit_post_link(
							sprintf(
							/* translators: %s: Name of current post */
								esc_html__( 'Edit %s', 'miteri' ),
								the_title( '<span class="screen-reader-text">"', '"</span>', false )
							),
							'<span class="edit-link">',
							'</span>'
						);
					endif;
					?>
				</footer><!-- .entry-footer -->

			</article>
			<?

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
