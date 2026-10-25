<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Miteri
 * @since Miteri 1.0
 */
get_header();
?>

<?php
/* Archive Options */
$archive_layout = get_theme_mod('archive_layout', 'list');
$archive_sidebar_position = get_theme_mod('archive_sidebar_position', 'content-sidebar');
$post_template = miteri_archive_template();
$post_column = miteri_archive_column();
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php if (have_posts()) : ?>
            <header class="page-header">
                <div class="page-header-wrapper">
                    <h1 class="page-title">Лидеры</h1>
                </div>
            </header><!-- .page-header -->
            <section class="row posts-loop wrapper-type-grid <?php
            if ('grid' == $archive_layout) {
                echo esc_attr('flex-row');
            }
            ?>">
                         <?php
                         /* Start the Loop */
                         while (have_posts()) : the_post();
                             ?>
                    <div class="post-wrapper <?php echo esc_attr($post_column); ?>">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('large-post'); ?>>
							<div class="entry-header">
								<?php if ( 'post' === get_post_type() ) : ?>
									<div class="entry-meta">
										<span class="posted-on">
											<?php the_time( get_option( 'date_format' ) ); ?>
										</span>
										<span class="sep">/</span>
										<span class="cat-links"><?php the_category( ', ' ); ?></span>
									</div>
								<?php endif; ?>
								<h2 class="entry-title"><?php the_title(); ?></h2>
							</div><!-- .entry-header -->

							<?php if ( has_post_thumbnail() ) : ?>
								<figure class="entry-thumbnail">
									
										<?php if ( is_home() && $blog_sidebar_position == 'content-fullwidth' ) {
											the_post_thumbnail('medium');
										} elseif ( ( is_archive() || is_search() ) && $archive_sidebar_position == 'content-fullwidth') {
											the_post_thumbnail('medium');
										} else {
											the_post_thumbnail('medium');
										}
										?>
								</figure>
                                <style type="text/css">.entry-thumbnail img { min-height: 300px !important; width: auto !important; }</style>
							<?php endif; ?>
						</article>
                    </div>
                <?php endwhile; ?>
            </section>
            <?php
            the_posts_navigation();
        else :
            get_template_part('template-parts/post/content', 'none');
        endif;
        ?>
    </main><!-- #main -->
</div><!-- #primary -->
<?php
// Sidebar
if ('content-sidebar' == $archive_sidebar_position || 'sidebar-content' == $archive_sidebar_position) {
    get_sidebar();
}
get_footer();
