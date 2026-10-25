<?php
/*
Template name: Статьи и обзоры
*/
the_post();
?>
<?php get_header('standart'); ?>
      <section class="section section-lg section-2-columns bg-default novi-background bg-cover">
        <div class="container container-bigger">
          <div class="row row-50 justify-content-md-center align-items-lg-center justify-content-xl-between">
            <div class="col-md-12">
              <h3><?php the_title(); ?></h3>
              <div class="divider divider-default"></div>
              <p class="text-spacing-sm"><?php the_content(); ?></p>
            </div>
          </div>
        </div>
      </section>
<?php get_footer(); ?>
