<?php
/*
Template name: Каталог
*/
the_post();
?>
<?php get_header('standart'); ?>
      <section class="section section-lg bg-gray-lighter novi-background bg-cover text-center">
        <div class="container container-wide">
          <div class="row row-fix">
            <div class="col-sm-12">
              <h3>Каталог</h3>
              <div class="divider divider-default"></div>
            </div>
          </div>
          <div class="row row-30 justify-content-sm-center">
            <div class="col-xl-12">
                <div class="row">
<? 
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$catalogs = get_posts(array('post_type' => 'catalog', 'posts_per_page' => -1, 'tax_query' => array(
    array(
      'taxonomy' => 'catalog_category',
      'field' => 'id',
      'terms' => $term->term_id
    )
  )
	));
?>
<? foreach ($catalogs as $child) { ?>
			<div class="col-md-6 col-lg-4 col-xl-3 col-xxl-3" style="margin-bottom: 80px;">
              <div class="product">
                <div class="product-image"><a href="<?php echo get_permalink($child->ID); ?>"><img src="<?php echo get_field('день_фотка', $child->ID); ?>" class="day" alt="" width="188" height="246"><img src="<?php echo get_field('ночь_фотка', $child->ID); ?>" alt="" width="188" height="246" class="night"></a></div>
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
