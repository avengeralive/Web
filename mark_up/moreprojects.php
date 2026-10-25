<section>
   <div class="container">
        <div class="btn-project-portfolio text-center">
            <a href="#" class="btn btn-primary email-us-btn" ymParam='PORF_Z'><span class="icon icon-email"></span> оставить заявку</a>
        </div>
       
   </div>  
    <div class='grey-block2'>
        <div class='container'>
            <div class="nice_title">Другие проекты</div>

            <div class="row clearfix" id="portfolio-list"><!--portfolio-list-small-->
                <?php
                $mod = DATE('Y-m-d H:i:s', get_post_time());

                $id = get_the_ID();
                $cat = 0;
                foreach((get_the_category($id)) as $category) {
                    if(array_search($category->cat_ID, array(11, 12)) !== false) $cat = $category->cat_ID;
                   // echo $category->cat_ID.'<br>';
                   // var_dump(array_search($category->cat_ID, array(10, 11, 12)));
                }

              //  echo $cat;

                $onlyLater = function ( $where ) use ($mod)
                {
                    return 'IF(wp_posts.post_date > "'.$mod.'", 0, 1) ASC, post_date ASC';
                    /*echo $where;
                    $where =  $where . ' AND  wp_posts.post_date > "'.$mod.'" ';
                    echo $where;
                    return $where;*/
                };

                add_filter( 'posts_orderby' , $onlyLater );
         /*       add_filter( 'posts_clauses', function ($a) use($mod) {
              //      $a['where'] .= ' AND wp_posts.post_date >= DATE("'.$mod.'")';
                    var_dump($a);
                    return $a;
                });*/

                $params = array(
                    // 'category_name'=>'portfolio',
                    //'meta_key' => 'ordering',
                    'suppress_filters'=>false,
                    'posts_orderby' => 'rand()',//IF(post_date > "'.$mod.'", 0, 1), post_date DESC',
                    //'order' => 'ASC',
                    'posts_per_page' => 3,
                    'exclude'=>$id
                );

                if ($cat) {
                    $params['cat'] = $cat;
                } else {
                    $params['category_name'] = 'portfolio';
                }

                $posts = get_posts($params);

                remove_filter( 'posts_orderby' , $onlyLater );

                foreach ($posts as $post) {
                    setup_postdata($post);
                    ?>
                    <div class="col-md-4">
                        <a href="<?php the_permalink(); ?>" class="portfolio-item clmn">
            <span class="portfolio-item-img">
                <?php
                $image = get_field('main_image');
                $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                if (!empty($image)) {
                    echo '<img src="' . $large_image_url[0]/*$image['url']*/ . '" alt="'. get_the_title($post) . '" style="width: 300px; margin: 0px" />';
                    //	echo '<img src="'.$image['url'].'" alt="" style="width: 260px; margin: 20px" />';
                }
                ?>

            </span>
            <span class="portfolio-item-type">

            <?php
            $id = get_the_ID();
            foreach ((get_the_category($id)) as $category) {
                if ($category->slug == 'program') {
                    echo '<i class="type-app-icon"></i>';
                }
                if ($category->slug == 'game') {
                    echo '<i class="type-game-icon"></i>';
                }
                if ($category->slug == 'web') {
                    echo '<i class="type-web-icon"></i>';
                }
            }
            ?>

            </span>
                            <span class="portfolio-item-title"><b><?php the_title(); ?></b></span>
                        </a>
                    </div>
                <?
                }
                ?>
            </div>
        </div>
    </div>
</section>