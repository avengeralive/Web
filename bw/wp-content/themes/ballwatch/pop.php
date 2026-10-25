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
$catalogs = get_terms( 'catalog_category', array( 'hide_empty' => false ) );
?>
<? foreach ($catalogs as $child) { ?>
			<div class="col-12 col-md-6 col-lg-4" style="margin-top: 30px;">
            <a class="gallery-item" href="<? echo get_term_link($child->term_id); ?>">
              <div class="gallery-item-image">
              <figure><img src="<?php echo z_taxonomy_image_url($child->term_id); ?>" alt="" style="height: auto; width: 100%;"/>
              </figure>
              <div class="caption">
                <p class="caption-title"><? echo $child->name; ?></p>
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
