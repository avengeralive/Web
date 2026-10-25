<?php get_header(); ?>

<section class="post_blog_bg primary_bg">
	<div class="container">
				<?php if ( have_posts() ) : the_post(); ?>
						 
				<h2><? the_title(); ?></h2>
				<? the_content();  ?>

				<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>