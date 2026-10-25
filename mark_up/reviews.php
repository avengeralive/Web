<section class="clients-block">
    <div class="<? if(isset($blockclass)) {echo $blockclass; } else {echo "review"; }?>"  <? if(!isset($nostellar)) { echo 'data-stellar-background-ratio="0.5"'; }?> >
        <div class="container text-center">
            <h2>Отзывы клиентов</h2>
            <div class="review-block">
                <div class="row">

                    <div style="position:relative" id="reviews-carousel">
                        <div class="reviews-carousel-arrows carousel-arrows">
                            <a class="carousel-arrow a-left" href="#"><i></i></a>
                            <a class="carousel-arrow a-right" href="#"><i></i></a>
                        </div>

                        <ul class="reviews-carousel-list no-list left-list">

                            <?php
                            $tt=1;
                            ?>
                            <?php if ( $posts ) { ?>
                                <?php
                                foreach($posts as $post) {
                                    setup_postdata($post);
                                    ?>
                                    <li>
                                        <div data-id="#block<?php echo $tt; ?>"
                                           class="js-review-show reviewer-company clmn <?php if ($tt == 1) {
                                               echo 'active';
                                           } ?>" style="line-height: 152px; height: 171px!important; vertical-align:middle;">

                                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'small'); ?>
                                            <?php $alt = get_the_title($post); ?>
                                            <img src="<?php echo $image[0]; ?>" alt="<?=$alt?>" style="max-width: 70%; margin-left: 15%"><i></i>
                                        </div>
                                    </li>
                                    <?php
                                    $tt = $tt + 1;
                                    } ?>
                            <?php }; wp_reset_query();?>

                        </ul>
                        <!--/blog carousel-->
                    </div>
                </div>
                <div class="review-text">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            $tt=1;
                            //query_posts('category_name=testimonials&orderby=date&order=DESC');?>
                            <?php if ( $posts ) { ?>
                                <?php
                                foreach($posts as $post) {
                                    setup_postdata($post);
                                    $image = get_field('avatar'); ?>
                                    <div class="review-content" id="block<?php echo $tt; ?>" <?php if($tt==1){echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
                                        <div class="reviewer-content">
                                            <?php $alt = get_the_title($post); ?>
                                            <div class="reviewer-photo"><img src="<?php echo $image['url'];?>" alt="<?=$alt?>"></div>
                                            <div class="overflow">
                                                <div class="reviewer-text"><?php the_content(); ?></div>
                                                <div class="reviewer-name"><?php the_title(); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $tt=$tt+1;
                                }; ?>
                            <?php }; wp_reset_query();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>