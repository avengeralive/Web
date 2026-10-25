<?php
/*
Template Name: Страница "Проекты"
*/
get_header(); ?>

	<section class="company-info">
            <div class="container text-center">
                <h1 class="noBorderTop">ПОРТФОЛИО</h1>
                <p>За 8 лет работы компании нашими специалистами было разработано более 100 различных проектов. Самые успешные и интересные решения представлены в нашем портфолио.</p>
            </div> 
              
    </section>

<section class="portfolio-menu-section">
		<div class="container">
            <?
                $cat = 0;
                if(array_key_exists('cat', $_GET)) $cat = $_GET['cat'];
            ?>
            <ul class="no-list portfolio-menu">
                <li><a href="portfolio?cat=12" <?php if($cat==12)?>>Приложения</a></li>
                <li><a href="portfolio?cat=10" <?php if($cat==10){echo'class="active"';}?>>Веб-сервисы</a></li>
                <li><a href="portfolio?cat=11" <?php if($cat==11){echo'class="active"';}?>>Игры</a></li>
                <li><a href="portfolio" <?php if($cat==0){echo'class="active"';}?>>Все</a></li>
            </ul>

			<div class="row" id="portfolio-list" itemscope itemtype="http://schema.org/ItemList">
			
				<?php
				
				
				$params = explode('&', $query_string);
				if($params[0]!="page_id=7"){
					$srt="&".$params[0];
				}else{$srt="&paged=1";}

				//query_posts('category_name=portfolio&orderby=ordering&order=ASC'.$srt);
                $params = array(
                   // 'category_name'=>'portfolio',
                    //'meta_key' => 'ordering',
                    'orderby' => 'post_date',
                    'order' => 'ASC',
                    'posts_per_page'=>100
                );

                if($cat){
                    $params['cat'] = $cat;
                }else{
                    $params['category_name'] = 'portfolio';
                }

                //global $wpdb;
                query_posts($params);


                //query_posts('category_name=portfolio&orderby=date&posts_per_page=3'.$srt);
				global $wp_query, $wp_rewrite;  
				$max = $wp_query->max_num_pages;  
				?>	
				<?php if ( have_posts() ) : ?>
					<?php
                    $i=0;
					while ( have_posts() ) : the_post(); ?>
						<div class="col-md-4" itemprop="itemListElement" itemscope itemtype="http://schema.org/MobileApplication">
							<a href="<?php the_permalink(); ?>" class="portfolio-item clmn"  itemprop="url">
								<span class="portfolio-item-img">
									<?php $i++;
										$image = get_field('main_image');
                                        $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
                                        $img_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
$_alt = $img_alt ? $img_alt : get_the_title();
										//if( !empty($image) ){
											echo '<img src="'.$large_image_url[0]/*$image['url']*/.'" alt="'. $_alt .'" style="width: 300px; margin: 0px" itemprop="image" />';
										//	echo '<img src="'.$image['url'].'" alt="" style="width: 260px; margin: 20px" />';
										//}
									?>
			
								</span>
								<span class="portfolio-item-type">

								<?php
                                $id = get_the_ID();
                                foreach((get_the_category($id)) as $category) {
                                    if($category->slug=='program'){echo'<i class="type-app-icon"></i><meta itemprop="applicationCategory" content="Business"/>
                    <meta itemprop="operatingSystem" content="Android,iOS"/>';}
                                    if($category->slug=='game'){echo'<i class="type-game-icon"></i><meta itemprop="applicationCategory" content="Game"/>
                    <meta itemprop="operatingSystem" content="Android,iOS"/>';}
                                    if($category->slug=='web'){echo'<i class="type-web-icon"></i><meta itemprop="applicationCategory" content="Business"/>
                    <meta itemprop="operatingSystem" content="WEB"/>';}
                                }
                                ?>
								
								</span>
                    
                    <meta itemprop="position" content="<?php echo $i; ?>"/>
                    <div itemscope itemprop="aggregateRating" itemtype="https://schema.org/AggregateRating">
                        <meta itemprop="bestRating" content="5"/>
                        <meta itemprop="ratingValue" content="5"/>
                        <meta itemprop="reviewCount" content="99"/>
                    </div>
								<span class="portfolio-item-title"><b itemprop="name"><?php the_title(); ?></b></span>
								<span class="portfolio-item-text" itemprop="description"><?php echo (get_post_meta($post->ID, 'short_description', true)); ?></span>
							</a>
						</div>
					<?php
					endwhile; ?>
				<?php endif; wp_reset_query();?>
			</div>
			
			<?php //if (function_exists('wp_corenavi')) wp_corenavi($max, 7, 'Больше интересных проектов'); ?>
		</div>

		<div class="portfolio-bottom-z text-center"><a class="btn btn-primary email-us-btn" href="#" ymParam='PORTFOLIO_FOOTER_Z'><span class="icon icon-email"></span> оставить заявку</a></div>
		
</section>

<script type="text/javascript">
$(function() {
     $('#emailForm').submit( function() {
         yaCounter934261.reachGoal('callback_portfolio');
         yaCounter934261.reachGoal('all_callbacks');
         yaCounter934261.reachGoal('all_goals');
         return true;
     });

     $('#callForm').submit( function() {
         yaCounter934261.reachGoal('callback_contact');
         yaCounter934261.reachGoal('all_project_price_check');
         yaCounter934261.reachGoal('all_goals');
         return true;
     });
});
</script>


<?php get_footer(); ?>