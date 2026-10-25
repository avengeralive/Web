<style>
@media screen and (max-width: 450px) {
	.header-img{margin-top: 99px; padding-bottom: 34px;}
	.header-img img{top: 0px!important;}
}
</style>

<section id="section_0">
    <div class="content-header yellow-block">
        <div class="container">
            <h1>ПОРТФОЛИО</h1>
            <div class="h1-description text-center">За 5 лет работы компании нашими специалистами было разработано более 80 различных проектов. Самые успешные и интересные решения представлены в нашем портфолио.</div>
        </div>
    </div>
</section>

<section id="section_1">
	<div class="content white-block-container">
		<div class="container">


			
			
			<div class="row clearfix" id="portfolio-list">
			
				<?php
				query_posts(array(
                    'cat'=>$_GET['cat'],
                    'meta_key' => 'ordering',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC',
                    'posts_per_page'=>100,
                ));?>
				<?php if ( have_posts() ) : ?>
					<?php
					while ( have_posts() ) : the_post(); ?>
						<div class="col-md-4">
							<a href="<?php the_permalink(); ?>" class="portfolio-item">
								<span class="portfolio-item-img">
									<?php
                                    $image = get_field('main_image');
                                    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
                                    if( !empty($image) ){
                                        echo '<img src="'.$large_image_url[0]/*$image['url']*/.'" alt="" style="width: 300px; margin: 0px" />';
                                        //	echo '<img src="'.$image['url'].'" alt="" style="width: 260px; margin: 20px" />';
                                    }
                                    ?>
                                </span>
								<span class="portfolio-item-type">
								
								<?php
									$id = get_the_ID();
									foreach((get_the_category($id)) as $category) { 
										if($category->slug=='program'){echo'<i class="type-app-icon"></i>';}
										if($category->slug=='game'){echo'<i class="type-game-icon"></i>';}
										if($category->slug=='web'){echo'<i class="type-app-icon"></i>';}
									}
								?>
								
								</span>
								<span class="portfolio-item-title"><b><?php the_title(); ?></b></span>
								<span class="portfolio-item-text"><?php echo (get_post_meta($post->ID, 'short_description', true)); ?></span>
							</a>
						</div>
					<?php
					endwhile; ?>
				<?php endif; wp_reset_query();?>
			</div>
		</div>
		<div class="white-block-bottom"></div>
	</div>

</section>