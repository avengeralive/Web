<section class="<?=(isset($block_class)?($block_class):'')?>our-work">
    <div class="portfolio parallax">
        <div class="portfolio-carousel">
            <h2>наши работы</h2>
            <ul class="carousel-block no-list left-list">


                <?
                    foreach($posts as $post) {
                        setup_postdata($post); ?>
                        <?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');?>

                        <?php

                        $image = get_field('background');
                        $id = get_the_ID();
                        $permalink = (get_post_meta($post->ID, 'project_link', true));//get_permalink($id);

                        $review_text = get_post_meta($post->ID, 'review_text', true);
                        $review_image = get_post_meta($post->ID, 'review_image', true);
                        $review_name = get_post_meta($post->ID, 'review_name', true);

                        $review_image = wp_get_attachment_image_src($review_image, array(110, 110));

                        $reviewExist = 0;

                        if($review_text && $review_name && (!isset($noShowReviewInSlider) || $noShowReviewInSlider == 0)) $reviewExist = 1;
                        ?>

                        <li class="carousel-item block-with-bg bgsize<? if($reviewExist) echo " review-exist";?>" <?php if( !empty($image) ){echo 'style="background:url('.$image['url'].') scroll no-repeat top center; background-size:cover;"';}?> >
                            <div class="portfolio-carousel-text">
                                <div class="container">
                                    <div class="portfolio-carousel-arrows carousel-arrows">
                                        <a class="carousel-arrow a-left" href="#"><i></i></a>
                                        <a class="carousel-arrow a-right" href="#"><i></i></a>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="<?php echo $large_image_url[0]; ?>" alt="" style="max-height: 500px; margin-left:auto; margin-right:auto; display:block;" class="anim-block"  data-anim-dir="left" data-anim-start="368" data-anim-end="0">
                                        </div>

                                        <div class="col-md-6">
                                            <div class="anim-block" data-anim-start="368" data-anim-end="0" data-anim-dir="left" data-anim-speed="0.3">
                                                <div class="phone-icons">
                                                    <?php
                                                    if(get_post_meta($post->ID, 'type_apple', true)==1){echo'<span class="icon icon-apple"></span>';}
                                                    if(get_post_meta($post->ID, 'type_android', true)==1){echo'<span class="icon icon-android"></span>';}
                                                    if(get_post_meta($post->ID, 'type_windows', true)==1){echo'<span class="icon os-iconwindow"></span>';}
                                                    ?>
                                                </div>
                                                <h3><?php the_title(); ?></h3>
                                                <div class="carousel-item-text"><?php the_content(); ?></div>
                                                <p><a href="<?php echo (get_post_meta($post->ID, 'project_link', true)); ?>" class="btn btn-default">Посмотреть</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?


                                        if($reviewExist){
                                    ?>
                                    <div class="review-text review-text-portfolio">
                                        <div class="row">
                                            <div class="col-md-12">
                                               <div id="block1" class="review-content">
                                                    <div class="reviewer-content">
                                                        <div class="reviewer-photo"><img alt="" src="<?=$review_image[0]?>"></div>
                                                        <div class="overflow">
                                                            <div class="reviewer-text"><p><?=$review_text?></p>
                                                            </div>
                                                            <div class="reviewer-name"><?=$review_name?></div>
                                                        </div>
                                                    </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <? }?>
                                    
                                </div>
                            </div>

                        </li>

                    <?php } ?>
            </ul>
            <div class="portfolio-carousel-pager list-bullet text-center">
                 <ul class="list-bullet-control">
                    <li class="active"><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                </ul>
            </div>
        </div>
    </div>

</section>