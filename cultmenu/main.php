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
			<div class="col-xs-12 col-sm-12 col-md-6 slider">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
				<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				<li data-target="#carousel-example-generic" data-slide-to="1"></li>
				<li data-target="#carousel-example-generic" data-slide-to="2"></li>
				  <li data-target="#carousel-example-generic" data-slide-to="3"></li>
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">
				  <?
					$loop = new WP_Query( array(
'post_type' => 'post',
'posts_per_page' => 4,
'orderby'=> 'date',
'order'=> 'DESC',
) );
$i = 0;
while ($loop->have_posts()) { $loop->the_post();
					?>
				<div class="item <? if ($i == 0) { ?>active<? } ?>">
				  <img src="<? echo get_the_post_thumbnail_url(); ?>" style="height: 100%; width: auto; position: absolute; top: 0; left: 0;">
				  <div class="carousel-caption">
					<? the_title(); ?>
				  </div>
				</div>
				  <? $i++; } ?>
			  </div>

			  <!-- Controls -->
			  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			  </a>
			</div>
		</div>	
				<div class="col-xs-12 col-sm-12 col-md-6 rbns" style="padding: 0px;">
					<?
					$loop = new WP_Query( array(
'post_type' => 'post',
'posts_per_page' => 4,
'orderby'=> 'date',
'order'=> 'DESC',
) );

while ($loop->have_posts()) : $loop->the_post();
					?>
					<div class="col-xs-12 col-sm-6 col-md-6 newsitem">
						<img src="<? echo get_the_post_thumbnail_url(); ?>" style="width: calc(100% - 30px); margin: 0 15px; position: absolute; top: 0; left: 0;">
						<div class="newstitle">
							<a href="<? the_permalink(); ?>"><h2>
								<? the_title(); ?>
							</h2></a>
						</div>
					</div>
					<? endwhile; ?>
				</div>
		</div>
			<div class="row" style="padding-top: 30px;">
			</div>
			<div class="row" style="padding-top: 30px;">
				<?
					$loop = new WP_Query( array(
'post_type' => 'post',
'posts_per_page' => 4,
'orderby'=> 'date',
'order'=> 'DESC',
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
				<button class="btn btn-yet" style="color: #2937B8;">
      				Смотреть еще
      			</button>
			</div>
		</div>			
	</div>
	<div class="row popular" style="background: #2937B8; padding: 30px 0px;">
		<div class="container">
			<div class="col-xs-12">
				<h2 style="color: #FFE8F2;">
					Популярное
				</h2>
			</div>
			<div class="col-xs-12" style="padding: 0px;">
			<?
					$loop = new WP_Query( array(
'post_type' => 'post',
'posts_per_page' => 4,
'orderby'=> 'date',
'order'=> 'DESC',
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
			<div class="col-xs-12" style="padding-top: 30px;">
				<button class="btn btn-yet" style="color: #2937B8;">
      				Смотреть еще
      			</button>
			</div>
		</div>
	</div>									
	<div class="row reviews" style="padding: 30px 0px;">
		<div class="container">
			<div class="col-xs-12">
				<h2>
					Отзывы
				</h2>
			</div>
			<div class="col-xs-12" style="padding: 0px;">
			<?
					$loop = new WP_Query( array(
'post_type' => 'post',
'posts_per_page' => 4,
'orderby'=> 'date',
'order'=> 'DESC',
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
			<div class="col-xs-12" style="padding-top: 30px;">
				<button class="btn btn-yet" style="color: #2937B8;">
      				Смотреть еще
      			</button>
			</div>
		</div>
	</div>		
</section>
<? get_footer(); ?>