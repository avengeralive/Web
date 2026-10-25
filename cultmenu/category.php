<?
/* 
Template name: Main page
*/
?>
<?php get_header(); ?>
<section class="post_blog_bg primary-bg">
	<div class="container">
		<div class="content">	
			
			<div class="row" style="padding-top: 30px;">
			</div>
			<div class="row" style="padding-top: 30px;">
				<?
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$loop = new WP_Query( array(
'post_type' => 'post',
'posts_per_page' => 20,
'orderby'=> 'date',
'order'=> 'DESC',
'paged'=>$paged
) );

while ($loop->have_posts()) : $loop->the_post();
					?>
					<div class="col-xs-12 col-sm-6 col-md-3 newsitem">
						<img src="<? echo get_the_post_thumbnail_url(); ?>" style="width: calc(100% - 30px); margin: 0 15px; position: absolute; top: 0; left: 0;">
						<div class="newstitle">
							<a href="<? the_permalink(); ?>"><h2>
								<? the_title(); ?>
							</h2></a>
						</div>
					</div>
					<? endwhile; ?>
			</div>
			<div class="row" style="padding-top: 30px;">
				<?php the_posts_pagination( array(
    'mid_size' => 10,
    'prev_text' => __( '< Назад', 'textdomain' ),
    'next_text' => __( 'Вперед >', 'textdomain' ),
) ); ?>	
			</div>
		</div>			
	</div>
</section>
<? get_footer(); ?>