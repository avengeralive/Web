<?php
/*
Template Name: New.Infoshell "Blog"
*/
require 'index.header.php';

require_once(locate_template('ImagePreview.php'));
?>
<section>
    <div class="infoshel-container container">
        <p></p>
        <h2 class="infoshel-h2 text-center">Блог</h2>
        <p></p>
        <div class="row">


		<?php
        $params = array();
        parse_str($query_string, $params);
		
		$i=0;

        $page = 1;

        if(array_key_exists('page',$params)) $page = str_replace('/', '', $params['page']);
        $offset = ($page-1) * 9;

        //var_dump($page, $offset);
        $posts = get_posts(array(
            'category_name'=>'blog',
            'orderby'=>'date',
            'order'=>'DESC',
            'posts_per_page'=>9,
            'offset'=>$offset
        ));
        

        foreach($posts as $post) {
            setup_postdata($post);
            $id = get_the_ID();
            if(($i % 3) == 0) echo '<div class="col-12"><br/></div>';
            $i++;
            $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'blog_small');
            ?>
            <div class="col-4">
          <div class="infoshel-main-ourWork__slider-img">
        <a href="<?php the_permalink($id); ?>">
            <div class="infoshel-main-ourWork__slider-img-block">
                <img src="<?php echo $img[0]; ?>" alt="">
            </div>
            <div class="infoshel-main-ourWork__slider-img-text">
                <?php the_time('j F Y'); ?><br/>
                    <h4><?php the_title(); ?></h4>
                    <!--p><?php echo get_the_excerpt(); ?></p-->
                    <p></p>
                    <p><?php echo(get_post_meta($post->ID, 'short_description', true)); ?></p>
                    <p class="blog-item-type">
							<?php


                            foreach ((get_the_category($id)) as $category) {
                                $idc = $category->cat_ID;
                                $link = get_category_link($idc);
                                $img_arr = get_field('categ_image', 'category_' . $idc);

                                if (!empty($img_arr['sizes']['thumbnail']))
                                    echo "<i class='icc' rubr='$idc' style='background:url(" . $img_arr['sizes']['thumbnail'] . ") no-repeat center center;'></i>";
                            }
                            ?>
							</p>
            </div>
        </a>
        </div>
        </div>
            
        <?php } ?>
		</div>

        <div class="row clearfix"><br/></div>
		<div class="row clearfix">
		<?php
            $info = get_category(2);
            $pagecount = ceil($info->category_count / 9);
            if($pagecount > 1) {
                ?><div style="text-align:center;margin:auto"><?
                for ($i = 1; $i <= $pagecount; $i++) {
                    ?><a class="btn btn-warning <? if($i == $page) echo " active";?>" href="blog/<?= $i ?>"><?= $i ?></a> <?
                }
                ?></div><?
            }
         ?>

        </div>
        <div class="row clearfix"><br/><br/></div>
    </div>
</section>
<?php require 'index.footer.php'; ?>