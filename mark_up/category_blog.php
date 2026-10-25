<section class="section-blog">
    
</section>
<div class="container text-center blog-title">
   <h1 class="txt-black">БЛОГ</h1>
</div>
<section class="blog-container">
		<div class="container">
        

		<?php 
		$ii=1; $close=0;

        while ( have_posts() ) {
            the_post();

            if ($ii == 1) {
                echo '<div class="row">';
                $close = 0;
            }
            ?>

            <div class="col-md-4">
                <div class="blog-item-block grey-bg">
                    <a href="<?php the_permalink(); ?>" class="blog-item">
							<span class="blog-item-img">
								<?php the_post_thumbnail('blog_small'); ?>
							</span>
							<span class="blog-item-type">
							<?php
                            $id = get_the_ID();
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
                        <span class="blog-item-date"><?php the_time('j F y'); ?></span>
							  <span
                                  class="blog-item-text"><?php echo(get_post_meta($post->ID, 'short_description', true)); ?>
                              </span>
                    </a>
                </div>
            </div>


            <?php

            if ($ii == 3) {
                echo "</div>";
                $ii = 0;
                $close = 1;
            }
            $ii = $ii + 1;
        }?>
		<?php if($close==0){echo "</div>";} ?>

			<!--<div class="btn-container text-center"><a href="#" class="btn-yellow">БОЛЬШЕ</a></div>-->

		</div>
	
</section>