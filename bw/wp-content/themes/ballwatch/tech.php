<?php
/*
Template name: Технологии
*/
the_post();
?>
<?php get_header('standart'); ?>
      <!-- History -->
      <section class="section section-lg bg-gray-lighter novi-background bg-cover text-center">
        <div class="container container-wide">
          <div class="row row-fix">
            <div class="col-sm-12 text-center">
              <h3><a href="o-kompanii/tehnologii">Технологии</a></h3>
            </div>
			  <? 
$args = array(
	'post_parent' => 94,
	'post_type'   => 'page', 
	'numberposts' => -1,
	'post_status' => 'publish' 
);
$children = get_children( $args );
?>
            <div class="col-xl-12">
                <div class="row">
<? foreach ($children as $child) { ?>
					<div class="col-12 col-md-6 col-lg-4" style="margin-top: 30px;">
					  <a class="gallery-item" href="<? echo get_permalink($child->ID); ?>">
						  <div class="gallery-item-image">
							<figure><img src="<?php echo get_field('обложка', $child->ID); ?>" alt=""/>
							</figure>
							<div class="caption">
							  <p class="caption-title"><? echo $child->post_title; ?></p>
							  <p class="caption-text"><? echo get_field('описание', $child->ID); ?></p>
							</div>
						  </div>
					  </a>
                  </div>
<? } ?>
				  </div>
			</div>
            </div>
          </div>
	</section>
<?php get_footer(); ?>
