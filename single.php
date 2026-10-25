<?php
/**
 * The template to display single post
 *
 * @package WordPress
 * @subpackage FIXTEAM
 * @since FIXTEAM 1.0
 */

get_header();

while ( have_posts() ) { the_post();

	get_template_part( 'content', get_post_format() );

	// Related posts
	if ((int) fixteam_get_theme_option('show_related_posts') && ($fixteam_related_posts = (int) fixteam_get_theme_option('related_posts')) > 0) {
		fixteam_show_related_posts(array('orderby' => 'rand',
										'posts_per_page' => max(1, min(9, $fixteam_related_posts)),
										'columns' => max(1, min(4, fixteam_get_theme_option('related_columns')))
										),
									fixteam_get_theme_option('related_style')
									);
	}
	if (get_the_category()[0]->term_id == 41) {
?>
	<a class="tp-caption rev-btn home-btn rs-hover-ready" href="/services/laptop-repair/">Назад</a>
<?php
	}
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
}

get_footer();
?>