<div class="container">
    <div>
        <div class="anim-block" data-anim-start="368" data-anim-end="0" data-anim-dir="left" data-anim-speed="0.3" style="margin:0 0 0 20px;">
            <? if(isset($showSlyderTitles)&& $showSlyderTitles) { ?>
                <div class="new_slider_subtitle"><?php echo get_field('slyder_title'); ?></div>
                <div class="new_slider_title">выашримдыав<?php the_title(); ?></div>
            <? }?>
            <?php the_content(); ?>
        </div>
    </div>
</div>
