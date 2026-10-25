<?php
/**
 * Template part for displaying posts
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'augusta-article' ); ?>>

	<?php if ( is_sticky() ) : ?>
		<span class="fas fa-thumbtack augusta-sticky text-muted" title="<?php echo esc_attr__( 'Sticky Post', 'augusta' ); ?>"></span>
	<?php endif; ?>

	<?php augusta_post_thumbnail(); ?>

	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title singular-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title archive-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				augusta_posted_on();
				augusta_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_singular() ) : ?>
		<div class="entry-content">
			<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'augusta' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'augusta' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->
	<?php else : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more-link"><?php esc_html_e( 'More Details', 'augusta' ); ?> <i class="fas fa-long-arrow-alt-right ml-2"></i></a>
		</div>
	<?php endif; ?>

	<footer class="entry-footer">
		<?php augusta_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
