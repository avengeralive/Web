<?php
/*
Template name: Новинки
*/
the_post();
?>
<?php get_header('standart'); ?>
      <section class="section section-lg bg-gray-lighter novi-background bg-cover text-center">
        <div class="container container-wide">
          <div class="row row-fix">
            <div class="col-sm-12">
              <h3><?php the_title(); ?></h3>
              <div class="divider divider-default"></div>
            </div>
          </div>
          <div class="row row-30 justify-content-sm-center">
            <div class="col-xl-12">
                <div class="row">
<? 
$catalogs = get_posts(array('post_type' => 'catalog', 'posts_per_page' => -1,
		'meta_query'	=> array(
				array(
						'key'		=> 'новинка',
						'value'		=> true,
						'compare'	=> '='
					)
		)
	));
?>
<? foreach ($catalogs as $child) { ?>
			<div class="col-md-6 col-lg-4 col-xl-3 col-xxl-3">
              <div class="product">
                <div class="product-image"><a href="product-page.html"><img src="<?php echo get_field('обложка', $child->ID); ?>" alt="" width="188" height="246"></a></div>
                <div class="product-title">
                  <h5><a href="<?php echo get_permalink($child->ID); ?>"><? echo $child->post_title; ?></a></h5>
                </div>
                <div class="product-button"><a class="button button-secondary button-nina" href="<?php echo get_permalink($child->ID); ?>">Подробнее</a></div>
              </div>
            </div>
<? } ?>
	</div>
	</div>
	</div>
		  </div>
      </section>
<?php get_footer(); ?>
