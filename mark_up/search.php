<?php
get_header(); ?>

<style>
@media screen and (max-width: 450px) {
	.header-img{margin-top: 99px; padding-bottom: 34px;}
	.header-img img{top: 0px!important;}
}
</style>


<div class="header-img">
	<img src="<?php echo get_template_directory_uri(); ?>/images/blog2-bg.jpg" alt="" data-stellar-ratio="0.5" />
	<div class="img-title">Результаты поиска</div>   
</div>

<section id="section_3" class="wh">
	<div class="company-info white-block">
		<div class="container blog_wrapper">


		<?php if ( have_posts() ) : ?>
		
		
		<?php 
		$ii=1; $close=0;
		while ( have_posts() ) : the_post(); ?>
		<?php
			if($ii==1){echo '<div class="row clearfix">';$close=0;}
		?>
		
				<div class="col-md-4">
					<div class="blog-item-block grey-bg">
						<a href="<?php the_permalink(); ?>" class="blog-item">
							<span class="blog-item-img">
								<?php the_post_thumbnail('blog_small'); ?>
							</span>
							<span class="blog-item-type">
							<?php
								$id = get_the_ID();
								foreach((get_the_category($id)) as $category) { 
									if($category->slug=='photo'){echo'<i class="type-photo-icon"></i>';}
									if($category->slug=='video'){echo'<i class="type-video-icon"></i>';}
								}
							?>
							</span>
							<span class="blog-item-title"><?php the_title(); ?></span>
							<span class="blog-item-date"><?php the_date('j F y'); ?></span>
							<span class="blog-item-text"><?php echo implode(array_slice(explode('<br>',wordwrap(strip_tags(get_the_excerpt()),250,'<br>',false)),0,1)); ?></span>
						</a>
					</div>
				</div>
			<?php
				
				if($ii==3){echo "</div>"; $ii=0; $close=1;}
				$ii=$ii+1;
			endwhile; ?>
		<?php if($close==0){echo "</div>";} ?>

		<?php else : ?>
		
			<p>Ничего не найденно.</p>
		
		<?php endif; ?>
		

		</div>
	</div>
</section>

<?php get_footer(); ?>

		<section id="primary">
			<div id="content" role="main">

			

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentyeleven' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>

				<?php twentyeleven_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				

				<?php twentyeleven_content_nav( 'nav-below' ); ?>

			

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyeleven' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>