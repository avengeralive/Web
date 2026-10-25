<div class="new_slider_header">
    <div class="new_slider_controls">
        <div class="new_slider_pager"></div>
    </div>

    <div class="new_slider_carousel">
        <ul class="new_slider_block">
            <?

            $first = true;
            if(!$posts)
                $posts = get_posts(array(
                    'category_name'=>'header_slider',
                    'orderby'=>'date',
                    'order'=>'DESC',
                ));

            foreach($posts as $post) {
                setup_postdata($post);

                $bgImage = get_field('background');
                if( !empty($bgImage) ) {
                    $bgImage = $bgImage['url'];
                }else {
                    $bgImage = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                    $bgImage = $bgImage[0];
                }
                ?>
                <li class="new_slider_item <? if(!$first) {echo " hidden_item";}?>" style="background: url(<?php echo $bgImage; ?>) center center no-repeat; background-size:cover;">
                    <div class="new_slider_text_container" >
                        <? include(locate_template((isset($sliderContentTmpl)&&$sliderContentTmpl)?$sluderContentTmpl:'new_slider_content.php'));?>
                    </div>

                    <!--<div class="new_slider_bg_container" data-stellar-ratio="0.5">
                        <img src="<?php echo $bgImage; ?>" class="new_slider_bg_img">
                    </div>-->
                </li>
                <?$first = false;?>
            <?}?>
        </ul>
    </div>
</div>