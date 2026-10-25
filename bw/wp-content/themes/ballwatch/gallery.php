<?php
/*
Template name: Галерея
*/
the_post();
?>
<?php get_header('standart'); ?>
     <?php //var_dump(get_field('where_to_buy')); ?>
      <section class="section section-lg text-center bg-gray-lighter novi-background bg-cover">
        <div class="container-wide">
          <h3>Галерея</h3>
          <div class="divider divider-default"></div>
          <div class="isotope-wrap row row-0 row-fix justify-content-sm-center">
            <div class="col-xl-12">
              <div class="isotope isotope-default" data-isotope-layout="masonry" data-isotope-group="gallery-01" data-lightgallery="group">
                <div class="row">
<? $images = get_field('галлерея', 2);
foreach ($images as $key=>$image) { ?>
                  <div class="col-12 col-md-6 col-lg-4 isotope-item" data-filter="type 1"><a class="gallery-item" href="<? echo $image['фото']; ?>" data-lightgallery="item">
                      <div class="gallery-item-image">
                        <figure><img src="<? echo $image['фото']; ?>" alt="" width="570" height="790"/>
                        </figure>
                      </div></a>
                  </div>
<? } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
<?php get_footer(); ?>
