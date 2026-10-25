<?php
/*
Template Name: Страница "Блог"
*/
get_header();
require_once(locate_template('ImagePreview.php'));
?>
<section class="section-blog">  
</section>
<div class="container text-center blog-title">
<h1 class="txt-black">БЛОГ</h1>
</div> 
<section class="blog-container">
		<div class="container blog_wrapper" id="portfolio-list">


		<?php

        $params = array();
        parse_str($query_string, $params);
		
		$ii=1; $close=0;

        $page = 1;

        //if(array_key_exists('page',$params)) $page = str_replace('/', '', $params['page']);
        if(isset($_GET['pg'])) $page = $_GET['pg'];
        $offset = ($page-1) * 9;

        //var_dump($page, $offset);
        $posts = get_posts(array(
            'category_name'=>'blog',
            'orderby'=>'date',
            'order'=>'DESC',
            'posts_per_page'=>9,
            'offset'=>$offset
        ));

        echo '<div class="row clearfix">';

        foreach($posts as $post) {
            setup_postdata($post);

            $id = get_the_ID();

            $permalink = get_permalink($id); // get_post_id(), false );

            ?>
            <!-- <?= $id ?> -->

            <div class="col-md-4">
                <div class="blog-item-block grey-bg">
                    <a href="<?=$permalink ?>" class="blog-item clmn">
							<span class="blog-item-img">
								<?php
                                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'big');
                                if (!empty($image)) {
                                    $image[0] = str_replace(get_bloginfo('url').'/', '', $image[0]);
                                    $preview = ImagePreview::createPreview($image[0], 340, 240);
                                    echo '<img src="' . $preview . '" alt="' . get_the_title() . ' "/>';
                                }
                                ?>
							</span>
							<span class="blog-item-type">
							<?php


                            foreach ((get_the_category($id)) as $category) {
                                $idc = $category->cat_ID;
                                $link = get_category_link($idc);
                                $img_arr = get_field('categ_image', 'category_' . $idc);

                                if (!empty($img_arr['sizes']['thumbnail'])) {
                                    echo "<i class='icc' rubr='$idc' style='background:url(" . $img_arr['sizes']['thumbnail'] . ") no-repeat center center;'></i>";
                                }
                            }
                            ?>
							</span>
                        <span class="blog-item-title"><?php the_title(); ?></span>
                        <span class="blog-item-date"><?php the_time('j F Y'); ?></span>
                        <span
                            class="blog-item-text"><?php echo(get_post_meta($post->ID, 'short_description', true)); ?></span>
                    </a>
                </div>
            </div>


            <?php
        }
        ?>
		</div>

		
		<?php

            $info = get_category(2);
            $pagecount = ceil($info->category_count / 9);
            if($pagecount > 1) {
                ?><div style="text-align: center"><?
                for ($i = 1; $i <= $pagecount; $i++) {
                    ?><a class="btn-yellow<? if($i == $page) echo " active";?>" href="blog/?pg=<?= $i ?>"><?= $i ?></a> <?
                }
                ?></div><?
            }
         ?>
			

		</div>
	
</section>

<?php get_footer(); ?>