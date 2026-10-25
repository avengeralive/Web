<?php get_header(); ?>

<section class="post_blog_bg primary_bg">
				<?php if ( have_posts() ) :  while ( have_posts() ) : the_post();
						 
				<?php endwhile; ?>
				
				<?php else: ?>

				<?php endif; ?>
</section>

<?php get_footer(); ?>